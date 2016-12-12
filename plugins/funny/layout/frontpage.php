<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The funny theme is built upon the Essential theme.
 *
 * @package    theme
 * @subpackage funny
 * @author     estarguars113
 * @author     Based on code originally written Julian (@moodleman) Ridden,by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$hashiddendock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('hidden-dock', $OUTPUT));
$sideregionsmaxwidth = (!empty($PAGE->theme->settings->sideregionsmaxwidth));
$hascenterblock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('center', $OUTPUT));


/* blocks top */
$hastopleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('top-left', $OUTPUT));
$hastopmiddle = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('top-middle', $OUTPUT));
$hastopright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('top-right', $OUTPUT));
$hastopblocks = $hastopleft || $hastopmiddle || $hastopright;

/* blocks bottom */
$hasbottomleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('bottom-left', $OUTPUT));
$hasbottommiddle = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('bottom-middle', $OUTPUT));
$hasbottomright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('bottom-right', $OUTPUT));
$hasbottomblocks = $hasbottomleft || $hasbottommiddle || $hasbottomright;

$hasslide1 = (!empty($PAGE->theme->settings->slide1));
$hasslide1image = (!empty($PAGE->theme->settings->slide1image));
$hasslide1caption = (!empty($PAGE->theme->settings->slide1caption));
$hasslide1url = (!empty($PAGE->theme->settings->slide1url));
$hasslide2 = (!empty($PAGE->theme->settings->slide2));
$hasslide2image = (!empty($PAGE->theme->settings->slide2image));
$hasslide2caption = (!empty($PAGE->theme->settings->slide2caption));
$hasslide2url = (!empty($PAGE->theme->settings->slide2url));
$hasslide3 = (!empty($PAGE->theme->settings->slide3));
$hasslide3image = (!empty($PAGE->theme->settings->slide3image));
$hasslide3caption = (!empty($PAGE->theme->settings->slide3caption));
$hasslide3url = (!empty($PAGE->theme->settings->slide3url));
$hasslide4 = (!empty($PAGE->theme->settings->slide4));
$hasslide4image = (!empty($PAGE->theme->settings->slide4image));
$hasslide4caption = (!empty($PAGE->theme->settings->slide4caption));
$hasslide4url = (!empty($PAGE->theme->settings->slide4url));
$hasslide5 = (!empty($PAGE->theme->settings->slide5));
$hasslide5image = (!empty($PAGE->theme->settings->slide5image));
$hasslide5caption = (!empty($PAGE->theme->settings->slide5caption));
$hasslide5url = (!empty($PAGE->theme->settings->slide5url));
$hasslideshow = ($hasslide1||$hasslide2||$hasslide3||$hasslide4||$hasslide5);
$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;

$hasalert1 = (empty($PAGE->theme->settings->enable1alert)) ? false : $PAGE->theme->settings->enable1alert;
$hasalert2 = (empty($PAGE->theme->settings->enable2alert)) ? false : $PAGE->theme->settings->enable2alert;
$hasalert3 = (empty($PAGE->theme->settings->enable3alert)) ? false : $PAGE->theme->settings->enable3alert;
$alertinfo = '<span class="fa-stack "><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-info fa-stack-1x fa-inverse"></i></span>';
$alertwarning = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-warning fa-stack-1x fa-inverse"></i></span>';
$alertsuccess = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></span>';

$hasblocksdescription = (!empty($PAGE->theme->settings->blocksdescription));
$hasblock1 = (!empty($PAGE->theme->settings->blocktitle1));
$hasblocktext1 = (!empty($PAGE->theme->settings->blocktext1));
$hasblockimage1 = (!empty($PAGE->theme->settings->blockimage1));
$hasblockurl1 = (!empty($PAGE->theme->settings->blockurl1));
$hasblockbutton1 = (!empty($PAGE->theme->settings->blockbutton1));
$hasblock2 = (!empty($PAGE->theme->settings->blocktitle2));
$hasblocktext2 = (!empty($PAGE->theme->settings->blocktext2));
$hasblockimage2 = (!empty($PAGE->theme->settings->blockimage2));
$hasblockurl2 = (!empty($PAGE->theme->settings->blockurl2));
$hasblockbutton2 = (!empty($PAGE->theme->settings->blockbutton2)) ;
$hasblock3 = (!empty($PAGE->theme->settings->blocktitle3));
$hasblocktext3 = (!empty($PAGE->theme->settings->blocktext3));
$hasblockimage3 = (!empty($PAGE->theme->settings->blockimage3));
$hasblockurl3 = (!empty($PAGE->theme->settings->blockurl3));
$hasblockbutton3 = (!empty($PAGE->theme->settings->blockbutton3));
$hasblock4 = (!empty($PAGE->theme->settings->blocktitle4));
$hasblocktext4 = (!empty($PAGE->theme->settings->blocktext4));
$hasblockimage4 = (!empty($PAGE->theme->settings->blockimage4));
$hasblockurl4 = (!empty($PAGE->theme->settings->blockurl4));
$hasblockbutton4 = (!empty($PAGE->theme->settings->blockbutton4)) ;
$hasblock5 = (!empty($PAGE->theme->settings->blocktitle5));
$hasblocktext5 = (!empty($PAGE->theme->settings->blocktext5));
$hasblockimage5 = (!empty($PAGE->theme->settings->blockimage5));
$hasblockurl5 = (!empty($PAGE->theme->settings->blockurl5));
$hasblockbutton5 = (!empty($PAGE->theme->settings->blockbutton5)) ;
$hasmainpageblocks = ($hasblock1||$hasblock2||$hasblock3||$hasblock4||$hasblock5);


$showcontentfrontpage = (!empty($PAGE->theme->settings->frontpagecontent)) ? true : $PAGE->theme->settings->frontpagecontent;


$haslogo = (!empty($PAGE->theme->settings->logo));
$hassecondarylogo = (!empty($PAGE->theme->settings->secondarylogo));

$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;

/* Slide1 settings */
$hideonphone = $PAGE->theme->settings->hideonphone;
if ($hasslide1) {
    $slide1 = $PAGE->theme->settings->slide1;
}
if ($hasslide1image) {
    $slide1image = $PAGE->theme->setting_file_url('slide1image', 'slide1image');
}
if ($hasslide1caption) {
    $slide1caption = $PAGE->theme->settings->slide1caption;
}
if ($hasslide1url) {
    $slide1url = $PAGE->theme->settings->slide1url;
}

/* slide2 settings */
if ($hasslide2) {
    $slide2 = $PAGE->theme->settings->slide2;
}
if ($hasslide2image) {
    $slide2image = $PAGE->theme->setting_file_url('slide2image', 'slide2image');
}
if ($hasslide2caption) {
    $slide2caption = $PAGE->theme->settings->slide2caption;
}
if ($hasslide2url) {
    $slide2url = $PAGE->theme->settings->slide2url;
}

/* slide3 settings */
if ($hasslide3) {
    $slide3 = $PAGE->theme->settings->slide3;
}
if ($hasslide3image) {
    $slide3image = $PAGE->theme->setting_file_url('slide3image', 'slide3image');
}
if ($hasslide3caption) {
    $slide3caption = $PAGE->theme->settings->slide3caption;
}
if ($hasslide3url) {
    $slide3url = $PAGE->theme->settings->slide3url;
}

/* slide4 settings */
if ($hasslide4) {
    $slide4 = $PAGE->theme->settings->slide4;
}
if ($hasslide4image) {
    $slide4image = $PAGE->theme->setting_file_url('slide4image', 'slide4image');
}
if ($hasslide4caption) {
    $slide4caption = $PAGE->theme->settings->slide4caption;
}
if ($hasslide4url) {
    $slide4url = $PAGE->theme->settings->slide4url;
}

/* slide5 settings */
if ($hasslide5) {
    $slide5 = $PAGE->theme->settings->slide5;
}
if ($hasslide5image) {
    $slide5image = $PAGE->theme->setting_file_url('slide5image', 'slide5image');
}
if ($hasslide5caption) {
    $slide5caption = $PAGE->theme->settings->slide5caption;
}
if ($hasslide5url) {
    $slide5url = $PAGE->theme->settings->slide5url;
}
$hasslideshow = $hasslide1 || $hasslide2 || $hasslide3 || $hasslide4 || $hasslide5;


if($hasblocksdescription){
	 $blocksdescription = $PAGE->theme->settings->blocksdescription;
}

/* block 1 settings*/
if ($hasblock1) {
    $blocktitle1 = $PAGE->theme->settings->blocktitle1;
}
if ($hasblockimage1) {
    $blockimage1 = $PAGE->theme->setting_file_url('blockimage1', 'blockimage1');
}
if ($hasblocktext1) {
    $blocktext1 = $PAGE->theme->settings->blocktext1;
}
if ($hasblockurl1) {
    $blockurl1 = $PAGE->theme->settings->blockurl1;
}
if ($hasblockbutton1){
	$blockbutton1 = $PAGE->theme->settings->blockbutton1;
}

/* block 2 settings*/
if ($hasblock2) {
    $blocktitle2 = $PAGE->theme->settings->blocktitle2;
}
if ($hasblockimage2) {
    $blockimage2 = $PAGE->theme->setting_file_url('blockimage2', 'blockimage2');
}
if ($hasblocktext2) {
    $blocktext2 = $PAGE->theme->settings->blocktext2;
}
if ($hasblockurl2) {
    $blockurl2 = $PAGE->theme->settings->blockurl2;
}
if ($hasblockbutton2){
	$blockbutton2 = $PAGE->theme->settings->blockbutton2;
}

/* block 3 settings*/
if ($hasblock3) {
    $blocktitle3 = $PAGE->theme->settings->blocktitle3;
}
if ($hasblockimage3) {
    $blockimage3 = $PAGE->theme->setting_file_url('blockimage3', 'blockimage3');
}
if ($hasblocktext3) {
    $blocktext3 = $PAGE->theme->settings->blocktext3;
}
if ($hasblockurl3) {
    $blockurl3 = $PAGE->theme->settings->blockurl3;
}
if ($hasblockbutton3){
	$blockbutton3 = $PAGE->theme->settings->blockbutton3;
}

/* block 4 settings*/
if ($hasblock4) {
    $blocktitle4 = $PAGE->theme->settings->blocktitle4;
}
if ($hasblockimage4) {
    $blockimage4 = $PAGE->theme->setting_file_url('blockimage4', 'blockimage4');
}
if ($hasblocktext4) {
    $blocktext4 = $PAGE->theme->settings->blocktext4;
}
if ($hasblockurl4) {
    $blockurl4 = $PAGE->theme->settings->blockurl4;
}
if ($hasblockbutton4){
	$blockbutton4 = $PAGE->theme->settings->blockbutton4;
}

/* block 5 settings*/
if ($hasblock5) {
    $blocktitle5 = $PAGE->theme->settings->blocktitle5;
}
if ($hasblockimage5) {
    $blockimage5 = $PAGE->theme->setting_file_url('blockimage5', 'blockimage5');
}
if ($hasblocktext5) {
    $blocktext5 = $PAGE->theme->settings->blocktext5;
}
if ($hasblockurl5) {
    $blockurl5 = $PAGE->theme->settings->blockurl5;
}
if ($hasblockbutton5){
	$blockbutton5 = $PAGE->theme->settings->blockbutton5;
}

theme_essential_check_colours_switch();
theme_essential_initialise_colourswitcher($PAGE);

$bodyclasses = array();
$bodyclasses[] = 'essential-colours-' . theme_essential_get_colours();
if ($sideregionsmaxwidth) {
    $bodyclasses[] = 'side-regions-with-max-width';
}

$left = (!right_to_left());  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.
echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <noscript>
			<link rel="stylesheet" type="text/css" href="<?php echo $CFG->wwwroot;?>/theme/essential/style/nojs.css" />
	</noscript>
    <!-- Google web fonts -->
    <?php require_once(dirname(__FILE__).'/includes/fonts.php'); ?>
    <!-- iOS Homescreen Icons -->
    <?php require_once(dirname(__FILE__).'/includes/iosicons.php'); ?>
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php require_once(dirname(__FILE__).'/includes/header.php'); ?>

<!-- Start Main Regions -->
<div id="page" class="container-fluid">

<!-- Start Alerts -->

<!-- Alert #1 -->
<?php if ($hasalert1) { ?>  
	<div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert1type ?>">  
	<a class="close" data-dismiss="alert" href="#">×</a>
	<?php 
	if ($PAGE->theme->settings->alert1type == 'info') {
		$alert1icon = $alertinfo;
    } else if ($PAGE->theme->settings->alert1type == 'error') {
    	$alert1icon = $alertwarning;
   	} else {
   		$alert1icon = $alertsuccess;
   	} 
    $alert1title = 'alert1title_'.current_language();
    $alert1text = 'alert1text_'.current_language();
   	echo $alert1icon.'<span class="title">'.$PAGE->theme->settings->$alert1title.'</span>'.$PAGE->theme->settings->$alert1text; ?> 
</div>
<?php } ?>

<!-- Alert #2 -->
<?php if ($hasalert2) { ?>  
	<div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert2type ?>">  
	<a class="close" data-dismiss="alert" href="#">×</a>
	<?php 
	if ($PAGE->theme->settings->alert2type == 'info') {
		$alert2icon = $alertinfo;
    } else if ($PAGE->theme->settings->alert2type == 'error') {
    	$alert2icon = $alertwarning;
   	} else {
   		$alert2icon = $alertsuccess;
   	} 
    $alert2title = 'alert2title_'.current_language();
    $alert2text = 'alert2text_'.current_language();
   	echo $alert2icon.'<span class="title">'.$PAGE->theme->settings->$alert2title.'</span>'.$PAGE->theme->settings->$alert2text; ?> 
</div>
<?php } ?>

<!-- Alert #3 -->
<?php if ($hasalert3) { ?>  
	<div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert3type ?>">  
	<a class="close" data-dismiss="alert" href="#">×</a>
	<?php 
	if ($PAGE->theme->settings->alert3type == 'info') {
		$alert3icon = $alertinfo;
    } else if ($PAGE->theme->settings->alert3type == 'error') {
    	$alert3icon = $alertwarning;
   	} else {
   		$alert3icon = $alertsuccess;
   	} 
    $alert3title = 'alert3title_'.current_language();
    $alert3text = 'alert3text_'.current_language();
   	echo $alert3icon.'<span class="title">'.$PAGE->theme->settings->$alert3title.'</span>'.$PAGE->theme->settings->$alert3text; ?> 
</div>
<?php } ?>
<!-- End Alerts -->

<!-- Start Slideshow -->
<?php 
	if($hasslideshow) {
		require_once(dirname(__FILE__).'/includes/slideshow.php');
	} 
?>
<!-- End Slideshow -->


<!-- Start Middle Blocks -->
<?php 
	if($PAGE->theme->settings->frontpagemiddleblocks==1) {
		require_once(dirname(__FILE__).'/includes/middleblocks.php');
	} else if($PAGE->theme->settings->frontpagemiddleblocks==2 && !isloggedin()) {
		require_once(dirname(__FILE__).'/includes/middleblocks.php');
	} else if($PAGE->theme->settings->frontpagemiddleblocks==3 && isloggedin()) {
		require_once(dirname(__FILE__).'/includes/middleblocks.php');
	} 
?>
<!-- End Middle Blocks -->

<!-- Start Frontpage Content -->
<?php if($PAGE->theme->settings->usefrontcontent ==1) { 
	echo $PAGE->theme->settings->frontcontentarea;
	?>
<?php }?>
<!-- End Frontpage Content -->


    <div id="page-content" class="row-fluid">
    	 <!-- Start Blocks Top -->
			        			<?php if($hastopblocks){ ?>
			        				<div id="blocks-top" class="block-region blocks_inline">
			        					<?php if($hastopleft){ 
			        						echo $OUTPUT->blocks('top-left', 'span4 block-left');
			        					 } if($hastopmiddle){ 
			        						echo $OUTPUT->blocks('top-middle', 'span4 block-middle');
			        					 } if($hastopright){ 
			        						echo $OUTPUT->blocks('top-right', 'span4 block-right');
			        					 }?>
			        				</div>
								<?php } ?>
								<!-- End Block Top -->
								
			<?php if($hascenterblock){ ?>
					<div id="region-center" class="block-region">
	        			<div class="region-content">
	        				<?php echo $OUTPUT->blocks('center', 'span12'); ?>	        				
	        			</div>
	        			<div class="sitename">
	        				<p><?php echo $SITE->shortname; ?></p>
	        			</div>
	        		</div>
				<?php } ?>

        <section id="region-main" class="span12">
        	<div id="page-navbar" class="clearfix">
            	<div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
            	<nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
        	</div>
            <?php
            	echo $OUTPUT->course_content_header();
	            echo $OUTPUT->main_content();
	            echo $OUTPUT->course_content_footer();
            ?>
        </section>
     
        <!-- Start Blocks Bottom -->
	                    <?php if($hasbottomblocks){ ?>
	        				<div id="blocks-bottom" class="block-region blocks_inline">
	        					<?php if($hasbottomleft){ 
	        						echo $OUTPUT->blocks('bottom-left', 'span4 block-left');
	        					 } if($hasbottommiddle){ 
	        						echo $OUTPUT->blocks('bottom-middle', 'span4 block-middle');
	        					 } if($hasbottomright){ 
	        						echo $OUTPUT->blocks('bottom-right', 'span4 block-right');
	        					 }
	        					 ?>
	        				</div>
						<?php } ?>
			<!-- End Blocks Bottom -->
    </div>
    
    <!-- End Main Regions -->
    
    
    <!-- Start Blocks Main Page -->
	<?php if ($hasmainpageblocks) { ?>
			<?php require_once(dirname(__FILE__).'/includes/blocksmainpage.php'); ?>
	<?php } ?>
	<!-- End Blocks Main Page -->

    <?php if (is_siteadmin()) { ?>
	<div class="hidden-blocks">
    	<div class="row-fluid">
        	<h4><?php echo get_string('visibleadminonly', 'theme_essential') ?></h4>
            <?php
                echo $OUTPUT->essentialblocks('hidden-dock');
            ?>
    	</div>
	</div>
	<?php } ?>

	<footer id="page-footer" class="container-fluid">
		<?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>
	</footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>

<!-- Start Google Analytics -->
<?php if ($hasanalytics) { ?>
	<?php require_once(dirname(__FILE__).'/includes/analytics.php'); ?>
<?php } ?>
<!-- End Google Analytics -->

<script type="text/javascript">
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
</script>

</body>
</html>
