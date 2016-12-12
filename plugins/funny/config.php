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
 * The funny theme is built upon the Essential theme.
 *
 * @package    theme
 * @subpackage funny
 * @author     estarguars113
 * @author     Based on code originally written Julian (@moodleman) Ridden,by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'funny';


$THEME->doctype = 'html5';
$THEME->yuicssmodules = array();
$THEME->parents = array('bootstrapbase');
$THEME->sheets = array('essential', 'layout','slides', 'categories', 'font-awesome.min', 'alternative1', 'alternative2', 'alternative3', 'settings');
$THEME->supportscssoptimisation = false;
$THEME->enable_dock = false;

$THEME->editor_sheets = array();

$THEME->plugins_exclude_sheets = array(
    'block' => array(
        'html',
    ),
);

$THEME->layouts = array(
    // Front page.
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('side-pre','center' ,'home-left', 'home-middle', 'home-right', 'top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right','hidden-dock'),
        'defaultregion' => 'hidden-dock',
        'options' => array('nonavbar'=>true),
    ),
    // Most backwards compatible layout without the blocks - this is the layout used by default.
    'base' => array(
        'file' => 'columns3.php',
        'regions' => array('top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'top-left',
    ),
    // Standard layout with blocks, this is recommended for most pages with general information.
    'standard' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
    ),
    // Main course page.
    'course' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post', 'top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu'=>true),
    ),
    'coursecategory' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post','top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'side-post',
    ),
    // part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post', 'top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'side-post',
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre','top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'side-pre',
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post','top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu'=>true),
    ),
    // My public page.
    'mypublic' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post','top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'side-post',
    ),
    'login' => array(
        'file' => 'columns1.php',
        'regions' => array('top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right', 'hidden-dock'),
        'defaultregion' => 'hidden-dock',
        'options' => array('langmenu'=>true),
    ),

    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => array(
        'file' => 'columns1.php',
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'noheader'=>true ,'noblocks'=>true),
    ),
    // No blocks and minimal footer - used for legacy frame layouts only!
    'frametop' => array(
        'file' => 'columns1.php',
        'regions' => array('footer-left', 'footer-middle', 'footer-right'),
        'defaultregion' => 'footer-right',
        'options' => array('nofooter'=>true, 'nocoursefooter'=>true),
    ),
    // Embeded pages, like iframe/object embeded in moodleform - it needs as much space as possible.
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array()
    ),
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, links, or API calls that would lead to database or cache interaction.
    // Please be extremely careful if you are modifying this layout.
    'maintenance' => array(
        'file' => 'maintenance.php',
        'regions' => array(),
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'columns1.php',
        'options' => array('nofooter'=>true, 'nonavbar'=>false, 'noblocks'=>true),
    ),
    // The pagelayout used when a redirection is occuring.
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => array(),
    ),
    // The pagelayout used for reports.
    'report' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre','top-left','top-middle','top-right','bottom-left','bottom-middle','bottom-right'),
        'defaultregion' => 'side-pre',
    ),
    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => 'secure.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre'
    ),
);

$THEME->javascripts = array(
    'coloursswitcher','fontsize_header'
);

$THEME->javascripts_footer = array(
    'dockmod','fontsize_footer'
);

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->csspostprocess = 'theme_funny_process_css';

$useragent = '';
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $useragent = $_SERVER['HTTP_USER_AGENT'];
}

if (core_useragent::is_ie() && !core_useragent::check_ie_version('9.0')) {
    $THEME->javascripts[] = 'html5shiv';
}
