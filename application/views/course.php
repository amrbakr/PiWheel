<?php 
    include('includes.php');
    include('header.php');
    include('notification.php');
    //showThis($course);
 ?>

<section class="course-head">
	<div class="course-thumb">
		<div class="course-title">
            <ul class="item-tags">
            <?php if ($course->Tags != ""): ?>
                <?php 
                    $tags = explode(",",$course->Tags);
                 ?>
                 <?php foreach ($tags as $tag): ?>
                     <li><a href=""><?php echo $tag; ?></a></li>
                 <?php endforeach ?>
            <?php endif ?>
            </ul>

			<h2><?php echo $course->Name; ?></h2>
		</div>
            <img src="<?php echo base_url(); ?>application/uploads/courses/<?php echo $course->Image; ?>" alt="">
        <span class="course-info">
            <span class="level"><?php echo $course->Level; ?></span>
            <span class="period"><?php echo $course->Duration; ?> Days</span> 
            <div class="cb"></div>
            <span class="static-stars stars-white star-<?php echo $course->Rating;?>"></span> 
        </span>
	</div>
    <div class="course-video">
        <a href="javascript:void(0);" class="thumb">
            <span class="title">Introductory Video</span>
            <img src="images/videos/course-video-thumb.jpg" alt="">
            <span class="glass"></span>
            <span class="play"></span>
        </a>
        <span class="controls">
            <span class="v-pause"></span>
            <span class="v-seek"><div style="width:40%;"></div></span>
            <span class="v-volume"></span>
        </span>
    </div>
</section>

<div class="course-content">

    <section class="course-inst">
        <div class="inst-head clearfix">
            <a class="thumb" href="<?php echo base_url().'profile/'.$course->InstructorID->Username; ?>"><img src="<?php echo base_url(); ?>application/uploads/instructors/<?php echo $course->InstructorID->Image; ?>" alt=""></a>
            <p class="info"><?php echo $course->InstructorID->Fullname; ?><br>New York, USA</p>
            <span class="arrow-bottom-white"></span>
        </div>
        <div class="bio">
            <h2 class="mod-title">About <?php echo $course->InstructorID->Fullname; ?></h2>
            <p>
                <?php 
                     echo $course->InstructorID->About; 
                 ?>
            </p>
        </div>
        <div class="university">
            <div class="thumb">
                <img src="images/universities/1_s.jpg" alt="">
                <span class="arrow-top-white"></span>
            </div>
            <div class="details">
                <h2 class="mod-title"><?php echo $course->UniveristyID->description; ?></h2>
                <p class="mod-info"><?php echo $course->UniveristyID->About; ?></p>
            </div>
        </div>
    </section>

    <section class="course-details">
        <div class="head">
            <h2 class="mod-title">Course Brief</h2>
            <span class="arrow-top-white"></span>
        </div>
        <div class="body clearfix">
            <div class="mod-left-col">
            <p>
                <?php echo $course->Brief; ?>
            </p>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p> -->
            </div>
            <div class="mod-right-col">
                <div class="mod-thumb"><img src="<?php echo base_url(); ?>application/uploads/admin/Courses/<?php echo $course->Image; ?>" alt=""><span class="arrow-right-white"></span></div>
                <div class="mod-thumb"><img src="<?php echo base_url(); ?>application/uploads/admin/Courses/<?php echo $course->Image; ?>" alt=""><span class="arrow-right-white"></span></div>
            </div>
        </div>

        <div class="head">
            <h2 class="mod-title">Ratings</h2>
            <span class="arrow-top-white off-white"></span>
        </div>
        <div class="body clearfix off-white">
            <div class="mod-left-col">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
            </div>
            <div class="mod-right-col tar">
                <span class="static-stars star-3 first"></span>
                <div class="point">Point1 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point2 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point3 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point4 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point5 &nbsp; <span class="static-stars small star-2"></span></div>
            </div>
            <div class="cb"></div>
            <div class="hr"></div>

            <div class="mod-left-col">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
            </div>
            <div class="mod-right-col tar">
                <span class="static-stars star-3 first"></span>
                <div class="point">Point1 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point2 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point3 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point4 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point5 &nbsp; <span class="static-stars small star-2"></span></div>
            </div>
            <div class="cb"></div>
            <div class="hr"></div>

            <div class="mod-left-col">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, odio hic possimus nihil consequatur molestiae optio facilis adipisci. Debitis veniam blanditiis nihil doloribus delectus asperiores necessitatibus sapiente magnam omnis ipsum.</p>
            </div>
            <div class="mod-right-col tar">
                <span class="static-stars star-3 first"></span>
                <div class="point">Point1 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point2 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point3 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point4 &nbsp; <span class="static-stars small star-2"></span></div>
                <div class="point">Point5 &nbsp; <span class="static-stars small star-2"></span></div>
            </div>
            <div class="cb"></div>
        </div>
    </section>

    <section class="course-book">
        <div class="head first">
            <h2 class="mod-title"><?php echo $course->Price; ?><small>$</small></h2>
            <span class="arrow-top-white darker"></span>
        </div>
        <div class="body" style="padding:0 10px;">
        <?php if ($logged): ?>
            <!-- <div class="summary">Your Card Ends<br>with ( xxxx ) will be<br>charged ?</div>
            <div class="cb"></div>
            <a href="javascript:void(0);" class="flat-btn light-red fl" id="confirm-course">Confirm</a>
            <a href="javascript:void(0);" class="flat-btn dark-blue fr" id="cancel-course">Cancel</a>
            <div class="cb"></div> -->
            <a href="javascript:void(0);" class="flat-btn large light-blue" id="join-course">Subscribe Now</a>
        <?php else: ?>
            <a href="javascript:void(0);" class="flat-btn large light-blue" id="join-course">Subscribe Now</a>
        <?php endif ?>
            
        </div>

        <div class="head-index"><h2 class="mod-title">Index</h2></div>
        <div class="chapter">
            <div class="head">
                <h2 class="mod-title">Chapter 1</h2>
            </div>
            <div class="body">
                <ul class="chapter-list">
                    <li><a href="#">Introduction</a></li>
                    <li class="icon-doc"><a href="#">Subject Basics (doc)</a></li>
                    <li class="icon-video"><a href="#">Subject Basics (Video)</a></li>
                    <li><a href="#">Basics Test</a></li>
                </ul>
            </div>
        </div>

        <div class="chapter">
            <div class="head">
                <h2 class="mod-title">Chapter 2</h2>
            </div>
            <div class="body">
                <ul class="chapter-list">
                    <li><a href="#">Introduction</a></li>
                    <li class="icon-doc"><a href="#">Subject Basics (doc)</a></li>
                    <li class="icon-video"><a href="#">Subject Basics (Video)</a></li>
                    <li><a href="#">Basics Test</a></li>
                </ul>
            </div>
        </div>

        <div class="chapter">
            <div class="head">
                <h2 class="mod-title">Chapter 3</h2>
            </div>
            <div class="body">
                <ul class="chapter-list">
                    <li><a href="#">Introduction</a></li>
                    <li class="icon-doc"><a href="#">Subject Basics (doc)</a></li>
                    <li class="icon-video"><a href="#">Subject Basics (Video)</a></li>
                    <li><a href="#">Basics Test</a></li>
                </ul>
            </div>
        </div>
    </section>

</div> <!-- #course-content -->

</div> <!-- .container -->

<?php 
    include('footer.php');
 ?>