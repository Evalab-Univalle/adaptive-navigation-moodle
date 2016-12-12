<?php
	
	/*  31536000 = 1 year
	 *  2592000 = 1 month
	 *  604800 = 1 week
	 *  86400 = 1 day
	 *  3600 = 1 hour
	 */
	 
	function admin_stats_nav_title($context) {
			$array = array(
				40 => get_string('adminstatscategory', 'block_admin_stats'),
				50 => get_string('adminstatscourse', 'block_admin_stats'),
				70 => get_string('adminstatsmodule', 'block_admin_stats')          
			);
			return $array[$context];
		} 
	 
   function admin_stats_participants($role = '5',$context){// default students
	   	$students = get_role_users($role , $context);
		return $students;
   }
   	
	function admin_stats_get_item_name($module,$itemid){
		$resourcename= get_coursemodule_from_id($module,$itemid)->name;
		return $resourcename;
	}
	
	function admin_stats_course_start_date($courseid){
		global $DB;
		$sql = "SELECT startdate FROM {course} WHERE id = ?";
		return $DB->get_field_sql($sql,array('id'=>$courseid));
	}
	
	function admin_stats_item_start_date($itemid){
		global $DB;
		$sql = "SELECT added FROM {course_modules} WHERE id = ?";
		return $DB->get_field_sql($sql,array('id'=>$itemid));
	}
	
	function admin_stats_get_url_module($courseid, $cmid){
		global $CFG, $OUTPUT, $DB;	
		$modname = admin_stats_get_module_name($cmid);
		$recoursename = admin_stats_get_item_name($modname,$cmid);
		$activityicon = $OUTPUT->pix_icon('icon', $recoursename, $modname, array('class'=>'icon'));
		$url = $CFG->wwwroot.'/mod/'.$modname.'/view.php?id='.$cmid;
		$itemurl = '<a href="'.$url.'" alt="'.$recoursename.'">'.$activityicon.$recoursename.'</a>';
		return $itemurl;
	}
	
	function admin_stats_get_list_months($startdate){
   		$months = array();
		$timenow = time(); // GMT
		$strftimedate = get_string("strftimedate");
    	$strftimedaydate = get_string("strftimedaydate");

	    // What day is it now for the user, and when is midnight that day (in GMT).
	    $timemidnight = $today = usergetmidnight($timenow);
		
		while ($timemidnight > $startdate) {
	        $timemidnight = $timemidnight - 2592000;
	        $timenow = $timenow - 2592000;
			$months["$timemidnight"] = userdate($timenow, $strftimedaydate);
		}
		return $months;
   }
	
	function admin_stats_get_list_hours($stardate){
   		$hours = array();
		$timenow = time(); // GMT

	    // What day is it now for the user, and when is midnight that day (in GMT).
	    $timemidnight = $today = usergetmidnight($timenow);
		
		while ($timemidnight > $course->startdate) {
	        $timemidnight = $timemidnight - 86400;
	        $timenow = $timenow - 86400;
		}
   }
	
	function admin_stats_get_modules_in_use($courseid) {
	    global  $DB;
	    $dbmanager = $DB->get_manager(); 
	    $modulesinuse = array();
		$modules = $DB->get_records_sql("SELECT id,name FROM {modules}");
	    foreach ($modules as $module) {
	        if (
	            $dbmanager->table_exists($module) &&
	            $DB->record_exists($module, array('course'=>$courseid))
	        ) {
	            $modulesinuse[$module->id] = $module->name;
	        }
	    }
	    return $modulesinuse;
	}
	
	function admin_stats_modules_list($courseid){
		global $DB;
		$sql = "SELECT id, module
				FROM {course_modules} 
				WHERE cm.course = ? ";
		$modulesid = $DB->get_records_sql($sql, array($courseid));
		
		$modules = array();
		foreach ($modulesid as $item) {
			$moduleid = $item->module;		
			$modules[$item->id] = admin_stats_get_url_module($courseid,$item->id);
		}
		return $modules;
	}
	
	function admin_stats_views_course($courseid, $start = null, $end = null, $group = null){
		global $DB;
		if(isset($group)){
			if($group == 5){
				$sql = "SELECT cmid ";
			}
			else if($group == 3){
				$sql = "SELECT userid ";
			}	
			else if($group == 4){
				$sql = "SELECT module ";
			}	
			else if($group == 0){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), '%Y-%m-%d %H.%i.%s'),11,13)";
			}
			else if($group == 1){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), '%Y-%m-%d %H.%i.%s'),9,11)";
			}
			else if($group == 2){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), '%Y-%m-%d %H.%i.%s'),5,7)";
			}
			$sql .= " as label, COUNT('x') AS numviews";
		}else{
			$sql = "SELECT COUNT('x') AS numviews";
		          
		}	
		
		$sql .= " FROM  {log} WHERE course = ? AND action LIKE 'view%'";	
		
		if($start){
			$sql .= " AND time >= ".$start;
		}
		
		if($end){
			$sql .= " AND time <= ".$end;
		}
		
		if(isset($group)){
			$sql .= " GROUP BY label ORDER BY numviews desc";
			$views = $DB->get_records_sql($sql, array($courseid));
		}
		else{
			$views = $DB->get_field_sql($sql, array($courseid));
		}
		return $views;		
	}
	
	function admin_stats_views_module($moduleid, $start = null, $end = null, $group = null){
		global $DB;
		
		if(isset($group)){
			if($group == 3){
				$sql = "SELECT userid ";
			}	
			else if($group == 0){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), 'Y-%m-%d %H.%i.%s'),11,13)";
			}
			else if($group == 1){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), 'Y-%m-%d %H.%i.%s'),9,11)";
			}
			else if($group == 2){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), 'Y-%m-%d %H.%i.%s'),5,7)";
			}
			$sql .= "as label , COUNT('x') AS numviews FROM {log} ";
		}
		else{
			$sql = "SELECT COUNT('x') AS numviews FROM {log}";
		}
		
		$sql .= " WHERE cmid = ? AND action LIKE 'view%'";
		
		if($start){
			$sql .= "AND time >= ".$start;
		}
		
		if($end){
			$sql .= "AND time <= ".$end;
		}
		
		if(isset($group)){
			$sql .= "GROUP BY label ORDER BY numviews desc";
			$views = $DB->get_records_sql($sql, array($moduleid));
		}
		else{
			$views = $DB->get_field_sql($sql, array($moduleid));
		}
		
		return $views;		
	}
	
	function admin_stats_category_sons($coursecategory){
		global $DB;
		$sql = "select id from {course_categories} where parent = ?";
		return $DB->get_fieldset_sql($sql,array('parent' => $coursecategory));
	}
	
	function admin_stats_views_coursecategory($coursecategory, $start = null, $end = null, $group = null){
		global $DB;
		if(isset($group)){
			if($group == 4){
				$sql = "SELECT userid ";
			}	
			else if($group == 3){
				$sql = "SELECT userid ";
			}
			else if($group == 0){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), 'Y-%m-%d %H.%i.%s'),11,13)";
			}
			else if($group == 1){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), 'Y-%m-%d %H.%i.%s'),9,11)";
			}
			else if($group == 2){
				$sql = "SELECT SUBSTR(DATE_FORMAT(FROM_UNIXTIME(time), 'Y-%m-%d %H.%i.%s'),5,7)";
			}
			$sql .= "as label, COUNT('x') AS numviews ";
		}
		else{
			$sql = "SELECT COUNT('x') AS numviews";
		}
		
		$sql = " FROM {log} AS l,{course} AS c
		         WHERE l.course = c.id AND l.action LIKE 'view%' AND module = 'course' AND c.category = ?";
		if($start){
			$sql .= "AND l.time >= ".$start;
		}
		
		if($end){
			$sql .= "AND l.time <= ".$end;
		}
		if(isset($group)){
			$sql .= "GROUP BY label ORDER BY numviews";
			$views = $DB->get_records_sql($sql, array($coursecategory));
		}		
		else{
			$views = $DB->get_field_sql($sql, array($coursecategory));
		}
		
		$childrens = admin_stats_category_sons($coursecategory);
		if(count($childrens) > 0){
			foreach ($childrens as $child) {
				$numviews = admin_stats_views_coursecategory($child, $start, $end , $group );
				
				if(isset($group)){
					$views = array_merge($views,$numviews);
				}
				else{
					$views += $numviews;
				}
			}
		}
		
		
		return $views;		
	}
	
function admin_stats_first_access($courseid){
		global $DB;
		$sql = "selet DATE_FORMAT(FROM_UNIXTIME(MIN(time)), 'Y-%m-%d %H.%i.%s') as firstaccess, count('x') 
				from {log} where course = ? groub by firstaccess";
		return 	$DB->get_records_sql($sql, array('course' => $courseid));	
}

function admin_stats_get_module_name($moduleid){
		global $DB;
		return $DB->get_field('modules','name',array('id'=>$moduleid));
	}

function admin_stats_get_course_url($courseid){
	global $DB, $CFG;
	$name = $DB->get_field('course','fullname', array('id' => $courseid));
	return '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$courseid.'">'.$name.'</a>';
}

function admin_stats_get_user_url($userid){
	global $DB, $CFG;
	$user = $DB->get_record_sql('select firstname, lastname from {user} where id = ?', array('id' => $userid));
	return '<a href="'.$CFG->wwwroot.'/user/profile.php?id='.$userid.'">'.$user->firstname.' '.$user->lastname.'</a>';
}

	
function admin_stats_get_id_from_url($url){
		$start = strpos($url, '='); // first attribute passed to the url
		if(!$end = strpos($url, '=', $start)){
			$end = strlen($url);
		}
		return substr($url, $start + 1, ($end - ($start + 1)));
}
	
/**
* Get the array of logs for a set of users between two dates
* @param int $from start date
* @param int $to end date
* @param array $for user list or int for a single user
* @param $course id of the course
*/
function use_stats_extract_logs($from, $to, $for = null, $course = null){
    global $USER, $DB;
    $for = (is_null($for)) ? $USER->id : $for ;

    if (is_array($for)){
        $userlist = implode("','", $for);
        $userclause = " AND userid IN ('{$userlist}') ";
    } else {
        $userclause = " AND userid = {$for} ";
    }

    if (@$course->id){
	    $coursecontext = context_course::instance($course->id);
	        
	    // we search first enrol time for this user
	    $sql = "
			SELECT
				id,
				MIN(timestart) as timestart
			FROM
				{role_assignments} ra
			WHERE
				contextid = $coursecontext->id
				$userclause
	    ";
	    $firstenrol = $DB->get_record_sql($sql);
    
	    $from = max($from, $firstenrol->timestart);
	}
        
    $courseclause = (!is_null(@$course->id)) ? " AND course = $course->id " : '' ;

    $sql = "
       SELECT
         id,
         course,
         action,
         time,
         module,
         userid,
         cmid
       FROM
         {log}
       WHERE
         time > ? AND 
         time < ? AND
         ((course = 1 AND action = 'login') OR
          (1
          $courseclause))
		$userclause
       ORDER BY
         time
    ";
    
    if($rs = $DB->get_recordset_sql($sql, array($from, $to))){
        $logs = array();
        foreach($rs as $log){
            $logs[] = $log;
        }
        $rs->close($rs);
        return $logs;
    }
    return array();    
}

/**
* given an array of log records, make a displayable aggregate
* @param array $logs
* @param string $dimension
*/
function use_stats_aggregate_logs($logs, $dimension, $origintime = 0){
    global $CFG, $DB, $OUTPUT, $USER;

    // will record session aggregation state as current session ordinal
    $sessionid = 0;

    $currentuser = 0;

    $aggregate = array();        
	$aggregate['sessions'] = array();
	
    if (!empty($logs)){
        $logs = array_values($logs);

        $memlap = 0; // will store the accumulated time for in the way but out of scope laps.
        
        for($i = 0 ; $i < count($logs) ; $i++){
            $log = $logs[$i];
        	$currentuser = $log->userid; // we "guess" here the real identity of the log's owner.
        	
        	if (isset($logs[$i + 1])){
	            $lognext = $logs[$i + 1];
	            $lap = $lognext->time - $log->time;
	        } else {
	        	$lap = $CFG->block_use_stats_lastpingcredit * MINSECS;
	        }

			if (in_array($log->$dimension, $ignoremodulelist)){
				$lap = 0;
			}

            if ($lap == 0) continue;

            // do not loose last lap, but set sometime to it
            // if ($lap > 60 * MINSECS) $lap = (60 * MINSECS) / 2;
            $sessionpunch = false;
            if ($lap > 60 * MINSECS){
            	$lap = $CFG->block_use_stats_lastpingcredit * MINSECS;
            	if ($lognext->action != 'login' && $log->action != 'login') $sessionpunch = true;
            }

            switch($dimension){
                case 'module':{
                    if (!in_array($log->$dimension, $modulelist)){
                        $memlap += $lap;
                        continue;
                    } else {
                        $lap += $memlap;
                        $memlap = 0;
                    }
                    break;
                }
            }

            if (!isset($log->$dimension)){
                $OUTPUT->notice('unknown dimension');
            }
            
           	/// Per login session aggregation
           	if ($log->action != 'login' && @$lognext->action == 'login'){
           		// repair first visible session track that has no login
           		if (!isset($aggregate['sessions'][$sessionid]->sessionstart)){
           			 @$aggregate['sessions'][$sessionid]->sessionstart = $logs[0]->time;
           		}
           		@$aggregate['sessions'][$sessionid]->sessionend = $log->time;
           	}
           	if ($log->action == 'login'){
           		if (@$lognext->action != 'login'){
	           		$sessionid++;
	           		@$aggregate['sessions'][$sessionid]->elapsed = $lap;
	           		@$aggregate['sessions'][$sessionid]->sessionstart = $log->time;
           		} else {
           			continue;
           		}
           	} else {
           		if ($sessionpunch){
           			// this record is the last one of the current session.
           			@$aggregate['sessions'][$sessionid]->sessionend = $log->time ;
	           		$sessionid++;
           			@$aggregate['sessions'][$sessionid]->sessionstart = $lognext->time;
           			@$aggregate['sessions'][$sessionid]->elapsed = $lap;
           		} else {
	           		if (!isset($aggregate['sessions'][$sessionid])){
	           			@$aggregate['sessions'][$sessionid]->sessionstart = $log->time;
		           		@$aggregate['sessions'][$sessionid]->elapsed = $lap;
	           		} else {
		           		@$aggregate['sessions'][$sessionid]->elapsed += $lap;
		           	}
		        }
        	}
                        
            /// Standard global lap aggregation
            if (array_key_exists($log->$dimension, $aggregate) && array_key_exists($log->cmid, $aggregate[$logs[$i]->$dimension])){
                @$aggregate[$log->$dimension][$log->cmid]->elapsed += $lap;
                @$aggregate[$log->$dimension][$log->cmid]->events += 1;
            } else {
                @$aggregate[$log->$dimension][$log->cmid]->elapsed = $lap;
                @$aggregate[$log->$dimension][$log->cmid]->events = 1;
            }

            /// Standard inactivity level lap aggregation
            if ($log->cmid){
	            if (array_key_exists('activities', $aggregate)){
	                @$aggregate['activities']->elapsed += $lap;
	                @$aggregate['activities']->events += 1;
	            } else {
	                @$aggregate['activities']->elapsed = $lap;
	                @$aggregate['activities']->events = 1;
	            }
	        }

            /// Standard course level lap aggregation
            if (array_key_exists('coursetotal', $aggregate) && array_key_exists($log->course, $aggregate['coursetotal'])){
                @$aggregate['coursetotal'][$log->course]->elapsed += $lap;
                @$aggregate['coursetotal'][$log->course]->events += 1;
            } else {
                @$aggregate['coursetotal'][$log->course]->elapsed = $lap;
                @$aggregate['coursetotal'][$log->course]->events = 1;
            }
            
            $origintime = $log->time;
        }
    }

	// this is our last change to guess a user when no logs available
    if (empty($currentuser)) $currentuser = optional_param('userid', $USER->id, PARAM_INT);
    
    // we need check if time credits are used and override by credit earned
	if (file_exists($CFG->dirroot.'/mod/checklist/xlib.php')){
		include_once($CFG->dirroot.'/mod/checklist/xlib.php');
		$checklists = checklist_get_instances($COURSE->id, true); // get timecredit enabled ones
		
		foreach($checklists as $ckl){
			if ($credittimes = checklist_get_credittimes($ckl->id, 0, $currentuser)){
				foreach($credittimes as $credittime){
					
					// if credit time is assigned to NULL course module, we assign it to the checklist itself
					if (!$credittime->cmid){
						$cklcm = get_coursemodule_from_instance('checklist', $ckl->id);
						$credittime->cmid = $cklcm->id;
					}
					
					if (!empty($CFG->checklist_strict_credits)){
						// if strict credits, do override time even if real time is higher 
						$aggregate[$credittime->modname][$credittime->cmid]->elapsed = $credittime->credittime;
						$aggregate[$credittime->modname][$credittime->cmid]->timesource = 'credit';
					} else {
						// this processes validated modules that although have no logs
						if (!isset($aggregate[$credittime->modname][$credittime->cmid])){
							$aggregate[$credittime->modname][$credittime->cmid] = new StdClass;
							$aggregate[$credittime->modname][$credittime->cmid]->elapsed = 0;
							$aggregate[$credittime->modname][$credittime->cmid]->events = 0;
						}
						if ($aggregate[$credittime->modname][$credittime->cmid]->elapsed <= $credittime->credittime){
							$aggregate[$credittime->modname][$credittime->cmid]->elapsed = $credittime->credittime;
							$aggregate[$credittime->modname][$credittime->cmid]->timesource = 'credit';
						}
					}
				}
			}

			if ($declarativetimes = checklist_get_declaredtimes($ckl->id, 0, $currentuser)){
				foreach($declarativetimes as $declaredtime){

					// if declared time is assigned to NULL course module, we assign it to the checklist itself
					if (!$declaredtime->cmid){
						$cklcm = get_coursemodule_from_instance('checklist', $ckl->id);
						$declaredtime->cmid = $cklcm->id;
					}
					
					if (!empty($CFG->checklist_strict_declared)){
						// if strict declared, do override time even if real time is higher 
						$aggregate[$declaredtime->modname][$declaredtime->cmid]->elapsed = $declaredtime->declaredtime;
						$aggregate[$declaredtime->modname][$declaredtime->cmid]->timesource = 'declared';
					} else {
						// this processes validated modules that although have no logs
						if (!isset($aggregate[$declaredtime->modname][$declaredtime->cmid])){
							$aggregate[$declaredtime->modname][$declaredtime->cmid] = new StdClass;
							$aggregate[$declaredtime->modname][$declaredtime->cmid]->elapsed = 0;
							$aggregate[$declaredtime->modname][$declaredtime->cmid]->events = 0;
						}
						if ($aggregate[$declaredtime->modname][$declaredtime->cmid]->elapsed <= $declaredtime->declaredtime){
							$aggregate[$declaredtime->modname][$declaredtime->cmid]->elapsed = $declaredtime->declaredtime;
							$aggregate[$declaredtime->modname][$declaredtime->cmid]->timesource = 'declared';
						}
					}
				}
			}
		}
	}
    
    // we need finally adjust some times from time recording activities

	if (array_key_exists('scorm', $aggregate)){
		foreach(array_keys($aggregate['scorm']) as $cmid){
			if ($cm = $DB->get_record('course_modules', array('id'=> $cmid))){ // these are all scorms
				
				// scorm activities have their accurate recorded time
				$realtotaltime = 0;
				if ($realtimes = $DB->get_records_select('scorm_scoes_track', " element = 'cmi.core.total_time' AND scormid = $cm->instance AND userid = $currentuser ",array(),'id,element,value')){
					foreach($realtimes as $rt){
						$realcomps = preg_match("/(\d\d):(\d\d):(\d\d)\./", $rt->value, $matches);
						$realtotaltime += $matches[1] * 3600 + $matches[2] * 60 + $matches[3];
					}
				}
				if ($aggregate['scorm'][$cmid]->elapsed < $realtotaltime) $aggregate['scorm'][$cmid]->elapsed = $realtotaltime;
			}
		}
	}    
	
    return $aggregate;    
}

/**
* given an array of log records, make a displayable aggregate
* @param array $logs
* @param string $dimension
*/
function use_stats_aggregate_logs_per_user($logs, $dimension, $origintime = 0){
    global $CFG, $DB, $OUTPUT;

    if (isset($CFG->block_use_stats_capturemodules)){
        $modulelist = explode(',', $CFG->block_use_stats_capturemodules);
    } else {
        print_error('errornotinitiaized', 'block_use_stats');
    }

    $aggregate = array();        
    if (!empty($logs)){
        $logs = array_values($logs);

        $memlap = array(); // will store the accumulated time for in the way but out of scope laps.

		$end = count($logs) - 2;

		
        for($i = 0 ; $i < $end ; $i++){
        	$userid = $logs[$i]->userid;
            $log[$userid] = $logs[$i];

			// we fetch the next receivable log for this user
            $j = $i + 1;
            while( ($logs[$j]->userid != $userid) && $j < $end && (($logs[$j]->time - $log[$userid]->time) < 60 * MINSECS)){
            	$j++;
            }
            if ($j < $end && (($logs[$j]->time - $log[$userid]->time) < 60 * MINSECS)){
	            $lognext[$userid] = $logs[$j];
            	$lap[$userid] = $lognext[$userid]->time - $log[$userid]->time;
	        } else {
				$lap[$userid] = $CFG->block_use_stats_lastpingcredit * MINSECS;
			}
			
			if ($lap[$userid] == 0) continue;

            switch($dimension){
                case 'module':{
                    if (!in_array($log[$userid]->$dimension, $modulelist)){
                        $memlap[$userid] = 0 + @$memlap[$userid] + $lap[$userid];
                        continue;
                    } else {
                        $lap[$userid] += 0 + @$memlap[$userid];
                        $memlap[$userid] = 0;
                    }
                    break;
                }
            }


            if (!isset($log[$userid]->$dimension)){
                $OUTPUT->notice('unknown dimension');
            }
            
            if (!isset($aggregate[$userid])){
            	$aggregate[$userid] = array();
            }
            
           /// Standard global lap aggregation
            if (array_key_exists($log[$userid]->$dimension, $aggregate[$userid]) && array_key_exists($log[$userid]->cmid, $aggregate[$userid][$logs[$i]->$dimension])){
                $aggregate[$userid][$log[$userid]->$dimension][$log[$userid]->cmid]->elapsed += $lap[$userid];
                $aggregate[$userid][$log[$userid]->$dimension][$log[$userid]->cmid]->events += 1;
            } else {
                $aggregate[$userid][$log[$userid]->$dimension][$log[$userid]->cmid]->elapsed = $lap[$userid];
                $aggregate[$userid][$log[$userid]->$dimension][$log[$userid]->cmid]->events = 1;
            }

           	/// Per login session aggregation
           	if ($log[$userid]->action != 'login' && @$lognext[$userid]->action == 'login'){
           		$aggregate[$userid]['sessions'][$sessionid]->sessionend = $log[$userid]->time ;
           	}
           	if ($log[$userid]->action == 'login'){
           		if (@$lognext[$userid]->action != 'login'){
	           		$sessionid = 0 + @$sessionid + 1;
	           		$aggregate[$userid]['sessions'][$sessionid]->elapsed = 0; // do not use first login time
	           		$aggregate[$userid]['sessions'][$sessionid]->sessionstart = $log[$userid]->time;
           		}
           	} else {
           		if (!isset($aggregate['sessions'][$sessionid])){
           			$aggregate[$userid]['sessions'][$sessionid]->sessionstart = $log[$userid]->time;
	           		$aggregate[$userid]['sessions'][$sessionid]->elapsed = $lap[$userid];
           		} else {
	           		$aggregate[$userid]['sessions'][$sessionid]->elapsed += $lap[$userid];
	           	}
        	}
            
		    // we need check if time credits are used and override by credit earned
			if (file_exists($CFG->dirroot.'/mod/checklist/xlib.php')){
				include_once($CFG->dirroot.'/mod/checklist/xlib.php');
				$checklists = checklist_get_instances($COURSE->id, true); // get timecredit enabled ones
				
				foreach($checklists as $ckl){
					if ($credittimes = checklist_get_credittimes($ckl->id, 0, $userid)){
						foreach($credittimes as $credittime){
							
							// if credit time is assigned to NULL course module, we assign it to the checklist itself
							if (!$credittime->cmid){
								$cklcm = get_coursemodule_from_instance('checklist', $ckl->id);
								$credittime->cmid = $cklcm->id;
							}
							
							if (!empty($CFG->checklist_strict_credits)){
								// if strict credits, do override time even if real time is higher 
								$aggregate[$userid][$credittime->modname][$credittime->cmid]->elapsed = $credittime->credittime;
								$aggregate[$userid][$credittime->modname][$credittime->cmid]->timesource = 'credit';
							} else {
								// this processes validated modules that although have no logs
								if (!isset($aggregate[$userid][$credittime->modname][$credittime->cmid])){
									$aggregate[$userid][$credittime->modname][$credittime->cmid] = new StdClass;
									$aggregate[$credittime->modname][$credittime->cmid]->elapsed = 0;
									$aggregate[$credittime->modname][$credittime->cmid]->events = 0;
								}
								if (@$aggregate[$userid][$credittime->modname][$credittime->cmid]->elapsed <= $credittime->credittime){
									$aggregate[$userid][$credittime->modname][$credittime->cmid]->elapsed = $credittime->credittime;
									$aggregate[$userid][$credittime->modname][$credittime->cmid]->timesource = 'credit';
								}
							}
						}
					}
	
					if ($declarativetimes = checklist_get_declaredtimes($ckl->id, 0, $userid)){
						foreach($declarativetimes as $declaredtime){
	
							// if declared time is assigned to NULL course module, we assign it to the checklist itself
							if (!$declaredtime->cmid){
								$cklcm = get_coursemodule_from_instance('checklist', $ckl->id);
								$declaredtime->cmid = $cklcm->id;
							}
							
							if (!empty($CFG->checklist_strict_declared)){
								// if strict declared, do override time even if real time is higher 
								$aggregate[$userid][$declaredtime->modname][$declaredtime->cmid]->elapsed = $declaredtime->declaredtime;
								$aggregate[$userid][$declaredtime->modname][$declaredtime->cmid]->timesource = 'declared';
							} else {
								// this processes validated modules that although have no logs
								if (!isset($aggregate[$userid][$declaredtime->modname][$declaredtime->cmid])){
									$aggregate[$userid][$declaredtime->modname][$declaredtime->cmid] = new StdClass;
									$aggregate[$userid][$declaredtime->modname][$declaredtime->cmid]->elapsed = 0;
									$aggregate[$userid][$declaredtime->modname][$declaredtime->cmid]->events = 0;
								}
								if ($aggregate[$userid][$declaredtime->modname][$declaredtime->cmid]->elapsed <= $declaredtime->declaredtime){
									$aggregate[$userid][$declaredtime->modname][$declaredtime->cmid]->elapsed = $declaredtime->declaredtime;
									$aggregate[$userid][$declaredtime->modname][$declaredtime->cmid]->timesource = 'declared';
								}
							}
						}
					}
				}
			}
            
            // $origintime = $log[$userid]->time;
        }
    }
    return $aggregate;    
}
?>
