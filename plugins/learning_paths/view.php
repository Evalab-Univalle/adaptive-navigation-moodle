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
	require_once('learning_paths_form.php');
	require_once('lib.php');
	require_once("{$CFG->libdir}/formslib.php");
	include $CFG->dirroot.'/lib/graphlib.php';
	

	global $DB, $USER, $OUTPUT, $PAGE, $CFG,$COURSE;
	
	
	$courseid = required_param('courseid', PARAM_INT);
	$viewpage = required_param('viewpage', PARAM_INT);
	$objectiveid = optional_param('objectiveid', null, PARAM_INT);
	$pathid = optional_param('pathid', null, PARAM_INT);
	$itemid = optional_param('itemid', null, PARAM_INT);
	$userid = optional_param('userid', null, PARAM_INT);
	$remove = optional_param('remove', null, PARAM_INT); // default update
	$confirm = optional_param('confirm', null, PARAM_INT);

	
	$url = new moodle_url('/blocks/learning_paths/view.php?viewpage='.$viewpage.'&courseid='.$courseid);
	$courseurl = new moodle_url('/course/view.php?id='.$courseid);
	
	require_login($courseid);
	
	// Setup Page
	
	$PAGE->set_url($url);
	$PAGE->set_context(context_system::instance(), $courseid);
	$PAGE->set_pagelayout('standard');
	$PAGE->set_heading(block_lp_nav_title($viewpage));
	$PAGE->set_title(block_lp_nav_title($viewpage));
	
	$nav_title = block_lp_nav_title($viewpage);
	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add(get_string('course'),$courseurl);
	$PAGE->navbar->add($nav_title);
	
	
	
	echo $OUTPUT->header();
	/*
	 $tabrow = array();
	 $tabrow[] = new tabobject('learning_objecives','view.php?'.$params, get_string('learning_objecives', 'block_learning_paths'));
	 $tabrow[] = new tabobject('learning_paths','view.php?'.$params, get_string('learning_paths', 'block_learning_paths'));
	 $tabrow[] = new tabobject('learning_paths_items','view.php?'.$params, get_string('learning_paths', 'block_learning_paths'));
	 $tabrow[] = new tabobject('learning_paths_users','view.php?'.$params, get_string('learning_paths', 'block_learning_paths'));
	
	
	$selected = array('0');
	
	$inactive = array();
	
	$objectives = block_lp_get_objectives($courseid);
	if(!count($objectives)>0){
		$inactive[] = array('1','2','3');
	}
	
	 $tabs = array();
	 $tabs[] = $tabrow;
     print_tabs($tabs,$selected, $inactive, null, true);*/

	 if($viewpage == 1){ // objetive
	 	$form = new learningobjective_form(null , array('courseid' => $courseid));	 	
	 	$toform = array('viewpage' => $viewpage , 'courseid' => $courseid);
	 	$form->set_data($toform);
	 	
	 	if($remove){
				if($confirm == 1){
					block_lp_delete_objective($id);
				}
				echo $OUTPUT->confirm(get_string('objective_delete', 'block_learning_paths'), 
										 $url.'&objectiveid='.$id.'&remove=1&confirm=1', $url);
			}
			
	 	if ($data = $form->get_data()){
				print_object("get data");
				$data->course = $courseid;
			    if($data->id){ //update record
					$objective = block_lp_get_objective($data->id);
					$form->set_data($objective);
			    	block_lp_update_objective($data);
			    }
				else{// create record
					block_lp_add_objective($data);
				}
				redirect($url);
		}
		
		  
	}
	else if($viewpage == 2){ // path	 		 
	 	$form = new learningpath_form(null , array('courseid' => $courseid));	 	
	 	$toform = array('viewpage' => $viewpage, 'courseid' => $courseid ,'pathid' => $pathid);
	 	$form->set_data($toform);
	 if ($data=$form->get_data()){
			    if($data->id){ //update record
					$path = block_lp_get_path($data->id);
					$form->set_data($path);
			    	block_lp_add_learning_path($data);
			    }
				else{
					block_lp_add_learning_path($data);
				}
			    redirect($url);
		}
		if($remove){
				if($confirm == 1){
					block_lp_delete_path($id);
				}
				echo $OUTPUT->confirm(get_string('path_delete', 'block_learning_paths'), 
										 $url.'&pathid='.$id.'&remove=1&confirm=1', $url);
			}
			
	 }
	 else if($viewpage == 3){ // path item
		$form = new  learningpathitems_form(null , array('courseid' => $courseid));	 	
	 	$toform = array('viewpage' => $viewpage, 'courseid' => $courseid , 'pathid' => $pathid , 'itemid' => $itemid);
	 	$form->set_data($toform);
		if ($data = $form->get_data()){
			    	foreach($data as $name => $value){
						if (preg_match('/^item_(.*)$/', $name, $matches)){// have they clicked yes/no option
							if($value == 1){ // to add tho the path
							
								$itemid = substr($name, strpos($name, '_') + 1);
								$module = block_lp_get_module_item($itemid);
							
								$instance = new stdClass;
								$instance->pathid = $pathid;
								$instance->itemid = $itemid;
								$instance->moduleid = $module;
								$instance->deadline = $data->{'deadline_'.$itemid};
								$instance->action = $data->{'action_'.$itemid};
								$instance->weight = $data->{'weight_'.$itemid};
								
								if($pathitem = block_lp_get_pathitem_instance($pathitd, $itemid)){// already exists
									block_lp_update_learning_path_items($instance);
								}
								else{// add item to the path
									block_lp_add_learning_path_items($instance);
								}
							}
						}
					}
			    redirect($url);
		}
		 
		 if($remove){
				if($confirm == 1){
					$pathitem = block_lp_get_pathitem_instance($pathitd, $itemid);
					block_lp_delete_learning_path_items($pathitem->id);
				}
				echo $OUTPUT->confirm(get_string('path_delete', 'block_learning_paths'), 
										 $url.'&pathid='.$pathid.'&itemid='.$itemid.'&remove=1&confirm=1', $url);
			}
	 }
	 else if($viewpage == 4){ // path user
	 
		$form = new learningpathusers_form(null , array('courseid' => $courseid));	 	
		$toform = array('viewpage' => $viewpage, 'courseid' => $courseid , 'pathid' => $pathid , 'userid' => $userid);
	 	$form->set_data($toform);
		if ($data = $form->get_data()){
			    foreach($data as $name => $value){						
						if (preg_match('/^user_(.*)$/', $name, $matches)){// have they clicked yes/no option
							$userid = substr($name, strpos($name, '_') + 1);	
								if($value == 1){ // to add to the path
									$instance = new stdClass;
									$pathid = $data->{'pathid_'.$userid};
									$instance->pathid = $pathid;
									$instance->userid = $userid;
									$instance->startdate = time();
									$instance->status = 'active';
									if($pathuser = block_lp_get_pathuser_instance($pathid,$userid)){// already exists
										$pathuser->startdate = time();
										$pathuser->status = 'active';
										block_lp_update_learning_path_user($pathuser);
									}
									else{//enroll user
										block_lp_add_learning_path_user($instance);
									}
								}
						}
					}
			    //redirect($url);
		}
		 
		 if($remove){
				if($confirm){
					$pathuser = block_lp_get_pathuser_instance($pathitd, $userid);
					block_lp_delete_learning_path_user($patuser->id);
				}
				echo $OUTPUT->confirm(get_string('path_delete', 'block_learning_paths'), 
										 $url.'&pathid='.$pathid.'&itemid='.$itemid.'&remove=1&confirm=1', $url);
			}
	 	
	 }
	  
	$form->set_data($toform);

	// Display Form.
	$form->display();
	
	if ($form->is_cancelled()){
	   	 		redirect($url);	 
	}
	
	// Display List.
	if($table=$form->display_list()) {
	    echo html_writer::table($table);
	}
	else{
		echo get_string('youdonthaveany','block_learning_paths');
	}
	echo $OUTPUT->footer();
?>
