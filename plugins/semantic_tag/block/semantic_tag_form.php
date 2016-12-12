<?php
    require_once("{$CFG->libdir}/formslib.php");
	require_once("lib.php");	

	class semantic_tag_form extends moodleform {
		
	    public function definition() {	
				
				$mform = $this->_form;
				
				$mform->addElement('header', 'displayinfo', get_string('semantictag', 'block_semantic_tag'));
        		$mform->addElement('text', 'name', get_string('name', 'block_semantic_tag'));
				
				$attributes = array('rows' => '8', 'cols' => '40');
		        $mform->addElement('textarea', 'description', get_string('description', 'block_semantic_tag'), $attributes);
		        $mform->setType('description', PARAM_TEXT);
				
				$mform->addElement('hidden', 'action');
				$mform->addElement('hidden', 'courseid');
				$mform->addElement('hidden', 'moduleid');
				$mform->addElement('hidden', 'id');
       			$this->add_action_buttons();
		}
		
			public function display_list() {
				global $DB, $OUTPUT, $CFG;				
				$courseid = $this->_customdata['courseid'];
				// Page parameters.
				$page    = optional_param('page', 0, PARAM_INT);
				$perpage = optional_param('perpage', 10, PARAM_INT);    // how many per page
				$dir     = optional_param('dir', 'DESC', PARAM_ALPHA);

				$changescount = $DB->count_records('block_semantic_tag');
				$sort = 'name';


				$baseurl = new moodle_url('view.php?', array('id' => $courseid, 'dir' => $dir, 'perpage' => $perpage));
				echo $OUTPUT->paging_bar($changescount, $page, $perpage, $baseurl);
				$table = new html_table();
				$table->head  = array(get_string('s_no', 'block_semantic_tag'), get_string('name'), get_string('description'), get_string('remove'));
		
				$inc= 1;
				$sql = "select * from {block_semantic_tag} where courseid = ".$courseid;
				$tags = $DB->get_recordset_sql($sql, array(),  $page*$perpage, $perpage);
				foreach ($tags as $tag) {
					$row = array();
					$tagid = $tag->id;
					$row[] = $inc++;
					$row[] = $tag->name;
					$row[] = $tag->description;
					$row[] = '<center><center><a  title="remove" href="'.$CFG->wwwroot.'/blocks/semantic_tag/edit.php?id='.$courseid.'&tagid='.$tagid.'&remove=1"/>
							 <img src="'.$OUTPUT->pix_url('t/delete') . '" class="iconsmall"/></a></center>';
					$table->data[] = $row;
				}
				return $table;
		}
	}
	
	class semantic_tag_query_form extends moodleform {
		
	    public function definition() {	
				$courseid = $this->_customdata['courseid'];
				$mform = $this->_form;
				
				$mform->addElement('date_time_selector', 'start_date', get_string('start', 'block_admin_stats'));	
				$mform->addElement('date_time_selector', 'end_date', get_string('end', 'block_admin_stats'));
				
				$modules = semantic_tag_modules_in_use($courseid);
				$mform->addElement('select', 'module', get_string('module'), $modules);
				
				$actions = array('view' => 'view','association' => 'used in association');
				$selectaction = $mform->addElement('select', 'action', get_string('action'), $actions);
				$selectaction->setSelected('0');
				
				$number = array(0 =>'0 '.get_string('allrecords','block_admin_stats') , 5 => '5', 10 => '10', 15 => '15');
				$selectnumber = $mform->addElement('select', 'number', get_string('numbertoshow'), $number);
				$selectnumber->setSelected('10');
				
				$mform->addElement('hidden', 'id'); // course id
				$this->add_action_buttons();
			}
		}
	
?>
