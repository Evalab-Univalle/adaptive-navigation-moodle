<?php
    
	require_once ('lib.php');
	require_once ('scoreitem_form.php');
	require_once("{$CFG->libdir}/formslib.php");

	defined('MOODLE_INTERNAL') || die();

	global $CFG, $USER, $OUTPUT,$PAGE,$COURSE;
	
	$PAGE->set_heading('Learning Styles');
	$PAGE->set_title('Learning Styles');
	
	$url = $CFG->wwwroot.'/blocks/score_item/learningstyle.php';
	$PAGE->set_url($url);
	$PAGE->set_pagelayout('standard');
	
	require_login($COURSE->id);
	
	print_object($COURSE);
	print_object($USER);
	
	
	$form = new learningstyle_form();
	
	if($form->is_cancelled()) {
		redirect($url);
	}
	else if ($fromform = $form->get_data()) {
	    print_object($fromform);
	}
	
	echo $OUTPUT->header();
	
	$time = now();
	$toform = array('user_id'=>$USER->id,'date'=>$time);
	$form->set_data($toform);
	$form->display();
	
	echo $OUTPUT->footer();
?>
