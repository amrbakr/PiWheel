<?php 
    include('includes.php');
 ?>
<body>

<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</li>
<![endif]-->

<?php 

    include('header.php'); 
    include('notification.php');
?>


<aside class="sidecol filters">

	<div class="side-mod-1">
		<h3 class="mod-head"><i class="icon icon-tags">&nbsp;</i> Tags</h3>
		<div class="mod-body">
			<select id="tags" data-placeholder="Choose tags..." style="width:190px;" multiple class="chzn-select">
			<option></option>
			<option value="1">Petroleuom</option>
			<option value="2">Mechanics</option>
			<option value="3">Art</option>
			<option value="4">Rockets</option>
			<option value="5">Web Design</option>
			<option value="6">Graphic</option>
			<option value="7">Math</option>
			<option value="8">Architecture</option>
			</select>
		</div>
		<div class="tags-btn-group">
			<a href="javascript:void(0);" id="uncheck-all-tags">Unselect All</a>
			<a href="javascript:void(0);" id="check-all-tags">Select All</a>
		</div> <!-- .tags-btn -->
	</div> <!-- .side-mod-1 -->

	<div class="side-mod-1">
		<h3 class="mod-head"><i class="icon icon-level">&nbsp;</i> Level</h3>
		<div class="mod-body level-range">
			<div id="level-range" class="noUiSlider"></div>
			<ul>
			<li>Genius</li>
			<li>Intermediate</li>
			<li>Professional</li>
			<li>Beginner</li>
			<li>Hobby</li>
			</ul>
		</div>
	</div> <!-- .side-mod-1 -->

	<div class="side-mod-1">
		<h3 class="mod-head"><i class="icon icon-price">&nbsp;</i> Price</h3>
		<div class="mod-body clearfix">
			<div id="price-range" class="noUiSlider"></div>
			<div class="cb"></div>
            <div class="guide clearfix">
            	<div class="fl">Free</div>
            	<div class="fr">$5K</div>
            </div> <!-- .period-range -->
		</div>
	</div> <!-- .side-mod-1 -->

	<div class="side-mod-1">
		<h3 class="mod-head"><i class="icon icon-clock">&nbsp;</i> Period</h3>
		<div class="mod-body clearfix">
			<div id="period-range" class="noUiSlider"></div>
			<div class="cb"></div>
            <div class="guide clearfix">
            	<div class="fl">1Hr</div>
            	<div class="fr">1 Year</div>
            </div> <!-- .period-range -->
		</div>
	</div> <!-- .side-mod-1 -->

</aside> <!-- .sidecol.filters -->
    

<div class="maincol" style="background: white;">
	<section>
		<div class="home-head clearfix">
			<h1>Courses</h1>
			<div class="sort">
				Sort By &nbsp;<a href="javascript:void(0)" class="sort-btn"><span>Most Viewed</span></a>
			</div>
		</div> <!-- .home-head -->

		<div class="home-thumbs">
			<?php foreach ($courses as $course): ?>
			 <div class="item">
				<h2 class="item-title"><a href="<?php echo base_url().'course/'.$course->Name ?>"><?php echo $course->Name ?></a></h2>
				<img src="<?php echo base_url().'application/uploads/courses/'.$course->Image;?>" alt>
				<div class="thumb-foot">
					<span class="stars-white"></span>
					<div class="details">
						<span class="level"><?php echo $course->Level; ?></span>
						<span class="period"><?php echo $course->Duration; ?> Days</span>
						<span class="price"><?php echo $course->Price; ?></span>
					</div>
				</div> <!-- .thumb-foot -->
				<ul class="item-tags">
				<?php foreach ($course->Tags as $tag): ?>
					<li><a href=""><?php echo $tag; ?></a></li>
				<?php endforeach ?>
				</ul> <!-- .item-tags -->
			</div> <!-- .item -->
			<?php endforeach ?>
		</div> <!-- .home-thumbs -->
	</section>

</div> <!-- .maincol -->

</div> <!-- .container -->

<?php include('footer.php'); ?>