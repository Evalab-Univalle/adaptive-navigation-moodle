<?php
    
    defined('MOODLE_INTERNAL') || die();

	function block_score_item_add_score_item($item){
		global  $DB;
	    try{
	            $itemid=$DB->insert_record('block_score_item',$item);
	     } catch (Exception $e){
	     	print_object("fallo");
	     	print_object($e);
	         return array(null,false); 
	     }
		 $item->itemid = $itemid;
		 return $item;
	}
	
	function block_score_item_get_score_by_id($itemid,$userid){
		global $DB;
		$query = 'select * from {block_score_item} where itemid= ? and userid= ?';
		$score = $DB->get_record_sql($query,array('itemid'=>$itemid, 'userid' => $userid));
		return $score;	
	}
	
	
	function block_score_item_update_score_item($item){
	    global $DB;
		try{
			$item_id = $DB->update_record('block_score_item', $item);
		}catch (Exception $e){
	     	print_object("fallo");
	     	print_object($e);
	        return array(null,false); 
	     }
		return $item_id ;
	}
	
	function block_score_item_delete_score($itemid,$userid){
		global  $DB;
		 try{	    	
	    	$DB->delete_records('block_score_item',array('itemid' => $itemid , 'userid' => $userid));
	     } catch (Exception $e){
	     		print_object("fallo");
	     		print_object($e);
	            return array(null,false); 
	     }
		
	}
	
	function block_score_item_get_ranking($courseid,  $startdate = null, $enddate = null, $module = null , $group = 'itemid', $limit = null){
		global $DB;
		$sql = "select ".$group." as g, avg(score) as average
				from {block_score_item}
				where courseid = ".$courseid;	
				
		
		if(isset($startdate) && $startdate !=1){
			$sql .= " and timemodified <= ".$startdate; 
		}
		
		if(isset($enddate) && $enddate !=1){
			$sql .= " and timemodified >= ".$enddate; 
		}
		
		if(isset($module) && $module !=1){
			$sql .= " and moduleid = ".$module; 
		}
		
		$sql .= " group by g order by average desc";
		return $DB->get_records_sql($sql);
	}
	
	function block_score_item_scores_item($courseid, $itemid, $showcomments = false, $showuser = false, $showdate = false, $limit = null){
		global $DB;
		$sql = "select id,score ";
		
		if($showcomments){
			$sql .= " ,comment";
		}
		
		if($showuser){
			$sql .= " ,userid";
		}
		
		if($showdate){
			$sql .= " ,timemodified";
		}
		
		$sql .= " from {block_score_item} where itemid = ? and courseid = ?";		
		$sql .= " order by score desc";
		
		if($limit){
			$sql .= " limit ".$limit;
		}
		
		return $DB->get_records_sql($sql, array('itemid' => $itemid ,'courseid' => $courseid));
	}
	
	function block_score_item_scores_user($courseid, $userid, $showcomments = false, $showdate = false, $showmodule = false, $limit = null){
		global $DB;
		$sql = "select id,itemid,score ";
		
		if($showcomments){
			$sql .= " ,comment";
		}
				
		if($showdate){
			$sql .= " ,timemodified";
		}
		
		if($showmodule){
			$sql .= " ,moduleid";
		}
		
		$sql .= " from {block_score_item} where userid = ? and courseid = ?";		
		$sql .= " order by score desc";
		
		if($limit){
			$sql .= " limit ".$limit;
		}
		
		return $DB->get_records_sql($sql, array('userid' => $userid ,'courseid' => $courseid));
	}
	
	function block_score_item_score_average_item($courseid, $itemid){
		global $DB;		
		$sql = "select avg(score) from {block_score_item}  where itemid = ? and courseid = ?";
		return $DB->get_field_sql($sql, array('itemid' => $itemid ,'courseid' => $courseid));
	}
	
	function block_score_item_get_module_item($itemid){
		global $DB;
		$sql = "select module from {course_modules} where id = ?";
		return $DB->get_field_sql($sql, array('id'=>$itemid));
	}
	
	function block_score_item_get_module_name($moduleid){
		global $DB;
		$query = "select  name from {modules} as m where id = ?  ";
		$mod= $DB->get_field_sql($query,array('id'=>$moduleid));
		return $mod;		
	}
	
	function block_score_item_get_display_name($modname,$itemid){
		$name = '';
		if($item = get_coursemodule_from_id($modname,$itemid)){
			$name = $item->name;
		}
	return $name;
	}
	
	function block_score_item_get_item_url($itemid , $moduleid = null){
		global $CFG, $OUTPUT;
		if(is_null($moduleid)){
			$moduleid = block_score_item_get_module_item($itemid);
		}	
		
		$modname = block_score_item_get_module_name($moduleid);
		$recoursename = block_score_item_get_display_name($modname,$itemid);
		$activityicon = $OUTPUT->pix_icon('icon', $recoursename, $modname, array('class'=>'icon'));
		$url = $CFG->wwwroot.'/mod/'.$modname.'/view.php?id='.$moduleid;
		$itemurl = '<a href="'.$url.'" alt="'.$recoursename.'">'.$activityicon.$recoursename.'</a>';
		return $itemurl;
	}
	
	function block_score_item_get_itemscore_url($courseid,$itemid, $action = 'view',$moduleid = null){
		global $CFG;
		if(is_null($moduleid)){
			$moduleid = block_score_item_get_module_item($itemid);
		}	
		$modname = block_score_item_get_module_name($moduleid);
		$recoursename = block_score_item_get_display_name($modname,$itemid);
		$url = '<a href="'.$CFG->wwwroot.'/blocks/score_item/'.$action.'.php?id='.$courseid.'&itemid='.$itemid.'" >'.$recoursename.'</a>';
		return $url;
	}
	
	function block_score_item_get_user_url($courseid,$userid, $action = 'view'){
		global $DB,$CFG;
		$user = $DB->get_record('user',array('id'=>$userid));
		$username = $user->firstname." ".$user->lastname;
		$url = '<a href="'.$CFG->wwwroot.'/blocks/score_item/'.$action.'.php?id='.$courseid.'&userid='.$userid.'" >'.$username.'</a>';
		return $url;
	}
	
	function block_score_item_get_module_url($courseid,$moduleid, $action = 'view'){
		global $DB,$CFG;
		$modname = block_score_item_get_module_name($moduleid);
		$url = '<a href="'.$CFG->wwwroot.'/blocks/score_item/'.$action.'.php?id='.$courseid.'&moduleid='.$moduleid.'" >'.$modname.'</a>';
		return $url;
	}
	
	function block_score_item_get_resources_course($courseid){
		global $DB;
		$query = 'select id, module from {course_modules} where course = ?  ';	
		$items = $DB->get_records_sql($query,array('course'=>$courseid));
		return $items;
	}
	
	function block_score_item_get_scores_course($courseid){
		global $DB;
		$query = 'select * from {block_score_item} where courseid = ?  ';	
		$items = $DB->get_records_sql($query,array('courseid'=>$courseid));
		return $items;
	}
	
	function block_score_item_get_resources_visited_by_course_and_user($courseid,$userid){
		global $DB;
		$query = "select  distinct cmid, module, course, userid from {log} as l where module in (select name from {modules}) and action like 'view%' and course= ? and userid= ? and module <> 'label'";	
		$items = $DB->get_records_sql($query,array('course'=>$courseid,'userid'=>$userid));
		return $items;
	}
	
?>
