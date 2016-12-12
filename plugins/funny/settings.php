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
 * The funny theme is built upon the funny theme.
 *
 * @package    theme
 * @subpackage funny
 * @author     estarguars113
 * @author     Based on code originally written Julian (@moodleman) Ridden,by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
$settings = null;

defined('MOODLE_INTERNAL') || die;


	$ADMIN->add('themes', new admin_category('theme_funny', 'funny'));

	// "geneicsettings" settingpage
	$temp = new admin_settingpage('theme_funny_generic',  get_string('geneicsettings', 'theme_funny'));
	
	// Default Site icon setting.
    $name = 'theme_funny/siteicon';
    $title = get_string('siteicon', 'theme_funny');
    $description = get_string('siteicondesc', 'theme_funny');
    $default = 'laptop';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
    // Include Awesome Font from Bootstrapcdn
    $name = 'theme_funny/bootstrapcdn';
    $title = get_string('bootstrapcdn', 'theme_funny');
    $description = get_string('bootstrapcdndesc', 'theme_funny');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
    //  file setting.
    $name = 'theme_funny/logo';
    $title = get_string('logo', 'theme_funny');
    $description = get_string('logodesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Second Logo file setting
	$name = 'theme_funny/secondlogo';
	$title = get_string('secondlogo','theme_funny');
	$description = get_string('secondlogodesc', 'theme_funny');
	$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
	$temp->add($setting);	
	
  	// Slogan Text (under logo)
    $name = 'theme_funny/slogan';
    $title = get_string('slogan', 'theme_funny');
    $description = get_string('slogandesc', 'theme_funny');
    $default = 'slogan';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT, 35);  
    $temp->add($setting);        	
    
    // Font Selector.
    $name = 'theme_funny/fontselect';
    $title = get_string('fontselect' , 'theme_funny');
    $description = get_string('fontselectdesc', 'theme_funny');
    $default = '1';
    $choices = array(
    	'1'=>'Oswald & PT Sans', 
    	'2'=>'Lobster & Cabin', 
    	'3'=>'Raleway & Goudy', 
    	'4'=>'Allerta & Crimson Text', 
    	'5'=>'Arvo & PT Sans',
    	'6'=>'Dancing Script & Josefin Sans',
    	'7'=>'Allan & Cardo',
    	'8'=>'Molengo & Lekton',
    	'9'=>'Droid Serif & Droid Sans',
    	'10'=>'Corbin & Nobile',
    	'11'=>'Ubuntu & Vollkorn',
    	'12'=>'Bree Serif & Open Sans', 
    	'13'=>'Bevan & Pontano Sans', 
    	'14'=>'Abril Fatface & Average', 
    	'15'=>'Playfair Display and Muli', 
    	'16'=>'Sansita One & Kameron',
    	'17'=>'Istok Web & Lora',
    	'18'=>'Pacifico & Arimo',
    	'19'=>'Nixie One & Ledger',
    	'20'=>'Cantata One & Imprima',
    	'21'=>'Rancho & Gudea',
    	'22'=>'DISABLE Google Fonts');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // User picture in header setting.
    $name = 'theme_funny/headerprofilepic';
    $title = get_string('headerprofilepic', 'theme_funny');
    $description = get_string('headerprofilepicdesc', 'theme_funny');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	    
    // Fixed or Variable Width.
    $name = 'theme_funny/pagewidth';
    $title = get_string('pagewidth', 'theme_funny');
    $description = get_string('pagewidthdesc', 'theme_funny');
    $default = 1200;
    $choices = array(1900=>get_string('fixedwidthwide','theme_funny'), 1200=>get_string('fixedwidthnarrow','theme_funny'), 100=>get_string('variablewidth','theme_funny'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Max width setting
    $name = 'theme_funny/maxwidth';
    $title = get_string('maxwidth','theme_funny');
    $description = get_string('maxwidthdesc', 'theme_funny');
    $default = '100';
    $choices = array('800' => '800px','960' => '960px','1100' => '1100px','1200' => '1200px','1600' =>'1600px', '100' => '100%');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);	
	
	//  Layout
    $name = 'theme_funny/layout';
    $title = get_string('layout','theme_funny');
    $description = get_string('layoutdesc', 'theme_funny');
    $default = 'three-column';
    $choices = array('three-column','just-right', 'just-left', 'no-columns');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);	
    


    // Use max width for side regions.
    $name = 'theme_funny/sideregionsmaxwidth';
    $title = get_string('sideregionsmaxwidth', 'theme_funny');
    $description = get_string('sideregionsmaxwidthdesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //Include the Editicons css rules
    $name = 'theme_funny/editicons';
    $title = get_string('editicons', 'theme_funny');
    $description = get_string('editiconsdesc', 'theme_funny');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $temp->add($setting);
    
    // Performance Information Display.
    $name = 'theme_funny/perfinfo';
    $title = get_string('perfinfo' , 'theme_funny');
    $description = get_string('perfinfodesc', 'theme_funny');
    $perf_max = get_string('perf_max', 'theme_funny');
    $perf_min = get_string('perf_min', 'theme_funny');
    $default = 'min';
    $choices = array('min'=>$perf_min, 'max'=>$perf_max);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Navbar Seperator.
    $name = 'theme_funny/navbarsep';
    $title = get_string('navbarsep' , 'theme_funny');
    $description = get_string('navbarsepdesc', 'theme_funny');
    $nav_thinbracket = get_string('nav_thinbracket', 'theme_funny');
    $nav_doublebracket = get_string('nav_doublebracket', 'theme_funny');
    $nav_thickbracket = get_string('nav_thickbracket', 'theme_funny');
    $nav_slash = get_string('nav_slash', 'theme_funny');
    $nav_pipe = get_string('nav_pipe', 'theme_funny');
    $dontdisplay = get_string('dontdisplay', 'theme_funny');
    $default = '/';
    $choices = array('/'=>$nav_slash, '\f105'=>$nav_thinbracket, '\f101'=>$nav_doublebracket, '\f054'=>$nav_thickbracket, '|'=>$nav_pipe);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Copyright setting.
    $name = 'theme_funny/copyright';
    $title = get_string('copyright', 'theme_funny');
    $description = get_string('copyrightdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
    // Footnote setting.
    $name = 'theme_funny/footnote';
    $title = get_string('footnote', 'theme_funny');
    $description = get_string('footnotedesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Custom CSS file.
    $name = 'theme_funny/customcss';
    $title = get_string('customcss', 'theme_funny');
    $description = get_string('customcssdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $ADMIN->add('theme_funny', $temp);
    
    /* Custom Menu Settings */
    $temp = new admin_settingpage('theme_funny_custommenu', get_string('custommenuheading', 'theme_funny'));
	            
    //This is the descriptor for the following Moodle color settings
    $name = 'theme_funny/mydashboardinfo';
    $heading = get_string('mydashboardinfo', 'theme_funny');
    $information = get_string('mydashboardinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Toggle dashboard display in custommenu.
    $name = 'theme_funny/displaymydashboard';
    $title = get_string('displaymydashboard', 'theme_funny');
    $description = get_string('displaymydashboarddesc', 'theme_funny');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //This is the descriptor for the following Moodle color settings
    $name = 'theme_funny/mycoursesinfo';
    $heading = get_string('mycoursesinfo', 'theme_funny');
    $information = get_string('mycoursesinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Toggle courses display in custommenu.
    $name = 'theme_funny/displaymycourses';
    $title = get_string('displaymycourses', 'theme_funny');
    $description = get_string('displaymycoursesdesc', 'theme_funny');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Set terminology for dropdown course list
	$name = 'theme_funny/mycoursetitle';
	$title = get_string('mycoursetitle','theme_funny');
	$description = get_string('mycoursetitledesc', 'theme_funny');
	$default = 'course';
	$choices = array(
		'course' => get_string('mycourses', 'theme_funny'),
		'unit' => get_string('myunits', 'theme_funny'),
		'class' => get_string('myclasses', 'theme_funny'),
		'module' => get_string('mymodules', 'theme_funny')
	);
	$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
    
    $ADMIN->add('theme_funny', $temp);
    
	/* Color Settings */
    $temp = new admin_settingpage('theme_funny_color', get_string('colorheading', 'theme_funny'));
    $temp->add(new admin_setting_heading('theme_funny_color', get_string('colorheadingsub', 'theme_funny'),
            format_text(get_string('colordesc' , 'theme_funny'), FORMAT_MARKDOWN)));

    // Background Image.
    $name = 'theme_funny/pagebackground';
    $title = get_string('pagebackground', 'theme_funny');
    $description = get_string('pagebackgrounddesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'pagebackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Main theme colour setting.
    $name = 'theme_funny/themecolor';
    $title = get_string('themecolor', 'theme_funny');
    $description = get_string('themecolordesc', 'theme_funny');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme Hover colour setting.
    $name = 'theme_funny/themehovercolor';
    $title = get_string('themehovercolor', 'theme_funny');
    $description = get_string('themehovercolordesc', 'theme_funny');
    $default = '#29a1c4';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    
    // Footer background colour setting.
    $name = 'theme_funny/footercolor';
    $title = get_string('footercolor', 'theme_funny');
    $description = get_string('footercolordesc', 'theme_funny');
    $default = '#000000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer text colour setting.
    $name = 'theme_funny/footertextcolor';
    $title = get_string('footertextcolor', 'theme_funny');
    $description = get_string('footertextcolordesc', 'theme_funny');
    $default = '#DDDDDD';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer Block Heading colour setting.
    $name = 'theme_funny/footerheadingcolor';
    $title = get_string('footerheadingcolor', 'theme_funny');
    $description = get_string('footerheadingcolordesc', 'theme_funny');
    $default = '#CCCCCC';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer Seperator colour setting.
    $name = 'theme_funny/footersepcolor';
    $title = get_string('footersepcolor', 'theme_funny');
    $description = get_string('footersepcolordesc', 'theme_funny');
    $default = '#313131';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer URL colour setting.
    $name = 'theme_funny/footerurlcolor';
    $title = get_string('footerurlcolor', 'theme_funny');
    $description = get_string('footerurlcolordesc', 'theme_funny');
    $default = '#BBBBBB';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer URL hover colour setting.
    $name = 'theme_funny/footerhovercolor';
    $title = get_string('footerhovercolor', 'theme_funny');
    $description = get_string('footerhovercolordesc', 'theme_funny');
    $default = '#FFFFFF';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for the user theme colors.
    $name = 'theme_funny/alternativethemecolorsinfo';
    $heading = get_string('alternativethemecolors', 'theme_funny');
    $information = get_string('alternativethemecolorsdesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    $defaultalternativethemecolors = array('#a430d1', '#d15430', '#5dd130');
    $defaultalternativethemehovercolors = array('#9929c4', '#c44c29', '#53c429');

    foreach (range(1, 3) as $alternativethemenumber) {

        // Enables the user to select an alternative colors choice.
        $name = 'theme_funny/enablealternativethemecolors' . $alternativethemenumber;
        $title = get_string('enablealternativethemecolors', 'theme_funny', $alternativethemenumber);
        $description = get_string('enablealternativethemecolorsdesc', 'theme_funny', $alternativethemenumber);
        $default = false;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
        
        // User theme colour name.
        $name = 'theme_funny/alternativethemename' . $alternativethemenumber;
        $title = get_string('alternativethemename', 'theme_funny', $alternativethemenumber);
        $description = get_string('alternativethemenamedesc', 'theme_funny', $alternativethemenumber);
        $default = get_string('alternativecolors', 'theme_funny', $alternativethemenumber);
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
  
        // User theme colour setting.
        $name = 'theme_funny/alternativethemecolor' . $alternativethemenumber;
        $title = get_string('alternativethemecolor', 'theme_funny', $alternativethemenumber);
        $description = get_string('alternativethemecolordesc', 'theme_funny', $alternativethemenumber);
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // User theme hover colour setting.
        $name = 'theme_funny/alternativethemehovercolor' . $alternativethemenumber;
        $title = get_string('alternativethemehovercolor', 'theme_funny', $alternativethemenumber);
        $description = get_string('alternativethemehovercolordesc', 'theme_funny', $alternativethemenumber);
        $default = $defaultalternativethemehovercolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    }

 	$ADMIN->add('theme_funny', $temp);
 
 
    /* Slideshow Widget Settings */
    $temp = new admin_settingpage('theme_funny_slideshow', get_string('slideshowheading', 'theme_funny'));
    $temp->add(new admin_setting_heading('theme_funny_slideshow', get_string('slideshowheadingsub', 'theme_funny'),
            format_text(get_string('slideshowdesc' , 'theme_funny'), FORMAT_MARKDOWN)));
    
    // Toggle Slideshow.
    $name = 'theme_funny/toggleslideshow';
    $title = get_string('toggleslideshow' , 'theme_funny');
    $description = get_string('toggleslideshowdesc', 'theme_funny');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_funny');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_funny');
    $displayafterlogin = get_string('displayafterlogin', 'theme_funny');
    $dontdisplay = get_string('dontdisplay', 'theme_funny');
    $default = 'alwaysdisplay';
    $choices = array('1'=>$alwaysdisplay, '2'=>$displaybeforelogin, '3'=>$displayafterlogin, '0'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Hide slideshow on phones.
    $name = 'theme_funny/hideonphone';
    $title = get_string('hideonphone' , 'theme_funny');
    $description = get_string('hideonphonedesc', 'theme_funny');
    $display = get_string('alwaysdisplay', 'theme_funny');
    $dontdisplay = get_string('dontdisplay', 'theme_funny');
    $default = 'display';
    $choices = array(''=>$display, 'hidden-phone'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Slideshow Design Picker.
    $name = 'theme_funny/slideshowvariant';
    $title = get_string('slideshowvariant' , 'theme_funny');
    $description = get_string('slideshowvariantdesc', 'theme_funny');
    $slideshow1 = get_string('slideshow1', 'theme_funny');
    $slideshow2 = get_string('slideshow2', 'theme_funny');
    $default = 'slideshow1';
    $choices = array('1'=>$slideshow1, '2'=>$slideshow2);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	//This is the descriptor for the Slideshow
    $name = 'theme_funny/slidecolorinfo';
    $heading = get_string('slidecolors', 'theme_funny');
    $information = get_string('slidecolorsdesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
      // Slide Header colour setting.
    $name = 'theme_funny/slideheadercolor';
    $title = get_string('slideheadercolor', 'theme_funny');
    $description = get_string('slideheadercolordesc', 'theme_funny');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Slide Text colour setting.
    $name = 'theme_funny/slidecolor';
    $title = get_string('slidecolor', 'theme_funny');
    $description = get_string('slidecolordesc', 'theme_funny');
    $default = '#888';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Slide Button colour setting.
    $name = 'theme_funny/slidebuttoncolor';
    $title = get_string('slidebuttoncolor', 'theme_funny');
    $description = get_string('slidebuttoncolordesc', 'theme_funny');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
        //This is the descriptor for the Slideshow
    $name = 'theme_funny/footercolorinfo';
    $heading = get_string('footercolors', 'theme_funny');
    $information = get_string('footercolorsdesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    /*
     * Slide 1
     */
     
    //This is the descriptor for Slide One
    $name = 'theme_funny/slide1info';
    $heading = get_string('slide1', 'theme_funny');
    $information = get_string('slideinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Title.
    $name = 'theme_funny/slide1';
    $title = get_string('slidetitle', 'theme_funny');
    $description = get_string('slidetitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_funny/slide1image';
    $title = get_string('slideimage', 'theme_funny');
    $description = get_string('slideimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_funny/slide1caption';
    $title = get_string('slidecaption', 'theme_funny');
    $description = get_string('slidecaptiondesc', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
    $name = 'theme_funny/buttontext1';
    $title = get_string('buttontext', 'theme_funny');
    $description = get_string('buttontext', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_funny/slide1url';
    $title = get_string('slideurl', 'theme_funny');
    $description = get_string('slideurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 2
     */
     
    //This is the descriptor for Slide Two
    $name = 'theme_funny/slide2info';
    $heading = get_string('slide2', 'theme_funny');
    $information = get_string('slideinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Title.
    $name = 'theme_funny/slide2';
    $title = get_string('slidetitle', 'theme_funny');
    $description = get_string('slidetitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_funny/slide2image';
    $title = get_string('slideimage', 'theme_funny');
    $description = get_string('slideimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_funny/slide2caption';
    $title = get_string('slidecaption', 'theme_funny');
    $description = get_string('slidecaptiondesc', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
    $name = 'theme_funny/buttontext2';
    $title = get_string('buttontext', 'theme_funny');
    $description = get_string('buttontext', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_funny/slide2url';
    $title = get_string('slideurl', 'theme_funny');
    $description = get_string('slideurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 3
     */

    //This is the descriptor for Slide Three
    $name = 'theme_funny/slide3info';
    $heading = get_string('slide3', 'theme_funny');
    $information = get_string('slideinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Title.
    $name = 'theme_funny/slide3';
    $title = get_string('slidetitle', 'theme_funny');
    $description = get_string('slidetitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_funny/slide3image';
    $title = get_string('slideimage', 'theme_funny');
    $description = get_string('slideimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_funny/slide3caption';
    $title = get_string('slidecaption', 'theme_funny');
    $description = get_string('slidecaptiondesc', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
    $name = 'theme_funny/buttontext3';
    $title = get_string('buttontext', 'theme_funny');
    $description = get_string('buttontext', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_funny/slide3url';
    $title = get_string('slideurl', 'theme_funny');
    $description = get_string('slideurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * Slide 4
     */
     
    //This is the descriptor for Slide Four
    $name = 'theme_funny/slide4info';
    $heading = get_string('slide4', 'theme_funny');
    $information = get_string('slideinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Title.
    $name = 'theme_funny/slide4';
    $title = get_string('slidetitle', 'theme_funny');
    $description = get_string('slidetitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_funny/slide4image';
    $title = get_string('slideimage', 'theme_funny');
    $description = get_string('slideimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_funny/slide4caption';
    $title = get_string('slidecaption', 'theme_funny');
    $description = get_string('slidecaptiondesc', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
    $name = 'theme_funny/buttontext1';
    $title = get_string('buttontext', 'theme_funny');
    $description = get_string('buttontext', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_funny/slide4url';
    $title = get_string('slideurl', 'theme_funny');
    $description = get_string('slideurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	//This is the descriptor for Slide Four
    $name = 'theme_funny/slide4info';
    $heading = get_string('slide4', 'theme_funny');
    $information = get_string('slideinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Title.
    $name = 'theme_funny/slide5';
    $title = get_string('slidetitle', 'theme_funny');
    $description = get_string('slidetitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_funny/slide5image';
    $title = get_string('slideimage', 'theme_funny');
    $description = get_string('slideimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide5image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_funny/slide5caption';
    $title = get_string('slidecaption', 'theme_funny');
    $description = get_string('slidecaptiondesc', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
    $name = 'theme_funny/buttontext1';
    $title = get_string('buttontext', 'theme_funny');
    $description = get_string('buttontext', 'theme_funny');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // URL.
    $name = 'theme_funny/slide5url';
    $title = get_string('slideurl', 'theme_funny');
    $description = get_string('slideurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $ADMIN->add('theme_funny', $temp);
    
    $temp = new admin_settingpage('theme_funny_frontcontent', get_string('frontcontentheading', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_frontcontent', get_string('frontcontentheadingsub', 'theme_funny'),
            format_text(get_string('frontcontentdesc' , 'theme_funny'), FORMAT_MARKDOWN)));
    
    // Enable Frontpage Content
    $name = 'theme_funny/usefrontcontent';
    $title = get_string('usefrontcontent', 'theme_funny');
    $description = get_string('usefrontcontentdesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	//Main Page Block Background Image.
    $name = 'theme_funny/mainblockbackground';
    $title = get_string('mainblockbackground', 'theme_funny');
    $description = get_string('mainblockbackgrounddesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'mainblockbackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Frontpage Content
    $name = 'theme_funny/frontcontentarea';
    $title = get_string('frontcontentarea', 'theme_funny');
    $description = get_string('frontcontentareadesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Toggle Frontpage Middle Blocks
    $name = 'theme_funny/frontpagemiddleblocks';
    $title = get_string('frontpagemiddleblocks' , 'theme_funny');
    $description = get_string('frontpagemiddleblocksdesc', 'theme_funny');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_funny');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_funny');
    $displayafterlogin = get_string('displayafterlogin', 'theme_funny');
    $dontdisplay = get_string('dontdisplay', 'theme_funny');
    $default = 'display';
    $choices = array('1'=>$alwaysdisplay, '2'=>$displaybeforelogin, '3'=>$displayafterlogin, '0'=>$dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
        
    $ADMIN->add('theme_funny', $temp);
	
	/* Social Network Settings */
	$temp = new admin_settingpage('theme_funny_social', get_string('socialheading', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_social', get_string('socialheadingsub', 'theme_funny'),
            format_text(get_string('socialdesc' , 'theme_funny'), FORMAT_MARKDOWN)));
	
    // Website url setting.
    $name = 'theme_funny/website';
    $title = get_string('website', 'theme_funny');
    $description = get_string('websitedesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Facebook url setting.
    $name = 'theme_funny/facebook';
    $title = get_string(    	'facebook', 'theme_funny');
    $description = get_string(    	'facebookdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Flickr url setting.
    $name = 'theme_funny/flickr';
    $title = get_string('flickr', 'theme_funny');
    $description = get_string('flickrdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_funny/twitter';
    $title = get_string('twitter', 'theme_funny');
    $description = get_string('twitterdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Google+ url setting.
    $name = 'theme_funny/googleplus';
    $title = get_string('googleplus', 'theme_funny');
    $description = get_string('googleplusdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_funny/linkedin';
    $title = get_string('linkedin', 'theme_funny');
    $description = get_string('linkedindesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Pinterest url setting.
    $name = 'theme_funny/pinterest';
    $title = get_string('pinterest', 'theme_funny');
    $description = get_string('pinterestdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Instagram url setting.
    $name = 'theme_funny/instagram';
    $title = get_string('instagram', 'theme_funny');
    $description = get_string('instagramdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // YouTube url setting.
    $name = 'theme_funny/youtube';
    $title = get_string('youtube', 'theme_funny');
    $description = get_string('youtubedesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Skype url setting.
    $name = 'theme_funny/skype';
    $title = get_string('skype', 'theme_funny');
    $description = get_string('skypedesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
 
    // VKontakte url setting.
    $name = 'theme_funny/vk';
    $title = get_string('vk', 'theme_funny');
    $description = get_string('vkdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting); 
    
    $ADMIN->add('theme_funny', $temp);
	
	
	
	/* blocks main page*/
	$temp = new admin_settingpage('theme_funny_blocks_main', get_string('blocksmainpage', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_blocks_main', get_string('blocksmainpagesub', 'theme_funny'),
            format_text(get_string('blocksmainpagedesc' , 'theme_funny'), FORMAT_MARKDOWN)));
			
	//Main Page Block Background Image.
    $name = 'theme_funny/mainblockbackground';
    $title = get_string('mainblockbackground', 'theme_funny');
    $description = get_string('mainblockbackgrounddesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'mainblockbackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Description
	$name = 'theme_funny/blocksdescription';
    $title = get_string('blocksdescription' , 'theme_funny');
    $description = get_string('blocksdescriptiondesc', 'theme_funny');	
	$setting = new admin_setting_configtext($name, $title, $description, '');
	$setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* Block 1*/
	
	// Title
	$name = 'theme_funny/blocktitle1';
    $title = get_string('blocktitle', 'theme_funny');
    $description = get_string('blocktitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	
	// Description
	$name = 'theme_funny/blocktext1';
    $title = get_string('blocktext' , 'theme_funny');
    $description = get_string('blocktextdesc', 'theme_funny');	
	$setting = new admin_setting_configtextarea($name, $title, $description, $default);
	$setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Image.
    $name = 'theme_funny/blockimage1';
    $title = get_string('blockimage', 'theme_funny');
    $description = get_string('blockimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'blockimage1');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
	$name = 'theme_funny/blockbutton1';
    $title = get_string('blockbutton', 'theme_funny');
    $description = get_string('blockbuttondesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// URL
	$name = 'theme_funny/blockurl1';
    $title = get_string('blockurl', 'theme_funny');
    $description = get_string('blockurl1desc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* Block 2*/
	
	// Title
	$name = 'theme_funny/blocktitle2';
    $title = get_string('blocktitle', 'theme_funny');
    $description = get_string('blocktitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	
	// Description
	$name = 'theme_funny/blocktext2';
    $title = get_string('blocktext' , 'theme_funny');
    $description = get_string('blocktextdesc', 'theme_funny');	
	$setting = new admin_setting_configtextarea($name, $title, $description, $default);
	$setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Image.
    $name = 'theme_funny/blockimage2';
    $title = get_string('blockimage', 'theme_funny');
    $description = get_string('blockimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'blockimage2');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
	$name = 'theme_funny/blockbutton2';
    $title = get_string('blockbutton', 'theme_funny');
    $description = get_string('blockbuttondesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// URL
	$name = 'theme_funny/blockurl2';
    $title = get_string('blockurl', 'theme_funny');
    $description = get_string('blockurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* Block 3*/
	
	// Title
	$name = 'theme_funny/blocktitle3';
    $title = get_string('blocktitle', 'theme_funny');
    $description = get_string('blocktitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	
	// Description
	$name = 'theme_funny/blocktext3';
    $title = get_string('blocktext' , 'theme_funny');
    $description = get_string('blocktextdesc', 'theme_funny');	
	$setting = new admin_setting_configtextarea($name, $title, $description, $default);
	$setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Image.
    $name = 'theme_funny/blockimage3';
    $title = get_string('blockimage', 'theme_funny');
    $description = get_string('blockimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'blockimage3');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
	$name = 'theme_funny/blockbutton3';
    $title = get_string('blockbutton', 'theme_funny');
    $description = get_string('blockbuttondesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// URL
	$name = 'theme_funny/blockurl3';
    $title = get_string('blockurl', 'theme_funny');
    $description = get_string('blockurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
		
	/* Block 4*/
	
	// Title
	$name = 'theme_funny/blocktitle4';
    $title = get_string('blocktitle', 'theme_funny');
    $description = get_string('blocktitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	
	// Description
	$name = 'theme_funny/blocktext4';
    $title = get_string('blocktext' , 'theme_funny');
    $description = get_string('blocktextdesc', 'theme_funny');	
	$setting = new admin_setting_configtextarea($name, $title, $description, $default);
	$setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Image.
    $name = 'theme_funny/blockimage4';
    $title = get_string('blockimage', 'theme_funny');
    $description = get_string('blockimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'blockimage4');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
	$name = 'theme_funny/blockbutton3';
    $title = get_string('blockbutton', 'theme_funny');
    $description = get_string('blockbuttondesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// URL
	$name = 'theme_funny/blockurl4';
    $title = get_string('blockurl', 'theme_funny');
    $description = get_string('blockurldesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* Block 5*/
	
	// Title
	$name = 'theme_funny/blocktitle5';
    $title = get_string('blocktitle', 'theme_funny');
    $description = get_string('blocktitledesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	
	// Description
	$name = 'theme_funny/blocktext5';
    $title = get_string('blocktext' , 'theme_funny');
    $description = get_string('blocktextdesc', 'theme_funny');	
	$setting = new admin_setting_configtextarea($name, $title, $description, $default);
	$setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Image.
    $name = 'theme_funny/blockimage5';
    $title = get_string('blockimage', 'theme_funny');
    $description = get_string('blockimagedesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'blockimage5');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// Button text
	$name = 'theme_funny/blockbutton4';
    $title = get_string('blockbutton', 'theme_funny');
    $description = get_string('blockbuttondesc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	// URL
	$name = 'theme_funny/blockurl5';
    $title = get_string('blockurl5', 'theme_funny');
    $description = get_string('blockurl5desc', 'theme_funny');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $default = '';
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	$ADMIN->add('theme_funny', $temp);
	
	/* Circular navigation Settings */
    $temp = new admin_settingpage('theme_funny_circular_nav', get_string('circularnavheading', 'theme_funny'));
    $temp->add(new admin_setting_heading('theme_funny_circularnav', get_string('circularnavsub', 'theme_funny'),
            format_text(get_string('circularnavdesc' , 'theme_funny'), FORMAT_MARKDOWN)));


	$name = 'theme_funny/buttoncolor';
    $title = get_string('buttoncolor', 'theme_funny');
    $description = get_string('buttoncolordesc', 'theme_funny');
	$default = '#000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	$name = 'theme_funny/buttonhovercolor';
    $title = get_string('buttonhovercolor', 'theme_funny');
    $description = get_string('buttonhovercolordesc', 'theme_funny');
	$default = '#fff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

	$name = 'theme_funny/oddcolor';
    $title = get_string('oddcolor', 'theme_funny');
    $description = get_string('oddcolordesc', 'theme_funny');
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	$name = 'theme_funny/oddhovercolor';
    $title = get_string('oddhovercolor', 'theme_funny');
    $description = get_string('oddhovercolordesc', 'theme_funny');
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	$name = 'theme_funny/evencolor';
    $title = get_string('evencolor', 'theme_funny');
    $description = get_string('evencolordesc', 'theme_funny');
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	$name = 'theme_funny/evenhovercolor';
    $title = get_string('evenhovercolor', 'theme_funny');
    $description = get_string('evenhovercolordesc', 'theme_funny');
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	 /* menu item 1*/
	$name = 'theme_funny/itemicon1';
    $title = get_string('itemicon1', 'theme_funny');
    $description = get_string('itemicon1desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	 
	$name = 'theme_funny/itemurl1';
    $title = get_string('itemurl1', 'theme_funny');
    $description = get_string('itemurl1desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* menu item 2*/
	$name = 'theme_funny/itemicon2';
    $title = get_string('itemicon2', 'theme_funny');
    $description = get_string('itemicon2desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	 
	$name = 'theme_funny/itemurl2';
    $title = get_string('itemurl2', 'theme_funny');
    $description = get_string('itemurl2desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* menu item 3*/
	$name = 'theme_funny/itemicon3';
    $title = get_string('itemicon3', 'theme_funny');
    $description = get_string('itemicon3desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	 
	$name = 'theme_funny/itemurl3';
    $title = get_string('itemurl3', 'theme_funny');
    $description = get_string('itemurl3desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* menu item 4*/
	$name = 'theme_funny/itemicon4';
    $title = get_string('itemicon4', 'theme_funny');
    $description = get_string('itemicon4desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	 
	$name = 'theme_funny/itemurl4';
    $title = get_string('itemurl4', 'theme_funny');
    $description = get_string('itemurl1desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	/* menu item 5*/
	$name = 'theme_funny/itemicon5';
    $title = get_string('itemicon5', 'theme_funny');
    $description = get_string('itemicon5desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	 
	$name = 'theme_funny/itemurl5';
    $title = get_string('itemurl5', 'theme_funny');
    $description = get_string('itemurl5desc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	

	$ADMIN->add('theme_funny', $temp);
	
	/* CEO Settings */
	$temp = new admin_settingpage('theme_funny_ceo', get_string('ceoheading', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_ceo', get_string('ceoheadingsub', 'theme_funny'),
            format_text(get_string('ceodesc' , 'theme_funny'), FORMAT_MARKDOWN)));
			
		// CEO Settings
	    $name = 'theme_funny/mtaghead';
	    $heading = get_string('mtaghead', 'theme_funny');
	    $information = get_string('mtagheaddesc', 'theme_funny');
	    $setting = new admin_setting_heading($name, $heading, $information);
   		$temp->add($setting);
    // Keywords Meta Tag Setting
        $name = 'theme_funny/mtkeywords';
        $title = get_string('mtkeywords', 'theme_funny');
        $description = get_string('mtkeywordsdesc', 'theme_funny');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_TEXT, 100, 3);  
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    // Description Meta Tag Setting
        $name = 'theme_funny/mtdescription';
        $title = get_string('mtdescription', 'theme_funny');
        $description = get_string('mtdescriptiondesc', 'theme_funny');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_TEXT, 100, 3);  
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    // OPTIONAL META TAGs _ Show
        $name = 'theme_funny/optionalmtag';
        $title = get_string('optionalmtag','theme_funny');
        $description = get_string('optionalmtagdesc', 'theme_funny');
        $default = '1';
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    // Custom META TAGs
        $name = 'theme_funny/custommtag';
        $title = get_string('custommtag', 'theme_funny');
        $description = get_string('custommtagdesc', 'theme_funny');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_RAW, 100, 5);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);	
	
     $ADMIN->add('theme_funny', $temp);
	 
     /* Category Settings */
    $temp = new admin_settingpage('theme_funny_categoryicon', get_string('categoryiconheading', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_categoryicon', get_string('categoryiconheadingsub', 'theme_funny'),
            format_text(get_string('categoryicondesc' , 'theme_funny'), FORMAT_MARKDOWN)));
    
    // Enable Category Icon Styling
    $name = 'theme_funny/usecategoryicon';
    $title = get_string('usecategoryicon', 'theme_funny');
    $description = get_string('usecategoryicondesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Default Icon Selector.
    $name = 'theme_funny/defaultcategoryicon';
    $title = get_string('defaultcategoryicon' , 'theme_funny');
    $description = get_string('defaultcategoryicondesc', 'theme_funny');
    $default = 'f07c';
    $choices = array(
        'f000' => 'fa-glass',
        'f001' => 'fa-music',
        'f002' => 'fa-search',
        'f003' => 'fa-envelope-o',
        'f004' => 'fa-heart',
        'f005' => 'fa-star',
        'f006' => 'fa-star-o',
        'f007' => 'fa-user',
        'f008' => 'fa-film',
        'f009' => 'fa-th-large',
        'f00a' => 'fa-th',
        'f00b' => 'fa-th-list',
        'f00c' => 'fa-check',
        'f00d' => 'fa-times',
        'f00e' => 'fa-search-plus',
        'f010' => 'fa-search-minus',
        'f011' => 'fa-power-off',
        'f012' => 'fa-signal',
        'f013' => 'fa-cog',
        'f014' => 'fa-trash-o',
        'f015' => 'fa-home',
        'f016' => 'fa-file-o',
        'f017' => 'fa-clock-o',
        'f018' => 'fa-road',
        'f019' => 'fa-download',
        'f01a' => 'fa-arrow-circle-o-down',
        'f01b' => 'fa-arrow-circle-o-up',
        'f01c' => 'fa-inbox',
        'f01d' => 'fa-play-circle-o',
        'f01e' => 'fa-repeat',
        'f021' => 'fa-refresh',
        'f022' => 'fa-list-alt',
        'f023' => 'fa-lock',
        'f024' => 'fa-flag',
        'f025' => 'fa-headphones',
        'f026' => 'fa-volume-off',
        'f027' => 'fa-volume-down',
        'f028' => 'fa-volume-up',
        'f029' => 'fa-qrcode',
        'f02a' => 'fa-barcode',
        'f02b' => 'fa-tag',
        'f02c' => 'fa-tags',
        'f02d' => 'fa-book',
        'f02e' => 'fa-bookmark',
        'f02f' => 'fa-print',
        'f030' => 'fa-camera',
        'f031' => 'fa-font',
        'f032' => 'fa-bold',
        'f033' => 'fa-italic',
        'f034' => 'fa-text-height',
        'f035' => 'fa-text-width',
        'f036' => 'fa-align-left',
        'f037' => 'fa-align-center',
        'f038' => 'fa-align-right',
        'f039' => 'fa-align-justify',
        'f03a' => 'fa-list',
        'f03b' => 'fa-outdent',
        'f03c' => 'fa-indent',
        'f03d' => 'fa-video-camera',
        'f03e' => 'fa-picture-o',
        'f040' => 'fa-pencil',
        'f041' => 'fa-map-marker',
        'f042' => 'fa-adjust',
        'f043' => 'fa-tint',
        'f044' => 'fa-pencil-square-o',
        'f045' => 'fa-share-square-o',
        'f046' => 'fa-check-square-o',
        'f047' => 'fa-arrows',
        'f048' => 'fa-step-backward',
        'f049' => 'fa-fast-backward',
        'f04a' => 'fa-backward',
        'f04b' => 'fa-play',
        'f04c' => 'fa-pause',
        'f04d' => 'fa-stop',
        'f04e' => 'fa-forward',
        'f050' => 'fa-fast-forward',
        'f051' => 'fa-step-forward',
        'f052' => 'fa-eject',
        'f053' => 'fa-chevron-left',
        'f054' => 'fa-chevron-right',
        'f055' => 'fa-plus-circle',
        'f056' => 'fa-minus-circle',
        'f057' => 'fa-times-circle',
        'f058' => 'fa-check-circle',
        'f059' => 'fa-question-circle',
        'f05a' => 'fa-info-circle',
        'f05b' => 'fa-crosshairs',
        'f05c' => 'fa-times-circle-o',
        'f05d' => 'fa-check-circle-o',
        'f05e' => 'fa-ban',
        'f060' => 'fa-arrow-left',
        'f061' => 'fa-arrow-right',
        'f062' => 'fa-arrow-up',
        'f063' => 'fa-arrow-down',
        'f064' => 'fa-share',
        'f065' => 'fa-expand',
        'f066' => 'fa-compress',
        'f067' => 'fa-plus',
        'f068' => 'fa-minus',
        'f069' => 'fa-asterisk',
        'f06a' => 'fa-exclamation-circle',
        'f06b' => 'fa-gift',
        'f06c' => 'fa-leaf',
        'f06d' => 'fa-fire',
        'f06e' => 'fa-eye',
        'f070' => 'fa-eye-slash',
        'f071' => 'fa-exclamation-triangle',
        'f072' => 'fa-plane',
        'f073' => 'fa-calendar',
        'f074' => 'fa-random',
        'f075' => 'fa-comment',
        'f076' => 'fa-magnet',
        'f077' => 'fa-chevron-up',
        'f078' => 'fa-chevron-down',
        'f079' => 'fa-retweet',
        'f07a' => 'fa-shopping-cart',
        'f07b' => 'fa-folder',
        'f07c' => 'fa-folder-open',
        'f07d' => 'fa-arrows-v',
        'f07e' => 'fa-arrows-h',
        'f080' => 'fa-bar-chart-o',
        'f081' => 'fa-twitter-square',
        'f082' => 'fa-facebook-square',
        'f083' => 'fa-camera-retro',
        'f084' => 'fa-key',
        'f085' => 'fa-cogs',
        'f086' => 'fa-comments',
        'f087' => 'fa-thumbs-o-up',
        'f088' => 'fa-thumbs-o-down',
        'f089' => 'fa-star-half',
        'f08a' => 'fa-heart-o',
        'f08b' => 'fa-sign-out',
        'f08c' => 'fa-linkedin-square',
        'f08d' => 'fa-thumb-tack',
        'f08e' => 'fa-external-link',
        'f090' => 'fa-sign-in',
        'f091' => 'fa-trophy',
        'f092' => 'fa-github-square',
        'f093' => 'fa-upload',
        'f094' => 'fa-lemon-o',
        'f095' => 'fa-phone',
        'f096' => 'fa-square-o',
        'f097' => 'fa-bookmark-o',
        'f098' => 'fa-phone-square',
        'f099' => 'fa-twitter',
        'f09a' => 'fa-facebook',
        'f09b' => 'fa-github',
        'f09c' => 'fa-unlock',
        'f09d' => 'fa-credit-card',
        'f09e' => 'fa-rss',
        'f0a0' => 'fa-hdd-o',
        'f0a1' => 'fa-bullhorn',
        'f0f3' => 'fa-bell',
        'f0a3' => 'fa-certificate',
        'f0a4' => 'fa-hand-o-right',
        'f0a5' => 'fa-hand-o-left',
        'f0a6' => 'fa-hand-o-up',
        'f0a7' => 'fa-hand-o-down',
        'f0a8' => 'fa-arrow-circle-left',
        'f0a9' => 'fa-arrow-circle-right',
        'f0aa' => 'fa-arrow-circle-up',
        'f0ab' => 'fa-arrow-circle-down',
        'f0ac' => 'fa-globe',
        'f0ad' => 'fa-wrench',
        'f0ae' => 'fa-tasks',
        'f0b0' => 'fa-filter',
        'f0b1' => 'fa-briefcase',
        'f0b2' => 'fa-arrows-alt',
        'f0c0' => 'fa-users',
        'f0c1' => 'fa-link',
        'f0c2' => 'fa-cloud',
        'f0c3' => 'fa-flask',
        'f0c4' => 'fa-scissors',
        'f0c5' => 'fa-files-o',
        'f0c6' => 'fa-paperclip',
        'f0c7' => 'fa-floppy-o',
        'f0c8' => 'fa-square',
        'f0c9' => 'fa-bars',
        'f0ca' => 'fa-list-ul',
        'f0cb' => 'fa-list-ol',
        'f0cc' => 'fa-strikethrough',
        'f0cd' => 'fa-underline',
        'f0ce' => 'fa-table',
        'f0d0' => 'fa-magic',
        'f0d1' => 'fa-truck',
        'f0d2' => 'fa-pinterest',
        'f0d3' => 'fa-pinterest-square',
        'f0d4' => 'fa-google-plus-square',
        'f0d5' => 'fa-google-plus',
        'f0d6' => 'fa-money',
        'f0d7' => 'fa-caret-down',
        'f0d8' => 'fa-caret-up',
        'f0d9' => 'fa-caret-left',
        'f0da' => 'fa-caret-right',
        'f0db' => 'fa-columns',
        'f0dc' => 'fa-sort',
        'f0dd' => 'fa-sort-asc',
        'f0de' => 'fa-sort-desc',
        'f0e0' => 'fa-envelope',
        'f0e1' => 'fa-linkedin',
        'f0e2' => 'fa-undo',
        'f0e3' => 'fa-gavel',
        'f0e4' => 'fa-tachometer',
        'f0e5' => 'fa-comment-o',
        'f0e6' => 'fa-comments-o',
        'f0e7' => 'fa-bolt',
        'f0e8' => 'fa-sitemap',
        'f0e9' => 'fa-umbrella',
        'f0ea' => 'fa-clipboard',
        'f0eb' => 'fa-lightbulb-o',
        'f0ec' => 'fa-exchange',
        'f0ed' => 'fa-cloud-download',
        'f0ee' => 'fa-cloud-upload',
        'f0f0' => 'fa-user-md',
        'f0f1' => 'fa-stethoscope',
        'f0f2' => 'fa-suitcase',
        'f0a2' => 'fa-bell-o',
        'f0f4' => 'fa-coffee',
        'f0f5' => 'fa-cutlery',
        'f0f6' => 'fa-file-text-o',
        'f0f7' => 'fa-building-o',
        'f0f8' => 'fa-hospital-o',
        'f0f9' => 'fa-ambulance',
        'f0fa' => 'fa-medkit',
        'f0fb' => 'fa-fighter-jet',
        'f0fc' => 'fa-beer',
        'f0fd' => 'fa-h-square',
        'f0fe' => 'fa-plus-square',
        'f100' => 'fa-angle-double-left',
        'f101' => 'fa-angle-double-right',
        'f102' => 'fa-angle-double-up',
        'f103' => 'fa-angle-double-down',
        'f104' => 'fa-angle-left',
        'f105' => 'fa-angle-right',
        'f106' => 'fa-angle-up',
        'f107' => 'fa-angle-down',
        'f108' => 'fa-desktop',
        'f109' => 'fa-laptop',
        'f10a' => 'fa-tablet',
        'f10b' => 'fa-mobile',
        'f10c' => 'fa-circle-o',
        'f10d' => 'fa-quote-left',
        'f10e' => 'fa-quote-right',
        'f110' => 'fa-spinner',
        'f111' => 'fa-circle',
        'f112' => 'fa-reply',
        'f113' => 'fa-github-alt',
        'f114' => 'fa-folder-o',
        'f115' => 'fa-folder-open-o',
        'f118' => 'fa-smile-o',
        'f119' => 'fa-frown-o',
        'f11a' => 'fa-meh-o',
        'f11b' => 'fa-gamepad',
        'f11c' => 'fa-keyboard-o',
        'f11d' => 'fa-flag-o',
        'f11e' => 'fa-flag-checkered',
        'f120' => 'fa-terminal',
        'f121' => 'fa-code',
        'f122' => 'fa-reply-all',
        'f122' => 'fa-mail-reply-all',
        'f123' => 'fa-star-half-o',
        'f124' => 'fa-location-arrow',
        'f125' => 'fa-crop',
        'f126' => 'fa-code-fork',
        'f127' => 'fa-chain-broken',
        'f128' => 'fa-question',
        'f129' => 'fa-info',
        'f12a' => 'fa-exclamation',
        'f12b' => 'fa-superscript',
        'f12c' => 'fa-subscript',
        'f12d' => 'fa-eraser',
        'f12e' => 'fa-puzzle-piece',
        'f130' => 'fa-microphone',
        'f131' => 'fa-microphone-slash',
        'f132' => 'fa-shield',
        'f133' => 'fa-calendar-o',
        'f134' => 'fa-fire-extinguisher',
        'f135' => 'fa-rocket',
        'f136' => 'fa-maxcdn',
        'f137' => 'fa-chevron-circle-left',
        'f138' => 'fa-chevron-circle-right',
        'f139' => 'fa-chevron-circle-up',
        'f13a' => 'fa-chevron-circle-down',
        'f13b' => 'fa-html5',
        'f13c' => 'fa-css3',
        'f13d' => 'fa-anchor',
        'f13e' => 'fa-unlock-alt',
        'f140' => 'fa-bullseye',
        'f141' => 'fa-ellipsis-h',
        'f142' => 'fa-ellipsis-v',
        'f143' => 'fa-rss-square',
        'f144' => 'fa-play-circle',
        'f145' => 'fa-ticket',
        'f146' => 'fa-minus-square',
        'f147' => 'fa-minus-square-o',
        'f148' => 'fa-level-up',
        'f149' => 'fa-level-down',
        'f14a' => 'fa-check-square',
        'f14b' => 'fa-pencil-square',
        'f14c' => 'fa-external-link-square',
        'f14d' => 'fa-share-square',
        'f14e' => 'fa-compass',
        'f150' => 'fa-caret-square-o-down',
        'f151' => 'fa-caret-square-o-up',
        'f152' => 'fa-caret-square-o-right',
        'f153' => 'fa-eur',
        'f154' => 'fa-gbp',
        'f155' => 'fa-usd',
        'f156' => 'fa-inr',
        'f157' => 'fa-jpy',
        'f158' => 'fa-rub',
        'f159' => 'fa-krw',
        'f15a' => 'fa-btc',
        'f15b' => 'fa-file',
        'f15c' => 'fa-file-text',
        'f15d' => 'fa-sort-alpha-asc',
        'f15e' => 'fa-sort-alpha-desc',
        'f160' => 'fa-sort-amount-asc',
        'f161' => 'fa-sort-amount-desc',
        'f162' => 'fa-sort-numeric-asc',
        'f163' => 'fa-sort-numeric-desc',
        'f164' => 'fa-thumbs-up',
        'f165' => 'fa-thumbs-down',
        'f166' => 'fa-youtube-square',
        'f167' => 'fa-youtube',
        'f168' => 'fa-xing',
        'f169' => 'fa-xing-square',
        'f16a' => 'fa-youtube-play',
        'f16b' => 'fa-dropbox',
        'f16c' => 'fa-stack-overflow',
        'f16d' => 'fa-instagram',
        'f16e' => 'fa-flickr',
        'f170' => 'fa-adn',
        'f171' => 'fa-bitbucket',
        'f172' => 'fa-bitbucket-square',
        'f173' => 'fa-tumblr',
        'f174' => 'fa-tumblr-square',
        'f175' => 'fa-long-arrow-down',
        'f176' => 'fa-long-arrow-up',
        'f177' => 'fa-long-arrow-left',
        'f178' => 'fa-long-arrow-right',
        'f179' => 'fa-apple',
        'f17a' => 'fa-windows',
        'f17b' => 'fa-android',
        'f17c' => 'fa-linux',
        'f17d' => 'fa-dribbble',
        'f17e' => 'fa-skype',
        'f180' => 'fa-foursquare',
        'f181' => 'fa-trello',
        'f182' => 'fa-female',
        'f183' => 'fa-male',
        'f184' => 'fa-gittip',
        'f185' => 'fa-sun-o',
        'f186' => 'fa-moon-o',
        'f187' => 'fa-archive',
        'f188' => 'fa-bug',
        'f189' => 'fa-vk',
        'f18a' => 'fa-weibo',
        'f18b' => 'fa-renren',
        'f18c' => 'fa-pagelines',
        'f18d' => 'fa-stack-exchange',
        'f18e' => 'fa-arrow-circle-o-right',
        'f190' => 'fa-arrow-circle-o-left',
        'f191' => 'fa-caret-square-o-left',
        'f192' => 'fa-dot-circle-o',
        'f193' => 'fa-wheelchair',
        'f194' => 'fa-vimeo-square',
        'f195' => 'fa-try'
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //This is the descriptor for Category Icons
    $name = 'theme_funny/categoryiconinfo';
    $heading = get_string('categoryiconinfo', 'theme_funny');
    $information = get_string('categoryiconinfodesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Category Icons.
    $name = 'theme_funny/categoryicon';
    $title = get_string('categoryicon' , 'theme_funny');
    $description = get_string('categoryicondesc', 'theme_funny');
    $choices = array_merge(array('' => 'Use Default'), $choices);

    foreach (range(1, 20) as $categorynumber) {
        $setting = new admin_setting_configselect($name . $categorynumber, $title . ' ' . $categorynumber,
                $description . $categorynumber, $default, $choices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    }

    $ADMIN->add('theme_funny', $temp);
    
    $temp = new admin_settingpage('theme_funny_mobileapps', get_string('mobileappsheading', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_mobileapps', get_string('mobileappsheadingsub', 'theme_funny'),
            format_text(get_string('mobileappsdesc' , 'theme_funny'), FORMAT_MARKDOWN)));
    // Android App url setting.
    $name = 'theme_funny/android';
    $title = get_string('android', 'theme_funny');
    $description = get_string('androiddesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iOS App url setting.
    $name = 'theme_funny/ios';
    $title = get_string('ios', 'theme_funny');
    $description = get_string('iosdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //This is the descriptor for iOS Icons
    $name = 'theme_funny/iosiconinfo';
    $heading = get_string('iosicon', 'theme_funny');
    $information = get_string('iosicondesc', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // iPhone Icon.
    $name = 'theme_funny/iphoneicon';
    $title = get_string('iphoneicon', 'theme_funny');
    $description = get_string('iphoneicondesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iPhone Retina Icon.
    $name = 'theme_funny/iphoneretinaicon';
    $title = get_string('iphoneretinaicon', 'theme_funny');
    $description = get_string('iphoneretinaicondesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iPad Icon.
    $name = 'theme_funny/ipadicon';
    $title = get_string('ipadicon', 'theme_funny');
    $description = get_string('ipadicondesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iPad Retina Icon.
    $name = 'theme_funny/ipadretinaicon';
    $title = get_string('ipadretinaicon', 'theme_funny');
    $description = get_string('ipadretinaicondesc', 'theme_funny');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $ADMIN->add('theme_funny', $temp);
    
    /* User Alerts */
    $temp = new admin_settingpage('theme_funny_alerts', get_string('alertsheading', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_alerts', get_string('alertsheadingsub', 'theme_funny'),
            format_text(get_string('alertsdesc' , 'theme_funny'), FORMAT_MARKDOWN)));
    
    //This is the descriptor for Alert One
    $name = 'theme_funny/alert1info';
    $heading = get_string('alert1', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Enable Alert
    $name = 'theme_funny/enable1alert';
    $title = get_string('enablealert', 'theme_funny');
    $description = get_string('enablealertdesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Type.
    $name = 'theme_funny/alert1type';
    $title = get_string('alerttype' , 'theme_funny');
    $description = get_string('alerttypedesc', 'theme_funny');
    $alert_info = get_string('alert_info', 'theme_funny');
    $alert_warning = get_string('alert_warning', 'theme_funny');
    $alert_general = get_string('alert_general', 'theme_funny');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Title.
    $name = 'theme_funny/alert1title_'.current_language();
    $title = get_string('alerttitle', 'theme_funny');
    $description = get_string('alerttitledesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Text.
    $name = 'theme_funny/alert1text_'.current_language();
    $title = get_string('alerttext', 'theme_funny');
    $description = get_string('alerttextdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //This is the descriptor for Alert Two
    $name = 'theme_funny/alert2info';
    $heading = get_string('alert2', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Enable Alert
    $name = 'theme_funny/enable2alert';
    $title = get_string('enablealert', 'theme_funny');
    $description = get_string('enablealertdesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Type.
    $name = 'theme_funny/alert2type';
    $title = get_string('alerttype' , 'theme_funny');
    $description = get_string('alerttypedesc', 'theme_funny');
    $alert_info = get_string('alert_info', 'theme_funny');
    $alert_warning = get_string('alert_warning', 'theme_funny');
    $alert_general = get_string('alert_general', 'theme_funny');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Title.
    $name = 'theme_funny/alert2title_'.current_language();
    $title = get_string('alerttitle', 'theme_funny');
    $description = get_string('alerttitledesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Text.
    $name = 'theme_funny/alert2text_'.current_language();
    $title = get_string('alerttext', 'theme_funny');
    $description = get_string('alerttextdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    //This is the descriptor for Alert Three
    $name = 'theme_funny/alert3info';
    $heading = get_string('alert3', 'theme_funny');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Enable Alert
    $name = 'theme_funny/enable3alert';
    $title = get_string('enablealert', 'theme_funny');
    $description = get_string('enablealertdesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Type.
    $name = 'theme_funny/alert3type';
    $title = get_string('alerttype' , 'theme_funny');
    $description = get_string('alerttypedesc', 'theme_funny');
    $alert_info = get_string('alert_info', 'theme_funny');
    $alert_warning = get_string('alert_warning', 'theme_funny');
    $alert_general = get_string('alert_general', 'theme_funny');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Title.
    $name = 'theme_funny/alert3title_'.current_language();
    $title = get_string('alerttitle', 'theme_funny');
    $description = get_string('alerttitledesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Text.
    $name = 'theme_funny/alert3text_'.current_language();
    $title = get_string('alerttext', 'theme_funny');
    $description = get_string('alerttextdesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
            
    
    $ADMIN->add('theme_funny', $temp);
    
    /* Analytics Settings */
    $temp = new admin_settingpage('theme_funny_analytics', get_string('analyticsheading', 'theme_funny'));
	$temp->add(new admin_setting_heading('theme_funny_analytics', get_string('analyticsheadingsub', 'theme_funny'),
            format_text(get_string('analyticsdesc' , 'theme_funny'), FORMAT_MARKDOWN)));
    
    // Enable Analytics
    $name = 'theme_funny/useanalytics';
    $title = get_string('useanalytics', 'theme_funny');
    $description = get_string('useanalyticsdesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Google Analytics ID
    $name = 'theme_funny/analyticsid';
    $title = get_string('analyticsid', 'theme_funny');
    $description = get_string('analyticsiddesc', 'theme_funny');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Clean Analytics URL
    $name = 'theme_funny/analyticsclean';
    $title = get_string('analyticsclean', 'theme_funny');
    $description = get_string('analyticscleandesc', 'theme_funny');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
        
    $ADMIN->add('theme_funny', $temp);

