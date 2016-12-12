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

$hasfacebook    = (empty($PAGE->theme->settings->facebook)) ? false : $PAGE->theme->settings->facebook;
$hastwitter     = (empty($PAGE->theme->settings->twitter)) ? false : $PAGE->theme->settings->twitter;
$hasgoogleplus  = (empty($PAGE->theme->settings->googleplus)) ? false : $PAGE->theme->settings->googleplus;
$haslinkedin    = (empty($PAGE->theme->settings->linkedin)) ? false : $PAGE->theme->settings->linkedin;
$hasyoutube     = (empty($PAGE->theme->settings->youtube)) ? false : $PAGE->theme->settings->youtube;
$hasflickr      = (empty($PAGE->theme->settings->flickr)) ? false : $PAGE->theme->settings->flickr;
$hasvk          = (empty($PAGE->theme->settings->vk)) ? false : $PAGE->theme->settings->vk;
$haspinterest   = (empty($PAGE->theme->settings->pinterest)) ? false : $PAGE->theme->settings->pinterest;
$hasinstagram   = (empty($PAGE->theme->settings->instagram)) ? false : $PAGE->theme->settings->instagram;
$hasskype       = (empty($PAGE->theme->settings->skype)) ? false : $PAGE->theme->settings->skype;
$hasios         = (empty($PAGE->theme->settings->ios)) ? false : $PAGE->theme->settings->ios;
$hasandroid     = (empty($PAGE->theme->settings->android)) ? false : $PAGE->theme->settings->android;
$haswebsite     = (empty($PAGE->theme->settings->website)) ? false : $PAGE->theme->settings->website;

$hastagline = ($SITE->summary);

// If any of the above social networks are true, sets this to true.
$hassocialnetworks = ($hasfacebook || $hastwitter || $hasgoogleplus || $hasflickr || $hasinstagram || $hasvk || $haslinkedin || $haspinterest || $hasskype || $haslinkedin || $haswebsite || $hasyoutube ) ? true : false;
$hasmobileapps = ($hasios || $hasandroid ) ? true : false;
$hasheaderprofilepic = (empty($PAGE->theme->settings->headerprofilepic)) ? false : $PAGE->theme->settings->headerprofilepic;

$hasheaderprofilepic = (empty($PAGE->theme->settings->headerprofilepic)) ? false : $PAGE->theme->settings->headerprofilepic;
$hasslogan= (empty($PAGE->theme->settings->slogan)) ? false : $PAGE->theme->settings->slogan;

/* Modified to check for IE 7/8. Switch headers to remove backgound-size CSS (in Custom CSS) functionality if true */
$checkuseragent = '';
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $checkuseragent = $_SERVER['HTTP_USER_AGENT'];
}
?>

<?php
// Check if IE7 browser and display message
if (strpos($checkuseragent, 'MSIE 7')) {
	echo get_string('ie7message', 'theme_essential');
}?>

<?php
if (strpos($checkuseragent, 'MSIE 8') || strpos($checkuseragent, 'MSIE 7')) {?>
    <header id="page-header-IE7-8" class="clearfix">
<?php
} else { ?>
    <header id="page-header" class="clearfix">
<?php
} ?>

    <div class="container-fluid">
    <div class="row-fluid">
    <!-- HEADER: LOGO AREA -->
        <?php if ($hassocialnetworks && $hasmobileapps) { ?>
        	<div class="span6">
        <?php } else if (!$hassocialnetworks && $hasmobileapps) { ?>
        	<div class="span6">
        <?php } else if ($hassocialnetworks && !$hasmobileapps) { ?>
        	<div class="span6">
        <?php } else { ?>
        	<div class="span9">
        <?php } ?>
            <?php if (!$haslogo) { ?>
                <i id="headerlogo" class="fa fa-<?php echo $PAGE->theme->settings->siteicon ?>"></i>
                <?php if ($hasslogan) { ?>
                	<h1 id="title"><?php echo $SITE->shortname; ?></h1>
                	<h2 id="subtitle"><?php echo $hasslogan; ?></h2>                	
                <?php } else if($hastagline){ ?>
                	<h1 id="title" style="line-height: 2em"><?php echo $SITE->shortname; ?></h1>
                	<h2 id="subtitle"><?php p(strip_tags(format_text($hastagline, FORMAT_HTML))) ?></h2>
                <?php } ?>
                
            <?php } else { ?>                
                <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
                
            <?php } ?>
        </div>
         <?php if (isloggedin() && $hasheaderprofilepic) { ?>
        <div class="span3 pull-right" id="profilepic">
            <p id="socialheading"><?php echo $USER->firstname; ?></p>
            <ul class="socials unstyled nav pull-right">
                <li><?php include('profileblock.php');?></li>
            </ul>            

        </div>
        <?php
        }else{
        	include('profileblock.php');
        }

        // If true, displays the heading and available social links; displays nothing if false.
        if ($hassocialnetworks) {
        ?>
        <div class="span3 pull-right">
        <p id="socialheading"><?php echo get_string('socialnetworks','theme_essential')?></p>
            <ul class="socials unstyled">
                <?php if ($hasgoogleplus) { ?>
                <li><a href="<?php echo $hasgoogleplus; ?>" class="socialicon googleplus"><i class="fa fa-google-plus fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hastwitter) { ?>
                <li><a href="<?php echo $hastwitter; ?>" class="socialicon twitter"><i class="fa fa-twitter fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hasfacebook) { ?>
                <li><a href="<?php echo $hasfacebook; ?>" class="socialicon facebook"><i class="fa fa-facebook fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($haslinkedin) { ?>
                <li><a href="<?php echo $haslinkedin; ?>" class="socialicon linkedin"><i class="fa fa-linkedin fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hasyoutube) { ?>
                <li><a href="<?php echo $hasyoutube; ?>" class="socialicon youtube"><i class="fa fa-youtube fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hasflickr) { ?>
                <li><a href="<?php echo $hasflickr; ?>" class="socialicon flickr"><i class="fa fa-flickr fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($haspinterest) { ?>
                <li><a href="<?php echo $haspinterest; ?>" class="socialicon pinterest"><i class="fa fa-pinterest fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hasinstagram) { ?>
                <li><a href="<?php echo $hasinstagram; ?>" class="socialicon instagram"><i class="fa fa-instagram fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hasvk) { ?>
                <li><a href="<?php echo $hasvk; ?>" class="socialicon vk"><i class="fa fa-vk fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hasskype) { ?>
                <li><a href="<?php echo $haskype; ?>" class="socialicon skype"><i class="fa fa-skype fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($haswebsite) { ?>
                		<li><a href="<?php echo $haswebsite; ?>" class="socialicon website"><i class="fa fa-globe fa-inverse"></i></a></li>
                <?php } ?>
	    </ul>
        </div>
        <?php 
        }

        // If true, displays the heading and available social links; displays nothing if false.
        if ($hasmobileapps) {
        ?>
        <div class="span2 pull-right">
        <p id="socialheading"><?php echo get_string('mobileappsheading','theme_essential')?></p>
            <ul class="socials unstyled">
                <?php if ($hasios) { ?>
                <li><a href="<?php echo $hasios; ?>" class="socialicon ios"><i class="fa fa-apple fa-inverse"></i></a></li>
                <?php } ?>
                <?php if ($hasandroid) { ?>
                <li><a href="<?php echo $hasandroid; ?>" class="socialicon android"><i class="fa fa-android fa-inverse"></i></a></li>
                <?php } ?>
	    </ul>
        </div>
        <?php 
        }
        
        if (!empty($courseheader)) { ?>
        <div id="course-header"><?php echo $courseheader; ?></div>
        <?php } ?>
    </div>
</header>

<header role="banner" class="navbar navbar">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $SITE->shortname; ?></a>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                    <li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

       


<div id="course-info" class="blocks_inline">
        	<div id="welcome_message">
        		<h2><?php echo get_string('welcome','theme_essential').'  '.$USER->firstname;; ?></h2>
        	</div>
	        <div id="page-header-date"><h3><?php setlocale(LC_ALL,"es_ES");
					echo strftime("%A %d de %B del %Y"); ?></h3></div>
				<div is="page-header-help">
						 <div id="font-slider">
				        	<h3><?php echo get_string('fontsize','theme_essential'); ?></h3>
				        	<input value="" id="slider_value" name="slider_value" />	        	
			            <span id="slider"> </span>
			            <div id="save_buttons"><button><a href="#" id="save_fontsize"><?php echo get_string('save','theme_essential'); ?></a></button></div>
				        </div>
				        <?php if (isloggedin()){ ?>
				        	<div id='course_menus' class='blocks_inline pull-right'>
			                <ul>
			                    <?php if ($this->page->course->id != SITEID): ?>
			                        <li class="dropdown">
			                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="position: relative;"><?php echo $this->pix_icon('i/course', '', '', array('style' => 'padding-right: 5px')); ?><?php echo $this->page->course->shortname; ?><b class="caret"></b></a>
			                            <ul class="dropdown-menu pull-right">
			                                <li><?php echo html_writer::link(new moodle_url('/course/view.php', array('id' => $this->page->course->id)), get_string('coursehome','theme_essential')); ?>
			                                <li class="divider"></li>
			                                <li><?php echo html_writer::link(new moodle_url('/user/index.php', array('id' => $this->page->course->id)), $this->pix_icon('i/users', '') . get_string('participants')); ?>
			                                <!-- <li><?php echo html_writer::link(new moodle_url('/badges/view.php', array('type' => 2, 'id' => $this->page->course->id)), $this->pix_icon('i/badge', '') . ' Course badges'); ?> -->
											
											  <li><?php echo html_writer::link(new moodle_url('/course/recent.php', array('id' => $this->page->course->id)), get_string('pluginname','block_recent_activity')); ?>
											
			                                <?php if (has_capability('moodle/grade:viewall', $this->page->context)): ?>
			                                    <li><?php echo html_writer::link(new moodle_url('/grade/report/index.php', array('id' => $this->page->course->id)), $this->pix_icon('i/grades', '') . get_string('grades')); ?>
			                                <?php else: ?>
			                                    <li><?php echo html_writer::link(new moodle_url('/grade/report/user/index.php', array('id' => $this->page->course->id, 'userid' => $USER->id)), $this->pix_icon('i/grades', '') . ' Grades'); ?>
			                                <?php endif ?>
			
			                                <?php if (has_capability('moodle/site:viewreports', $this->page->context)): ?>
			                                    <li><?php echo html_writer::link(new moodle_url('/report/outline/index.php', array('id' => $this->page->course->id)), $this->pix_icon('i/report', '') . get_string('reports')); ?>
			                                <?php endif ?>
			                            </ul>
			                        </li>
			                    <?php endif ?>
			                    <li class="dropdown">
			                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="position: relative;"><?php echo $this->pix_icon('t/message', '', '', array('style' => 'padding-right: 5px')); ?><b class="caret"></b></a>
			                        <ul class="dropdown-menu pull-right">
			                            <li><?php echo html_writer::link(new moodle_url('/message/index.php'), $this->pix_icon('t/message', '') .get_string('messages','theme_essential')); ?></li>
			                            <li><?php echo html_writer::link(new moodle_url('/blog/index.php', array('userid' => $USER->id)), get_string('blog','theme_essential')); ?></li>
			                            <li><?php echo html_writer::link(new moodle_url('/mod/forum/user.php', array('id' => $USER->id)), get_string('forumpost','theme_essential')); ?></li>
			                        </ul>
			                    </li>
			                </ul>
			                <div class="dropdown">
			
			                </div>
				        <?php } ?>
					</div>
  	</div>
</div>
