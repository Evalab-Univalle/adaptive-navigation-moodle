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
class block_learning_paths extends block_base {
	
    public function init() {
        $this->title = get_string('pluginname', 'block_learning_paths');
    }
    
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        global $CFG, $USER, $COURSE, $PAGE, $DB;
        
        $this->content =  new stdClass;
        $this->content->text = '';
		$this->content->footer = '';
		
		$userid = $USER->id;
		$courseid = $COURSE->id;

		$context = get_context_instance(CONTEXT_COURSE, $courseid);
		
		if (has_capability('block/learning_paths:view', $context)) {
				$paths = block_lp_get_paths_user($userid);				
				if(count($paths)>0){
					print_object($paths);
					$table = new html_table();
		        	$table->head  = array(get_string('pathname', 'block_learning_paths'));
					$table->data = array();
					foreach ($paths as $pathid) {
						$path = block_lp_get_path($pathid);
						$progress = block_lp_get_progress_user_path($courseid,$userid,$pathid);
						print_object($progress);
						
						$progresstag = '<progress value="'.$progress.'" max="100"></progress><label>'.$progress.'</label>';
						$table->data[] = array($path->name);
						$table->data[] = array('<label>'. get_string('progress', 'block_learning_paths').': </label>'.$progresstag);
					}
					$this->content->text = html_writer::table($table);
				}
				
				$url = $CFG->wwwroot.'/blocks/learning_paths/view.php?courseid='.$courseid.'&viewpage=';
				
				if (has_capability('block/learning_paths:edit_objective', $context)){
					$this->content->text .= html_writer::link($url.'1',get_string('objective', 'block_learning_paths')).'<br>';
				 }
				
					if (has_capability('block/learning_paths:edit_path', $context)
					    and $DB->count_records('block_lp_objectives') > 0
					 ) {
						$this->content->text .= html_writer::link($url.'2',get_string('path', 'block_learning_paths')).'<br>';
					}
					
					if (has_capability('block/learning_paths:edit_items', $context)
					    and $DB->count_records('block_lp_paths') > 0
					 ) {
						$this->content->text .= html_writer::link($url.'3',get_string('pathitems', 'block_learning_paths')).'<br>';
					}
					if (has_capability('block/learning_paths:edit_items', $context)
					    and $DB->count_records('block_lp_paths') > 0
					  ) {
						$this->content->text .= html_writer::link($url.'4',get_string('pathurserenrollments', 'block_learning_paths')).'<br>';
					}
					if (has_capability('block/learning_paths:view_progress_users',$context)){
						$this->content->text .= html_writer::link($CFG->wwwroot.'/blocks/learning_paths/report.php?courseid='.$courseid,get_string('report'));
					}
		}else{
			$this->content->text =  '<h3 class="error">'.get_string('donthavepermissions', 'block_learning_paths').'</h3>';
		}
		return $this->content;
    }
}
