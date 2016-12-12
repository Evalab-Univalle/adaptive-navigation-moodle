<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Essential theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage Essential
 * @author     Julian (@moodleman) Ridden
 * @author     Based on code originally written by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
 class theme_funny_core_renderer extends theme_bootstrapbase_core_renderer {
 	
 	/*
     * This renders a notification message.
     * Uses bootstrap compatible html.
     */
    public function notification($message, $classes = 'notifyproblem') {
        $message = clean_text($message);
        $type = '';

        if ($classes == 'notifyproblem') {
            $type = 'alert alert-error';
        }
        if ($classes == 'notifysuccess') {
            $type = 'alert alert-success';
        }
        if ($classes == 'notifymessage') {
            $type = 'alert alert-info';
        }
        if ($classes == 'redirectmessage') {
            $type = 'alert alert-block alert-info';
        }
        return "<div class=\"$type\">$message</div>";
    } 
    
    /**
     * Outputs the page's footer
     * @return string HTML fragment
     */
    public function footer() {
        global $CFG, $DB, $USER;

        $output = $this->container_end_all(true);

        $footer = $this->opencontainers->pop('header/footer');

        if (debugging() and $DB and $DB->is_transaction_started()) {
            // TODO: MDL-20625 print warning - transaction will be rolled back
        }

        // Provide some performance info if required
        $performanceinfo = '';
        if (defined('MDL_PERF') || (!empty($CFG->perfdebug) and $CFG->perfdebug > 7)) {
            $perf = get_performance_info();
            if (defined('MDL_PERFTOLOG') && !function_exists('register_shutdown_function')) {
                error_log("PERF: " . $perf['txt']);
            }
            if (defined('MDL_PERFTOFOOT') || debugging() || $CFG->perfdebug > 7) {
                $performanceinfo = essential_performance_output($perf);
            }
        }

        $footer = str_replace($this->unique_performance_info_token, $performanceinfo, $footer);

        $footer = str_replace($this->unique_end_html_token, $this->page->requires->get_end_code(), $footer);

        $this->page->set_state(moodle_page::STATE_DONE);

        if(!empty($this->page->theme->settings->persistentedit) && property_exists($USER, 'editing') && $USER->editing && !$this->really_editing) {
            $USER->editing = false;
        }

        return $output . $footer;
    }
		
    protected function render_custom_menu(custom_menu $menu) {
    	/*
    	* This code replaces adds the current enrolled
    	* courses to the custommenu.
    	*/
    
    	$hasdisplaymycourses = (empty($this->page->theme->settings->displaymycourses)) ? false : $this->page->theme->settings->displaymycourses;
        if (isloggedin() && $hasdisplaymycourses) {
        	$mycoursetitle = $this->page->theme->settings->mycoursetitle;
            if ($mycoursetitle == 'module') {
				$branchlabel = '<i class="icon-briefcase"></i>'.get_string('mymodules', 'theme_essential');
				$branchtitle = get_string('mymodules', 'theme_essential');
			} else if ($mycoursetitle == 'unit') {
				$branchlabel = '<i class="icon-briefcase"></i>'.get_string('myunits', 'theme_essential');
				$branchtitle = get_string('myunits', 'theme_essential');
			} else if ($mycoursetitle == 'class') {
				$branchlabel = '<i class="icon-briefcase"></i>'.get_string('myclasses', 'theme_essential');
				$branchtitle = get_string('myclasses', 'theme_essential');
			} else {
				$branchlabel = '<i class="icon-briefcase"></i>'.get_string('mycourses', 'theme_essential');
				$branchtitle = get_string('mycourses', 'theme_essential');
			}
            $branchurl   = new moodle_url('/my/index.php');
            $branchsort  = 10000;
 
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
 			if ($courses = enrol_get_my_courses(NULL, 'fullname ASC')) {
 				foreach ($courses as $course) {
 					if ($course->visible){
 						$branch->add(format_string($course->fullname), new moodle_url('/course/view.php?id='.$course->id), format_string($course->shortname));
 					}
 				}
 			} else {
 				$branch->add('<em>'.get_string('noenrolments', 'theme_essential').'</em>',new moodle_url('/'),get_string('noenrolments', 'theme_essential'));
 			}
            
        }
        
        /*
    	* This code replaces adds the My Dashboard
    	* functionality to the custommenu.
    	*/
        $hasdisplaymydashboard = (empty($this->page->theme->settings->displaymydashboard)) ? false : $this->page->theme->settings->displaymydashboard;
        if (isloggedin() && $hasdisplaymydashboard) {
            $branchlabel = '<i class="icon-dashboard"></i>'.get_string('mydashboard', 'theme_essential');
            $branchurl   = new moodle_url('/my/index.php');
            $branchtitle = get_string('mydashboard', 'theme_essential');
            $branchsort  = 10000;
 
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
 			$branch->add('<em><i class="icon-user"></i>'.get_string('profile').'</em>',new moodle_url('/user/profile.php'),get_string('profile'));
 			$branch->add('<em><i class="icon-calendar"></i>'.get_string('pluginname', 'block_calendar_month').'</em>',new moodle_url('/calendar/view.php'),get_string('pluginname', 'block_calendar_month'));
 			$branch->add('<em><i class="icon-envelope"></i>'.get_string('pluginname', 'block_messages').'</em>',new moodle_url('/message/index.php'),get_string('pluginname', 'block_messages'));
 			$branch->add('<em><i class="icon-certificate"></i>'.get_string('badges').'</em>',new moodle_url('/badges/mybadges.php'),get_string('badges'));
 			$branch->add('<em><i class="icon-file"></i>'.get_string('privatefiles', 'block_private_files').'</em>',new moodle_url('/user/files.php'),get_string('privatefiles', 'block_private_files'));
 			$branch->add('<em><i class="icon-signout"></i>'.get_string('logout').'</em>',new moodle_url('/login/logout.php'),get_string('logout'));    
        }
 
        return parent::render_custom_menu($menu);
    }
    
 	/*
    * This code replaces the icons in the Admin block with
    * FontAwesome variants where available.
    */
     
 	protected function render_pix_icon(pix_icon $icon) {
        if (self::replace_moodle_icon($icon->pix) !== false && $icon->attributes['alt'] === '' && $icon->attributes['title'] === '') {
            return self::replace_moodle_icon($icon->pix);
        } else {
            return parent::render_pix_icon($icon);
        }
    }
    private static function replace_moodle_icon($name) {
        $icons = array(
            'add' => 'plus',
            'book' => 'book',
            'chapter' => 'file',
            'docs' => 'question-sign',
            'generate' => 'gift',
            'i/backup' => 'upload-alt',
            'i/checkpermissions' => 'user',
            'i/edit' => 'pencil',
            'i/filter' => 'filter',
            'i/grades' => 'table',
            'i/group' => 'group',
            'i/hide' => 'eye-open',
            'i/import' => 'download-alt',
            'i/move_2d' => 'move',
            'i/navigationitem' => 'circle-blank',
            'i/outcomes' => 'magic',
            'i/publish' => 'globe',
            'i/reload' => 'refresh',
            'i/report' => 'list-alt',
            'i/restore' => 'download-alt',
            'i/return' => 'repeat',
            'i/roles' => 'user',
            'i/settings' => 'beaker',
            'i/show' => 'eye-close',
            'i/switchrole' => 'random',
            'i/user' => 'user',
            'i/users' => 'user',
            't/right' => 'arrow-right',
            't/left' => 'arrow-left',
        );
        if (isset($icons[$name])) {
            return "<i class=\"icon-$icons[$name]\" id=\"icon\"></i>";
        } else {
            return false;
        }
    }
    
    /**
    * Get the HTML for blocks in the given region.
    *
    * @since 2.5.1 2.6
    * @param string $region The region to get HTML for.
    * @return string HTML.
    * Written by G J Bernard
    */
    
    public function essentialblocks($region, $classes = array(), $tag = 'aside') {
        $classes = (array)$classes;
        $classes[] = 'block-region';
        $attributes = array(
            'id' => 'block-region-'.preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $region),
            'class' => join(' ', $classes),
            'data-blockregion' => $region,
            'data-droptarget' => '1'
        );
        return html_writer::tag($tag, $this->blocks_for_region($region), $attributes);
    }
	
	public function one_block_region($region,$classes = array()) {
      $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
	  $classes = (array)$classes;
      $classes[] = 'block-region';
      $attributes = array(
            'id' => 'block-region-'.preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $region),
            'class' => join(' ', $classes),
            'data-blockregion' => $region,
            'data-droptarget' => '1'
     );
	 $bc =  $blockcontents[0];
     $block = '';
            if ($bc instanceof block_contents) {
                 $block .= $this->block($bc, $region);
             } else if ($bc instanceof block_move_target) {
                 $block .= $this->block_move_target($bc);
             } else {
                 throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
             }
		return html_writer::tag('div', $block, $attributes);
      }
	
    
    /**
    * Returns HTML to display a "Turn editing on/off" button in a form.
    *
    * @param moodle_url $url The URL + params to send through when clicking the button
    * @return string HTML the button
    * Written by G J Bernard
    */
    
    public function edit_button(moodle_url $url) {
        $url->param('sesskey', sesskey());    
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $btn = 'btn-danger';
            $title = get_string('turneditingoff');
            $icon = 'icon-off';
        } else {
            $url->param('edit', 'on');
            $btn = 'btn-success';
            $title = get_string('turneditingon');
            $icon = 'icon-edit';
        }
        return html_writer::tag('a', html_writer::start_tag('i', array('class' => $icon.' icon-white')).
               html_writer::end_tag('i'), array('href' => $url, 'class' => 'btn '.$btn, 'title' => $title));
    }
	
	 public function main_content() {
        $html = '<div role="main">';
		
		$settingsnav = $this->page->settingsnav;
		if ($this->page->cm) {
            
            // Using course admin because a student doesn't have access to it.
            if ($this->page->settingsnav->get('modulesettings')
                    && $this->page->settingsnav->get('modulesettings')->children
                    && $this->page->settingsnav->get('modulesettings')->children->count() > 0) {
                ob_start();
                ?>
                <?php if(count($settingsnav->get('modulesettings')->children)>0){ ?>
	                <div class="well dropdown well-small" style="float: left; margin-right: 10px; ">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                    <?php echo $this->pix_icon('i/settings', ''); ?>
	                    <b class="caret"></b></a>
	                    
	                    	<ul class="dropdown-menu">
			                    <?php foreach ($settingsnav->get('modulesettings')->children as $node): ?>
			                            <li><?php 
			                            if(!($node->children->count()>0  || $node->nodetype==navigation_node::NODETYPE_BRANCH)){
			                            	echo html_writer::link($node->action, $node->get_content());
			                            }
										else{ ?>
											<ul class="dropdown-menu">
												<?php 
													$childrens = $node->children;
													foreach($childrens as $child){?>
														<li><?php echo html_writer::link($child->action, $child->get_content()); ?></li>
													<?php }
												?>
											</ul>
										<?php }
										 ?></li>
			                        <?php endforeach ?>
			                    </ul>
	                    
	                </div>
                <?php }?>
                <?php
                $html .= ob_get_clean();
            };
        }else if ($this->page->course) {
            
            // Using course admin because a student doesn't have access to it.
            if ($this->page->settingsnav->get('courseadmin')
                    && $this->page->settingsnav->get('courseadmin')->children
                    && $this->page->settingsnav->get('courseadmin')->children->count() > 0) {
                ob_start();
                ?>
                <?php if(count($settingsnav->get('courseadmin')->children)>0){ ?>
	                <div class="well dropdown well-small" style="float: left; margin-right: 10px; ">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                    <?php echo $this->pix_icon('i/settings', ''); ?>
	                    <b class="caret"></b></a>
	                    
	                    	<ul class="dropdown-menu">
			                    <?php foreach ($settingsnav->get('courseadmin')->children as $node): ?>
			                            <li><?php 
			                            if(!($node->children->count()>0  || $node->nodetype==navigation_node::NODETYPE_BRANCH)){
			                            	echo html_writer::link($node->action, $node->get_content());
			                            }
										 ?></li>
			                        <?php endforeach ?>
			                    </ul>
	                    
	                </div>
                <?php }?>
                <?php
                $html .= ob_get_clean();
            };
        }
        $html .= $this->unique_main_content_token;
        $html .= '</div>';
        return $html;
    }
	 /*
     * This renders the navbar.
     * Uses bootstrap compatible html.
     */
     /*
 	public function navbar() {
        global $CFG, $OUTPUT;

        $items = $this->page->navbar->get_items();
        $breadcrumbs = array();
		
        if(count($items)>0){
        	 foreach ($items as $item) {
	            //print_object($item);
	            $item->hideicon = true;
	            $dropdown = '';
				
	            if ($item->type === navigation_node::TYPE_ROOTNODE) {	            	
	                $parentcat = $item->parent;
	                $neighbours = $parentcat->get_rootnodes();
	                $content = array();
					if(count($neighbours)>1){
						foreach ($neighbours as $neighbour) {
		                    $current = '';
		                    $neighbour->icon = null;
		                    if (empty($neighbour->action)) {
		                        continue;
		                    } else if ($neighbour->text == $item->text) {
		                        $neighbour->add_class('current');
		                    }
		                    $content[] = $this->render($neighbour);
		                }
						 $dropdown = "<ul class='dropdown-menu'><li>" . implode("</li><li>", $content) . "</li></ul>";
					}
					else{
						$dropdown = $this->render( $parentcat );
					}
	               
	            } 
	            else if ($item->type === navigation_node::TYPE_CATEGORY) {
	                $parentcat = coursecat::get($this->page->course->category)->parent;
	                $parentcat = coursecat::get($parentcat);
	                $neighbours = $parentcat->get_children();
	                $content = array();
					if(count($neighbours)>1){
		                foreach ($neighbours as $neighbour) {
		                    $current = '';
		                    if ($neighbour->id == $this->page->course->category) {
		                        $current = 'current';
		                    }
		                    $content[] = "<a class='$current' href='$CFG->wwwroot/course/index.php?categoryid={$neighbour->id}'>{$neighbour->name}</a>";
		                }
		                $dropdown = "<ul class='dropdown-menu'><li>" . implode("</li><li>", $content) . "</li></ul>";
					}
					else{
						$dropdown = $this->render( $parentcat );
					}
	            } else if ($item->type === navigation_node::TYPE_COURSE) {
	                // $item->add_class('dropdown');
	                $parentcat = coursecat::get($this->page->course->category);
	
	                $content = array();
	                $courses = enrol_get_my_courses('id');
	                $neighbours = $parentcat->get_courses();
					if(count($neighbours)>1){
						foreach ($neighbours as $neighbour) {
		                    $current = '';
		                    if ($neighbour->id === $this->page->course->id) {
		                        $current = 'current';
		                    } else if (!isset($courses[$neighbour->id]) && !is_siteadmin()) {
		                        continue;
		                    }
		                    $content[] = "<a class='$current' href='$CFG->wwwroot/course/view.php?id={$neighbour->id}'>{$neighbour->fullname}</a>";
		                }
		                $dropdown = "<ul class='dropdown-menu'><li>" . implode("</li><li>", $content) . "</li></ul>";
					}
					else{
						$dropdown = $this->render( $parentcat );
					}
	            } else if ($item->type === navigation_node::TYPE_SECTION) {
	                $parentnode = $item->parent;
	                $neighbours = $parentnode->children->type(navigation_node::TYPE_SECTION);
	                $content = array();
					if(count($neighbours)>1){
						foreach ($neighbours as $neighbour) {
		                    $current = '';
		                    if ($neighbour->text == $item->text) {
		                        $neighbour->add_class('current');
		                    }
		                    if ($neighbour->action == null) {
		                        $neighbour->action = new moodle_url('/course/view.php', array('id'=>$this->page->course->id));
		                    }
		                    $neighbour->icon = null;
		                    $content[] = $this->render($neighbour);
		                }
		                $dropdown = "<ul class='dropdown-menu'><li>" . implode("</li><li>", $content) . "</li></ul>";
					}
					else{
						$dropdown = $this->render( $parentcat );
					}
	            } else if ($item->type === navigation_node::TYPE_ACTIVITY || $item->type === navigation_node::TYPE_RESOURCE) {
	                $cm = $this->page->cm;
	                $course = $cm->get_modinfo();
	                $section = $course->get_section_info($cm->sectionnum);
	                $content = array();
					if(count($course->get_cms())>1){
						foreach ($course->get_cms() as $ccm) {
		                    $current = '';
		                    if ($section->section != $ccm->sectionnum) {
		                        continue;
		                    } else if (!$ccm->has_view()) {
		                        continue;
		                    } else if (!$ccm->uservisible) {
		                        continue;
		                    } else if ($ccm->id == $cm->id) {
		                        $current = 'current';
		                    }
		                    $content[] = html_writer::link($ccm->get_url(), html_writer::empty_tag('img', array('src' => $ccm->get_icon_url())) .
		                        ' ' . $ccm->get_formatted_name(), array('class' => $current));
		                }
		                $dropdown = "<ul class='dropdown-menu'><li>" . implode("</li><li>", $content) . "</li></ul>";
					}
					else{
						$dropdown = $this->render( $section );
					}
	                
	            } else if ($item->type === navigation_node::TYPE_SETTING && !empty($item->action)) {
	                $parentnode = $item->parent;
	                $neighbours = $parentnode->children->type(navigation_node::TYPE_SETTING);
	                $content = array();
					if(count($neighbours)>1){
						foreach ($neighbours as $neighbour) {
		                    $current = '';
		                    if ($neighbour->text == $item->text) {
		                        $neighbour->add_class('current');
		                    }
		                    // if ($neighbour->action == null) {
		                    //     $neighbour->action = new moodle_url('/course/view.php', array('id'=>$this->page->course->id));
		                    // }
		                    $neighbour->icon = null;
		                    $content[] = $this->render($neighbour);
		                }
		                $dropdown = "<ul class='dropdown-menu'><li>" . implode("</li><li>", $content) . "</li></ul>";
					}
					else{
						$dropdown = $this->render( $parentnode );
					}
				
	         	}
	            $renderered = $item->get_content();
	            if (!empty($item->action)) {
	                $renderered = html_writer::link($item->action, $item->get_content());
	            }
	
	            if (!empty($dropdown)) {
	                // $renderered = html_writer::link($item->action, $item->get_content() . '<b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
	                $renderered .= ' ' . html_writer::link('#', '<b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
	                $renderered .= $dropdown;
	            }
	
	            $breadcrumbs[] = $renderered;
	
	        }
        }
      
        if (empty($breadcrumbs)) {
            $breadcrumbs[] = html_writer::link(new moodle_url('/'), get_string('home'));
        }

        $divider = '<span class="divider">/</span>';
        $list_items = '<li class="dropdown">'.join(" $divider</li><li class='dropdown'>", $breadcrumbs).'</li>';
        $title = '<span class="accesshide">'.get_string('pagepath').'</span>';
        return $title . '<ul class="breadcrumb">'.$list_items.'</ul>';
    }
	*/	 

	  /**
     * Return the standard string that says whether you are logged in (and switched
     * roles/logged in as another user).
     * @param bool $withlinks if false, then don't include any links in the HTML produced.
     * If not set, the default is the nologinlinks option from the theme config.php file,
     * and if that is not set, then links are included.
     * @return string HTML fragment.
     */
    public function login_info($withlinks = null) {
        global $USER, $CFG, $DB, $SESSION;

        $data = array(
            'withlinks' => null,
            'withlinks' => null,
            'loginpage' => null,
            'course' => null,
            'loggedinas' => null,
            'realuser' => null,
            'loginasfullname' => null,
            'realuser' => null,
            'withlinks' => null,
            'loginastitle' => null,
            'loginaslink' => null,
            'course' => null,
            'loginurl' => null,
            'context' => null,
            'fullname' => null,
            'loggedinasguest' => null,
            'withlinks' => null,
            'link' => null,
            'linktitle' => null,
            'from' => null,
            'fromurl' => null,
            'loginas' => null,
            'loginpage' => null,
            'withlinks' => null,
            'showloginlink' => null,
            'role' => null,
            'loginas' => null,
            'username' => null,
            'switchrole' => null,
            'switchroleurl' => null,
            'switchroleurl' => null,
            'switchroleurl' => null,
            'loginas' => null,
            'username' => null,
            'showlogout' => null,
            'logouttext' => null,
            'notloggedin' => null,
            'loginas' => null,
            'loginpage' => null,
            'withlinks' => null,
            'showloginlink' => null,
            'logintext' => null,
            'notloggedin' => null,
            'loginas' => null,
            'showloginlink' => null,
            'loginurl' => null,
            'logintext' => null,
            'username' => null
        );
        $data = (object) $data;

        if (during_initial_install()) {
            return '';
        }

        $data->withlinks = $withlinks;
        if (is_null($withlinks)) {
            $data->withlinks = empty($this->page->layout_options['nologinlinks']);
        }

        $data->loginpage = ((string)$this->page->url === get_login_url());
        $data->course = $this->page->course;
        $course = $this->page->course;
        $data->loggedinas = session_is_loggedinas();
        $data->realuser = session_get_realuser();
        $data->loginasfullname = fullname($data->realuser, true);
        if (session_is_loggedinas()) {
            // $realuser = session_get_realuser();
            // $fullname = fullname($realuser, true);
            if ($data->withlinks) {
                $data->loginastitle = get_string('loginas');
                $data->loginaslink = new moodle_url('/course/loginas.php', array('id' => $data->course->id, 'sesskey' => sesskey()));
                // $loginastitle = get_string('loginas');
                // $realuserinfo = " [<a href=\"$CFG->wwwroot/course/loginas.php?id=$course->id&amp;sesskey=".sesskey()."\"";
                // $realuserinfo .= "title =\"".$loginastitle."\">$fullname</a>] ";
            } else {
                // $realuserinfo = " [$fullname] ";
            }
        } else {
            $realuserinfo = '';
        }

        $loginurl = get_login_url();
        $data->loginurl = $loginurl;

        if (empty($course->id)) {
            // $course->id is not defined during installation
            return '';
        } else if (isloggedin()) {
            $context = context_course::instance($course->id);
            $data->context = $context;

            $fullname = fullname($USER, true);
            $data->fullname = $fullname;
            // Since Moodle 2.0 this link always goes to the public profile page (not the course profile page)
            if ($data->withlinks) {
                $data->link = new moodle_url('/user/profile.php', array('id' => $USER->id));
                $data->linktitle = get_string('viewprofile');
                // $linktitle = get_string('viewprofile');
                // $username = "<a href=\"$CFG->wwwroot/user/profile.php?id=$USER->id\" title=\"$linktitle\">$fullname</a>";
            } else {
                // $username = $fullname;
            }
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host', array('id'=>$USER->mnethostid))) {
                $data->from = $idprovider->name;
                if ($withlinks) {
                    $data->fromurl = $idprovider->wwwroot;
                    // $username .= " from <a href=\"{$idprovider->wwwroot}\">{$idprovider->name}</a>";
                } else {
                    // $username .= " from {$idprovider->name}";
                }
            }
            if (isguestuser()) {
                $loggedinas = $realuserinfo.get_string('loggedinasguest');
                $data->loggedinasguest = true;
                $data->loginas = get_string('loggedinasguest');
                if (!$data->loginpage && $data->withlinks) {
                    $data->showloginlink = true;
                    // $loggedinas .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
                }
            } else if (is_role_switched($course->id)) { // Has switched roles
                $rolename = '';
                if ($role = $DB->get_record('role', array('id'=>$USER->access['rsw'][$context->path]))) {
                    $data->role = role_get_name($role, $context);
                    $rolename = ': '.role_get_name($role, $context);
                }
                // $loggedinas = get_string('loggedinas', 'moodle', $username).$rolename;
                $data->loginas = get_string('loggedinas', 'moodle', $data->fullname);
                if ($withlinks) {
                    $data->switchrole = get_string('switchrolereturn');
                    $data->switchroleurl = new moodle_url('/course/switchrole.php', array('id'=>$course->id,'sesskey'=>sesskey(), 'switchrole'=>0, 'returnurl'=>$this->page->url->out_as_local_url(false)));
                    $data->switchroleurl = $data->switchroleurl->out();
                    // $loggedinas .= '('.html_writer::tag('a', get_string('switchrolereturn'), array('href'=>$url)).')';
                }
            } else {
                // $loggedinas = $realuserinfo.get_string('loggedinas', 'moodle', $username);
                $data->loginas = get_string('loggedinas', 'moodle', $data->fullname);
                if ($data->withlinks) {
                    $data->showlogout = true;
                    $data->logouttext = get_string('logout');
                    $data->logouturl = new moodle_url('/login/logout.php', array('sesskey' => sesskey()));
                    // $loggedinas .= " (<a href=\"$CFG->wwwroot/login/logout.php?sesskey=".sesskey()."\">".get_string('logout').'</a>)';
                }
            }
        } else {
            $data->notloggedin = true;
            $data->loginas = get_string('loggedinnot', 'moodle');
            if (!$data->loginpage && $data->withlinks) {
                $data->showloginlink = true;
            }
        }
        $data->logintext = get_string('login');

        ob_start();
        $output = ob_get_clean();
        return $output;

        // $loggedinas = '<div class="logininfo">'.$loggedinas.'</div>';

        // if (isset($SESSION->justloggedin)) {
        //     unset($SESSION->justloggedin);
        //     if (!empty($CFG->displayloginfailures)) {
        //         if (!isguestuser()) {
        //             if ($count = count_login_failures($CFG->displayloginfailures, $USER->username, $USER->lastlogin)) {
        //                 $loggedinas .= '&nbsp;<div class="loginfailures">';
        //                 if (empty($count->accounts)) {
        //                     $loggedinas .= get_string('failedloginattempts', '', $count);
        //                 } else {
        //                     $loggedinas .= get_string('failedloginattemptsall', '', $count);
        //                 }
        //                 if (file_exists("$CFG->dirroot/report/log/index.php") and has_capability('report/log:view', context_system::instance())) {
        //                     $loggedinas .= ' (<a href="'.$CFG->wwwroot.'/report/log/index.php'.
        //                                          '?chooselog=1&amp;id=1&amp;modid=site_errors">'.get_string('logs').'</a>)';
        //                 }
        //                 $loggedinas .= '</div>';
        //             }
        //         }
        //     }
        // }

    }
}
