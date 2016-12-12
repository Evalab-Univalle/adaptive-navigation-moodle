<?php
    require_once(dirname(__FILE__) . "/lib.php"); 

class block_admin_stats extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_admin_stats');        
    }
    
    function get_content() {    
        global $COURSE,$PAGE,$CFG,$DB;
        $courseid = $COURSE->id;
        $context = get_context_instance(CONTEXT_COURSE, $courseid);
		
		list($context, $course, $cm) = get_context_info_array($PAGE->context->id);
		$contextlevel = $context->contextlevel;
		
		$courseinstance = $DB->get_record('course', array('id' => $courseid), 'id, category');
		$category = $course->category;
		
		print_object($context);
		
		$this->content = new stdClass;
		$this->content->text = ''; 
        $this->content->footer = ''; 
		
		if (has_capability('block/admin_stats:view', $context)) {
			
			
        	if($contextlevel == 40){ // course category context
				$visits = admin_stats_views_coursecategory($category);
				$this->content->text .= get_string('numberofvisits','block_admin_stats').": ".$visits;
				
				$this->content->footer .= '<a href="'.$CFG->wwwroot.'/blocks/admin_stats/view.php?context='.$contextlevel.'&categoryid='.$courseid.'">'.get_string('viewmore','block_admin_stats').'</a>';	
			}else if($contextlevel == 50){ // course context	
				$visits = admin_stats_views_course($courseid);
				$this->content->text .= get_string('numbervisits','block_admin_stats').": ".$visits;
				
				$this->content->footer .= '<a href="'.$CFG->wwwroot.'/blocks/admin_stats/view.php?context='.$contextlevel.'&courseid='.$courseid.'">'.get_string('viewmore','block_admin_stats').'</a>';	
			}else if($contextlevel == 70){ // module context
				$visits = admin_stats_views_module($cm->id);
				$this->content->text .= get_string('numbervisits','block_admin_stats').": ".$visits;
				
				$this->content->footer .= '<a href="'.$CFG->wwwroot.'/blocks/admin_stats/view.php?context='.$contextlevel.'&cmid='.$cmid.'">'.get_string('viewmore','block_admin_stats').'</a>';
				$this->content->footer .= '<a href="'.$CFG->wwwroot.'/blocks/admin_stats/view.php?context='.$contextlevel.'&cmid='.$cmid.'">'.get_string('viewtimesessions','block_admin_stats').'</a>';		
			}
			print_object($visits);
			
		}
		 return $this->content;
	}
}
?>
