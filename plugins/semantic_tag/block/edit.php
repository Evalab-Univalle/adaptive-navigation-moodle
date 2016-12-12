<?php
   
    require_once('../../config.php');
    require_once('lib.php');
    require_once('semantic_tag_form.php');
	require_once("{$CFG->libdir}/formslib.php");
	global $DB, $USER, $OUTPUT, $PAGE, $CFG;
	
	$courseid = required_param('id', PARAM_INT);
	$tagid = optional_param('tagid', null, PARAM_INT); 
	$itemid = optional_param('itemid', null, PARAM_INT);
	$remove = optional_param('remove', null, PARAM_INT);
	$confirm = optional_param('confirm', null, PARAM_INT);
	
	require_login($courseid);
	$userid = $USER->id;
	
	// Setup page
	$context = get_context_instance(CONTEXT_COURSE, $courseid);	
	$PAGE->set_context($context);
	$PAGE->set_pagelayout('standard');
	$url = $CFG->wwwroot.'/blocks/semantic_tag/edit.php?id='.$courseid;
	$courseurl = $CFG->wwwroot.'/course/view.php?id='.$courseid;
	$PAGE->set_url($url);	
	
	// Setup navbar
	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add(get_string('course'), $courseurl);
	$PAGE->navbar->add(get_string('viewtags', 'block_semantic_tag'));
	
	
	/* PROCESS ANY SUBMISSION */

	// alg:
	// if we have an 'add' submission
	// then loop over all the inputs
	print_object("post");
	print_object($_POST);
	$post_keys = array_keys($_POST);
	print_object($_POST);
		if (in_array ('addTags', $post_keys)) {// have they clicked?
			foreach ($_POST as $key => $value){
				$itemid = substr($key, strpos($key, '_') + 1);	
				print_object("itemid: ".$itemid);
				if (preg_match('/^tagname_(.*)$/', $key, $matches)){ // do we have a field?
					if (!empty($value)){ // does it have a value?
						// split, clean, validate, and add
						$splittags = preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
						print_object("split tags");
						print_object($splittags);
						//$splittags = explode(" ", $value);
						foreach ($splittags as $splittag){
							$splittag = semantic_tag_clean_tag_input($splittag);
							print_object("tagname: ".$splittag);
							if (!empty($splittag)){
								if (semantic_tag_validate_tag_name($splittag, $courseid)){
									print_object("validate name");
									print_object("tag: ".$splittag);
									if(!($currenttag = semantic_tag_get_tag('name',$splittag))){ // the tag doesn't exists
										$tag = new stdClass;
										$tag->name = $splittag;
										$tag->courseid = $courseid;
										semantic_tag_add_tag($tag);
									}
									$tag = semantic_tag_get_tag('name', $splittag);
									add_to_log($courseid, 'tag','association',$url,$tag->id,$itemid,$userid);
									semantic_tag_add_itemtag($splittag,$itemid, null);
									print_object("tag added: ".$splittag);
								}
							}
						}
					}
				}
			}
		} ?>
		 <script type="text/javascript">
				  var tag_datasource;
					  var YAHOO;
					YUI().use("yui2-autocomplete", "yui2-datasource", function (Y){
					YAHOO = Y.YUI2;
						 var tags = [<?php echo php_string_array_to_javascript_array_contents(array_map("semantic_tag_name(", semantic_tag_get_tags_by_course($courseid))); ?>];
				tag_datasource = new YAHOO.util.LocalDataSource(tags);
					});
					
					function createNewAutocompleteWidget(inputid,containerid){
				
				
				// Instantiate the AutoComplete
				var oAC = new YAHOO.widget.AutoComplete(inputid, containerid, tag_datasource);
				
				//oAC.prehighlightClassName = "yui-ac-prehighlight";
				//oAC.useShadow = true;
				oAC.delimChar = ",";
				oAC.queryDelay = 0.1;
			}
			
			
			// set to true during submission, so that the confirm box will not pop up
			var submitting=false;
			
			function isFormFilled(){ // returns true if the add tag form contains tags to add
				for(var i=0; i<document.addtagform.elements.length; i++){
					var el = document.addtagform.elements[i];
					if (el.type=="text" && el.value.match(/\S/)){ // makes sure it's not empty
						return true;
					}        
				}
				return false;
			}
			
			function askConfirm(){
				if (!submitting && isFormFilled()){ // if this is a non-submit event, but there are values to submit
					return "You have entered tags in the tagboxes, but haven't clicked 'Save' yet.";
				}
			}
			
			window.onbeforeunload = askConfirm;
	</script>
<?php

	require_login($course->id); // SECURITY: make sure the user has access to this course and is logged in
	
	echo $OUTPUT->header();
	
	// Set up necessary strings
	$OUTPUT->heading(get_string('edittags','block_score_item'));
	
	$userid = $USER->id;
	
	$context = get_context_instance(CONTEXT_COURSE, $courseid);
   // if (has_capability('block/semantic_tag:edit', $context)) {

		if($tagid){ // items taggued with one tag
					  $tag = semantic_tag_get_tag('id',$tagid);
					  if($itemid){
						 if($remove){							 
							 if($confirm){
								 semantic_tag_delete_itemtag($itemid,$tagid);									 
							  }
							 echo $OUTPUT->confirm(get_string('deletetagassociation', 'block_semantic_tag'), 
													 $url.'&tagid='.$tagid.'&itemid='.$itemid.'&remove=1&confirm=1', $url);								 
						 }
					 }
					 else{					 
							if($remove){
								echo $OUTPUT->confirm(get_string('deletetag', 'block_semantic_tag'), 
														 $url.'&tagid='.$tagid.'&remove=1&confirm=1', $url);
								if($confirm){
									 semantic_tag_delete_tag($tagid);
								  }
								 redirect($url);
							 }
							 else{
								$form = new semantic_tag_form(null , array('courseid' => $courseid));
								$toform = array('id' => $tagid, 'name' => $tag->name, 'description' => $tag->description);
								$form->set_data($toform);
								if ($form->is_cancelled()){
									redirect($url);
								 
								} else if ($data = $form->get_data()){
									if($data->id){
										semantic_tag_update_tag($data);
									}
									else{
										semantic_tag_add_tag($data);
									}							
									redirect($url);
								}
								else{
									print_object("display");
									$form->display();
									$form->display_list();
								}
							 }
					 }				
			 }
			 else{ 			 
				$items = semantic_tag_get_resources_visited_by_course_and_user($courseid,$userid);
				if(count($items)>0){
					$table = new html_table();
					$table->head = array(get_string('item','block_semantic_tag'),get_string('tagsapplied','block_semantic_tag'),get_string('addtags','block_semantic_tag').'<input type="submit" name="addTags" value="'.get_string('save').'" />');
					$table->data = array();
					
					foreach($items as $item){
						$itemid = $item->cmid;
						$itemurl = semantic_tag_get_item_url($itemid);
						
						$tags = semantic_tag_get_tags_item($itemid,$courseid);									
						$tagurls = '';
						if(count($tags)>0){
							foreach($tags as $tagid){
								$tag = semantic_tag_get_tag('id',$tagid);
								$tagurls .= '<a href="'.$url.'&tagid='.$tagid.'">'.$tag->name.'<img src="'.$OUTPUT->pix_url('t/edit') . '" class="iconsmall" /></a>'.'<a href="edit.php?id='.$courseid.'&tagid='.$tagid.'&itemid='.$itemid.'&remove=1" ><sup>[x]</sup></a>';
							}
						}
						
						$input_id = "myinput".$itemid;
						$container_id = "mycontainer".$itemid;
						$table->data[] = array($itemurl, $tagurls, 
											   '<div class="myAutoComplete"><input id="'.$input_id.'" type="text" name="tagname_'.$itemid.'" autocomplete=off tabindex='.$itemid.'/> <span id="'.$container_id.'"></span></div><script type="text/javascript"> YUI().use("yui2-autocomplete", "yui2-datasource", function (Y){createNewAutocompleteWidget("'.$input_id.'","'.$container_id.'");});</script>'); 
					}
					
					// print the form 
					echo '<div class="yui-skin-sam">'; // for 
					print('<form name="addtagform" method="post" action="edit.php?id='.$courseid.'" onSubmit="submitting=true;return true;">');
					echo html_writer::table($table);
					print('</form>');
					echo '</div>';
				}
				else{
						echo get_string('donthaveitemstoedit','block_semantic_tag');
				}
			 }
			 
			 ?>
			 <script type="text/javascript">
      YUI().use('yui2-yahoo-dom-event', function (Y){
          var YAHOO = Y.YUI2;

             (function() {
                 var Dom = YAHOO.util.Dom,
                     Event = YAHOO.util.Event;
                 
                 editable = {
                 config: {
                     class_name: 'editable'
                 },
                 init: function() {
                         this.clicked = false;
                         this.contents = false;
                         this.input = false;
                         
                         var _items = Dom.getElementsByClassName(this.config.class_name);
                         Event.addListener(_items, 'click', editable.dbl_click, editable, true);
                     },
                 dbl_click: function(ev) {
                         var tar = Event.getTarget(ev);
                         if (!tar) {
                             return;
                         }
                         if (tar.tagName && (tar.tagName.toLowerCase() == 'input')) {
                             return false;
                         }
                         this.check();
                         this.clicked = tar;
                         this.contents = this.clicked.innerHTML;
                         this.make_input();
                     },
                 make_input: function() {
                         this.input = Dom.generateId();
                         
                         new_input = document.createElement('input');
                         new_input.setAttribute('type', 'text');
                         new_input.setAttribute('id', this.input);
                         new_input.value = this.contents;
                         new_input.setAttribute('size', this.contents.length);
                         new_input.className = 'editable_input';
                         
                         this.clicked.innerHTML = '';
                         this.clicked.appendChild(new_input);
                         new_input.select();
                         Event.addListener(new_input, 'blur', editable.check, editable, true);
                         Event.addListener(new_input, 'keyup', function (ev){ if(ev.keyCode==13){this.clear_input();} else if (ev.keyCode == 27){ this.clear_input(true)}}, editable, true); // add check for enter and esc
                     },
                 clear_input: function(cancelled) {
                         if (cancelled){
                             this.clicked.innerHTML = this.contents;
                             this.clicked = false;
                             this.contents = false;
                             this.input = false;
                             return;
                             
                         } else if (this.input) {
                             if (Dom.get(this.input).value.length > 0) {
                                 this.clean_input();
                                 this.contents_new = Dom.get(this.input).value;
                                 this.clicked.innerHTML = this.contents_new;
                                 if (this.contents_new == this.contents){ // there's no change, so don't call callback (in our ConTag situation, it is appropriate to skip if not changed)
                                     this.clicked = false;
                                     this.contents = false;
                                     this.input = false;
                                     return;
                                 }
                             } else {
                                 this.contents_new = '[removed]'
                                 this.clicked.innerHTML = this.contents_new;
                             }
                         }
                         
                         this.callback();
                         
                         this.clicked = false;
                         this.contents = false;
                         this.input = false;
                     },
                 clean_input: function() {
                         checkText   = new String(Dom.get(this.input).value);
                         regEx1      = /\"/g;
                         checkText       = String(checkText.replace(regEx1, ''));
                         Dom.get(this.input).value = checkText;
                     },
                 check: function(ev) {
                         if (this.clicked) {
                             this.clear_input();
                         }
                     },
                 callback: function() {
                     }
                 }
             })();
      }); // end yui
    
    
    var nameToIDMap = {<?php $merged = array_merge($used_tags, $orphan_tags);
                       $lastel = end($merged);
                       foreach($merged as $tag){
						   $tagid = $tag->id;
                           echo '"'.semantic_tag_name($tagid).'":'.$tagid;
                           if ($lastel != $tag){
                               echo ',';
                           }
        } ?>};
    
    
    function getIDForOriginal(text){
        return nameToIDMap[text];
    }
    
    YUI().use('yui2-yahoo-dom-event', function (Y){
        var YAHOO = Y.YUI2;
    (function() {
        var Dom = YAHOO.util.Dom,
            Event = YAHOO.util.Event;
        editable.callback = function(){var id = getIDForOriginal(editable.contents); window.location="edit.php?id="+<?php echo $courseid ?>+"&<?php echo $CONTAG_RENAME_TAG_KEY_NAME ?>=TRUE&tag_id="+id+"&tag_new_name="+escape(editable.contents_new)};
        Event.onAvailable('editarea', editable.init, editable, true);
    })();
    });
    </script> 
			 
		<?php
		/* }
		 else{
			 echo get_string('youdonthavepermissions','block_semantic_tag');
		 }	*/
	$OUTPUT->footer(); 
?>

