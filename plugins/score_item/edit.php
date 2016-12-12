<?php
    
	require_once('../../config.php');
	require_once('score_item_form.php');
	require_once('lib.php');
	require_once("{$CFG->libdir}/formslib.php");
		
	global $USER,$DB,$OUTPUT,$PAGE,$CFG,$COURSE;
	
	$courseid = required_param('id', PARAM_INT);
	$userid =  required_param('userid', PARAM_INT);
	$itemid =  optional_param('itemid',null, PARAM_INT);	
	$rem = optional_param('rem',null, PARAM_INT);
	$confirm = optional_param('confirm',null, PARAM_INT);
	
	$context = get_context_instance(CONTEXT_COURSE, $courseid);
	
	// Setup page
	$PAGE->set_context($context);
	$PAGE->set_pagelayout('standard');
	$url = $CFG->wwwroot.'/blocks/score_item/edit.php?id='.$courseid.'&userid='.$userid;
	$courseurl = $CFG->wwwroot.'/course/view.php?id='.$courseid;
	$PAGE->set_url($url);	
	
	// Setup navbar
	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add(get_string('pluginname', 'block_score_item'), $url);
	$PAGE->navbar->add(get_string('course'), $courseurl);
	$PAGE->navbar->add(get_string('edittags', 'block_score_item'));;
	
	
	$post_keys = array_keys($_POST);
	if (in_array ('addScores', $post_keys)) { // have they clicked?
	
		$itemscores = array('score' => array(), 'comment' => array());
	    foreach ($_POST as $key => $value){
	    	$itemid = substr($key, strpos($key, '_') + 1);	    	
	    	if (preg_match('/^radio_(.*)$/', $key, $matches)){ // score radio?
				$score = $value;
	    		$comment = $_POST['area_'.$itemid];
	    		
	    		if($currentscore = block_score_item_get_score_by_id($itemid,$USER->id)){ //update
					$currentscore->score = $score;
					$currentscore->comment = $comment;
					$currentscore->timemodified = time();
					block_score_item_update_score_item($currentscore);
				}else{ // create
					$itemscore = new stdClass;
					$itemscore->itemid = $itemid;
					$itemscore->userid = $USER->id;
					$itemscore->courseid = $courseid;
					$itemscore->moduleid = block_score_item_get_module_item($itemid);
					$itemscore->score = $score;
					$itemscore->comment = $comment;
					$itemscore->timemodified = time();
					block_score_item_add_score_item($itemscore);
				}
			}
			
		}
		
	}
	
	echo $OUTPUT->header();	
	// Set up necessary strings
	$OUTPUT->heading(get_string('edittags','block_score_item'));
	
	if($itemid){
		if($rem){
			if($confirm){
				block_score_item_delete_score($itemid,$userid);
				redirect($url);
			}
			echo $OUTPUT->confirm(get_string('score_item_delete', 'block_score_item'), 
                                     $url.'&itemid='.$itemid.'&rem=1&confirm=1', $url);
			  	
		}
	}
	else{// scores given by a user
	
			print_object("userid: ".$userid);
			$items = block_score_item_get_resources_visited_by_course_and_user($courseid,$userid);
			if(count($items)>0){
				$table = new html_table();
				$table->head = array(get_string('item','block_score_item'),get_string('score'), get_string('comment','block_score_item').'<img src="'.$OUTPUT->pix_url('t/edit') . '" class="iconsmall" /><input type="submit" name="addScores" value="'.get_string('save').'" />', get_string('remove'));
				$table->data = array();
				
				
				foreach ($items as $item) {
					$itemid = $item->cmid;
					$modname = $item->module;
					$moduleid = block_score_item_get_module_item($itemid);
					
					$score = 0;
					$comment = '';
					$delete = '<img src="'.$OUTPUT->pix_url('t/delete') . '" class="iconsmall"/>';
					if($itemscore = block_score_item_get_score_by_id($itemid,$USER->id)){
						$score = $itemscore->score;
						$comment = $itemscore->comment;
						$delete = '<a href="'.$url.'&itemid='.$itemid.'&userid='.$itemscore->userid.'&rem=1"><img src="'.$OUTPUT->pix_url('t/delete') . '" class="iconsmall"/></a></center></a>';
					}
					
					$time = time();				
					$itemurl = block_score_item_get_item_url($itemid ,$moduleid );
					
					$itemurl .= '<br/>'.get_string('currentscore','block_score_item').': '.$score;
					
					$radio = '';
					for($i = 0; $i<6;$i++){
							$radio .= '<input type="radio" name="radio_'.$itemid.'" value="'.$i.'" >'.$i." ";						
					}
					$textarea = '<textarea name="area_'.$itemid.'">'.$comment.'</textarea>';
					
					$table->data[] = array($itemurl, $radio, $textarea, $delete);
				}
			
				print('<form name="addtagform" method="post" action="edit.php?id='.$courseid.'&userid='.$userid.'" onSubmit="submitting=true;return true;">');
				echo html_writer::table($table);
				print('</form>');
			}else{
				echo get_string('youdonthaveitemstoedit','block_score_item');
			}
		
	}	
	echo $OUTPUT->footer();
	
?>
