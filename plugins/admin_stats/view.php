<?php

	require_once('../../config.php');
	require_once('admin_stats_form.php');
	require_once('lib.php');
	require_once("{$CFG->libdir}/formslib.php");
	include $CFG->dirroot.'/lib/graphlib.php';
	
	global $DB, $USER, $OUTPUT, $PAGE, $CFG,$COURSE;
	
	// Parameters
	$context = required_param('context', PARAM_INT);
	
	$categoryid = optional_param('categoryid', null, PARAM_INT);
	$courseid = optional_param('courseid', null, PARAM_INT);
	$cmid = optional_param('cmid', null, PARAM_INT);
	$action = optional_param('action', 0, PARAM_INT);// 0 default number of hits, 1 time spent
	
	
	$color1 = $CFG->color1;
	
	$url = $CFG->wwwroot.'/blocks/admin_stats/view.php?context='.$context;
	// Setup Page
	$PAGE->set_url($url);
	$PAGE->set_context(context_system::instance(),$COURSE->id);
	$PAGE->set_pagelayout('standard');
	$PAGE->set_heading(get_string('adminstats','block_admin_stats'));
	$PAGE->set_title(get_string('adminstats','block_admin_stats'));
	
	// Setup Navbar
	$nav_title = admin_stats_nav_title($context);
	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add(get_string("pluginname", 'block_admin_stats'), new moodle_url($url));
	$PAGE->navbar->add($nav_title);
	 
	echo $OUTPUT->header();
	
	if($context == 40){
		
		$form = new coursecategory_admin_stats_form();
		
		$toform = array('categoryid' => $categoryid , 'context' => $context);
		$form->set_data($toform);
		
		if ($form->is_cancelled()){
			redirect($url);
		}else if($data=$form->get_data()){
				$startdate = $data->start_date;
				$enddate = $data->end_date;
				$order = $data->order;
			    
			    
		}
	}else if($context == 50){
		$form = new admin_stats_form();
		$toform = array('courseid' => $courseid , 'context' => $context);
		$form->set_data($toform);
		
		if ($form->is_cancelled()){
			redirect($url);
		}
		else if($data = $form->get_data()){
			print_object("data");
			print_object($data);
			$startdate = $data->start_date;
			$enddate = $data->end_date;
			$order = $data->order;
			$action = $data->action;
			$type = $data->graphtype;
			
			$img = '<img src="'.$CFG->wwwroot.'/blocks/admin_stats/graph.php?courseid='.$courseid.'&order='.$order.'&action='.$action.'&type='.$type.'&startdate='.$startdate.'&endate='.$enddate.'"/>';
			
		}
	}else if($context == 70){
		$form = new module_admin_stats_form();
		
		$toform = array('cmid' => $cmid , 'context' => $context);
		$form->set_data($toform);
		
		if ($form->is_cancelled()){
			redirect($url);
		}else if($data=$form->get_data()){
			$startdate = $data->start_date;
			$enddate = $data->end_date;
			$order = $data->order;
			if($data->action == 0){
				$results = admin_stats_views_module($cmid, $startdate, $enddate, $order); 
			}
		}
	}
	
		
		echo $img;
		// Display Form.
		$form->display();
		
		echo $OUTPUT->footer();
?>
