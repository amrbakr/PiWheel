
<?php include('includes.php'); ?>

<body>

<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</li>
<![endif]-->

<div class="container clearfix">

<?php include('header.php'); ?>
<div style="width:100%;">
 <?php 
        include('notification.php');
 ?>
 </div>

<section class="instructor-bio">
	<div class="photo-section">
		<div class="instructor-photo">
			<img src="<?php echo base_url(); ?>application/uploads/instructors/<?php echo $user->Image; ?>" alt>
			<span class="inst-arrow"></span>
			<span class="inst-title">
				<h2><?php echo $user->Fullname; ?></h2>
				<h3><?php echo $user->Title; ?></h3>
			</span>
			<ul class="inst-tags">
				<li><a href="">Petroleum</a></li>
				<li><a href="">Chemics</a></li>
				<li><a href="">Safety</a></li>
				<li><a href="">Programming</a></li>
				<li><a href="">Web Design</a></li>
			</ul>
		</div>

	</div>
	<div class="bio-section">
		<h2>Bio</h2>
		<p style="height:170px;">
			<?php echo $user->About; ?>
		</p>

		<div class="hr"></div>

		<h2>Certifications</h2>
		- PHD Philosophy<br>
		- Master BA<br>
		- Kindergarten, Smart Kid Academy<br>
	</div>
</section>

<section class="inst-courses">
	<ul>
		<!-- <li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/1.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-1"></span></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/2.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-2"></span></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/3.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-3"></span></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/4.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-4"></span></li>

		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/1.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-5"></span></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/2.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-0"></span></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/3.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-4"></span></li>
		<li><a href="javascript:void(0);" class="course-thumb"><img src="images/courses/instructor/4.jpg" alt="Course Name"><span class="course-title">Course Name</span></a><span class="static-stars blue-stars star-3"></span></li> -->

	</ul>
</section>

</div> <!-- .container -->




<?php include('footer.php'); ?>