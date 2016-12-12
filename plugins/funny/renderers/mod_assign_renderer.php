<?php
    require_once($CFG->dirroot . '/mod/assign/renderer.php');
	class theme_funny_mod_assign_renderer extends mod_assign_renderer {
	    /**
	     * Render the header.
	     *
	     * @param assign_header $header
	     * @return string
	     */
	    public function render_assign_header(assign_header $header) {
	        $o = '';
	
	        if ($header->subpage) {
	            $this->page->navbar->add($header->subpage);
	        }
	
	        $this->page->set_title(get_string('pluginname', 'assign'));
	        $this->page->set_heading($header->assign->name);
	
	        $o .= $this->output->header();
	        if ($header->preface) {
	            $o .= $header->preface;
	        }
	        // $heading = format_string($header->assign->name, false, array('context' => $header->context));
	        // $o .= $this->output->heading($heading);
	
	        if ($header->showintro) {
	            $o .= $this->output->box_start('generalbox boxaligncenter', 'intro');
	            $o .= format_module_intro('assign', $header->assign, $header->coursemoduleid);
	            $o .= $this->output->box_end();
	        }
	
	        return $o;
	    }
	}
?>