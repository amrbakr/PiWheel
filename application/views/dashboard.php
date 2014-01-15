<?php 
    include('includes.php');
    include('header.php');
    include('notification.php');
 ?>

<div class="container clearfix">

<section class="std-courses">
	<div class="std-head clearfix">
		<h2>Subscribed Courses</h2>
	</div>
	<div class="cb"></div>
	<ul>
	<?php if ($enrolledCourses): ?>

		<?php foreach ($enrolledCourses as $course): ?>
			<li><a href="<?php echo base_url(); ?>course/<?php echo $course['course'][0]->Name; ?>" class="course-thumb">
				<img src="<?php echo base_url(); ?>application/uploads/courses/<?php echo $course['course'][0]->Image;  ?>" alt="Course Name">
				<span class="course-title"><?php echo $course['course'][0]->Name; ?></span>
				<span class="rounded-num"><span>3</span>
				</a>
			</li>
		<?php endforeach ?>
		
		
	<?php endif ?>
		
	</ul>

	<div class="std-head clearfix">
		<h2>Suggested Courses</h2>
	</div>
	<div class="cb"></div>
	<ul>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/1.jpg" alt="Course Name"><span class="course-title">Course Name</span></a></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/2.jpg" alt="Course Name"><span class="course-title">Course Name</span></a></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/3.jpg" alt="Course Name"><span class="course-title">Course Name</span></a></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/4.jpg" alt="Course Name"><span class="course-title">Course Name</span></a></li>
	</ul>

	<div class="std-head clearfix">
		<h2>Certified</h2>
	</div>
	<div class="cb"></div>
	<ul>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/1.jpg" alt="Course Name"><span class="course-title">Course Name</span><span class="overlay"></span></a></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/2.jpg" alt="Course Name"><span class="course-title">Course Name</span><span class="overlay"></span></a></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/3.jpg" alt="Course Name"><span class="course-title">Course Name</span><span class="overlay"></span></a></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/4.jpg" alt="Course Name"><span class="course-title">Course Name</span><span class="overlay"></span></a></li>
	</ul>
</section>

</div> <!-- .container -->

<?php 
		include('footer.php');
 ?>