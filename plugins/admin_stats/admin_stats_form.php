<?php

	require_once("{$CFG->libdir}/formslib.php");
	require_once('lib.php');
	
	class admin_stats_form extends moodleform {

	    function definition() {
	        $mform =& $this->_form;
			$mform->addElement('header', 'coursestats', get_string('coursestats', 'block_admin_stats'));
			
			$types = array( '0' => get_string('bar', 'block_admin_stats'), '1' => get_string('area', 'block_admin_stats') );
			$typelist =$mform->addElement('select', 'graphtype', get_string('graphtype', 'block_admin_stats'), $types);
			$typelist->setSelected('0');
			
			$actions = array( '0' => get_string('numbervisits', 'block_admin_stats'), '1' => get_string('timespent', 'block_admin_stats') );
			$actionlist = $mform->addElement('select', 'action', get_string('action', 'block_admin_stats'), $actions);
			$actionlist->setSelected('0');
	
	        $mform->addElement('date_time_selector', 'start_date', get_string('start', 'block_admin_stats'));
	        //$mform->addRule('start_date', $errors, 'required', null, 'server');
	        $mform->addElement('date_time_selector', 'end_date', get_string('end', 'block_admin_stats'));
	        //$mform->addRule('end_date', $errors, 'required', null, 'server');
			
			$attributes = array();
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('hour'), 0, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('day'), 1, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('month'), 2, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('user'), 3, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('type','block_admin_stats'), 4, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('item','block_admin_stats'), 5, $attributes);
			$mform->addGroup($radioarray, 'order', '', array(' '), false);
			
			$mform->addElement('hidden', 'courseid');
			$mform->addElement('hidden', 'context'); 
			$this->add_action_buttons();
		}

		public function validation($data, $files) {
		        global $DB;		 
		         if($data['start_date'] >= $data['end_date']) {
		            $errors['errormsgdate'] = get_string('date_val', 'block_admin_stats');
		            return $errors;
		         }
		  }
	}
	
	class module_admin_stats_form extends moodleform {

	    function definition() {
	        $mform =& $this->_form;
			$mform->addElement('header', 'modulestats', get_string('modulestats', 'block_admin_stats'));
			
			$actions = array( '0' => get_string('numbervisits', 'block_admin_stats'), '1' => get_string('timespent', 'block_admin_stats') );
			$select = $mform->addElement('select', 'action', get_string('action', 'block_admin_stats'), $actions);
			$select->setSelected('0');
	
	        $mform->addElement('date_time_selector', 'start_date', get_string('start', 'block_admin_stats'));	
	        $mform->addElement('date_time_selector', 'end_date', get_string('end', 'block_admin_stats'));
			
			$attributes = array();
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('hour'), 0, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('day'), 1, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('month'), 2, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('user'), 3, $attributes);
			$mform->addGroup($radioarray, 'order', '', array(' '), false);
			
			$mform->addElement('hidden', 'moduleid');
			$mform->addElement('hidden', 'context'); 
			$this->add_action_buttons();
			
		}

		 public function validation($data, $files) {
		        global $DB;		 
		         if($data['start_date'] >= $data['end_date']) {
		            $errors['errormsg'] = get_string('date_val', 'block_admin_stats');
		            return $errors;
		         }
		  }
	}

	

	class coursecategory_admin_stats_form extends moodleform {

	    function definition() {
	        $mform =& $this->_form;
			$mform->addElement('header', 'categorystats', get_string('categorystats', 'block_admin_stats'));
			
			$actions = array( '0' => get_string('numbervisits', 'block_admin_stats'), '1' => get_string('timespent', 'block_admin_stats') );
			$select = $mform->addElement('select', 'action', get_string('action', 'block_admin_stats'), $actions);
			$select->setSelected('0');
			
	        $mform->addElement('date_time_selector', 'start', get_string('start', 'block_admin_stats'));	
	        $mform->addElement('date_time_selector', 'end', get_string('end', 'block_admin_stats'));
			
			$attributes = array();
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('hour'), 0, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('day'), 1, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('month'), 2, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('course'), 3, $attributes);
			$radioarray[] =& $mform->createElement('radio', 'order', '', get_string('user'), 4, $attributes);
			$mform->addGroup($radioarray, 'order', '', array(' '), false);
			
			$mform->addElement('hidden', 'categoryid');
			$mform->addElement('hidden', 'context');
			$this->add_action_buttons();
		}

		public function validation($data, $files) {
		        global $DB;		 
		         if($data['start_date'] >= $data['end_date']) {
		            $errors['errormsg'] = get_string('date_val', 'block_admin_stats');
		            return $errors;
		         }
		  }
	}



?>
