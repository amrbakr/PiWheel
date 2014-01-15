<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
  	{
		parent::__construct();
	}

	public function index()
	{	


		$this->load->model('course');
		$courses = $this->course->selectCoursesHomePage();
		$data['courses'] = $courses;
		$data['logged']  = false;
		if(isset($this->session->userdata['Username'])){
			$this->load->model('user');
			$user = $this->user->getUser($this->session->userdata['Username']);
			if($user->IsActive == 1)
				$data['active'] = true;
			$data['logged'] = true;
			$this->load->view('home',$data);
			return;
		}
		$this->load->view('home',$data);
	}

	public function logout(){
		$this->load->model('user');
		$this->user->preLogoutSettings($this->session->userdata['Username']);
		$this->session->sess_destroy();
		redirect('home');
	}

	public function login()
	{
		$this->setFormValidation_login();
		$this->load->model('course');
		$courses = $this->course->selectCoursesHomePage();
		$data['courses'] = $courses;
		$data['logged']  = false;
		if ($this->form_validation->run() !== FALSE){
			$data['login'] = true;
			$verifyUser = $this->user
				->verifyUser($this->input->post('username'),$this->input->post('password'));
			if(!$verifyUser){
				$data['login'] = false;
				$data['login_error'] = $this->lang->line('error_login_failed');;
				$this->load->view('home',$data);
			}else{
				$preLoginCheck = $this->user->preLoginCheck($verifyUser);
				if(!$preLoginCheck['result']){
					$data['login'] = false;
					$data['login_error'] = $preLoginCheck['message'];
					$this->load->view('home',$data);
					return;
				}else{
					$this->user->startSession($verifyUser,$this);
					
					if($verifyUser->RoleID == 3){
						redirect('profile/'.$verifyUser->Username);
					}
					if($verifyUser->RoleID == 2){
						//Student
						redirect('home');
					}
					redirect($_POST['currentURL']);
				}
				$this->load->view('home',$data);
			}
		}else{
			$data['login'] = false;
			$data['login_error'] = 'Invalid email or password';
			$this->load->view('home',$data);
		}
			
	}

	public function setFormValidation_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	public function setFormValidation_studentReg()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[50]|valid_email|is_unique[User.Username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[30]');
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[8]|max_length[30]');
		$this->form_validation->set_rules('gender', 'Gender', 'callback_genderCheck');
	}


	public function setFormValidation_instructorReg()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[50]|valid_email|is_unique[User.Username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[30]');
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[8]|max_length[30]|is_unique[User.Fullname]');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('About', 'Bio', 'trim|required|min_length[20]|max_length[1000]');
	}


	public function genderCheck($input)
	{
		if($input == "0"){
			$this->form_validation->set_message('genderCheck', 'Gender is required');
            return false;
		}else
		return true;
	}



	public function register()
	{	

		$type = $this->input->post('type');
		$this->load->model('course');
		$courses = $this->course->selectCoursesHomePage();
		$data['courses'] = $courses;
		$data['logged'] = false;
		if($type == 'student'){
			$this->setFormValidation_studentReg();
			if ($this->form_validation->run() == FALSE){
				$data['registerFailure'] = true;
				$data['registerTrial'] = true;
				$this->load->view('home',$data);
			}else{
				$this->load->model('user');
				$register = $this->user->studentReg($_POST);

				if($register){
						$verifyUser = $this->user->getUser($_POST['email']);
						$this->user->startSession($verifyUser,$this);
						redirect('home');
				}

				die();
				
			}

		}else{
			$this->setFormValidation_instructorReg();
			if ($this->form_validation->run() !== FALSE){
				if($_FILES['userfile']['name']){
					$UserID = uniqid();
					$fileExtension = strstr($_FILES['userfile']['name'], '.', false);
					$_FILES['userfile']['name'] = $UserID.$fileExtension;
					$path = $this->config->config['upload_path'];
					$this->config->set_item('upload_path',$path.'instructors/');
					$upload = uploadMe($this);
					if(isset($upload['upload_data'])){
						$this->load->model('user');
						$_POST['UserID'] = $UserID;
						$_POST['Image']  = $_FILES['userfile']['name'];
						if($this->user->instructorReg($_POST)){
							$verifyUser = $this->user->getUser($_POST['email']);
							$this->user->startSession($verifyUser,$this);
							redirect('home');
						}else{
							echo 'false';
						}
					}else{
						$data['registerInstructorFailure'] = true;
						$data['registerInstructorImageFailure'] = $upload['error'];
						$this->load->view('home',$data);
					}
					

				}else{
					$data['registerInstructorFailure'] = true;
					$data['registerInstructorImageFailure'] = 'Image is required';
					$this->load->view('home',$data);
				}

				
			}else{
				$data['registerInstructorFailure'] = true;
				$this->load->view('home',$data);
				
			}
		}
	}

	public function activateUser()
	{
		$token =  $this->uri->segment(3);
		$this->load->model('user');

		if($this->user->activateUser($token)){
			$Username = $this->user->getUsernameByToken($token);
			$user = $this->user->getUser($Username);
			$this->user->startSession($user,$this);
			redirect('home');
		}
	}


	public function setFormValidation_courseAdd()
	{
		$this->form_validation->set_rules('Name', 'Course Name', 'trim|required|min_length[5]|max_length[50]|is_unique[Course.Name]');
		$this->form_validation->set_rules('Brief', 'Course Description', 'trim|required|min_length[30]|max_length[1500]');
		$this->form_validation->set_rules('Price', 'Price', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('university_name', 'University Name', 'trim|required|min_length[3]|max_length[50]');
	}

	public function setFormValidation_uniAdd()
	{
		$this->form_validation->set_rules('newUniName', 'University Name', 'trim|required|min_length[4]|max_length[50]|is_unique[University.description]');
		
	}


	public function profile()
	{

		$data = array('logged'=>false);

		$this->load->model('user');
		$this->load->model('level');
		$this->load->model('University');
		$this->load->model('Course');



		$data['levels'] = $this->level->getLevels();
		$data['unis'] = $this->University->getUnis();

		//showThis($_POST);
		$data['operations'] = false;

		if(isset($_POST['submit_uni'])){
			$data['addCourseFailed'] = true;
			$data['operations'] = true;
			$this->setFormValidation_uniAdd();
			if ($this->form_validation->run() == FALSE){
				$data['addCourseFailed'] = true;
				$data['uniAddError'] = validation_errors();
			}else{

				if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "" ){
					$ImageID = uniqid();
					$fileExtension = strstr($_FILES['userfile']['name'], '.', false);
					$_FILES['userfile']['name'] = $ImageID.$fileExtension;
					$path = $this->config->config['upload_path'];

					$inputs = array(
						"description"=>$_POST['newUniName'],
						"About"=>$_POST['university_desc'],
						"ImageID"=>$ImageID,
						"Image"=>$_FILES['userfile']['name']);

					$this->config->set_item('upload_path',$path.'universities/');
					$upload = uploadMe($this);
				}else{
					$ImageID = "";
					$upload  = true;
					$inputs = array(
						"description"=>$_POST['newUniName'],
						"About"=>$_POST['university_desc']
					    );
				}
					// showThis($upload);
					if($upload){
						$this->load->model('University');
						if($this->University->insertUni($inputs)){
							$data['addUniSuccess'] = $inputs['description'];
							$data['unis'] = $this->University->getUnis();
							unset($data['uniAddError']);
						}else{
							echo 'insert failed';
						}
					}else{
						showThis($upload);
					}
			}
		}

		if(isset($_POST['submit']) || isset($_POST['submit_later'])){

			// showThis($_POST);
			// showThis($_FILES);
			$data['operations'] = true;
			 $_FILES['userfile'] = $_FILES['userfile1'];
			// die();
			$this->setFormValidation_courseAdd();
			if ($this->form_validation->run() == FALSE){
				// Validation Level 1 --> Check for the Name,Brief...
				if(!isset($_POST['Level'])){
					$data['levelFieldError'] = 'Level is Required';
				}
				$data['addCourseFailed'] = true;
			}else{
				// Validation Level 1 --> Check for the level
				if(!isset($_POST['Level'])){
					$data['levelFieldError'] = 'Level is Required';
					$data['addCourseFailed'] = true;
				}else{
					// Validation Level 3 --> Check for uploads
					$CourseID = uniqid();
					$fileExtension = strstr($_FILES['userfile']['name'], '.', false);
					$_FILES['userfile']['name'] = $CourseID.$fileExtension;
					$path = $this->config->config['upload_path'];
					$this->config->set_item('upload_path',$path.'courses/');
					$upload = uploadMe($this);
					//showThis($upload);
					if(isset($upload['upload_data'])){
						//showThis($_POST);
						if(isset($_POST['tags'])){
							$tagsOutput="";
							foreach($_POST['tags'] as $tag){
								$tagsOutput .= $tag.',';
							}
							$tagsOutput = rtrim($tagsOutput,',');
							$_POST['Tags'] = $tagsOutput;
							unset($_POST['tags']);
						}
							$_POST['Duration'] = $_POST['course_period'];
							unset($_POST['course_period']);
							$_POST['Image'] = $_FILES['userfile']['name'];
							unset($_POST['newUniName']);
							$uni = $this->University->getUniByName($_POST['university_name']);
							$_POST['UniveristyID'] = $uni->ID;
							$_POST['CourseID'] = $CourseID;
							$_POST['InstructorID'] = $this->session->userdata['UserID'];
							unset($_POST['university_name']);
							unset($_POST['university_desc']);
							if(isset($_POST['submit'])){
							$submit_type = $_POST['submit'];
							unset($_POST['submit']);
							$data['operations'] = true;
						}
						else{
							$data['operations'] = false;
							$submit_type = $_POST['submit_later'];
							unset($_POST['submit_later']);
						}
							
							
							$this->Course->insertCourse($_POST);
							
							if($submit_type == 'Save & Add Content'){
								$data['add_continue'] = true;
								$data['add_continue_courseID'] = $_POST['CourseID'];
								$data['add_continue_courseName'] = $_POST['Name'];

							}
							else
								$data['add_continue'] = false;
						
					}else{
						$data['addCourseFailed'] = true;
						$data['imageFailed'] = $upload['error'];
					}
					
				}
			}
		}

		if(isset($_POST['addChapter'])){
			$this->load->model('chapter');
			$this->chapter->saveChapter($_POST['chapterID']);
			$data['newChapter'] = true;
			
		}


		if(isset($_POST['courseDone'])){
			$courseName = rawurldecode($this->uri->segment(3));
			$course = $this->Course->selectCourseByName($courseName)[0];
			$courseID = $course->CourseID;
			$this->load->model('course');
			$this->course->courseDone($courseID);
		}

		if(isset($_POST['saveLesson']) || isset($_POST['saveLessonAndHide'])){
			//showThis($_POST);
			$_POST['chapter_name'] = trim($_POST['chapter_name']);

			if($_POST['chapter_name'] == "" || $_POST['lesson_name'] == "" || $_POST['content_type'] == ""){
				$data['addlessonFailed'] = true;
			}else{
				if(trim($_POST['chapterID']) == ""){
				    	$chapterID = uniqid();
				    	$_POST['chapterID'] = $chapterID;
				    }else{
				    	$chapterID = trim($_POST['chapterID']);
				    }
				    //Course_Chapter (CourseID,Name,ChapterID)
				    
				    $courseName = rawurldecode($this->uri->segment(3));
					$course = $this->Course->selectCourseByName($courseName)[0];
					$courseID = $course->CourseID;
					

					$inputs_Chapter = array("CourseID"=>$courseID,
						                    "Name" => $_POST['chapter_name'],
						                    "ChapterID" => $chapterID);

					// showThis($inputs_Chapter);
					// die();
					// 
					

					$this->load->model('chapter');

					$chapterInsert = $this->chapter->insertChapter($inputs_Chapter);
				$contentType = $_POST['content_type'];
				if($contentType == 'exam'){
					$questions = array();
					foreach ($_POST['question'] as $key => $value) {

					 	if($_POST['question_type'][$key] == 'regular-question')
					 		$type = "regular";
					 	else if($_POST['question_type'][$key] == 'mark-question')
					 		$type = "mark";
					 	else
					 		$type = "choice";

					 	$qText = $value;

					 	$answer = "";
					 	if($_POST['question_type'][$key] == 'mark-question')
					 		$answer = "true";
					 	else if($_POST['question_type'][$key] == 'choices-question'){
					 		$choicesAnswer = array();
					 		$qID = $key;
					 		foreach ($_POST['choices_'.$key] as $key => $value) {
					 			if(isset($_POST['choices_'.$qID.'_mark_'.$key]))
					 				$choicesAnswer[$value]="true";
					 			else
					 				$choicesAnswer[$value]="false";
					 		}
					 		$answer=$choicesAnswer;
					 	}

					 	$questions[]=array(
					 		"question"  => $qText,
					 		"type"  => $type,
					 		"answer"=> $answer
					 		);
					}

					if(trim($_POST['chapterID']) == ""){
				    	$chapterID = uniqid();
				    	$_POST['chapterID'] = $chapterID;
				    }else{
				    	$chapterID = trim($_POST['chapterID']);
				    }
				    //Course_Chapter (CourseID,Name,ChapterID)
				    
				    $courseName = rawurldecode($this->uri->segment(3));
					$course = $this->Course->selectCourseByName($courseName)[0];
					$courseID = $course->CourseID;
					

					$inputs_Chapter = array("CourseID"=>$courseID,
						                    "Name" => $_POST['chapter_name'],
						                    "ChapterID" => $chapterID);

					// showThis($inputs_Chapter);
					// die();

					$this->load->model('chapter');

					$chapterInsert = $this->chapter->insertChapter($inputs_Chapter);

					$data['lessonUpload'] = true;
					$data['lessonUploaded'] = $_POST['lesson_name'];
						// Insert Lesson (ChapterID,Name,Type,Content)
						// 
						$content = uniqid(); 
						$this->load->model('lesson');
						$inputs_Lesson=array(
							"ChapterID" => $chapterID,
							"Name"	    => $_POST['lesson_name'],
							"Type"		=> $_POST['content_type'],
							"Content"	=> $content,
							);

						createExamXMl($questions,$content);
						$this->lesson->insertLesson($inputs_Lesson);

						if(isset($_POST['saveLessonAndHide']))
							$data['hideLessonSection'] = true;
					//die();
					//showThis(createExamXMl($questions));
					//showThis($questions);
					//showThis($_POST);
			 		//die();
				}

				if($contentType == 'document' || $contentType == 'slides' || $contentType == 'video'){
					// Set config to allow pdf|ppt
				    $this->config->config['allowed_types'] = 'pdf|ppt';
				    $path = $this->config->config['upload_path'];
				    if($contentType == 'document')
				    $_FILES['userfile'] = $_FILES['userfile_document'];
				else
				    $_FILES['userfile'] = $_FILES['userfile_slides'];

				    
				    if(trim($_POST['chapterID']) == ""){
				    	$chapterID = uniqid();
				    	$_POST['chapterID'] = $chapterID;
				    }else{
				    	$chapterID = trim($_POST['chapterID']);
				    }
				    //Course_Chapter (CourseID,Name,ChapterID)
				    
				    $courseName = rawurldecode($this->uri->segment(3));
					$course = $this->Course->selectCourseByName($courseName)[0];
					$courseID = $course->CourseID;
					

					$inputs_Chapter = array("CourseID"=>$courseID,
						                    "Name" => $_POST['chapter_name'],
						                    "ChapterID" => $chapterID);

					// showThis($inputs_Chapter);
					// die();

					$this->load->model('chapter');

					$chapterInsert = $this->chapter->insertChapter($inputs_Chapter);
					
					if($contentType != 'video'){
						$lessonUploadPath = $path.'material/'.$chapterID.'_'.$_POST['lesson_name'];
						mkdir($lessonUploadPath);
						$this->config->config['upload_path'] = $lessonUploadPath;
					
						$upload = uploadMe($this);
					}else{
						$upload = array("upload_data"=>array());
						$upload["upload_data"]["full_path"] = $_POST['chapter_video'];
					}
					
					
					if(isset($upload['upload_data'])){
						// upload successfully
						$data['lessonUpload'] = true;
						$data['lessonUploaded'] = $_POST['lesson_name'];
						// Insert Lesson (ChapterID,Name,Type,Content)
						// 
						$this->load->model('lesson');
						$inputs_Lesson=array(
							"ChapterID" => $chapterID,
							"Name"	    => $_POST['lesson_name'],
							"Type"		=> $_POST['content_type'],
							"Content"	=> $upload['upload_data']['full_path'],
							);

						$this->lesson->insertLesson($inputs_Lesson);
						if(isset($_POST['saveLessonAndHide']))
							$data['hideLessonSection'] = true;

					}else{
						$data['lessonUpload'] = false;
					}
					
				}

				
				
			}
		
		}

		if(isset($this->session->userdata['Username'])){
			

			$Username   = $this->uri->segment(2);
			$courseName = rawurldecode($this->uri->segment(3));
			if($courseName != ""){
				$course = $this->Course->selectCourseByName($courseName)[0];
				
				$data['courseMaterial'] = $this->Course->selectCourseMaterial($course->CourseID);
				//die();
				$data['course'] = $course;
				if($course->Done == 1)
					$data['courseDone'] = true;
				else
					$data['courseDone'] = false;


				if(is_array($data['courseMaterial'])){
					foreach ($data['courseMaterial'] as $chapter) {
						$saved = $chapter->saved;
						if($saved == 0){
							$data['chapterSaved'] = false;
							$data['currentChapter'] = $chapter;
							break;
						}
					}
				}
				// $this->chapter->getCourseChapterCount($data['course']->CourseID);
				$data['operations'] = true;
				$data['add_continue'] = true;
				$data['add_continue_courseName'] = $courseName;
			}
			$instructor = $this->user->getUser($Username);
			$roleID     = $instructor->RoleID; 

			if($roleID === "2"){
				if($Username == $this->session->userdata['Username']){
					// Student accessing own profile
					$this->load->model('student');
					$this->load->model('course');
					$enrolledCourses = $this->student->getCourses($this->session->userdata['UserID']);
					$data['enrolledCourses'] = array();
					foreach ($enrolledCourses as $course) {
					  $courseInfo = $this->course->selectCourseByID($course->CourseID);
					  $data['enrolledCourses'][] = array("course"=>$courseInfo,"enrollment"=>$course);
					}
					$data['logged'] = true;
					$this->load->view('dashboard',$data);
					return;
				}else{
					$data['logged'] = true;
					$this->load->view('forbidden',$data);
					return;
				}
			}

			if($Username == $this->session->userdata['Username']){
				// Redirect to the Instructor Private Page
				$data['ownProfile'] = true;
				$data['logged'] = true;
				$data['user'] = $instructor;
				$this->load->model('chapter');
				$this->load->model('course');
				$Username =  $this->uri->segment(2);
				$user = $this->user->getUser($Username);
				$data['coursesDone']  = $this->course->myCoursesDone($user->UserID);
				$data['coursesSaved'] = $this->course->myCoursesSaved($user->UserID);
				
				if(isset($data['add_continue_courseID'])){
					showThis($data['add_continue_courseID']);
					showThis($data['add_continue_courseName']);
					$redirect_url = current_url().'/'.$data['add_continue_courseName'];
					redirect($redirect_url);
				}
				if(isset($data['courseDone'])){
					if($data['courseDone'] == true){
						$this->load->view('course_private',$data);
						return;
					}
				}

				$this->load->view('instructor_private',$data);
				return;
			}
			$user = $this->user->getUser($this->session->userdata['Username']);
			if($user->IsActive == 1){
				$data['active'] = true;
			}
			$data['logged'] = true;
			$data['user'] = $instructor;
			$this->load->view('instructor',$data);
			return;
		}else{

			$Username =  $this->uri->segment(2);
			$user = $this->user->getUser($Username);
			if($user->RoleID == 2){
				$this->load->view('forbidden',$data);
				return;
			}
			if($user->RoleID == 3){
				$data['user'] = $user;
				$this->load->view('instructor',$data);
				return;
			}
			
		}		
	}

	public function changePassword()
	{
		$this->load->model('user');

		$newPassword = $_POST['pass1'];
		$oldPassword = $_POST['pass3'];

		$oldPasswordDB = $this->session->userdata['Password'];

		$newPasswordDb = passwordEncryption($oldPassword,$this->session->userdata['Pass_Salt']);
		$passwordCheck = passwordChecks($newPassword,$oldPassword,$oldPasswordDB,$newPasswordDb);
		if($passwordCheck != false){

			$newGeneratedPassword = $passwordCheck['password'];
			$newGeneratedSalt     = $passwordCheck['salt'];

			$this->user->changePassword($this->session->userdata['UserID'],
			$newGeneratedPassword,$newGeneratedSalt);

			$this->load->model('notification');
			$this->notification->addNotification($this->session->userdata['UserID'],'Password has been changed successfully','Success');
			
			$url    = str_replace('PiWheel/','',$_POST['currentURl']);
			$this->user->startSession($this->user->getUser($this->session->userdata['Username']),$this);
			redirect($url);

		}else{
			echo 'false';
		}
	}

	public function changeEmail()
	{
		$this->load->model('user');
		$result = $this->user->changeEmail($this->session->userdata['UserID'],$_POST['newEmail']);
		$url    = str_replace('PiWheel/','',$_POST['currentURl']);
		$this->user->startSession($this->user->getUser($this->session->userdata['Username']),$this);
		$this->user->createToken($this->session->userdata['UserID'],$_POST['newEmail']);
		redirect($url);
	}

	public function course()
	{
		
		$this->load->model('course');
		$this->load->model('level');
		$this->load->model('user');
		$this->load->model('university');

		$courseName     =  rawurldecode($this->uri->segment(2));
		$course     	= $this->course->selectCourseByName($courseName)[0];
		

		$university     	  = $this->university->getUni($course->UniveristyID);
		$course->UniveristyID = $university;

		$instructor           = $this->user->getUserByID($course->InstructorID);
		$course->InstructorID = $instructor;

		$level  		= $this->level->getLevel($course->Level);
		$course->Level= $level->Name;

		$data['logged'] = false;
		$data['course'] = $course;

		if(isset($this->session->userdata['Username'])){
			$data['logged'] = true;
			if($this->userIsActive())
				$data['active'] = true;
			else
				$data['active'] = false;
		}

		$this->load->view('course',$data);
	}


	public function userIsActive()
	{
		$user = $this->user->getUser($this->session->userdata['Username']);
			if($user->IsActive == 1)
				return true;
			else
				return false;
			
	}


	public function userIsLogged()
	{
		if(isset($this->session->userdata['Username']))
			return true;

		return false;
	}



	
}