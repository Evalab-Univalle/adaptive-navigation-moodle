<?php

    require_once('../../config.php');
    require_once('lib.php');
    require_once('semantic_tag_form.php');
    require_once("{$CFG->libdir}/formslib.php");
	include $CFG->dirroot.'/lib/graphlib.php';
    
	global $DB, $USER, $OUTPUT, $PAGE, $CFG;
	
	$courseid = required_param('id', PARAM_INT);
	$userid = optional_param('userid', null, PARAM_INT);
	$moduleid = optional_param('moduleid', null, PARAM_INT);
	$itemid = optional_param('itemid', null, PARAM_INT);
	$tagid = optional_param('tagid', null, PARAM_INT);
	$report = optional_param('report', null, PARAM_INT);
	
	// Setup page
	$url = $CFG->wwwroot.'/blocks/semantic_tag/view.php?courseid='.$courseid;
	$courseurl = $CFG->wwwroot.'/course/view.php?id='.$courseid;
	$PAGE->set_url($url);
	$context = get_context_instance(CONTEXT_COURSE, $courseid);	
	$PAGE->set_context($context);
	$PAGE->set_pagelayout('standard');	
	$PAGE->set_heading(get_string('viewtags','block_semantic_tag'));
	$PAGE->set_title(get_string('viewtags','block_semantic_tag'));
	
	
	// Setup Navbar
	if($tagid){
		$tag = semantic_tag_get_tag('id',$tagid);	
		$nav_title = $tag->name;
	}
	else if($itemid){
		$nav_title = semantic_tag_get_recourse_name($itemid);
	}
	else if($userid){
		$nav_title = $USER->fistname." ".$USER->lastname;
	}
	else if($report){
		$nav_title = get_string('report');
	}
	else{
		$nav_title = get_string('pluginname','block_semantic_tag');
	}
	
	
	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add(get_string("pluginname", 'block_semantic_tag'), new moodle_url($url));
	$PAGE->navbar->add(get_string('course'), $courseurl);
	$PAGE->navbar->add($nav_title);
	
	echo $OUTPUT->header();
	
	if($itemid){// tags of a single item
	
		$tags = semantic_tag_get_tags_item($itemid, $courseid);
		if(count($tags)>0){
			$table = new html_table();
			$table->head  = array(get_string('item', 'block_semantic_tag'),get_string('tags', 'block_semantic_tag'));
			$table->data = array();
			$itemurl = semantic_tag_get_item_url($itemid);
			
			
			$taglist = '<ul>';
			foreach ($tags as $tagid) {
				$tag = semantic_tag_get_tag('id',$tagid);
				$tagname = $tag->tag_name;
				$taglist .= '<li><a href="'.$CFG->wwwroot.'/blocks/semantic_tag/view.php?tagid='.$tagid.'" />'.$tagname.'</a></li>';
			}
			$taglist .= '</ul>';
			$table->data[] = array($itemurl, $taglist);
			
			echo html_writer::table($table);
		}
	}
	else if($tagid){// item taggued by the tag
		$tag = semantic_tag_get_tag('id',$tagid);
		add_to_log($courseid, 'tag','view',$url,$tagid,null,$USER->id);
		
		$courses = semantic_tag_get_tag_courses($tagname);
		
		if(count($courses)>0){
			$table = new html_table();
			$table->head  = array(get_string('items', 'block_semantic_tag'),get_string('tags', 'block_semantic_tag'));
			$table->data = array();
			
			$tag = semantic_tag_get_tag('id',$tagid);
			$items = semantic_tag_get_items_by_tag_course($tagid, $courseid);
			if(count($items)>0){
				foreach($items as $item){
					$itemurl = semantic_tag_get_url_itemtag($courseid,$itemid);
					$tags = semantic_tag_get_tags_item($itemid,$courseid);											
							$tagurls = '';
							if(count($tags)>0){
								$tagurls = '<ul>';
								foreach($tags as $currentid){
									$tag = semantic_tag_get_tag('id',$currentid);
									$tagurl = semantic_tag_get_url_tag($courseid,$currentid);
									$tagurls .= '<li>'.$tagurl.'</li>';
								}
								$tagurls .= '</ul>';
							}
							$table->data[] = array($itemurl, $tagurls);							
				}
				echo html_writer::table($table);
			}
			$courses = semantic_tag_get_courses_by_tag($tagid);
			if(count($courses)>0){
				echo '<h3>'.get_string('taginothercourses','block_sementic_tag').'</h3>';
			
				$table = new html_table();
				$table->head  = array(get_string('course', 'block_semantic_tag'),get_string('items', 'block_semantic_tag'));
				$table->data = array();				
				
				if(count($courses)>0){
						foreach ($courses as $courseid) {
						$courseurl = semantic_tag_get_url_course($courseid);
						$tagothercourse =semantic_tag_get_items_list_tag_course($tagid, $courseid);
						$table->data[] = array($courseurl, $tagothercourse);	
						}
				}
				
				echo html_writer::table($table);
				}
		}		
	}
	else if($report){
		$formquery = new semantic_tag_query_form(null,array('courseid' => $courseid));
		
		if($formquery->is_cancelled()){
			redirect($url);
		}
		else if($data = $formquery->get_data()){
			
			$startdate = $data->start_date;
			$enddate = $data->end_date;
			$module = $data->module;
			$action = $data->action;
			$number = $data->number;
			
			$results = semantic_tag_get_most_used_tags($courseid,$module,$startdate,$enddate,'view',$number);
			
			$title = get_string('mostusedtags','block_semantic_tag');
			
			if(count($results)>0){
				$labels = array_keys($results);
				$values = array_values($results);
				
				$graph = new graph('600px', '400px');
				$graph->parameter['title'] 			    = $title;
				$graph->x_data           				= $labels;
				$graph->y_data['logs']   				= $values;
				
					
				$graph->draw_stack();
			}
			$url .= '&report=1';
			redirect($url);			
		}
		$formquery->display();
		
		echo '<h3>'.get_string('pathwaystudents', 'block_semantic_tag').'</h3>';
		echo '<p>'.get_string('descpathwaystudents', 'block_semantic_tag').'</p>';
		
		$table = new html_table();
		$table->head  = array(get_string('student'),get_string('pathwaystudents', 'block_semantic_tag'), get_string('numbervisitscourse', 'block_semantic_tag'));
		$table->data = array();
		
		$users = semantic_get_users_enrrolled($courseid);
		
		foreach($users as $user){
			$userid = $user->userid;
			$userurl = semantic_tag_get_url_student($userid);
			$tagurls = array();
			$tagsvisited = semantic_tag_get_pathway_tags($courseid,$userid);
			foreach($tagsvisited as $tag){
				$tagurls[] = semantic_tag_get_url_tag($courseid,$tag);
			}			
			$table->data[] = array($userurl,implode(",", $tagurls),semantic_tag_get_number_visits($courseid, $userid));
		}
		echo html_writer::table($table);
	}
	else{
		$items = semantic_tag_get_items_by_course($courseid);
		if(count($items)>0){
			$table = new html_table();
			$table->head  = array(get_string('item', 'block_semantic_tag'),get_string('tags', 'block_semantic_tag'));
			$table->data = array();
			
			foreach ($items as $cmid) {
				$itemurl = semantic_tag_get_item_url($cmid);
				$taglist ='';
				// tags in course taglist
				
				$coursetags = '';
				// tags in other courses coursetags
				$tags = semantic_tag_get_tags_item($cmid, $courseid);
				if(count($tags)>0){
				$taglist .= '<ul>';
					foreach($tags as $tagid){
						$taglist .= '<li>'.semantic_tag_get_url_tag($courseid,$tagid).'</li>';
						
					}
					$taglist .= '</ul>';				
				}
				$table->data[] = array($itemurl, $taglist);
			}
			echo html_writer::table($table);
		}
		else{
			echo get_string('donthaveitems','block_semantic_tag');
		}
		
	}
	echo $OUTPUT->footer();
	
?>
