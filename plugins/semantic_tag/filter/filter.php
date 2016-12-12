<?php

   require_once(dirname(dirname(dirname(__FILE__))).'/blocks/semantic_tag/lib.php');
   
   defined('MOODLE_INTERNAL') || die();
   
   class filter_contag extends moodle_text_filter {
    
		public function filter($text, array $options = array()) {			
			global $CFG;
			
			if (!$courseid = get_courseid_from_context($this->context)) {
	            $courseid = 0;
	        }
			
			// verificar si hay algo por hacer
			
			if (!has_capability('block/contag:view', $this->context)) {
	            return $text;
	        }
			
			$tags = semantic_tag_get_tags_by_course($courseid);
			$linkstags = array();
			if(!empty($tags)){				
				foreach ($tags as  $tag) {
					$tagname = $tag->tag_name;
					$href_tag_begin = html_writer::start_tag('a', array('class'=>'link_tag','href'=>$CFG->wwwroot.'/blocks/contag/view.php?id='.$courseid.'#'.$tagname));
					$linkstags[] = new filterobject($tagname, $href_tag_begin,"</a>",false,false,$tagname);
				}
				$linkstags = filter_remove_duplicates($linkstags);
				return filter_phrases($text, $linkstags);
			}
			return filter_phrases($text, $linkstags);
		}
	
	}
?>
