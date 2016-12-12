<?php
    require_once($CFG->dirroot . '/mod/lesson/renderer.php');
	class theme_funny_mod_lesson_renderer extends mod_lesson_renderer {
	
	    public function header($lesson, $cm, $currenttab = '', $extraeditbuttons = false, $lessonpageid = null, $extrapagetitle = null) {
	        global $CFG;
	
	        $activityname = format_string($lesson->name, true, $lesson->course);
	        if (empty($extrapagetitle)) {
	            $title = $this->page->course->shortname.": ".$activityname;
	        } else {
	            $title = $this->page->course->shortname.": ".$activityname.": ".$extrapagetitle;
	        }
	
	        // Build the buttons
	        $context = context_module::instance($cm->id);
	
	    /// Header setup
	        $this->page->set_title($title);
	        $this->page->set_heading($this->page->course->fullname);
	        lesson_add_header_buttons($cm, $context, $extraeditbuttons, $lessonpageid);
	        $output = $this->output->header();
	
	        if (has_capability('mod/lesson:manage', $context)) {
	            // $output .= $this->output->heading_with_help($activityname, 'overview', 'lesson');
	
	            if (!empty($currenttab)) {
	                ob_start();
	                include($CFG->dirroot.'/mod/lesson/tabs.php');
	                $output .= ob_get_contents();
	                ob_end_clean();
	            }
	        } else {
	            // $output .= $this->output->heading($activityname);
	        }
	
	        foreach ($lesson->messages as $message) {
	            $output .= $this->output->notification($message[0], $message[1], $message[2]);
	        }
	
	        return $output;
	    }
	
	}
?>