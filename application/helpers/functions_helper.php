<?php 




function showThis($field){
	echo '<pre>'.print_r($field,true).'</pre>';
}

function passwordEncryption($string,$random){
	$string = md5(md5($string).$random);
	return $string;
}

function languageCheck($lang){
	if($lang == 'english' || $lang == 'arabic')
		return true;
	else
		return false;
}

function successMessage($string){
	echo "
			<p style='color:green;font-style:oblique;'>
			{$string}
			</p>
	";	
}


function failureMessage($string){
	echo "
			<p style='color:red;font-style:oblique;'>
			{$string}
			</p>
	";	
}


function getSideBar(){
	include('application/views/sidebar.php');
}

function getHeader(){
	include('application/views/header.php');
}

function getSecondaryBar(){
	include('application/views/secondary_bar.php');
}

function getFooter(){
	include('application/views/footer.php');
}


	function createTable($data,$id,$edit,$delete,$path){
		
		echo '<div class="tab_container">
		<div id="tab1" class="tab_content">
		<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr>
			<th>Count</th> 
			';
			foreach ($data[0] as $key => $value) {
				echo '<th>'.$key.'</th>';
			}
			echo '<th>Actions</th>';
			echo '</tr> 
		</thead> 
		<tbody> 
			';
			$i=1;
			foreach ($data as $key => $value) {
				if($i % 2 == 0)
					$class = "even";
				else
					$class = "odd";
				echo '<tr class="'.$class.'">
				<td>'.$i.'</td>';$i++;

				//showThis($value);
				$ID =  $value->$id;
				//die();

				//var_dump($value);
				foreach ($value as $key => $value) {
					
					if(trim($key) == 'RoleID')
					echo '<td>'.getRole($value).'</td>';
				else if(trim($key) == $id)
					echo '<td>'.anchor($path.'/'.$ID,$value);
				else
					echo '<td>'.$value.'</td>';
				}
				if($edit){
					echo '<td>'.anchor($path.'/edit/'.$ID,'<img src="http://localhost/CodeIgniter_2.1.4/images/icn_edit.png">');
					if($delete)
					echo anchor($path.'delete/'.$ID,'<img src="http://localhost/CodeIgniter_2.1.4/images/icn_trash.png">');
					echo '</td>';
				}
				echo '</tr>';
			}
			//showThis($data);


			echo '
		</tbody> 
		</table>

		</div><!-- end of #tab2 -->
		
	</div><!-- end of .tab_container -->
	';
	}


function getRole($role){
	switch ($role)
{
case "1":
  return "Admin";
  break;
case "2":
  return "Student";
  break;
case "3":
  return "Instructor";
  break;
case "4":
return "Guest";
break;
default:
  echo "";
}
}


function getFields($role){
$role=getRole($role);
if($role == 'Admin'){
	$fields = array('Fullname','Username','IsActive','Birthdate','Gender','IsLoggedIn','LastLoginDate','StartDate');
}
if($role == 'Student'){
	$fields = array('Fullname','Username','Gender','Birthdate','IsActive','IsLoggedIn','LastLoginDate','StartDate');
}
if($role == 'Instructor'){
	$fields = array('Prefix','Title','Fullname','Username','Gender','Birthdate','IsActive',
					'IsLoggedIn','LastLoginDate','StartDate');
}
return $fields;
}


function viewForm($data,$fields,$id,$path){
echo '<div class="tab_container">
		<div id="tab1" class="tab_content">
		<table class="tablesorter" cellspacing="0"> 
		<thead>
		';

		foreach ($fields as $value) {

			echo '<tr><th>'.$value.'</th>';
			if($value == 'Gender'){
				if($data->$value == 1)
				echo '<td>Male</td></tr>';
				if($data->$value == 2)
				echo '<td>Female</td></tr>';
			}else if($value == 'IsActive'){
				if($data->$value == 1)
				echo '<td>Active</td></tr>';
				if($data->$value == 0)
				echo '<td>Not Active</td></tr>';
			}else if($value == 'IsLoggedIn'){
				if($data->$value == 1)
				echo '<td>Logged In</td></tr>';
				if($data->$value == 0)
				echo '<td>Not Logged In</td></tr>';
			}else if($data->$value== "0"){
				echo '<td>--</td></tr>';
			}else{
				echo '<td>'.$data->$value.'</td></tr>';
			}
			
		}

echo    '</thead>
<tr>
	<td>'.anchor($path.'edit/'.$data->$id,'<img src="../../images/icn_edit.png"> Edit ').'</td>
	<td>'.anchor($path.'delete/'.$data->$id,'<img src="../../images/icn_trash.png"> Delete ').'</td>
</tr>
		</table>
		</div>
	</div> 
			';
}


function editForm($data,$fields,$id,$path){
echo '<div class="tab_container">
		<div id="tab1" class="tab_content">
		'.form_open($path.$data->$id).'
		<table class="tablesorter" cellspacing="0"> 
		<thead>
		';

		foreach ($fields as $value) {

			if(isset($_POST[$value]))
				$thisValue = $_POST[$value];
			else
				$thisValue = $data->$value;

			echo '<tr><th>'.$value.'</th>';

			if($value == 'Gender'){
				echo '
					<td><select name="'.$value.'">
						<option value="0"></option>';
						if($data->Gender == 1)
							echo '<option selected="selected" value="1">Male</option>';
						else
							echo '<option value="1">Male</option>';
						
							if($data->Gender == 2)
							echo '<option selected="selected" value="2">Female</option>';
						else
							echo '<option value="2">Female</option>';
						
					echo '
					</select></td></tr>
				';
			}else if($value == 'IsActive' || $value == 'IsLoggedIn'){
				if(isset($_POST[$value]) || $data->$value == 1 )
				echo '<td><input class="checkbox" checked="checked" value="1" type="checkbox" name="'.$value.'" ></td></tr>"';
				else	
				echo '<td><input class="checkbox" type="checkbox" name="'.$value.'" ></td></tr>"';
			}else if($value == 'Birthdate'){
				echo '<td><input type="text" class="datepicker" name="'.$value.'" value="'.$thisValue.'" ></td></tr>';
			}else if($value == 'LastLoginDate'){
				echo '<td><input type="text" class="datetimepicker_last" name="'.$value.'" value="'.$thisValue.'" ></td></tr>';
			}else if($value == 'StartDate'){
				echo '<td><input type="text" class="datetimepicker_start" name="'.$value.'" value="'.$thisValue.'" ></td></tr>';
			}else{
				echo '<td><input type="text" name="'.$value.'" value="'.$thisValue.'" ></td></tr>';
			}
			
			
		
			
		}

echo    '</thead>
			<tr>
				<td><input type="submit" name="Submit" value="Submit"></td>
				<td><input type="submit" name="Submit" value="Cancel"></td>
			</tr>
			<tr><td><td><input type="hidden" name="edit" value="'.$data->$id.'"></td></td></tr>
		</table>
		</form>
		</div>
	</div> 
			';
}


function modifyDate($date){
date_default_timezone_set("UTC");
return date('Y-m-d', strtotime(str_replace('-', '/',$date)));
}

function modifyDateTime($date){
date_default_timezone_set("UTC");
return date('Y-m-d H:i:s', strtotime(str_replace('-', '/',$date)));
}


function getCourseFields(){
return array('Name','InstructorID','UniveristyID','Brief','Tags','Rating','Level','Duration','Price','Image','StartDate','EndDate');
}


function uploadMe($object){
$object->upload->initialize($object->config->config);
if (!$object->upload->do_upload())
	{
		$error = array('error' => $object->upload->display_errors());
		return $error;
	}
	else
	{
		$data = array('upload_data' => $object->upload->data());
		return $data;
		
	}
}


function modifyBirthDate($day,$month,$year)
{	
	$date = $year.'-'.$month.'-'.$day;
	return $date;
}

function saltGenerator()
{
	return random_string();
}


function tokenGenerator($email)
{
	return sha1(mt_rand(10000,99999).time().$email);
}


function sendMail()
{
	// This function will be used to handle outgoing emails
}


function createExamXMl($questions,$content)
{
	    $doc = new DOMDocument('1.0');
		// we want a nice output
		$doc->formatOutput = true;
		$main_root = $doc->createElement('exam');
		$main_root = $doc->appendChild($main_root);

	foreach ($questions as $question) {
		

		$root = $doc->createElement('question');
		$root = $main_root->appendChild($root);

		$title = $doc->createElement('text');
		$title = $root->appendChild($title);
		$text = $doc->createTextNode($question['question']);
		$text = $title->appendChild($text);

		$type = $doc->createElement('type');
		$type = $root->appendChild($type);
		$type_text = $doc->createTextNode($question['type']);
		$type_text = $type->appendChild($type_text);

		if(is_array($question['answer'])){
			$answers = $doc->createElement('answers');
			$answers = $root->appendChild($answers);
			foreach ($question['answer'] as $key => $value) {

				 $answer = $doc->createElement('answer');
				 $answer = $answers->appendChild($answer);
				 $answer->setAttribute("mark", $value);
				 $answer_text = $doc->createTextNode($key);
				 $answer_text = $answer->appendChild($answer_text);

			}
		}else{
			$answer = $doc->createElement('answer');
			$answer = $root->appendChild($answer);
			$answer_text = $doc->createTextNode($question['answer']);
			$answer_text = $answer->appendChild($answer_text);

		}

	}

	
	$doc->save("application/uploads/exams/".$content.".xml");

}

function readXMLExam($examID)
{	
	$path = base_url()."application/uploads/exams/".$examID.'.xml';
	$xml  =simplexml_load_file($path);
	return $xml;
}

function editXMlExam($examID)
{
	// This function will used for editing the exam after saving it to the .xml file
}


function passwordChecks($newPassword,$oldPassword,$oldPasswordDB,$newPasswordDB)
{	

	if(strlen($newPassword) < 8){
		return false;
	}

	if(trim($oldPasswordDB) != trim($newPasswordDB)){
		return false;
	}



	$newSalt = saltGenerator();
	$newGeneratedPassword = passwordEncryption($newPassword,$newSalt);

	$output['password'] = $newGeneratedPassword;
	$output['salt']     = $newSalt;
	return $output;
}

function getLevel($levelID)
{
	switch ($levelID) {
		case '1':
			return 'Hobby';
			break;
		case '2':
			return 'Beginner';
			break;
		case '3':
			return 'Intermediate';
			break;
		case '4':
			return 'Professional';
			break;
		case '5':
			return 'Genius';
			break;
		
		default:
			# code...
			break;
	}
}












?>