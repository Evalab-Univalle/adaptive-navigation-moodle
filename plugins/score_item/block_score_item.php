<?php
require_once(dirname(__FILE__) . "/lib.php");

	class block_score_item extends block_base {
		
	    public function init() {
	        $this->title = get_string('pluginname', 'block_score_item');
	    }
	    public function get_content() {
	        if ($this->content !== null) {
	            return $this->content;
	        }
			
			global $COURSE, $CFG, $PAGE,$USER;
			
			$courseid = $COURSE->id;
			$userid = $USER->id;			
			
			$this->content =  new stdClass;
			$this->content->text = ''; 
			$this->content->footer = ''; 
			
			list($context, $course, $cm) = get_context_info_array($PAGE->context->id);
			$contextlevel = $context->contextlevel;
			
			if (has_capability('block/score_item:view', $context)) {
				$blockurl = $CFG->wwwroot.'/blocks/score_item/';
				if($contextlevel == 50){// course level
				
					$scores = block_score_item_get_ranking($courseid, NULL, null, null , 'itemid', 10);
					
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
						$this->content->text .= html_writer::table($table);
						$this->content->footer .= html_writer::link($blockurl.'view.php?id='.$courseid.'&ranking=1', get_string('viewranking', 'block_score_item'));
						$this->content->footer .= html_writer::link($blockurl.'view.php?id='.$courseid.'&userid='.$userid, get_string('viewmyscores', 'block_score_item'));
		            	$this->content->footer .= html_writer::link($blockurl.'view.php?id='.$courseid, get_string('viewallscores', 'block_score_item'));
		            	$this->content->footer .= html_writer::link($blockurl.'edit.php?id='.$courseid.'&userid='.$userid, get_string('editmyscores', 'block_score_item'));
					
					}else{
						$blockurl = $CFG->wwwroot.'/blocks/score_item/';
						$this->content->text = '<h3>'.get_string('noscores', 'block_score_item').'</h3>';
						$this->content->footer = html_writer::link($blockurl.'edit.php?id='.$courseid.'&userid='.$userid, get_string('editmyscores', 'block_score_item'));
					}
				}
				else if($contextlevel == 70){ 
					$itemid  = $cm->id;
					$currentscore = block_score_item_get_score_by_id($itemid,$userid);
					
					$this->content->text .= '<form name="addtagform" method="post" action="edit.php?id='.$courseid.'" onSubmit="submitting=true;return true;">';
					$this->content->text .= get_string('currentscore','block_score_item').': '.$currentscore->score;
					for($i = 0; $i<6;$i++){
							$this->content->text .= '<input type="radio" name="radio_'.$itemid.'" value="'.$i.'" >'.$i." ";						
					}
					$this->content->text .= '<input type="text" name="area_'.$itemid.'" value="'.$currentscore->comment.'"/>';				
					$this->content->text .= '</form>';
					
					$this->content->footer .= html_writer::link($blockurl.'view.php?id='.$courseid.'&ranking=1', get_string('viewranking', 'block_score_item'));
					$this->content->footer .= html_writer::link($blockurl.'view.php?id='.$courseid.'&userid='.$userid, get_string('viewmyscores', 'block_score_item'));					
		            $this->content->footer .= html_writer::link($blockurl.'edit.php?id='.$courseid.'&userid='.$userid, get_string('editmyscores', 'block_score_item'));
				}				
			}
			else{
					$this->content->text = '<h3 class="error">'.get_string('youdonthavepermissions').'</h3>';
			}
            return $this->content;
		}
	}
?>
