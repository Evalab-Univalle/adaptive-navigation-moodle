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

$haslogo = (!empty($PAGE->theme->settings->logo));
$haslayout = (empty($PAGE->theme->settings->layout)) ? 0 : $PAGE->theme->settings->layout;
$layouts = array('three-column','just-right', 'just-left', 'no-columns');
$layout = $layouts[$haslayout];
$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;
$sideregionsmaxwidth = (!empty($PAGE->theme->settings->sideregionsmaxwidth));

/* aside */
$hasleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hasright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));

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



theme_funny_check_colours_switch();
theme_funny_initialise_colourswitcher($PAGE);

$bodyclasses = array();
$bodyclasses[] = $layout;
$bodyclasses[] = 'funny-colours-' . theme_funny_get_colours();
if ($sideregionsmaxwidth) {
    $bodyclasses[] = 'side-regions-with-max-width';
}

if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}



echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div id="page-content" class="row-fluid <?php echo $layout ?>">
   								 <!-- Start Blocks Top -->
			        			<?php if($hastopblocks){ ?>
			        				<div id="blocks-top" class="block-region blocks_inline">
			        					<?php if($hastopleft){ 
			        						echo $OUTPUT->one_block_region('top-left', 'span4 block-left');
			        					 } if($hastopmiddle){ 
			        						echo $OUTPUT->one_block_region('top-middle', 'span4 block-middle');
			        					 } if($hastopright){ 
			        						echo $OUTPUT->one_block_region('top-right', 'span4 block-right');
			        					 }?>
			        				</div>
								<?php } ?>
								<!-- End Block Top -->
		    	<?php if($layout == 'three-column') { ?>
		    		<div id="<?php echo $regionbsid; ?>" class="span9">
		                <section id="region-main" class="span9 pull-right">
		                <?php } else if($layout == 'just-left'){ ?>
		                <div id="<?php echo $regionbsid; ?>" class="span12">
		                <section id="region-main" class="span9 pull-right">
		                <?php } else if($layout == 'just-right'){ ?>
		                <div id="<?php echo $regionbsid; ?>" class="span9">
		                <section id="region-main" class="span12 pull-right">
		                <?php } else { ?>
		                <div id="<?php echo $regionbsid; ?>" class="span12">
		                <section id="region-main" class="span12">
			                <?php } ?>
			                	<div id="page-navbar" class="clearfix">
			            			<nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
			            			<div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
			        			</div>
			        			
			                    <?php
				                    echo $OUTPUT->course_content_header();
				                    echo $OUTPUT->main_content();
				                    echo $OUTPUT->course_content_footer();
			                    ?>
                </section>
                
                
              <!-- Start Block Left -->
                	<?php if($layout == 'three-column' || $layout == 'just-left'){
						if($hasleft || $hasright){
							echo '<div class="span3 desktop-first-column block-region">';
                			if($hasleft){
                				echo $OUTPUT->blocks('side-pre');
                			}
							if($layout == 'just-left'){
								if($hasright){
	                				echo $OUTPUT->blocks('side-post');
	                			}
							}
                			echo '</div>';
						}                		
                	}
					echo '</div>'; ?>
                 <!-- End Block Left -->
                  <!-- Start Block Right -->
                   <?php if($layout == 'three-column' || $layout == 'just-right')  {
					   if($hasleft || $hasright){
                   			echo '<div class="span3">';
                   				if($hasleft){
                   					echo $OUTPUT->blocks('side-pre');
                   				}
                   				if($hasright){
	                				echo $OUTPUT->blocks('side-post');
	                			}
	                		echo '</div>';
						}
	                } ?>
             <!-- End Block Right -->
      		 <!-- Start Blocks Bottom -->
	                    <?php if($hasbottomblocks){ ?>
	        				<div id="blocks-bottom" class="block-region blocks_inline">
	        					<?php if($hasbottomleft){ 
	        						echo $OUTPUT->one_block_region('bottom-left', 'span4 block-left');
	        					 } if($hasbottommiddle){ 
	        						echo $OUTPUT->one_block_region('bottom-middle', 'span4 block-middle');
	        					 } if($hasbottomright){ 
	        						echo $OUTPUT->one_block_region('bottom-right', 'span4 block-right');
	        					 }
	        					 ?>
	        				</div>
						<?php } ?>
			<!-- End Blocks Bottom -->
    </div>
    <!-- End Main Regions -->

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
<a href="#top" class="back-to-top" title="<?php print_string('backtotop', 'theme_funny'); ?>"><i class="fa fa-angle-up "></i></a>
</body>
</html>
