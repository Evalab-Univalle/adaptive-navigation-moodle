/**
 * The funny theme is built upon the Essential theme.
 *
 * @package    theme
 * @subpackage funny
 * @author     estarguars113
 * @author     Based on code originally written Julian (@moodleman) Ridden,by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

<?php
		function get_content () {
			global $USER, $CFG, $SESSION, $COURSE;
			$wwwroot = '';
			$signup = '';}
		
			if (empty($CFG->loginhttps)) {
				$wwwroot = $CFG->wwwroot;
			} else {
				$wwwroot = str_replace("http://", "https://", $CFG->wwwroot);
			}
		
		if (!isloggedin() or isguestuser()) {
			//echo '<h3 class="sitename">'.$SITE->shortname.'</h3>';
			echo '<form class="navbar-form" method="post" action="'.$wwwroot.'/login/index.php?authldap_skipntlmsso=1">';
			echo '<input class="span2" type="text" name="username" placeholder="'.get_string('username').'">';
			echo '<input class="span2" type="password" name="password" placeholder="'.get_string('password').'">';
			echo '<button class="btn" type="submit"> '.get_string('login').'</button>';
			echo '</form>';
		} else { 
		
		 echo html_writer::start_tag('div', array('id'=>'profilepic','class'=>'profilepic'));
				
					echo '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$USER->id.'&amp;course='.$COURSE->id.'"><img src="'.$CFG->wwwroot.'/user/pix.php?file=/'.$USER->id.'/f1.jpg" width="80px" height="80px" title="'.$USER->firstname.' '.$USER->lastname.'" alt="'.$USER->firstname.' '.$USER->lastname.'" /></a>';
				
			echo html_writer::end_tag('div');
			echo '<ul class="nav">
		
		<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#cm_submenu_5">
		<b class="caret"></b>
		</a>
		<ul class="dropdown-menu profiledrop">';
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/my">';
		echo '<em><i class="icon-book"></i>';
		echo get_string('mycourses');
		echo '</em></a>';
		echo '</li>';
		
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/user/profile.php">';
		echo '<em><i class="icon-user"></i>';
		echo get_string('viewprofile');
		echo '</em></a>';
		echo '</li>';
		
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/calendar/view.php?view=month">';
		echo '<em><i class="icon-calendar"></i>';
		echo get_string('calendar','calendar');
		echo '</em></a>';
		echo '</li>';
		
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/message/index.php">';
		echo '<em><i class="icon-envelope"></i>';
		echo get_string('messages','theme_essential');
		echo '</em></a>';
		echo '</li>';
		
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/grade/report/overview/index.php?id=1&userid='.$USER->id.'">';
		echo '<em><i class="icon-grades"></i>';
		echo get_string('grades');
		echo '</em></a>';
		echo '</li>';
		
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/user/files.php">';
		echo '<em><i class="icon-file"></i>';
		echo get_string('myfiles');
		echo '</em></a>';
		echo '</li>';
		
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/badges/mybadges.php">';
		echo '<em><i class="icon-certificate"></i>';
		echo get_string('badges');
		echo '</em></a>';
		echo '</li>';
		
		echo '<li>';
		echo '<a href="'.$CFG->wwwroot.'/login/logout.php">';
		echo '<em><i class="icon-signout"></i>';
		echo get_string('logout');
		echo '</em></a>';
		echo '</li>';
		
		
		echo '</ul></li></ul>';

}?>