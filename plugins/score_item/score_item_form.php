<?php
    
    require_once("{$CFG->libdir}/formslib.php");
	require_once("lib.php");	
	
	class score_item_form extends moodleform {
		
		public function definition() {
			
			$mform = $this->_form;
			$mform->addElement('hidden', 'id');	
			$mform->addElement('hidden', 'courseid');					
			$mform->addElement('hidden', 'itemid');
			$mform->addElement('hidden', 'userid');
			$mform->addElement('hidden', 'moduleid');
			$mform->addElement('hidden', 'timemodified');
			
			
			// add the radio button for the score
			$radioarray[] =& $mform->createElement('radio', 'score', '','0', 0, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','1', 1, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','2', 2, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','3', 3, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','4', 4, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','5', 5, null);
			
			$mform->addGroup($radioarray, 'score', 'score', array(' '), false);
			
			// comments
			$mform->addElement('textarea', 'comment', get_string('comments', "block_score_item"), 'rows="5" cols="50"');
			$mform->setType('comment', PARAM_TEXT);		
			
			
			$this->add_action_buttons(false);
		}
	}
	
	class score_item_query_form {
		
		public function definition() {
			$mform = $this->_form;
			
			$mform->addElement('date_time_selector', 'start_date', get_string('start', 'block_score_item'));	
	        $mform->addElement('date_time_selector', 'end_date', get_string('end', 'block_admin_stats'));
		}
	}
    
?>
