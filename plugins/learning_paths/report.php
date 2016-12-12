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
	
    require_once('../../config.php');
	require_once('lib.php');
	
	global $DB, $USER, $OUTPUT, $PAGE, $CFG,$COURSE;
	
	$courseid = required_param('courseid', PARAM_INT);
	$objectiveid = optional_param('objectiveid', null, PARAM_INT);
	$pathid = optional_param('pathid', null, PARAM_INT);
	$userid = optional_param('userid', null, PARAM_INT);
	
	require_login($courseid);
	
	// Setup Page
	$url = new moodle_url('/blocks/learning_paths/report.php?courseid='.$courseid);
	$courseurl = new moodle_url('/course/view.php?id='.$courseid);
	
	$PAGE->set_url($url);
	$PAGE->set_context(context_system::instance(), $courseid);
	$PAGE->set_pagelayout('standard');
	$PAGE->set_heading(get_string('report'));
	$PAGE->set_title(get_string('report'));
	
	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add(get_string('course'),$courseurl);
	$PAGE->navbar->add(get_string('report'),$url);
	
	
	
	echo $OUTPUT->header();
	
	$paths = block_lp_get_paths_course($courseid);
	print_object($paths);
	if(count($paths)>0){
		$table = new html_table();
		$table->head  = array(get_string('objective', 'block_learning_paths'),get_string('path', 'block_learning_paths'),get_string('user'), get_string('status', 'block_learning_paths'),get_string('progress', 'block_learning_paths'));
		$table->data = array();
		
		
		foreach($paths as $path){
			$objname = $path->objectivename;
			$pathid = $path->pathid;
			$pathname = $path->pathname;
			
			
			$users = block_lp_get_users_path($pathid);
			foreach($users as $user){
				$userid = $user->userid;
				$currentuser = block_lp_get_user_info($userid);
				$userurl = '<a href="'.$CFG->wwwroot.'/user/profile.phpid='.$userid.'">'.$currentuser->firstname.' '.$currentuser->lastname.'</a>';
				$status = $user->status;
				$progress = block_lp_get_progress_user_path($courseid,$userid,$pathid);
				$table->data[] = array($objname,$pathname,$userurl,$status,$progress);
			}
			
		}
		echo html_writer::table($table);
	}
	else{
		echo get_string('youdonthaveusers','block_learning_paths');
	}
	
	echo $OUTPUT->footer();
?>
