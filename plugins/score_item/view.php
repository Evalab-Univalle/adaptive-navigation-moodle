<?php

	require_once('../../config.php');
	require_once('lib.php');
	
	global $USER,$DB,$OUTPUT,$PAGE,$CFG;
	
    // Set up necessary parameters
	$courseid = required_param('id', PARAM_INT);
	$userid =  optional_param('userid',null, PARAM_INT);
	$moduleid = optional_param('moduleid',null,PARAM_RAW);
	$itemid = optional_param('itemid',null, PARAM_INT);
	$startdate = optional_param('startdate',null, PARAM_INT);
	$enddate = optional_param('enddate',null, PARAM_INT);
	$limit  = optional_param('limit',0, PARAM_INT);
	$group= optional_param('groupby',0, PARAM_INT); // 0 itemid,  1 module type, 2 user
	$ranking= optional_param('ranking',0, PARAM_INT);
	$average= optional_param('average',0, PARAM_INT);
	
	// Setup page
	$context = get_context_instance(CONTEXT_COURSE, $courseid);	
	$PAGE->set_context($context);
	$PAGE->set_pagelayout('standard');
	$url = $CFG->wwwroot.'/blocks/score_item/view.php?id='.$courseid;
	$courseurl = $CFG->wwwroot.'/course/view.php?id='.$courseid;
	$PAGE->set_url($url);	
	
	// Setup navbar
	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add(get_string('pluginname', 'block_score_item'), $url);
	$PAGE->navbar->add(get_string('course'), $courseurl);
	$PAGE->navbar->add(get_string('viewtags', 'block_score_item'));
	
	
	echo $OUTPUT->header();
	
	// Set up necessary strings
	$OUTPUT->heading(get_string('edittags','block_score_item'));
	
	if($ranking == 1){ // top ranking
					$scores = block_score_item_get_ranking($courseid, true, true,true , 'itemid', 10);
					if(count($scores)>0){
						$table = new html_table();	
						$table->head = array(get_string('item', 'block_score_item'), get_string('score', 'block_score_item'));
						$table->data = array();
						foreach ($scores as $itemscore) {
							$itemid = $itemscore->g;
							$average = $itemscore->average;
							$moduleid = block_score_item_get_module_item($itemid);
							$modname = block_score_item_get_module_name($moduleid,$itemid);
							$itemname = block_score_item_get_display_name($modname,$itemid);
							$itemurl = block_score_item_get_itemscore_url($courseid,$itemid, 'view',$moduleid);
							$table->data[] = array($itemurl, $average);
						}
						echo html_writer::table($table);
					}
					else{
						echo $OUTPUT->error_text(get_string('noscorestoview','block_score_item'));
					}
	}
	else if($average == 1){ // average of each item
					$items = block_score_item_get_resources_course($courseid);
					
					if(count($item)>0){
						$table = new html_table();	
						$table->head = array(get_string('item', 'block_score_item'), get_string('average', 'block_score_item'));
						$table->data = array();
						foreach ($items as $item) {
							$itemid = $item->id;
							$moduleid = $item->module;
							$itemurl = block_score_item_get_itemscore_url($courseid,$itemid, 'view',$moduleid);
							
							$currentscore = block_score_item_score_average_item($courseid, $itemid);
							$table->data[] = array($itemurl, $currentscore);
						}
						echo html_writer::table($table);
					}
					else{
						echo $OUTPUT->error_text(get_string('noitemstoview','block_score_item'));
					}
	}else if($itemid){// scores given to a single item
	
		$moduleid = block_score_item_get_module_item($itemid);
		$itemurl = block_score_item_get_item_url($itemid,$moduleid);
		$average = block_score_item_score_average_item($courseid, $itemid);
		
		echo '<h3>'.$itemurl.'</h3>';		
		echo '<h4><em>'.get_string('average','block_score_item').': </em>'.$average.'</h4>';
	
		$scores = block_score_item_scores_item($courseid, $itemid, true, true, true, null);
		if(count($scores)>0){
			$table = new html_table();	
			$table->head = array(get_string('score','block_score_item'),get_string('comment','block_score_item'),get_string('user'),get_string('date'));
						
			$table->data = array();
			
			foreach ($scores as $itemscore) {
				$score = $itemscore->score;
				$comment = $itemscore->comment;
				$currentuserid  = $itemscore->userid;
				$userurl = block_score_item_get_user_url($courseid,$currentuserid);
				$date = date('l jS \of F Y h:i:s A',$itemscore->timemodified);
				$table->data[] = array($score, $comment, $userurl, $date);
			}
			echo html_writer::table($table);
		}
		else{
			echo $OUTPUT->error_text(get_string('noscorestoview','block_score_item'));
		}
	}
	else if($userid){ // scores given by a user
		$scores =  block_score_item_scores_user($courseid, $userid, true, true ,true);
	
		if(count($scores)>0){
			$table = new html_table();	
			$table->head = array(get_string('item','block_score_item'),get_string('score','block_score_item'),get_string('comment','block_score_item'),get_string('date','block_score_item'));
			$table->data = array();
			foreach($scores as $itemscore){
				$itemid = $itemscore->itemid;
				$moduleid = block_score_item_get_module_item($itemid);
				$itemurl = block_score_item_get_itemscore_url($courseid,$itemid, 'view',$moduleid);
				$currentscore = $itemscore->score;
				$comment = $itemscore->comment;
				$date = date('l jS \of F Y h:i:s A',$itemscore->timemodified);
				
				$table->data[] = array($itemurl, $currentscore, $comment,$date);
			}
			echo html_writer::table($table);
		}
		else{
			echo $OUTPUT->error_text(get_string('noscorestoview','block_score_item'));
		}
	}
	else{// get all scores			
		$scores = block_score_item_get_scores_course($courseid);
		if(count($scores)>0){
			$table = new html_table();	
			$table->head = array(get_string('item','block_score_item'),get_string('score'),get_string('comment','block_score_item'),get_string('user'),get_string('date'));
			$table->data = array();
			foreach ($scores as $itemscore) {
				$itemid = $itemscore->itemid;				
				$moduleid = $itemscore->moduleid;
	 			$currentuserid  = $itemscore->userid;
	 			$score = $itemscore->score;
	 			$comment = $itemscore->comment;
				$userurl = block_score_item_get_user_url($courseid,$currentuserid);
				$date = date('l jS \of F Y h:i:s A',$itemscore->timemodified);
				$itemurl = block_score_item_get_itemscore_url($courseid,$itemid, 'view',$moduleid);	
				
				$table->data[] = array($itemurl, $score, $comment, $userurl, $date);
			}
			echo html_writer::table($table);
		}
		else{
			echo $OUTPUT->error_text(get_string('noscorestoview','block_score_item'));
		}
	}
	
	
	echo $OUTPUT->footer();
?>
