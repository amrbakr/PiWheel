<?php 
    include('includes.php');
    include('header.php');
    include('notification.php');
    // showThis($course);
     // foreach ($courseMaterial as $lesson ) {
     // 	showThis($lesson);
     // 	foreach ($lesson->lessons as $lesson ) {
     // 		$content = $lesson->Content;
     // 		break;
     // 	}
     // 	echo $content;
     // 	echo '<hr>';
     // }
     //die();
 ?>

<div class="container clearfix">
	
<aside class="sidecol course-sidenav">
	<a href="#" class="section-tab active">Home</a>
	<a href="#" class="section-tab">Forum <span class=" right-arrow"></span></a>
	<div class="chapter-nav">
	<?php if (is_array($courseMaterial)): ?>
		<?php foreach ($courseMaterial as $chapter): ?>
		<div class="head">
			<h2><?php echo $chapter->Name; ?></h2>
			<span class="arrow"></span>
		</div>
		<div class="body">
			<ul class="chapter-list white">
			<?php foreach ($chapter->lessons as $lesson): ?>
				<?php 
					$type = trim($lesson->Type);
					if($type == 'document')
						$class ='icon-doc';
					if($type == 'slides')
						$class ='icon-slides';
					if($type == 'video')
						$class ='icon-video';
					if($type == 'exam')
						$class ='icon-exam';
				 ?>
				<li class="<?php echo $class; ?>"><a class="lesson" data-type="<?php echo $lesson->Type; ?>" data-content="<?php echo $lesson->Content; ?>" href="javascript:void(0);"><?php echo $lesson->Name; ?></a><span class="finished-chapter"></span></li>
			<?php endforeach ?>
				<!-- <li><a href="">Introduction</a><span class="finished-chapter"></span></li>
				<li class="icon-doc"><a href="">Subject basics (doc)</a><span class="finished-chapter"></span></li>
				<li class="icon-video"><a href="">Subject basics (video)</a><span class="finished-chapter"></span></li>
				<li><a href="">Basics test</a><span class="finished-chapter"></span></li> -->
			</ul>
		</div>
	<?php endforeach ?>
	<?php endif ?>
	</div>

	<div class="foot"></div>
</aside> <!-- .sidecol.course-sidenav -->

<div class="maincol" style="background: white;">
	<div class="course-head-tab">
		<h1><?php echo $course->Name; ?>
		<input type="submit" style="float:right;margin-top:2%;" value="Publish" name="courseSave" class="form-btn red w60 submit">
		</h1>
	</div>


	<div id="lessonContent">
		<iframe id="lessonContentFrame" src="" style="width:100%; height:600px;" frameborder="0"></iframe>
		<div id="examContent">
			<?php foreach ($courseMaterial as $chapter): ?>
				<?php foreach ($chapter->lessons as $lesson ): ?>
					<?php if ($lesson->Type == 'exam'): ?>
						<div id="<?php echo $lesson->Content ?>" class="examDiv">
							<?php 
								// $examContent = readXMLExam($lesson->Content);
								// showThis($examContent);
								// die();
							 ?>
						</div>
					<?php endif ?>
				<?php endforeach ?>
			<?php endforeach ?>
		</div>
	</div>
	<!-- <div class="course-head-tab gray clearfix">
		<a href="" class="icon-write"></a>
		<div class="custom-search">
			<a rel="nofollow" href="javascript:void(0);" class="btn-search" id="btn-search"></a>
			<input type="text" class="search-box" id="search-box" value="Find Topic">
			<a rel="nofollow" href="javascript:void(0);" class="btn-go" id="btn-search">Go</a>
		</div>
	</div>
	
	<br><br> -->

	

	<!-- <div class="custom-table">
		<table>
			<tr>
				<th>Recent Posts</th>
				<th class="number">No. Ans</th>
				<th>Name</th>
				<th>Category</th>
			</tr>
			<tr>
				<td>Lorem Ipsum available</td>
				<td class="number">20</td>
				<td>Ahmed</td>
				<td>Art</td>
			</tr>
			<tr>
				<td>Lorem Ipsum available</td>
				<td class="number">43</td>
				<td>Mohamed</td>
				<td>Design</td>
			</tr>
			<tr>
				<td>Lorem Ipsum available</td>
				<td class="number">10</td>
				<td>Abdelrahman</td>
				<td>Programming</td>
			</tr>
			<tr>
				<td>Lorem Ipsum available</td>
				<td class="number">20</td>
				<td>Ahmed</td>
				<td>Art</td>
			</tr>
			<tr>
				<td>Lorem Ipsum available</td>
				<td class="number">43</td>
				<td>Mohamed</td>
				<td>Design</td>
			</tr>
			<tr>
				<td>Lorem Ipsum available</td>
				<td class="number">10</td>
				<td>Abdelrahman</td>
				<td>Programming</td>
			</tr>
		</table>
	</div>
	
	<br><br>

	<div class="custom-table">
		<table>
			<tr>
				<th>Categories</th>
				<th class="number">No. Posts</th>
				<th>Last Post</th>
			</tr>
			<tr>
				<td>Chapter 1</td>
				<td class="number">20</td>
				<td>Today</td>
			</tr>
			<tr>
				<td>Chapter 2</td>
				<td class="number">20</td>
				<td>Yesterday</td>
			</tr>
			<tr>
				<td>Chapter 3</td>
				<td class="number">14</td>
				<td>3 days ago</td>
			</tr>
		</table>
	</div>

	<br><br><br><br><br> -->

</div> <!-- .maincol -->

</div> <!-- .container -->

<?php 
		include('footer.php');
 ?>