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


require_once(dirname(__FILE__) . "/lib.php"); 

class block_semantic_tag extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_semantic_tag');        
    }//function init
    
    function get_content() {
    	
		if ($this->content !== null) {
	            return $this->content;
	        }
        
        global $CFG, $COURSE,$PAGE;
        $courseid = $COURSE->id;
		
		// Get the context of the page
		$context = get_context_instance(CONTEXT_COURSE, $courseid);
        list($context, $course, $cm) = get_context_info_array($PAGE->context->id);
		$contextlevel = $context->contextlevel;
		
		// Set up content components
        $this->content = new stdClass;
        $this->content->text = ''; 
        $this->content->footer = ''; 		
        if (has_capability('block/semantic_tag:view', $context)) { // can they view it?
            
            	if($contextlevel == 50){ // course context
            	
					$mostused = semantic_tag_get_most_used_tags($courseid,null,null,null,'view',10);
					print_object($mostused);
					if(count($mostused)){
						$this->content->text .= '<ul>';
						foreach($mostused as $record){
							$tagid = $record->id;
							$tagurl =  semantic_tag_get_url_tag($courseid,$tagid);
							$this->content->text .= '<li>'.$tagurl.'</li>';
						}
						$this->content->text .= '</ul>';
					} 
            		$this->content->footer = '<ul class="inline">';
					$this->content->footer .= '<li><a href="'.$CFG->wwwroot.'/blocks/semantic_tag/view.php?id='.$courseid.'">'.get_string('viewmore','block_semantic_tag').'</a></li>';
		            //if (has_capability('block/semantic_tag:edit', $context)){
		                $this->content->footer .= '<li><a href="'.$CFG->wwwroot.'/blocks/semantic_tag/edit.php?id='.$courseid.'">'.get_string('edit').'</a></li>';
					//} 
					//if (has_capability('block/semantic_tag:statistics', $context)){
						$this->content->footer .= '<li><a href="'.$CFG->wwwroot.'/blocks/semantic_tag/view.php?id='.$courseid.'&report=1">'.get_string('report').'</a></li>';
					//}
					$this->content->footer .= '</ul>';    
				}else if($contextlevel == 70){ // module context
					$tags = semantic_tag_get_tags_item($cm->id);
					if(count($tags)>0){
						$this->content->text = '<ul>';
						foreach ($tags as $tag) {
							$this->content->text .= '<li>'.semantic_tag_get_url_tag($courseid,$tagid).'</li>';
						}
						$this->content->text .= '</ul>';
					}
				}
	                   
        } // end 'has_capability->view'
		else{
			$this->content->text = '<h3 class="error">'.get_string('youdonthavepermissions').'</h3>';
		}
		 return $this->content;
    }

}
?>
