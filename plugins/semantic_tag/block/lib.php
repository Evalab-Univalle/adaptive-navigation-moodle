<?php

	defined('MOODLE_INTERNAL') || die();

	function semantic_tag_add_tag($tag){
		global  $DB;
	    try{
	            $tag_id=$DB->insert_record('block_semantic_tag',$tag);
	     } catch (Exception $e){
	            return array(null,false); 
	     }
		 return $tag_id;
	}
	
	function semantic_tag_update_tag($tag){
	    global $DB;
		$tag_id = $DB->update_record('block_semantic_tag',$tag);
		return $tag_id ;
	}
	
	function semantic_tag_delete_tag($tagid){
		global $DB;
		
		//delete asociations
		$DB->delete_records('item_tag_association',array('tagid' => $tagid));
		
		$DB->delete_records('block_semantic_tag', array('id' => $tagid));
	}
	
	function semantic_tag_name($tagid){
		$tag = semantic_tag_get_tag('id',$tagid);
		return $tag->name;
	}
	
	function semantic_tag_get_tag($attribute, $value){
	    global $DB;
		$tag = $DB->get_record('block_semantic_tag',array($attribute => $value));
		return $tag;
	}
	
	function semantic_tag_add_itemtag($tagname,$itemid, $moduleid = null){
		global  $DB;
		$tagitem = new stdClass;
		$tag = semantic_tag_get_tag('name',$tagname);		
		$tagid = $tag->id;
		if(!$currentitemtag = $DB->get_record('item_tag_association',array('tagid' => $tagid, 'itemid' => $itemid))){ // this association doesn't exists
			if(is_null($moduleid)){
				$moduleid = semantic_tag_get_module_id($itemid);
			}
			$tagitem->tagid = $tagid;
			$tagitem->itemid = $itemid;
			$tagitem->moduleid = $moduleid;
			try{
					$tagitem_id = $DB->insert_record('item_tag_association',$tagitem);
			 } catch (Exception $e){
					return array(null,false); 
			 }
			 $tagitem->id = $tagitem_id;
		}
		return $tagitem->id;
	}
	
	function semantic_tag_delete_itemtag($itemid,$tagid){
			global $DB;
			try{
				return $DB->delete_records('item_tag_association',array('itemid' => $itemid , 'tagid' => $tagid));
			} catch (Exception $e){
				print_object($e);
				return array(null,false); 
			}
	}
    
    
    function semantic_tag_get_most_used_tags($courseid,$module = null,$startdate = null, $enddate = null,$action = null,$limit = null){
    	global $DB;
		$sql = "select tag.id ,count('x') as hits from {block_semantic_tag} as tag ,{log} as l
		where l.module = 'tag' and l.course = tag.courseid and 
		l.course= ".$courseid;
		
		if($module){
			$sql .= " and l.module = " .$module;
		}
		
		if($startdate){
			$sql .= " and time >= ".$startdate;
		}
		
		if($enddate){
			$sql .= "  time <= ".$enddate;
		}
		
		if($action){
			$sql .= " and action like '%".$action."%'";
		}
		
		$sql .= " group by tag.id order by hits desc ";
		
		if($limit){
			$sql .= " limit ".$limit;
		}
		return $DB->get_records_sql($sql);
    }
    function semantic_tag_get_pathway_tags($courseid,$userid){
		global $DB;
		$tags = $DB->get_fieldset_sql("select  distinct info from {log} where course = ? and userid = ? and module = 'tag' and action like '%view%' order by time asc", array('course' => $courseid, 'userid' => $userid));
		return $tags;
	}
	
	function semantic_tag_get_items_by_course($courseid){
		global $DB;
		$itemids = $DB->get_fieldset_sql('select id from {course_modules} where course = ? and module != 12', array($courseid));// exclude labels
		return $itemids;
	}
	
	function semantic_tag_get_courses_by_tag($tagid){
		global $DB;
		$courses = $DB->get_fieldset_sql('select courseid from {block_semantic_tag} where id = ?', array($tagid));
		return $courses;
	}
	
	function semantic_tag_get_items_by_tag($tagid,$courseid){
		global $DB;
		$itemids = $DB->get_fieldset_sql('select itemid from {item_tag_association} as a, {block_semantic_tag} as t where tagid = ? and t.id = tagid and courseid = ?', array('tagid' => $tagid,'courseid' => $courseid));
		return $itemids;
	}
	
	function semantic_tag_get_tags_by_course($courseid){
		global $DB;
		$tags = $DB->get_fieldset_sql('select id from {block_semantic_tag} where courseid = ?', array('courseid'=>$courseid));
		return $tagss;
	}
	
	function semantic_tag_get_tags_item($itemid,$courseid){
		global $DB;
		$itemids = $DB->get_fieldset_sql('select tagid from {item_tag_association},{block_semantic_tag} as t where itemid = ? and t.id= tagid and courseid = ?', array('itemid'=>$itemid, 'courseid' => $courseid));
		return $itemids;
	}
	
	function semantic_tag_validate_tag_name($tagname, $courseid){
		global $DB;
		return preg_match('/^[a-z0-9_]+$/', $tagname) ? true : false; // the tag name contains any weird character
	}
	
	function semantic_tag_get_module_id($itemid){
		global $DB;
		$query = "select  m.id from {course_modules} as cm,{modules} as m where cm.id = ? and cm.module = m.id ";
		$mod= $DB->get_field_sql($query,array($itemid));
		return $mod;		
	}

	
	function semantic_tag_get_module_name($itemid){
		global $DB;
		$query = "select  m.name from {course_modules} as cm,{modules} as m where cm.id = ? and cm.module = m.id ";
		$mod= $DB->get_field_sql($query,array($itemid));
		return $mod;		
	}

	
	function semantic_tag_get_recourse_name($itemid, $modname = null){
		if(is_null($modname)){
			$modname = semantic_tag_get_module_name($itemid);
		}	
		$resourcename= get_coursemodule_from_id($modname,$itemid)->name;	
		return $resourcename;
	}
	
	function semantic_tag_get_item_url($itemid,$modname = null){
		global $CFG, $OUTPUT;	
		if(is_null($modname)){
			$modname = semantic_tag_get_module_name($itemid);
		}
		$recoursename = semantic_tag_get_recourse_name($itemid,$modname);
		$activityicon = $OUTPUT->pix_icon('icon', $recoursename, $modname, array('class'=>'icon'));
		$url = $CFG->wwwroot.'/mod/'.$modname.'/view.php?id='.$itemid;
		$itemurl = '<a href="'.$url.'" alt="'.$recoursename.'">'.$activityicon.$recoursename.'</a>';
		return $itemurl;
	}
	
	function semantic_tag_get_tag_courses($tagname){
		global $DB;
		$sql = "select courseid from {block_semantic_tag} where name = ?";
		return $DB->get_fieldset_sql($sql, array('name' => $tagname));
	}
	

	function semantic_tag_get_items_by_tag_course($tagid, $courseid){
		global $DB;
		$itemids = $DB->get_fieldset_sql('select itemid from {item_tag_association}, {block_semantic_tag} as block where tagid = ? and tagid = block.id and block.courseid = ? ', array('tagid'=>$tagid, 'courseid' => $courseid));
		return $itemids;
	}
	
	function semantic_tag_get_items_list_tag_course($tagid, $courseid){
		$tags = semantic_tag_get_items_by_tag_course($tagid, $courseid);
			$taglist = '<ul>';
			foreach ($tags as $tag) {
				$taglist .= '<li>'.semantic_tag_get_url_module($tag).'</li>';
			}
		$taglist .= '</ul>';
		return $taglist;
	}
	function semantic_get_users_enrrolled($courseid){
		global $DB;
		$sql = 'SELECT c.id AS id, c.fullname, u.id as userid, u.username, u.firstname, u.lastname, u.email, u.picture
				FROM mdl_role_assignments ra, mdl_user u, mdl_course c, mdl_context cxt
				WHERE ra.userid = u.id
				AND ra.contextid = cxt.id
				AND cxt.contextlevel =50
				AND cxt.instanceid = c.id
				AND c.id = ?
				AND roleid =5 ';
		$students =  $DB->get_recordset_sql($sql, array($courseid));
		return $students;
	}
	function semantic_tag_get_number_visits($courseid, $userid){
		global $DB;
		$sql = "select count(*) from {log}  WHERE course = ? AND userid AND userid = ? AND action LIKE 'view%'";
		return $DB->get_field_sql($sql, array('course' => $courseid, 'userid' => $userid));
	}
	
	function semantic_tag_get_url_student($userid){
		global $DB, $CFG;
		$user = $DB->get_record('user',array('id' => $userid));
		$url = $CFG->wwwroot.'/user/profile.php?id='.$userid;
		return '<a href ="'.$url.'" >'.$user->firstname.' '.$user->lastname.'</a>';
	}
	
	
	function semantic_tag_get_url_course($courseid){
		global $DB, $CFG;
		$course = $DB->get_record('course',array('id' => $courseid));
		$url = $CFG->wwwroot.'/course/view.php?id='.$courseid;
		return '<a href ="'.$url.'" >'.$course->name.'</a>';
	}
	
	function semantic_tag_get_url_tag($courseid,$tagid){
		global $CFG;
		$tag = semantic_tag_get_tag('id',$tagid);
		$url = $CFG->wwroot.'/blocks/semantic_tag/view.php?id='.$courseid.'&tagid='.$tagid;
		return '<a href="'.$url.'">'.$tag->name.'</a>';
	}
	
	function semantic_tag_get_url_itemtag($courseid,$itemid){
		global $CFG;
		$itemname = semantic_tag_get_recourse_name($itemid);
		$url = $CFG->wwroot.'/blocks/semantic_tag/view.php?id='.$courseid.'&itemid='.$itemid;
		return '<a href="'.$url.'">'.$itemname.'</a>';
	}
	function semantic_tag_get_resources_visited_by_course_and_user($courseid,$userid){
		global $DB;
		$query = "select  distinct cmid, module, course, userid from {log} as l where module in (select name from {modules}) and action like 'view%' and course= ? and userid= ? and module != 'label'";	
		$items = $DB->get_records_sql($query,array('course'=>$courseid,'userid'=>$userid));
		return $items;
	}
	
	function semantic_tag_get_courseurl($courseid){
		global $CFG, $DB;
		$course = $DB->get_record('course',array('id' => $courseid));
		$url = $CFG->wwwroot.'/course/view.php?id='.$courseid;
		return '<a href="'.$url.'">'.$course->name.'</a>';
	}
	
	// returns '"item1","item2","item3"' etc - or '' if the array is empty
	function php_string_array_to_javascript_array_contents($string_array){
		return $string_array ? '"'.implode('" , "', $string_array).'"' : '';
	}
	
	// cleans raw tag input string
	// trims, inner spaces to '_', lowers
	function semantic_tag_clean_tag_input($tagname){
		return strtolower(preg_replace('/ /','_', trim($tagname)));
	}
	
	function semantic_tag_item_get_module_item($itemid){
		global $DB;
		$sql = "select module from {course_modules} where id = ?";
		return $DB->get_field_sql($sql, array('id'=>$itemid));
	}
	
	/**
	 * Filters the modules list to those installed in Moodle instance and used in current course
	 *
	 * @return array
	 */
	function semantic_tag_modules_in_use($courseid) {
	    global $DB;
	    $dbmanager = $DB->get_manager(); // used to check if tables exist
	    $modules = $DB->get_records_sql('select id,name from {modules}');
		$modulesinuse = array();
	    foreach ($modules as $module) {
			$id = $module->id;			
			$modname = $module->name;
	        //if($module->visible == 1 && $dbmanager->table_exists($modname) && $DB->record_exists($modname, array('course'=>$courseid))) {
	            $modulesinuse[$id] = $modname;
	        //}
	    }
	    return $modulesinuse;
	}
?>
