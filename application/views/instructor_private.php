<?php 
    include('includes.php');
    include('header.php');
    include('notification.php');

    // showThis($courseMaterial);
    // die();
    // showThis($currentChapter->ChapterID);
    //showThis($courseMaterial);
    //showThis($course);
    //showThis($_POST);
    //showThis($add_continue_courseID);
    //if(isset($lessonUploaded)){
    //showThis($lessonUploaded);
    //showThis($lessonUpload);
    //showThis($_POST);
    // }
 ?>


<div class="container clearfix">

<section class="dash-head clearfix">
	<span class="left">Current Balance: $1,350</span>
	<span class="form-btn left red">Withdraw</span>
	<span class="right">Ever Earned: $120,230</span>
</section>

<div class="dashboard">
	<div class="dash-left">

		<h2 class="col-title">Required Action</h2>

		<table class="dash-table">
			<tr>
				<th>Course Name</th>
				<th>Student Name</th>
				<th>Action required</th>
			</tr>
			<tr>
				<td>The Course Name</td>
				<td>Ahmed Gumaa</td>
				<td>Correct Exam</td>
			</tr>
			<tr>
				<td>The Course Name</td>
				<td>Ahmed Gumaa</td>
				<td>Correct Exam</td>
			</tr>
			<tr>
				<td>The Course Name</td>
				<td>Ahmed Gumaa</td>
				<td>Correct Exam</td>
			</tr>
		</table>

		<a rel="nofollow" href="javascript:void(0);" class="expand-url">Archive of done actions +</a>

		<table class="dash-table">
			<tr>
				<th>Course Name</th>
				<th>Action Done</th>
				<th>Student Name</th>
				<th>Date</th>
			</tr>
			<tr>
				<td>The Course Name</td>
				<td>Sign Certification</td>
				<td>Mohamed J</td>
				<td>Yesterday</td>
			</tr>
			<tr>
				<td>The Course Name</td>
				<td>Corret Exam</td>
				<td>Ahmed Gumaa</td>
				<td>12/1/2013</td>
			</tr>
		</table>

		<br>
		<section class="std-courses">
			<ul>
			<?php foreach ($coursesDone as $course): ?>
				<li>
					<a href="<?php echo base_url().'profile/'.$user->Username.'/'.$course->Name; ?>" class="course-thumb">
						<img src="<?php echo base_url().'application/uploads/courses/'.$course->Image; ?>" alt="<?php echo $course->Name; ?>">
						<span class="course-cover"></span>
						<span class="course-actions">
							<span class="dash-icon icon-group"><?php echo count($course->subscribers); ?></span>
							<span class="dash-icon icon-value"><?php echo $course->Price; ?></span>
						</span>
						<span class="rounded-num"><span><?php echo $course->Level; ?></span></span>
					</a>
					<span class="static-stars small blue-stars star-<?php echo $course->Rating; ?>"></span>
				</li>
			<?php endforeach ?>
				<!-- <li>
					<a href="javascript:void(0);" class="course-thumb">
						<img src="images/courses/instructor/1.jpg" alt="Course Name">
						<span class="course-cover"></span>
						<span class="course-actions">
							<span class="dash-icon icon-group">130</span>
							<span class="dash-icon icon-value">2000</span>
						</span>
						<span class="rounded-num"><span>3</span></span>
					</a>
					<span class="static-stars small blue-stars star-3"></span>
				</li> -->
			</ul>
		</section>

		<section class="large-btns">
			<ul>
			<?php if (!isset($add_continue)): ?>
				<li data-section="add-course"  data-siblings="dash-section" class="add"><a href="javascript:void(0);" rel="nofollow"></a></li>
			<?php endif ?>
			<?php foreach ($coursesSaved as $course): ?>
			<li style="border-top:1px solid white;" data-section="add-chapter" data-siblings="dash-section" class="continue">
				<a href="<?php echo base_url().'profile/'.$user->Username.'/'.$course->Name; ?>" 
					style="background-image:url('');color:white;text-align: center;font-size:20px;" rel="nofollow">
					<p style="padding-top:20%">Continue Adding Course : </p>
					<?php echo $course->Name; ?>
				</a>
			</li>	
			<?php endforeach ?>
				
			</ul>
		</section>

	</div> <!-- .dash-left -->
	<div class="dash-right">

		<h2 class="col-title">Work Space</h2>
		
		<div class="dash-section <?php if(!$operations) echo 'active'; ?>">
			<div class="dash-image">
				<img src="<?php echo base_url(); ?>application/images/course-notes.jpg" alt="">
			</div>
		</div>

		<div id="add-course" class="dash-section <?php if(isset($addUniSuccess) || isset($addCourseFailed)) echo 'active'; ?>">
			<form onsubmit='
			
			if($("#newUniName").is(":visible")){
				if($("#submit_uni").attr("clicked"))
				return true;
				else{
					alertify.error("Save The Univeristy First");
					return false;
					}
				}else{
					return true;
				}

			

			' action="" id="addCourseForm" method="post" class="post-form no-round" enctype="multipart/form-data">
				<div class="form-row text-input">
					<h3 class="form-section">Adding New Course</h3>
				</div>
				<div class="form-row text-input">
					<h3 class="form-section">General Info</h3>
					<label class="form-label" for="course_name">Course Name <span>*</span></label><br>
					<input type="text" id="course_name" name="Name" value="<?php echo (isset($_POST['Name']))? $_POST['Name'] : "";  ?>"><br>
					<?php 
                    $errortext = form_error('Name');
                    if (isset($addCourseFailed) && $errortext != ""): ?>
                    <h4 class="alert_error" style="color:red"><?php echo form_error('Name');  ?></h4>
                    <?php endif ?>
				</div>
				<div class="form-row textarea question">
					<label class="form-label" for="course_desc">Course Description <span>*</span></label><br>
					<table>
						<tr>
							<td>
								<textarea id="addCourseTextarea" name="Brief" cols="30" rows="10" class="fl autogrow">
					                    <?php echo (isset($_POST['Brief']))? $_POST['Brief'] : "";  ?>
								</textarea></br>
							</td>
						</tr>
						<tr>
							<td>
								<?php 
                    $errortext = form_error('Brief');
                    if (isset($addCourseFailed) && $errortext != ""): ?>
                    <h4 class="alert_error" style="color:red"><?php echo form_error('Brief');  ?></h4>
                    <?php endif ?>
							</td>
						</tr>
					</table>
					
					
				</div>
				<div class="form-row text-input">
					<!-- <h3 class="form-section">Lesson 1</h3> -->
					<label class="form-label" for="course_tags">Tags</label><br>
					<!-- <input type="text" id="course_tags" name="course_tags"><br> -->
					<select id="course_tags" name="tags[]" data-placeholder="Choose tags..." style="width:230px;" multiple class="chzn-select">
					<option></option>
					<?php 
						$tags = array("Petroleuom","Mechanics","Art","Rockets","Webdesign","Graphic","Math","Architecture");
					 ?>
					 <?php foreach ($tags as $value): ?>
					 	<option value="<?php echo strtolower($value); ?>"><?php echo $value; ?></option>
					 <?php endforeach ?>
					</select><br>
					<!-- <p class="form-p">Seperate each tag by a comma,</p> -->
				</div>
				<div class="form-row input-checkbox">
					<label class="form-label" for="course_period">Period <span>*</span></label><br>
					<div id="course-period-range" class="noUiSlider"></div>
					<span data-range="<?php echo (isset($_POST['course_period']))? $_POST['course_period'] : "30";  ?>"></span>
				</div>
				<br>
				<div class="form-row input-checkbox">
					<label class="form-label" for="course_level">Level <span>*</span></label><br>
					 <?php 
					 	if(isset($_POST['Level'])){
					 		$levelValue = $_POST['Level'];
					 	}
					 	else
					 		$levelValue = 0; 
					 ?>

					 <?php foreach ($levels as $level): ?>
					 <?php 
					 	if($levelValue == $level->ID)
					 		$text = 'checked="checked"';
					 	else
					 		$text ='';
					  ?>
					 <label class="jCheckbox">
						<input type="radio" name="Level" value="<?php echo $level->ID; echo $text; ?>">
						<span class="checkbox-icon"></span>
						<?php echo $level->Name; ?>
					</label><br> 
					 
					 <?php endforeach ?>
					 <?php if(isset($levelFieldError)): ?>
	                    <h4 class="alert_error" style="color:red"><?php echo $levelFieldError;  ?></h4>
                    <?php endif ?>
				</div>
				<div class="form-row input-price">
					<label class="form-label" for="course_price">Price <span>*</span></label><br>
					<input type="text" id="course_price" name="Price" value=" <?php echo (isset($_POST['Price']))? $_POST['Price'] : "";  ?>"> &nbsp;<span class="form-text">$</span><br>
					<?php 
                    $errortext = form_error('Price');
                    if (isset($addCourseFailed) && $errortext != ""): ?>
                    <h4 class="alert_error" style="color:red"><?php echo form_error('Price');  ?></h4>
                    <?php endif ?>
					<p class="form-p">15% PiWheel Fees, You’ll earn: $xxx per course subscribtion</p>
				</div>

				<br>
				<div class="form-row text-input">
					<h3 class="form-section">University Info</h3>
					<label class="form-label" for="university_name">University Name<span>*</span></label><br>
					<select id="university_name" name="university_name"  style="width:230px;" >
					<option></option>
					<?php 
						$uniValue = $_POST['university_name'];
						if(isset($addUniSuccess)){
							$uniValue = $addUniSuccess;
						}
					 ?>
					<?php foreach ($unis as $uni): ?>
						<?php 
							if($uniValue == $uni->description){
								$text = 'selected';
							}
							else
								$text = '';
						 ?>
						<option value="<?php echo $uni->description; ?>" <?php echo $text; ?>><?php echo $uni->description; ?></option>
					<?php endforeach ?>
					<option value="Other">other</option>
					</select>
					<?php 
                    $errortext = form_error('university_name');
                    if (isset($addCourseFailed) && $errortext != ""): ?>
                    <h4 class="alert_error" style="color:red"><?php echo form_error('university_name');  ?></h4>
                    <?php endif ?>
				</div>
				<div class="UniDiv">
				<?php if (isset($uniAddError)): ?>
					<input type="hidden" id="uniAddFailed">
				<?php endif ?>
				
				<?php if (isset($addUniSuccess)): ?>
					<input type="hidden" id="uniAddSuccess">
				<?php endif ?>
				<div class="form-row upload-middle input-file">
					<label class="form-label" for="newUniName" >New University Name<span>*</span></label></br>
					<input type="text" id="newUniName" name="newUniName" value="<?php echo set_value('newUniName'); ?>">
					<?php 
                    $errortext = form_error('newUniName');
                    if (isset($uniAddError) && $errortext != ""): ?>
                    <h4 class="alert_error" style="color:red"><?php echo form_error('newUniName');  ?></h4>
                    <?php endif ?>
				</div>
				<div class="form-row upload-middle input-file">
					<label for="imageUpload" class="form-btn blue">Upload University Photo</label>
						<span class="filename"></span>
						<input type="file" name="userfile" id="imageUpload" class="unvisible" accept="image/jpeg,image/gif,image/png"><br>

				</div>
				<div class="form-row textarea question" style="margin-top:10px;">
					<label class="form-label" for="university_desc">University Description</label><br>
					<textarea id="newUniDesc" name="university_desc" cols="30" rows="10" class="fl autogrow">
						<?php 
							if(isset($_POST['university_desc'])){
							$uniDescText = $_POST['university_desc'];
							if($uniDescText)
								echo $uniDescText;
						}
						?>

					</textarea>
				</div>
				<br>
				<input type="submit" onclick="addCourseForm.submit()" name="submit_uni" id="submit_uni" value="Save University" class="form-btn red w60- padding submit">
				</div>

				<div class="form-row textarea custom-upload">
					<label class="form-label" for="course_image">Upload Course Image <span>*</span></label><br>
					<img src="<?php echo base_url(); ?>application/images/course-perview.jpg" alt="" class="upload-preview fl">
					<div class="form-row upload-middle input-file">
						<label for="course_image_file" class="form-btn blue">Upload</label>
						<span class="filename"></span>
						<input type="file" name="userfile1" id="course_image_file" class="unvisible" accept="image/jpeg,image/gif,image/png"><br>
					</div>
					<p class="form-p">Course image will be the first thing your student will see, please choose it to be as attractive and awsome<br>
					as possible, it’s the thing that will make it standout of the rest of the courses, no pixelation please only<br>
					high resolution images<br>
					Must be: Width 550 px hight: 400px<br></p>
				</div>

				<div class="form-row submit">
					<div class="left clearfix">
						<!-- <a rel="nofollow" href="javascript:void(0);" class="form-btn red w60- padding submit">Save &amp; Continue Later</a> -->
						<input type="submit" name="submit_later" value="Save &amp; Continue Later" class="form-btn red w60- padding submit courseSubmit">
						<input type="submit" name="submit" value="Save &amp; Add Content" class="form-btn red w60- padding submit courseSubmit">
						<!-- <a rel="nofollow" href="" class="form-btn red w60- padding submit">Save &amp; Add Content</a> -->
					</div>
				</div>
			</form>
		</div> <!-- #add-course -->

		<div id="add-chapter" class="dash-section <?php if(isset($add_continue) && $add_continue == true) echo 'active'; ?>">
			<form action="" method="post" class="post-form no-round" enctype="multipart/form-data">
				<div class="form-row text-input">
					<h3 class="form-section">Adding New Chapter</h3>
				</div>
				<div class="form-row text-input">
					<h3 class="form-section">Chapter 1</h3>
					<?php 
					if (isset($addlessonFailed)): ?>
						<h4  class="alert_error" style="color:red;">
							Kindly fill the required fields		
						</h4>
					<?php endif ?>
					<label class="form-label" for="chapter_name">Chapter Name <span>*</span></label><br>
					<table>
						<tr>
							<td>
								<input type="text" id="chapter_name" class="checkMe" name="chapter_name"
									data-table="Course_Chapter" 
									data-url="<?php echo base_url(); ?>" 
									data-column="Name" data-id="CourseID" 
									data-text="Chapter Name" 
									data-id-value="<?php echo $course->CourseID; ?>"
									<?php if (isset($lessonUploaded)): ?>
									   	value="<?php echo $_POST['chapter_name']; ?>" disabled
									<?php endif ?> 
									<?php if (isset($chapterSaved) && !$chapterSaved): ?>
									   	value="<?php echo $currentChapter->Name; ?>" disabled
									<?php endif ?>  
								autofocus>
									<?php if (isset($lessonUploaded)): ?>
										<input type="hidden" name="chapter_name" value="
										<?php echo $_POST['chapter_name'];  ?>
										">
									<?php endif ?>

									<?php if (isset($chapterSaved) && !$chapterSaved): ?>
									   	<input type="hidden" name="chapter_name" value="
										<?php echo $currentChapter->Name;  ?>
										">
									<?php endif ?> 

							</td>
							<td>
								<label id="chapter_name_success" style="display:none">
									<img class="succes_pointer" src="<?php echo base_url();?>application/myImages/success.png" alt="">
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<h4 id="chapter_name_error" class="alert_error" style="color:red;display:none">
									
								</h4>
							</td>
						</tr>
					</table>
				

				<div class="lessons-nav" style="">
				<?php if (isset($courseMaterial) && is_object($courseMaterial[0]) && isset($currentChapter)): ?>
					<ul>
					<?php foreach ($courseMaterial as $chapter): ?>
							<?php if ($chapter->ChapterID == $currentChapter->ChapterID): ?>
								<?php foreach ($chapter->lessons as $lesson ): ?>
									<li id="<?php echo 'lesson_'.$lesson->ID; ?>">
										<a href=""><?php echo $lesson->Name; ?></a>
										<span class="action-icons">
											<!-- <span class="okay-icon"></span> -->
											<a href="javascript:void(0);" id="<?php echo $lesson->ID; ?>" data-url="<?php echo base_url(); ?>" title="Delete Lesson!"  class="error-icon deleteLessonAction"></a>
										</span>
									</li>
								<?php endforeach ?>
							<?php endif ?>
		
							
						
					<?php endforeach ?>
					</ul>
				<?php endif ?>
					
				</div>	
					
				</div>
				
				
		    	<?php if (isset($hideLessonSection)): ?>
		    		<input type="hidden" id="hideLessonSection" value="true">
		    	<?php endif ?>


				<div class="form-row">
						<a class="add-lesson" style="display:none;" rel="nofollow" href="javascript:void(0);"><span>+</span> Add Lesson</a><br>
						<!-- <a class="add-lesson" rel="nofollow" href=""><span>+</span> Add Lesson</a> -->
				</div>
	
				<div class="form-row text-input lessonSection">
					<h3 class="form-section">Lesson</h3>
					<label class="form-label" for="lesson_name">Lesson Name <span>*</span></label><br>
					<table>
						<tr>
							<td>
								<input type="text" id="lesson_name" class="checkMe" name="lesson_name"
									data-table="Chapter_Lesson" 
									data-url="<?php echo base_url(); ?>" 
									data-column="Name" data-id="ChapterID" 
									data-text="Lesson Name" 
									data-id-value="<?php ?>" 
								>
							</td>
							<td>
								<label id="lesson_name_success" style="display:none">
									<img class="succes_pointer" src="<?php echo base_url();?>application/myImages/success.png" alt="">
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<h4 id="lesson_name_error" class="alert_error" style="color:red;display:none">
									
								</h4>
							</td>
						</tr>
					</table>
					
				</div>
				
				<div class="form-row select lessonSection">
					<label class="form-label" for="content_type">Content Type</label><br>
					<input type="hidden" name="count" id="questions_count" value="1">
					<select class="content_type" name="content_type">
						<option value="">Select content type:</option>
						<option value="document">Documents</option>
						<option value="slides">Slides</option>
						<option value="video">Video</option>
						<option value="exam">Exam</option>
					</select>
				</div>

				<br>
				<div class="content-type content-document">
					<div class="form-row textarea custom-upload">
						<label class="form-label" for="slides">Upload Documents: (.pdf or .ppt) format</label><br>
						<img src="<?php echo base_url(); ?>application/images/course-perview.jpg" alt="" class="upload-preview fl">
						<div class="form-row upload-middle input-file">
							<label for="documents_files" class="form-btn blue">Upload</label>
							<span class="filename"></span>
							<input type="file" id="documents_files" name="userfile_document" class="unvisible" accept="application/pdf,application/vnd.ms-powerpoint">
						</div>
					</div>
					<br>
				</div>
				<div class="content-type content-slides">
					<div class="form-row textarea custom-upload">
						<label class="form-label" for="slides">Upload Slides: (.pdf or .ppt) format</label><br>
						<!-- <textarea id="slides" name="slides" cols="30" rows="10" class="fl"></textarea> -->
						<img src="<?php echo base_url(); ?>application/images/course-perview.jpg" alt="" class="upload-preview fl">
						<div class="form-row upload-middle input-file">
							<label for="slides_files" class="form-btn blue">Upload</label>
							<span class="filename"></span>
							<input type="file" id="slides_files" name="userfile_slides" class="unvisible" accept="application/pdf,application/vnd.ms-powerpoint">
						</div>
					</div>
					<br>
				</div>
				<div class="content-type content-video">
					<div class="form-row text-input">
						<h3 class="form-section">Video</h3>
						<label class="form-label" for="chapter_video">Video URL</label><br>
						<input type="text" name="chapter_video" style="width: 450px;">
					</div>
					<br>
				</div>
				<div class="content-type content-exam">

					<div class="q-section">
						<div class="form-row text-input">
							<h3 class="form-section">Exam</h3>
							<label class="form-label" for="question_type">Question 1</label><br>
							<p class="form-p">Question Type<br>(If all questions are multiple choice and write or wrong, exam will be corrected automatically)</p>
							<select class="question_type" name="question_type[]">
								<option value="">Please select question type:</option>
								<option value="regular-question">Regular Question</option>
								<option value="mark-question">Right/Wrong Question</option>
								<option value="choices-question">Multiple Choices</option>
							</select>
						</div>
						<div class="questions-box">
						</div>
					</div>

					<div class="form-row">
						<a class="add-question" rel="nofollow" href="javascript:void(0);"><span>+</span> Add Question</a><br>
						<!-- <a class="add-lesson" rel="nofollow" href=""><span>+</span> Add Lesson</a> -->
					</div>
				</div>

				<div class="form-row submit">
				<input type="hidden" name="LessonCount" value="
						<?php
						if(isset($_POST['lessonCount']))
							echo $_POST['lessonCount'];
						else
							echo '1';
						?>
						">
						<input type="hidden" name="chapterID" value="
						<?php
						if(isset($newChapter)){
							echo '';
						}else{
							if(isset($_POST['chapterID']))
							echo $_POST['chapterID'];
						else if(isset($currentChapter))
							echo $currentChapter->ChapterID;
						else
							echo '';
						}  
						
						?>
						">
						<?php if (isset($lessonUpload) && $lessonUpload): ?>
							<input type="hidden" id="lessonUploaded" value="<?php echo $lessonUploaded; ?>">
						<?php endif ?>
				<div class="left clearfix lessonSection">
						<input type="submit" name="saveLessonAndHide" value="Save Lesson" class="form-btn blue-light medium">
						<input type="submit" name="saveLesson" value="Save &amp; Add Lesson" class="form-btn blue-light medium">
						<!-- <a rel="nofollow" href="javascript:void(0);" class="form-btn blue-light medium">Save Lesson</a> -->
						<!-- <a rel="nofollow" href="javascript:void(0);" class="form-btn blue-light medium">Save &amp; Add Lesson</a> -->
						<br><br><br><br>
					</div>
					<div class="cb"></div>
					<div class="left clearfix">
						<input type="submit" value="Save" name="courseSave" class="form-btn red w60 submit">
						<input type="submit" value="Done" name="courseDone" class="form-btn red w60 submit">
						<!-- <a rel="nofollow" href="javascript:void(0);" class="form-btn red w60 submit">Save</a>
						<a rel="nofollow" href="javascript:void(0);" class="form-btn red w60 submit">Done</a> -->
					</div>
					<div class="right clearfix">
						<!-- <input type="submit" name="" value="" style="border:none;"  class="form-btn chapter-link prev-chapter"> -->
						<input type="submit" name="addChapter" value="" style="border:none;"  class="form-btn chapter-link next-chapter">
						<!-- <a rel="nofollow" href="javascript:void(0);" class="chapter-link prev-chapter"></a> -->
						<!-- <a rel="nofollow" href="javascript:void(0);" class="chapter-link next-chapter"></a> -->
					</div>



					<!-- <div class="left clearfix"> -->
						<!-- <a rel="nofollow" href="javascript:void(0);" class="form-btn blue-light medium submit">Save Lesson</a>
						<a rel="nofollow" href="javascript:void(0);" class="form-btn blue-light medium">Save &amp; Add Lesson</a> -->
						<!-- <br><br><br><br>
					</div>
					<div class="cb"></div>

					<div class="left clearfix"> -->
						
						<!-- <input type="submit" class="form-btn red w60 submit" name="saveLesson" value="Save &amp; Add Lesson">
						<input type="submit" class="form-btn red w60 submit" name="" value="Save Lesson"> -->
						<!-- <a rel="nofollow" href="javascript:void(0);" class="form-btn red w60 submit">Done</a> -->
					<!-- </div> -->
					<!-- <div class="right clearfix">
						<a rel="nofollow" href="javascript:void(0);" class="chapter-link prev-chapter"></a>
						<a rel="nofollow" href="javascript:void(0);" class="chapter-link next-chapter"></a>
					</div> -->
				</div>
			</form>

					</div> <!-- #add-chapter -->
		<br>
		<br>
	</div> <!-- .dash-right -->
</div> <!-- .dashboard -->

</div> <!-- .container -->

<!-- ==============
	Hidden Fields
=============== -->
<div id="regular-question" class="dn">
	<div class="form-row textarea question">
		<label class="form-label">Question: (Regular Question)</label><br>
		<textarea data-type="regular_q" name="question[]" cols="30" rows="10" class="fl"></textarea>
	</div>
</div>
<div id="mark-question" class="dn">
	<div class="form-row textarea question">
		<label class="form-label">Question: (Right/Wrong Question)</label><br>
		<textarea data-type="mark_q" name="question[]" cols="30" rows="10" class="fl"></textarea>
		<div class="marks">
			<label class="jCheckbox">
				<input type="radio" data-type="mark_a" name="answer" value="true"><span class="checkbox-icon"></span> True
			</label><br>
			<label class="jCheckbox">
				<input type="radio" data-type="mark_a" name="answer" value="false"><span class="checkbox-icon"></span> False
			</label>
		</div>
	</div>
</div>
<div id="choices-question" class="dn">
	<div class="form-row textarea question">
		<label class="form-label">Question: (Choices)</label><br>
		<textarea data-type="choices_q" name="question[]" cols="30" rows="10" class="fl autogrow"></textarea><br>
		<div class="answers">
			<p>
				<input type="text" data-type="choices_a" name="choice">
				<!-- <input type="checkbox" name="mark[]"> -->
				<label class="jCheckbox">
					<input type="checkbox" data-type="choices_a_mark" name="choice_mark" value="true"><span class="checkbox-icon"></span>True
				</label>
			</p>
			<p><input type="text" data-type="choices_a" name="choice">
				<label class="jCheckbox">
					<input type="checkbox" data-type="choices_a_mark" name="choice_mark" value="true"><span class="checkbox-icon"></span>True
				</label></p>
			<p><input type="text" data-type="choices_a" name="choice">
				<label class="jCheckbox">
					<input type="checkbox" data-type="choices_a_mark" name="choice_mark" value="true"><span class="checkbox-icon"></span>True
				</label></p>
			<p><a href="javascript:void(0);" class="new-choice add-question"><span>+</span> Add New Choice</a></p>
		</div>
	</div>
</div>



<?php 
		include('footer.php');
 ?>