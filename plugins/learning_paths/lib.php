<?php

	/**
	 * Provides information about monitorable modules
	 *
	 * @return array
	 */
	function block_lp_get_monitorable_modules() {
	    global $DB;
	
	    return array(
	        'assign' => array(
	            'defaultTime'=>'duedate',
	            'actions'=>array(
	                'submitted'    => "SELECT id
	                                     FROM {assign_submission}
	                                    WHERE assignment = :eventid
	                                      AND userid = :userid
	                                      AND status = 'submitted'",
	                'marked'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'assign'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade IS NOT NULL",
	                'passed'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'assign'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade >= i.gradepass"
	            ),
	            'defaultAction' => 'submitted'
	        ),
	        'assignment' => array(
	            'defaultTime'=>'timedue',
	            'actions'=>array(
	                'submitted'    => "SELECT id
	                                     FROM {assignment_submissions}
	                                    WHERE assignment = :eventid
	                                      AND userid = :userid
	                                      AND (
	                                          numfiles >= 1
	                                          OR {$DB->sql_compare_text('data2')} <> ''
	                                      )",
	                'marked'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'assignment'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade IS NOT NULL",
	                'passed'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'assignment'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade >= i.gradepass"
	            ),
	            'defaultAction' => 'submitted'
	        ),
	        'bigbluebuttonbn' => array(
	            'defaultTime'=>'timedue',
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'bigbluebuttonbn'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'recordingsbn' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'recordingsbn'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'book' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'book'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'certificate' => array(
	            'actions'=>array(
	                'awarded'    => "SELECT id
	                                   FROM {certificate_issues}
	                                  WHERE certificateid = :eventid
	                                    AND userid = :userid"
	            ),
	            'defaultAction' => 'awarded'
	        ),
	        'chat' => array(
	            'actions'=>array(
	                'posted_to'    => "SELECT id
	                                     FROM {chat_messages}
	                                    WHERE chatid = :eventid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'posted_to'
	        ),
	        'choice' => array(
	            'defaultTime'=>'timeclose',
	            'actions'=>array(
	                'answered'     => "SELECT id
	                                     FROM {choice_answers}
	                                    WHERE choiceid = :eventid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'answered'
	        ),
	        'data' => array(
	            'defaultTime'=>'timeviewto',
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'data'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'feedback' => array(
	            'defaultTime'=>'timeclose',
	            'actions'=>array(
	                'responded_to' => "SELECT id
	                                     FROM {feedback_completed}
	                                    WHERE feedback = :eventid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'responded_to'
	        ),
	        'resource' => array(  // AKA file
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'resource'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'flashcardtrainer' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'flashcardtrainer'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'folder' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'folder'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'forum' => array(
	            'defaultTime'=>'assesstimefinish',
	            'actions'=>array(
	                'posted_to'    => "SELECT id
	                                     FROM {forum_posts}
	                                    WHERE userid = :userid AND discussion IN (
	                                          SELECT id
	                                            FROM {forum_discussions}
	                                           WHERE forum = :eventid
	                                    )"
	            ),
	            'defaultAction' => 'posted_to'
	        ),
	        'glossary' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                   WHERE course = :courseid
	                                     AND module = 'glossary'
	                                     AND action = 'view'
	                                     AND cmid = :cmid
	                                     AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'hotpot' => array(
	            'defaultTime'=>'timeclose',
	            'actions'=>array(
	                'attempted'    => "SELECT id
	                                    FROM {hotpot_attempts}
	                                   WHERE hotpotid = :eventid
	                                     AND userid = :userid",
	                'finished'     => "SELECT id
	                                     FROM {hotpot_attempts}
	                                    WHERE hotpotid = :eventid
	                                      AND userid = :userid
	                                      AND timefinish <> 0",
	            ),
	            'defaultAction' => 'finished'
	        ),
	        'imscp' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                    FROM {log}
	                                   WHERE course = :courseid
	                                     AND module = 'imscp'
	                                     AND action = 'view'
	                                     AND cmid = :cmid
	                                     AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'journal' => array(
	            'actions'=>array(
	                'posted_to'    => "SELECT id
	                                     FROM {journal_entries}
	                                    WHERE journal = :eventid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'posted_to'
	        ),
	        'lesson' => array(
	            'defaultTime'=>'deadline',
	            'actions'=>array(
	                'attempted'    => "SELECT id
	                                     FROM {lesson_attempts}
	                                    WHERE lessonid = :eventid
	                                      AND userid = :userid
	                                UNION ALL
	                                   SELECT id
	                                     FROM {lesson_branch}
	                                    WHERE lessonid = :eventid1
	                                      AND userid = :userid1",
	                'graded'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'lesson'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade IS NOT NULL"
	            ),
	            'defaultAction' => 'attempted'
	        ),
	        'page' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'page'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'quiz' => array(
	            'defaultTime'=>'timeclose',
	            'actions'=>array(
	                'attempted'    => "SELECT id
	                                     FROM {quiz_attempts}
	                                    WHERE quiz = :eventid
	                                      AND userid = :userid",
	                'finished'     => "SELECT id
	                                     FROM {quiz_attempts}
	                                    WHERE quiz = :eventid
	                                      AND userid = :userid
	                                      AND timefinish <> 0",
	                'graded'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'quiz'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade IS NOT NULL",
	                'passed'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'quiz'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade >= i.gradepass"
	            ),
	            'defaultAction' => 'finished'
	        ),
	        'scorm' => array(
	            'actions'=>array(
	                'attempted'    => "SELECT id
	                                     FROM {scorm_scoes_track}
	                                    WHERE scormid = :eventid
	                                      AND userid = :userid",
	                'completed'    => "SELECT id
	                                     FROM {scorm_scoes_track}
	                                    WHERE scormid = :eventid
	                                      AND userid = :userid
	                                      AND element = 'cmi.core.lesson_status'
	                                      AND {$DB->sql_compare_text('value')} = 'completed'",
	                'passed'       => "SELECT id
	                                     FROM {scorm_scoes_track}
	                                    WHERE scormid = :eventid
	                                      AND userid = :userid
	                                      AND element = 'cmi.core.lesson_status'
	                                      AND {$DB->sql_compare_text('value')} = 'passed'"
	            ),
	            'defaultAction' => 'attempted'
	        ),
	        'turnitintool' => array(
	            'defaultTime'=>'defaultdtdue',
	            'actions'=>array(
	                'submitted'    => "SELECT id
	                                     FROM {turnitintool_submissions}
	                                    WHERE turnitintoolid = :eventid
	                                      AND userid = :userid
	                                      AND submission_score IS NOT NULL"
	            ),
	            'defaultAction' => 'submitted'
	        ),
	        'url' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'url'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'wiki' => array(
	            'actions'=>array(
	                'viewed'       => "SELECT id
	                                     FROM {log}
	                                    WHERE course = :courseid
	                                      AND module = 'wiki'
	                                      AND action = 'view'
	                                      AND cmid = :cmid
	                                      AND userid = :userid"
	            ),
	            'defaultAction' => 'viewed'
	        ),
	        'workshop' => array(
	            'defaultTime'=>'assessmentend',
	            'actions'=>array(
	                'submitted'    => "SELECT id
	                                     FROM {workshop_submissions}
	                                    WHERE workshopid = :eventid
	                                      AND authorid = :userid",
	                'assessed'     => "SELECT s.id
	                                     FROM {workshop_assessments} a, {workshop_submissions} s
	                                    WHERE s.workshopid = :eventid
	                                      AND s.id = a.submissionid
	                                      AND a.reviewerid = :userid
	                                      AND a.grade IS NOT NULL",
	                'graded'       => "SELECT g.rawgrade
	                                     FROM {grade_grades} g, {grade_items} i
	                                    WHERE i.itemmodule = 'workshop'
	                                      AND i.iteminstance = :eventid
	                                      AND i.id = g.itemid
	                                      AND g.userid = :userid
	                                      AND g.finalgrade IS NOT NULL"
	            ),
	            'defaultAction' => 'submitted'
	        ),
	    );
	}
	
	/**
	 * Filters the modules list to those installed in Moodle instance and used in current course
	 *
	 * @return array
	 */
	function block_lp_modules_in_use($courseid) {
	    global $DB;
	    $dbmanager = $DB->get_manager(); // used to check if tables exist
	    $modules = get_monitorable_modules();
	    $modulesinuse = array();
	
	    foreach ($modules as $module => $details) {
	        if (
	            $dbmanager->table_exists($module) &&
	            $DB->record_exists($module, array('course'=>$courseid))
	        ) {
	            $modulesinuse[$module] = $details;
	        }
	    }
	    return $modulesinuse;
	}
	
/**
 * Checks if a variable has a value and returns a default value if it doesn't
 *
 * @param mixed $var The variable to check
 * @param mixed $def Default value if $var is not set
 * @return string
 */
function block_lp_default_value(&$var, $def = null) {
    return isset($var)?$var:$def;
}
	
	/**
 * Gets event information about modules monitored by an instance 
 *
 * @param string $orderby date expected or order in the course
 * @param string $pathid id of the path
 * @param array    $modules The modules used in the course
 * @return mixed   returns array of visible events monitored,
 *                 empty array if none of the events are visible,
 *                 null if all events are configured to "no" monitoring and
 *                 0 if events are available but no config is set
 */
function block_lp_event_information($courseid,$orderby = 'orderbycourse', $pathid, $modules) {
    global  $DB;
    $dbmanager = $DB->get_manager(); // used to check if tables exist
    $events = array();
    $numevents = 0;
    $numeventsconfigured = 0;
	
	// Get the items of the path
	$pathitems = block_lp_get_items_path($pathid);
	$listitems = array();
	foreach($pathitems as $pathitem){
		$listitems[] = $pathitem->itemid;
	}

    if($orderby == 'orderbycourse') {
        $sections = $DB->get_records('course_sections', array('course'=>$courseid), 'section', 'id,sequence');
        foreach ($sections as $section) {
            $section->sequence = explode(',', $section->sequence);
        }
    }

    // Check each known module (described in lib.php)
    foreach ($modules as $module => $details) {
        $fields = 'id, name';
        if (array_key_exists('defaultTime', $details)) {
            $fields .= ', '.$details['defaultTime'].' as due';
        }

        // Check if this type of module is used in the course, gather instance info
        $records = $DB->get_records($module, array('course'=>$courseid), '', $fields);
        foreach ($records as $record) {

            // Is the module part of the path
            if (in_array($record->id , $listitems )) {
                $numeventsconfigured++;
            
                $numevents++;

                // Check the time the module is due
                $expected = block_lp_get_pathitem_instance($pathid, $record->id)->deadline;
                    
                // Get the course module info
                $coursemodule = get_coursemodule_from_instance($module, $record->id, $COURSE->id);

                // Check if the module is visible, and if so, keep a record for it
                if ($coursemodule->visible == 1) {
                    $event = array(
                        'expected'=>$expected,
                        'type'=>$module,
                        'id'=>$record->id,
                        'name'=>format_string($record->name),
                        'cmid'=>$coursemodule->id,
                    );
                    if($orderby == 'orderbycourse') {
                        $event['section'] = $coursemodule->section;
                        $event['position'] = array_search($coursemodule->id, $sections[$coursemodule->section]->sequence);
                    }
                    $events[] = $event;
                }
			}
        }
    }

    if ($numeventsconfigured==0) {
        return 0;
    }
    if ($numevents==0) {
        return null;
    }

    // Sort by first value in each element, which is time due
    if($orderby == 'orderbycourse') {
        usort($events, 'compare_events');
    }
    else {
        sort($events);
    }
    return $events;
}

/**
 * Used to compare two activities/resources based on order on course page
 *
 * @param array $a array of event information
 * @param array $b array of event information
 * @return <0, 0 or >0 depending on order of activities/resources on course page
 */
function block_lp_compare_events($a, $b) {
    if($a['section'] != $b['section']) {
        return $a['section'] - $b['section'];
    }
    else {
        return $a['position'] - $b['position'];
    }
}

/**
 * Checked if a user has attempted/viewed/etc. an activity/resource
 *
 * @param array    $modules The modules used in the course
 * @param stdClass $config  The blocks configuration settings
 * @param array    $events  The possible events that can occur for modules
 * @param int      $userid  The user's id
 * @param array    $actions  Array of default actions to the modules
 * @param bool     $activitycompletion   Bool check if the activity completion feature is enabled
 * @return array   an describing the user's attempts based on module+instance identifiers
 */
function block_lp_get_attempts($courseid,$modules, $pathid, $events, $userid ) {
    global  $DB, $CFG;
    $attempts = array();
    

    foreach ($events as $event) {
		$cmid = $event['cmid'];
		$pathitem = block_lp_get_pathitem_instance($pathid, $cmid);
        
        $module = $modules[$event['type']];
        $action = $pathitem->action;
        $query =  $module['actions'][$action];
		$parameters = array('courseid' => $courseid, 'courseid1' => $courseid,
                            'userid' => $userid, 'userid1' => $userid,
                            'eventid' => $event['id'], 'eventid1' => $event['id'],
                            'cmid' => $event['cmid'], 'cmid1' => $event['cmid'],
                      );

         // Check if the user has attempted the module
        $attempts[$cmid] = $DB->record_exists_sql($query, $parameters)? 0 : 1;
    }
    return $attempts;
}

	function block_lp_nav_title($viewpage) {
			$array = array(
				1 => get_string('learningobjectives', 'block_learning_paths'),
				2 => get_string('learningpaths', 'block_learning_paths'),
				3 => get_string('learningpathitems', 'block_learning_paths'),  
				4 => get_string('userenrollments', 'block_learning_paths')  
			);
			return $array[$viewpage];
	}	
	
    /**
	 * Add a learning objective instance to the database
	 *
	 * @param stdClass $objective data extracted from the information given byt the user in the form
	 * @return int id of the instance
	 */
    function block_lp_add_objective($objective){
		global  $DB;
	    try{
				$objectiveid = $DB->insert_record("block_lp_objectives",$objective);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $objectiveid;
	}
	
	 /**
	 * Update a learning objective instance to the database
	 *
	 * @param stdClass $objective data extracted from the information given byt the user in the form
	 * @return int id of the instance
	 */
    function block_lp_update_objective($objective){
		global  $DB;
	    try{
				$objectiveid = $DB->update_record("block_lp_objectives",$objective);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $objectiveid;
	}
	
	/**
	 * Get a learning objective instance
	 *
	 * @param int $objectiveid
	 * @return stdClass $objective 
	 */
	function block_lp_get_objective($objectiveid){
		global  $DB;
	    try{
	            $objective = $DB->get_record("block_lp_objectives",array('id' => $objectiveid));
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $objective;
	}
	
	/**
	 * Get the total of students enrrolled by objective
	 *
	 * @param int $objectiveid instance of the objective
	 * @return int total of students by objective
	 */
	function block_lp_get_students_objective($objectiveid){
		global $DB;
		return $DB->get_field_sql('select count(userid) from {block_lp_enrollments} as e, {block_lp_paths} as p where e.pathid = p.id and p.objectiveid=  ?', array('objectiveid'=>$objectiveid));
	}
	
	/**
	 * Get all the paths associated to an objective
	 *
	 * @param int $objectiveid instance of the objective
	 * @return int id of the instance
	 */
	function block_lp_get_paths_objective($objectiveid){
		global $DB;
		return $DB->get_records('block_lp_paths', array('objectiveid'=>$objectiveid));
	}
	
	
	/**
	 * Delete a learning objective instance to the database
	 *
	 * @param int $objectiveid instance of the objective
	 * @return int id of the instance
	 */
	 
    function block_lp_delete_objective($objectiveid){
		global  $DB;
		$paths = block_lp_get_paths_objective($objectiveid);
		foreach ($paths as $id => $path) {
			blocl_lp_delete_path($id);
		}
	    try{	    	
	    	$objectiveid = $DB->delete_records("block_lp_objectives",array('id'=>$objectiveid));
	    	$objectiveid = $DB->delete_records("block_lp_objectives",array('id'=>$objectiveid));
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $objectiveid;
	}
	
	function block_lp_get_objectives($courseid){
		global $DB;
		return $DB->get_records('block_lp_objectives', array('course'=>$courseid));
	}
	

	
	function block_lp_add_learning_path($path){
		global  $DB;
	    try{
	            $pathid=$DB->insert_record("block_lp_paths",$path);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathid;
	}
	
	function block_lp_update_learning_path($path){
		global  $DB;
	    try{
	            $pathid=$DB->update_record("block_lp_paths",$path);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathid;
	}
	
	/**
	 * Get a learning paths instance
	 *
	 * @param int $pathid
	 * @return stdClass $objective 
	 */
	 
	function block_lp_get_path($pathid){
		global  $DB;
	    try{
	            $path = $DB->get_record("block_lp_paths",array('id' => $pathid));
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $path;
	}
	
	/**
	 * Get the total of students enrrolled by path
	 *
	 * @param int $pathid instance of the objective
	 * @return int total of students by path
	 */
	function block_lp_get_students_path($pathid){
		global $DB;
		return $DB->get_field_sql('select count(userid) from {block_lp_enrollments} where pathid = ?', array('pathid'=>$pathid));
	}
	
	function block_lp_get_items_path($pathid){
		global $DB;	
		return $DB->get_records('block_lp_items', array('pathid'=>$pathid));
	}
	
	
	
	function block_lp_get_users_path($pathid){
		global $DB;
		return $DB->get_records('block_lp_enrollments', array('pathid'=>$pathid));		
	}
	
	function block_lp_get_userspath_course($courseid){
		global $DB;	
		$sql = "select o.id as objectiveid, o.name as objectivename, p.id as pathid, p.name as pathname, u.userid as userid, u.startdate, u.status from {block_lp_enrollments} as u , {block_lp_paths} as p, {block_lp_objectives} as o
				where o.course = ? and o.id = p.objectiveid and p.id = u.pathid";
		return $DB->get_records_sql($sql, array($courseid));
	}
	
	function block_lp_delete_path($pathid){
		global $DB;
		
		$items = block_lp_get_items_path($pathid);
		foreach ($items as $id => $item) {
			block_lp_delete_learning_path_items($id);
		}
		
		$users = block_lp_get_users_path($pathid);
		foreach ($users as $id => $user) {
			block_lp_delete_learning_path_users($id);
		}
		try{	    	
	    	$pathid = $DB->dalete_record("block_lp_paths",array('id' => $pathid));
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathid;
	}
	
	
	function block_lp_get_paths_course($courseid){
		global $DB;
		$sql = "SELECT  p.id as pathid, o.name as objectivename, p.name as pathname, p.description, p.objectiveid 
				from {block_lp_paths} as p, {block_lp_objectives} as o 
				where o.course = ?
				and o.id = p.objectiveid ";
		return $DB->get_records_sql($sql,array($courseid));		
	}
	
	function block_lp_add_learning_path_items($pathitems){
		global  $DB;
	    try{
	            $pathitems = $DB->insert_record("block_lp_items",$pathitems);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathitems;
	}
	
	function block_lp_update_learning_path_items($pathitems){
		global  $DB;
	    try{
	            $pathitems = $DB->update_record("block_lp_items",$pathitems);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathitems;
	}
	
	function block_lp_get_pathitem($pathitemid){
		global $DB;
		return $DB->get_record('block_lp_items', array('id'=>$pathitemid));
	}
	
	function block_lp_get_pathitem_instance($pathid, $itemid){
		global $DB;
		return $DB->get_record('block_lp_items', array('pathid'=>$pathid , 'itemid' => $itemid));
	}
	
	function block_lp_delete_learning_path_items($pathitem){
		global $DB;
		try{	    	
	    	$pathitem = $DB->dalete_record("block_lp_items",array('id' => $pathitem));
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathitem;
	}
	
	function block_lp_get_items($courseid){
		global $DB;
		$sql = "SELECT id, module FROM {course_modules} WHERE course = ?";
		return $DB->get_records_sql($sql, array('course' => $courseid));
	}
	
	function block_lp_get_items_course($courseid){
		global $DB;	
		$sql = "select o.id as objectiveid, o.name as objectivename,p.id as pathid, p.name as pathname , i.itemid as itemid, i.moduleid, i.weight from {block_lp_items} as i , {block_lp_paths} as p, {block_lp_objectives} as o
				where o.course = ? and o.id = p.objectiveid and p.id = i.pathid";
		return $DB->get_records_sql($sql, array($courseid));
	}
	
	function block_lp_get_module_name($moduleid){
		global $DB;
		$sql = "SELECT name from {modules} where id = ?";
		return $DB->get_field_sql($sql, array('id' => $moduleid));
	}
	
	function block_lp_add_learning_path_user($pathuser){
		global  $DB;
	    try{
	            $pathuser = $DB->insert_record("block_lp_enrollments",$pathuser);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathuser;
	}
	
	function block_lp_update_learning_path_user($pathuser){
		global  $DB;
	    try{
	            $pathuser = $DB->update_record("block_lp_enrollments",$pathuser);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathiuser;
	}
	
	function block_lp_get_pathuser($pathuserid){
		global $DB;
		return $DB->get_record('block_lp_enrollments', array('id'=>$pathuserid));
	}
	
	function block_lp_get_pathuser_instance($pathid,$userid){
		global $DB;
		return $DB->get_record('block_lp_enrollments', array('pathid' => $pathid , 'userid' => $userid));
	}
	
	function block_lp_delete_learning_path_user($pathuser){
		global $DB;
		try{	    	
	    	$pathuser = $DB->delete_record("block_lp_enrollments",array('id' => $pathuser));
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $pathuser;
	}
	
	function block_lp_get_users_enrrolled($courseid){
		global $DB;
		$sql = 'SELECT c.id AS id, u.id as userid, u.username, u.firstname, u.lastname, u.email, u.picture
				FROM mdl_role_assignments ra, mdl_user u, mdl_course c, mdl_context cxt
				WHERE ra.userid = u.id
				AND ra.contextid = cxt.id
				AND cxt.contextlevel =50
				AND cxt.instanceid = c.id
				AND c.id = ?
				AND roleid =5 ';
		$students =  $DB->get_records_sql($sql, array($courseid));
		return $students;
	}
	
	function block_lp_get_item_instance($modname,$itemid){
		return get_coursemodule_from_id($modname,$itemid);
	}
	
	function block_lp_get_paths_user($userid){
		global $DB;
		return $DB->get_fieldset_sql('select pathid from {block_lp_enrollments} where userid = ?', array('userid'=>$userid));
	}
	
	function block_lp_get_progress_user_path($courseid,$userid,$pathid){
		global $DB;
		$modules = block_lp_modules_in_use($courseid);
		$events = block_lp_event_information($courseid,'orderbycourse', $pathid, $modules);
		$attempts = block_lp_get_attempts($courseid,$modules, $pathid, $events, $userid);
		$pathitems = block_lp_get_items_path($pathid);
		
		$progress = 0;
		foreach($pathitems as $pathitem){
			$itemid = $pathitem->itemid;
			$weight = $pathitem->weight;
			// $attempts[$itemid] is 0 or 1
			$progress += $attempts[$itemid]*$weight; 
		}
		return $progress;
	}
	
	function block_lp_get_status_user_path($pathid){
		global $DB;
		$sql = "SELECT status, COUNT('x') as numusers from {block_lp_enrollments}
				WHERE pathid = ?
				GROUP BY status";
		return $DB->get_records_sql($sql, array($pathid));
	}
	
	function block_lp_get_user_info($userid){
		global $DB;
		$sql = "select firstname, lastname, picture from {user} where id = ?";
		return $DB->get_record_sql($sql, array('id' => $userid));
	}
	
	function block_lp_get_number_students($pathid, $status = null){
		global $DB;
		$sql = "SELECT COUNT('x') as numviews from block_lp_enrollments}
				WHERE pathid = ?";
				
		if(isset($status)){
			$sql .= " AND status = ".$status;
		}
		return $DB->get_field_sql($sql, array($pathid));		
	}
	
	function block_lp_get_module_item($itemid){
		global $DB;
		$query = "select module from {course_modules} where id = ? ";
		$mod = $DB->get_field_sql($query,array($itemid));
		return $mod;		
	}
	
	
	function block_lp_get_recourse_name($moduleid){
		$modname = get_module($moduleid);
		$resourcename= get_coursemodule_from_id($modname,$moduleid)->name;
		return $resourcename;
	}
	
	function block_lp_get_url_item($moduleid, $itemid){
		global $CFG, $OUTPUT;	
		$modname = get_module_instance($moduleid)->name;
		$recoursename = get_recourse_name($itemd);
		$activityicon = $OUTPUT->pix_icon('icon', $recoursename, $modname, array('class'=>'icon'));
		$url = $CFG->wwwroot.'/mod/'.$modname.'/view.php?id='.$moduleid;
		$itemurl = '<a href="'.$url.'" alt="'.$recoursename.'">'.$activityicon.$recoursename.'</a>';
		return $itemurl;
	}
	
	
?>
