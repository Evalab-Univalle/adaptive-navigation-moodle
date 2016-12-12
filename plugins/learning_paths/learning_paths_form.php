<?php
    require_once("{$CFG->libdir}/formslib.php");
	require_once('lib.php');
	
	class learningobjective_form extends moodleform {
	    public function definition() {
	        $mform =& $this->_form;
	        $mform->addElement('header', 'displayinfo', get_string('learning_objective', 'block_learning_paths'));
	        $mform->addElement('text', 'name', get_string('name'));
	        $mform->addRule('name', get_string('plan_format', 'block_learning_paths'), 'regex', '#^[A-Z0-9 ]+$#i', 'client');
	        $mform->setType('name', PARAM_RAW);
			
	        $attributes = array('rows' => '8', 'cols' => '40');
	        $mform->addElement('textarea', 'description', get_string('description'), $attributes);
	        $mform->setType('description', PARAM_TEXT);
			
	        $mform->addElement('hidden', 'viewpage');
	        $mform->addElement('hidden', 'courseid');
	        $mform->addElement('hidden', 'id');
	        $this->add_action_buttons();
	    }
	    
	    public function validation($data, $files) {
	        global $DB;
	        $errors= array();
	        if($data['id']) { // the record already exists
	            return true;
	        } 
	    }
		
		public function display_list() {
	        global $DB, $OUTPUT, $CFG, $COURSE;	        
	        $courseid = $this->_customdata['courseid'];
	        // Page parameters.
	        $page    = optional_param('page', 0, PARAM_INT);
	        $perpage = optional_param('perpage', 10, PARAM_INT);    // how many per page
	        $dir     = optional_param('dir', 'DESC', PARAM_ALPHA);	
			
			// pages
			$nobjectives = $DB->count_records('block_lp_objectives');
			$baseurl = new moodle_url('view.php?viewpage=1', array('dir' => $dir, 'perpage' => $perpage));
			echo $OUTPUT->paging_bar($nobjectives, $page, $perpage, $baseurl);
			
	        $columns = array('name'    => get_string('name'),
	                         'description'     => get_string('description'));
	        $hcolumns = array();
	        $sort = 'name';
	      
	        foreach ($columns as $column=>$strcolumn) {
	            if ($sort != $column) {
	                $columnicon = '';
	                if ($column == 'name') {
	                    $columndir = 'DESC';
	                } else {
	                    $columndir = 'ASC';
	                }
	            } else {
	                $columndir = $dir == 'ASC' ? 'DESC':'ASC';
	                if ($column == 'name') {
	                    $columnicon = $dir == 'ASC' ? 'up':'down';
	                } else {
	                    $columnicon = $dir == 'ASC' ? 'down':'up';
	                }
	                $columnicon = " <img src=\"" . $OUTPUT->pix_url('t/' . $columnicon) . "\" alt=\"\" />";
	
	            }
				
	            $hcolumns[$column] = "<a href=\"view.php?viewpage=1&amp;dir=$columndir&amp;page=$page&amp;perpage=$perpage\">".$strcolumn."</a>$columnicon";
        	}

			$objectives = block_lp_get_objectives($courseid);

			$table = new html_table();
			$table->head  = array(get_string('number', 'block_learning_paths'),get_string('numberstudentsenrrolled', 'block_learning_paths'), $hcolumns['name'], $hcolumns['description'], get_string('edit'), get_string('remove'));
			$table->data = array();
			
			$inc= 1;
			foreach ($objectives as $objective) {
				$row = array();
				$objectiveid = $objective->id;
	            $row[] = $inc++;
	            $row[] = ($count = block_lp_get_students_objective($objectiveid) ) ? $count : 0;
	            $row[] = $objective->name;
	            $row[] = $objective->description;
	            $count = block_lp_get_students_objective($objectiveid);	            
	            $row[] = '<center><center><a  title="Edit" href="'.$CFG->wwwroot.'/blocks/learning_paths/view.php?viewpage=1&courseid='.$courseid.'&objectiveid='.$objectiveid.'"/>
	                     <img src="'.$OUTPUT->pix_url('t/edit') . '" class="iconsmall" /></a></center>';
	            $row[] = '<center><center><a  title="Remove" href="'.$CFG->wwwroot.'/blocks/learning_paths/view.php?viewpage=1&courseid='.$courseid.'.&objectiveid='.$objectiveid.'&remove=1"/>
	                     <img src="'.$OUTPUT->pix_url('t/delete') . '" class="iconsmall"/></a></center>';
	            $table->data[] = $row;
			}
			return $table;
		}
	}

class learningpath_form extends moodleform {
	    public function definition() {
	    	$courseid = $this->_customdata['courseid'];
			
	        $mform =& $this->_form;
	        $mform->addElement('header', 'displayinfo', get_string('learningpath', 'block_learning_paths'));
			
			$objectives = block_lp_get_objectives($courseid);
			$objectivelist = array();			
			foreach ($objectives as $objective) {
				$objectivelist[$objective->id] = $objective->name; 
			}
			$mform->addElement('select', 'objectiveid',  get_string('learning_objective', 'block_learning_paths'), $objectivelist);
			
	        $mform->addElement('text', 'name', get_string('learning_paths', 'block_learning_paths'));
	        $mform->addRule('name', get_string('plan_format', 'block_learning_paths'), 'regex', '#^[A-Z0-9 ]+$#i', 'client');
		    //$mform->addRule('name', $errors, 'required', null, 'server');
	        $mform->setType('name', PARAM_RAW);
			
	        $attributes = array('rows' => '8', 'cols' => '40');
	        $mform->addElement('textarea', 'description', get_string('desc', 'block_learning_paths'), $attributes);
	        $mform->setType('description', PARAM_TEXT);
	             
			
	        $mform->addElement('hidden', 'viewpage');
	        $mform->addElement('hidden', 'courseid');
	        $mform->addElement('hidden', 'id');
	        $this->add_action_buttons();
	    }

		public function validation($data,$files) {
	        global $DB;
	        $errors= array();
	        if($data['id']) {
	            return true;
	        }
	        /* else if ($DB->record_exists('block_lp_paths', array('name'=>$data['name']))) {
	           $errors['name'] = get_string('objective_exist', 'block_learning_paths');
	            return $errors;
	        }*/
	    }
		
		public function display_list() {
	        global $DB, $OUTPUT, $CFG, $COURSE;
	        $courseid = $this->_customdata['courseid'];
	        
	        // Page parameters.
	        $page    = optional_param('page', 0, PARAM_INT);
	        $perpage = optional_param('perpage', 10, PARAM_INT);    // how many per page
	        $dir     = optional_param('dir', 'DESC', PARAM_ALPHA);
	        $sort 	 = optional_param('sort','name',PARAM_RAW);	
			
			// pages
			$npaths = $DB->count_records('block_lp_paths');
			$baseurl = new moodle_url('view.php?viewpage=2', array('sort' => $sort,'dir' => $dir, 'perpage' => $perpage));
			echo $OUTPUT->paging_bar($npaths, $page, $perpage, $baseurl);
			
	        $columns = array('objectivename' => get_string('learning_objective','block_learning_paths'),
							 'name'    => get_string('name'));
	       
				
	        if (!isset($columns[$sort])) {
	            $sort = 'name';
	        }
	      
	        foreach ($columns as $column=>$strcolumn) {
	            if ($sort != $column) {
	                $columnicon = '';
	                if ($column == 'name') {
	                    $columndir = 'DESC';
	                } else {
	                    $columndir = 'ASC';
	                }
	            } else {
	                $columndir = $dir == 'ASC' ? 'DESC':'ASC';
	                if ($column == 'name') {
	                    $columnicon = $dir == 'ASC' ? 'up':'down';
	                } else {
	                    $columnicon = $dir == 'ASC' ? 'down':'up';
	                }
	                $columnicon = " <img src=\"" . $OUTPUT->pix_url('t/' . $columnicon) . "\" alt=\"\" />";
	
	            }
				
	            $hcolumns[$column] = "<a href=\"view.php?viewpage=2&sort=$column&amp;dir=$columndir&amp;page=$page&amp;perpage=$perpage\">".$strcolumn."</a>$columnicon";
        	}
			$paths= block_lp_get_paths_course($courseid);

			$table = new html_table();
			$table->head  = array(get_string('number','block_learning_paths'),get_string('numberstudentsenrrolled', 'block_learning_paths'),$hcolumns['objectivename'], $hcolumns['name'], get_string('description'), get_string('edit'), get_string('remove'));
			$table->data = array();
			
			$inc = 1;
			foreach ($paths as $path) {
				$row = array();
				$pathid = $path->id;
	            $row[] = $inc;
	            $row[] = ($count = block_lp_get_students_path($pathid))  ? $count : 0;
	            $row[] = $path->objectivename;
	            $row[] = $path->pathname;
	            $row[] = $path->description;
	            $row[] = '<center><center><a  title="Edit" href="'.$CFG->wwwroot.'/blocks/learning_paths/view.php?viewpage=2&courseid='.$courseid.'&pathid='.$pathid.'"/>
	                     <img src="'.$OUTPUT->pix_url('t/edit') . '" class="iconsmall" /></a></center>';
	            $row[] = '<center><center><a  title="Remove" href="'.$CFG->wwwroot.'/blocks/learning_paths/view.php?viewpage=2&courseid='.$courseid.'&pathid='.$pathid.'&remove=1"/>
	                     <img src="'.$OUTPUT->pix_url('t/delete') . '" class="iconsmall"/></a></center>';
	            $inc++;
	            $table->data[] = $row;
			}
			return $table;
		}
	}
	
	class learningpathitems_form extends moodleform {
		    public function definition() {
				$courseid = $this->_customdata['courseid'];
				
				global $OUTPUT, $DB;		    	
		    	$course = $DB->get_record('course',array('id' => $courseid));
		    	
		    	$mform =& $this->_form;
	       		$mform->addElement('header', 'displayinfo', get_string('learningpathitems', 'block_learning_paths'));
				
				$objectives = block_lp_get_objectives($courseid);
				$objectivelist = array();		
				$pathlist = array();	
				foreach ($objectives as $objective) {
					$objectiveid = $objective->id;
					$paths = block_lp_get_paths_objective($objectiveid);
					foreach ($paths as $path) {
						$pathlist[$path->id] = $path->name;
					}
				}
				$mform->addElement('select', 'pathid',  get_string('learning_path', 'block_learning_paths'), $pathlist);
					
					$items = block_lp_get_items($courseid);
					
					$modules = array();				
					$moduleslist = block_lp_get_monitorable_modules();
					$modulesinuse = array_keys($moduleslist);
					
					if(count($items)>0){
						foreach ($items as $cmid => $item) {	
							
							if(isset($modules[$item->module])){
								$modname = $modules[$item->module];
							}
							else{
								$modname = block_lp_get_module_name($item->module);
								$modules[$item->module] = $modname;
							}
													
							if(in_array($modname,$modulesinuse)){
								$details  = $moduleslist[$modname];
							
								$instance = block_lp_get_item_instance($modname, $cmid);
								$mform->addElement('html', '<div class="item">');
								
								// Icon, module type and name
								$icon = $OUTPUT->pix_icon('icon', $instance->name, $modname, array('class'=>'icon'));
								$mform->addElement('html', $icon.
												   '&nbsp;<strong>'.get_string('pluginname', $modname).
												   ': <em>'.format_string($instance->name).'</em></strong>');
								
								// Allow add to the path
								$mform->addElement('selectyesno', 'item_'.$cmid,
													   get_string('addItem', 'block_learning_paths'));    
								$mform->setDefault('item_'.$cmid, 0);		
								
								$mform->addHelpButton('item_'.$cmid,'addItems', 'block_learning_paths');
								// Print the date selector
								$mform->addElement('date_time_selector',
												   'deadline_'.$cmid,
												   get_string('deadlineexpected', 'block_learning_paths'));
												  
								// Assume a time/date for a activity/resource
								$expected = null;
								$datetimepropery = 'date_time_'.$cmid;
								
								$expected = time();
									
								// If there is a date associated with the activity/resource, use that
								if (isset($details['defaultTime']) && $instance->availableuntil != 0) {
										$expected = $instance->availableuntil;
								}
			
										
							
								$mform->setDefault('deadline_'.$cmid, $expected);
								$mform->addHelpButton('deadline_'.$cmid,
													  'deadlineexpected', 'block_learning_paths');
								// Print the action selector for the event
								$actions = array();
								foreach ($details['actions'] as $action => $sql) {
			
									// Before allowing pass marks, see that Grade to pass value is set
									if ($action == 'passed') {
										$params = array('itemmodule'=>$module, 'iteminstance'=>$instance->id);
										$gradetopass = $DB->get_record('grade_items', $params, 'gradepass');
										if ($gradetopass && $gradetopass->gradepass > 0) {
											$actions[$action] = get_string($action, 'block_learning_paths');
										}
									}
									else {
										$actions[$action] = get_string($action, 'block_learning_paths');
									}
								}
								if (isset($CFG->enablecompletion) && $CFG->enablecompletion==1) {
									$cm = get_coursemodule_from_instance($module, $instance->id, $courseid);
									if ($cm->completion!=0) {
										$actions['activity_completion'] = get_string('activity_completion',
																					 'block_learning_paths');
									}
								}
								
								if (count($actions) == 1) {
									$actions = array_keys($actions);
									$action = $actions[0];
									$mform->addElement('static', 'config_action_'.$cmid,
													   get_string('config_header_action', 'block_learning_paths'),
													   get_string($action, 'block_learning_paths'));
									$mform->addElement('hidden', 'action_'.$cmid, $action);
								}
								else {
									$mform->addElement('select', 'action_'.$cmid,
													   get_string('config_header_action', 'block_learning_paths'),
													   $actions );
									$listaction = $mform->setDefault('action_'.$cmid,
													   $details['defaultAction']);
													   
								}
								$mform->setType('action_'.$cmid, PARAM_ALPHANUMEXT);
								$mform->addHelpButton('action_'.$cmid,
													  'what_actions_can_be_monitored', 'block_learning_paths');  			  
								$weights = array();
								for($i = 5; $i<=100 ;$i = $i +5 ){
									$weights[$i] = $i."%";
								}  
								$wegiht = $mform->addElement('select', 'weight_'.$cmid, get_string('weight','block_learning_paths'), $weights); 
								$mform->addHelpButton('weight_'.$cmid,
													  'weighitems', 'block_learning_paths');   
								
								
								if($pathitem =  block_lp_get_pathitem_instance($pathitd, $itemid)){// item already in the path
									$mform->setDefault('item_'.$cmid, 1 );
									$mform->setDefault('deadline_'.$cmid, $pathitem->deadline);
									$mform->setDefault('weight_'.$cmid, $pathitem->weight);
									$mform->setDefault('action_'.$cmid, $pathitem->action);
								}
								$mform->addElement('html', '</div>');
							}
												  
						}
					}
					
				
				$mform->addElement('hidden', 'viewpage');
				$mform->addElement('hidden', 'courseid');
				$mform->addElement('hidden', 'id');
		        $this->add_action_buttons();
			}
			
			public function display_list() {
	        global $DB, $OUTPUT, $CFG, $COURSE;
	        $courseid = $this->_customdata['courseid'];
	        
	        // Page parameters.
	        $page    = optional_param('page', 0, PARAM_INT);
	        $perpage = optional_param('perpage', 10, PARAM_INT);    // how many per page
	        $dir     = optional_param('dir', 'DESC', PARAM_ALPHA);	
			$sort    = optional_param('sort', 'objectivename', PARAM_ALPHA);
			
			// pages
			$npaths = $DB->count_records('block_lp_items');
			$baseurl = new moodle_url('view.php?viewpage=3', array('sort' => $sort,'dir' => $dir, 'perpage' => $perpage));
			echo $OUTPUT->paging_bar($npaths, $page, $perpage, $baseurl);
			
	        $columns = array('objectivename' => get_string('learning_objective','block_learning_paths'),
							 'pathname' => get_string('learning_path','block_learning_paths'),
							 'weight' => get_string('weight'));
	        $hcolumns = array();
	       if (!isset($columns[$sort])) {
	            $sort = 'objectivename';
	        }
	      
	        foreach ($columns as $column=>$strcolumn) {
	            if ($sort != $column) {
	                $columnicon = '';
	                if ($column == 'objectivename') {
	                    $columndir = 'DESC';
	                } else {
	                    $columndir = 'ASC';
	                }
	            } else {
	                $columndir = $dir == 'ASC' ? 'DESC':'ASC';
	                if ($column == 'objectivename') {
	                    $columnicon = $dir == 'ASC' ? 'up':'down';
	                } else {
	                    $columnicon = $dir == 'ASC' ? 'down':'up';
	                }
	                $columnicon = " <img src=\"" . $OUTPUT->pix_url('t/' . $columnicon) . "\" alt=\"\" />";
	
	            }
				
	            $hcolumns[$column] = "<a href=\"view.php?viewpage=3&sort=$column&amp;dir=$columndir&amp;page=$page&amp;perpage=$perpage\">".$strcolumn."</a>$columnicon";
        	}

			$items = block_lp_get_items_course($courseid);

			$table = new html_table();
			$table->head  = array($hcolumns['objectivename'], $hcolumns['pathname'],get_string('item'), $hcolumns['weight'],get_string('remove'));
			$table->data = array();
			
			foreach ($items as $item) {
				$row = array();
				$itemid = $item->itemid;
				$moduleid = $item->moduleid;
				$pathid = $item->pathid;
	            $row[] = $item->objectivename;
	            $row[] = $item->pathname;
	            $row[] = block_lp_get_url_item($moduleid, $itemid);
	            $row[] = $item->weight;
	            $row[] = '<center><center><a  title="Remove" href="'.$CFG->wwwroot.'/blocks/learning_paths/view.php?viewpage=3&courseid='.$courseid.'&pathid='.$pathid.'&itemid='.$itemid.'&remove=1"/>
	                     <img src="'.$OUTPUT->pix_url('t/delete') . '" class="iconsmall"/></a></center>';
	            $table->data[] = $row;
			}
			return $table;
		}
	}

class learningpathusers_form extends moodleform {
		
		    public function definition() {
		    	global $COURSE, $CFG, $DB;
		    	$courseid = $this->_customdata['courseid'];
		    	
		    	$mform =& $this->_form;
	       		$mform->addElement('header', 'displayinfo', get_string('learningpathusers', 'block_learning_paths'));
				
				$objectives = block_lp_get_objectives($courseid);
				$pathlist = array();	
				foreach ($objectives as $objective) {
					$objectiveid = $objective->id;
					$paths = block_lp_get_paths_objective($objectiveid);
					foreach ($paths as $path) {
						$pathlist[$path->id] = $path->name;
					}
				}
				
				
				$users = block_lp_get_users_enrrolled($courseid);
				$userlist = array();
				
				foreach ($users as $user) {
					$userid = $user->userid;
					$username = $user->firstname.' '.$user->lastname;
					$mform->addElement('html', '<div class="user">');	
					$mform->addElement('html', '<a href="'.$CFG->wwwroot.'/user/profile.php?id='.$userid.'"><h3>'.$username.'</h3></a>');
					$mform->addElement('select', 'pathid_'.$userid,  get_string('learning_path', 'block_learning_paths'), $pathlist);
					$mform->addElement('selectyesno', 'user_'.$userid,
	                                           get_string('enrolluser', 'block_learning_paths'));
	                $mform->setDefault('pathid_'.$userid, 0);                          
	                $mform->addHelpButton('user_'.$userid, 'enrolluserspath', 'block_learning_paths'); 
					$mform->addElement('html', '</div>');
				}
				
				$mform->addElement('hidden', 'viewpage');
				$mform->addElement('hidden', 'courseid');
				$mform->addElement('hidden', 'id');
		        $this->add_action_buttons();
	       }
	       
	       public function display_list() {
	        global $DB, $OUTPUT, $CFG, $COURSE;
	        $courseid = $this->_customdata['courseid'];
		    
	        // Page parameters.
	        $page    = optional_param('page', 0, PARAM_INT);
	        $perpage = optional_param('perpage', 10, PARAM_INT);    // how many per page
	        $dir     = optional_param('dir', 'DESC', PARAM_ALPHA);	
			$sort    = optional_param('sort', 'objectivename', PARAM_ALPHA);
			
			// pages
			$npaths = $DB->count_records('block_lp_enrollments');
			$baseurl = new moodle_url('view.php?viewpage=4', array('sort' => $sort,'dir' => $dir, 'perpage' => $perpage));
			echo $OUTPUT->paging_bar($npaths, $page, $perpage, $baseurl);
			
	        $columns = array('objectivename' => get_string('learning_objective','block_learning_paths'),
							 'pathname' => get_string('learning_path','block_learning_paths'),
							 'status' => get_string('status'));
							 
	       $hcolumns = array();
	       if (!isset($columns[$sort])) {
	            $sort = 'objectivename';
	        }
	      
	        foreach ($columns as $column=>$strcolumn) {
	            if ($sort != $column) {
	                $columnicon = '';
	                if ($column == 'objectivename') {
	                    $columndir = 'DESC';
	                } else {
	                    $columndir = 'ASC';
	                }
	            } else {
	                $columndir = $dir == 'ASC' ? 'DESC':'ASC';
	                if ($column == 'objectivename') {
	                    $columnicon = $dir == 'ASC' ? 'up':'down';
	                } else {
	                    $columnicon = $dir == 'ASC' ? 'down':'up';
	                }
	                $columnicon = " <img src=\"" . $OUTPUT->pix_url('t/' . $columnicon) . "\" alt=\"\" />";
	
	            }
				
	            $hcolumns[$column] = "<a href=\"view.php?viewpage=4&sort=$column&amp;dir=$columndir&amp;page=$page&amp;perpage=$perpage\">".$strcolumn."</a>$columnicon";
        	}
			$users = block_lp_get_userspath_course($courseid);

			$table = new html_table();
			$table->head  = array($hcolumns['objectivename'], $hcolumns['pathname'],get_string('user'),$hcolumns['status'],get_string('remove'));
			$table->data = array();
			
			foreach ($users as $user) {
				$row = array();
				$userid = $user->userid;
				$pathid = $user->pathid;
				$currentuser = block_lp_get_user_info($userid);
	            $row[] = $user->objectivename;
	            $row[] = $user->pathname;
	            $row[] = $currentuser->firstname.$currentuser->lastname;
	            $row[] = $user->status;
	            $row[] = '<center><center><a  title="Remove" href="'.$CFG->wwwroot.'/blocks/learning_paths/view.php?viewpage=4&courseid='.$courseid.'&pathid='.$pathid.'&itemid='.$userid.'&remove=1"/>
	                     <img src="'.$OUTPUT->pix_url('t/delete') . '" class="iconsmall"/></a></center>';
	            $table->data[] = $row;
			}
			return $table;
		}
	}

/*	
	class feldersilverman_form extends moodleform {
	    public function definition() {
	        $mform =& $this->_form;
	        $mform->addElement('header', 'displayinfo', get_string('ilstest', 'block_learning_paths'));
	        $mform->addElement('html', '<div class="desc fieldset"><p>'.get_string('ilstestdesc', 'block_learning_paths').'</p></div>');
	        
	        $radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer37a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer37b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question37', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer1a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer1b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question1', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer13a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer13b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question13', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer25a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer25b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question25', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer21a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer21b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question21', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer6a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer6b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question6', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer38a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer38b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question38', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer18a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer18b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question18', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer10a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer10b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question10', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer2a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer2b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question2', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer31a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer31b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question31', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer11a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer11b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question11', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer7a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer7b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question7', '', array(' '), false);
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer19a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer19b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question19', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer3a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer3b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question3', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer36a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer36b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question36', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer20a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer20b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question20', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer8a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer8b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question8', '', array(' '), false);
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer44a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer44b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question44', '', array(' '), false);
			
			$radioarray=array();
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer4a','block_learning_paths'), 0, null);
			$radioarray[] =& $mform->createElement('radio', 'options', '', get_string('answer4b','block_learning_paths'), 1, null);
			$mform->addGroup($radioarray, 'question4', '', array(' '), false);
			
			$mform->addElement('hidden', 'userid');
			$mform->addElement('hidden', 'id');
		    $this->add_action_buttons();
		}
	}
	* /
?>
