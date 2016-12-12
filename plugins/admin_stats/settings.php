<?php
   defined('MOODLE_INTERNAL') || die;
   
   $settings->add(new admin_setting_configtext(
            'graphwidth',
            get_string('graphwidth', 'block_admin_stats'),
            get_string('graphwidth_help', 'block_admin_stats'),
            '600',
            PARAM_INT
        ));
 
	$settings->add(new admin_setting_configtext(
	            'graphheight',
	            get_string('graphheight', 'block_admin_stats'),
	            get_string('graphheight_help', 'block_admin_stats'),
	            '400',
	            PARAM_INT
	        ));
			
			// Color settings 

	$colors = array(	
	    'aqua'=>get_string('aqua', 'block_admin_stats'),
	    'black'=>get_string('black', 'block_admin_stats'),
	    'blue'=>get_string('blue', 'block_admin_stats'),
	    'fuchsia'=>get_string('fuchsia', 'block_admin_stats'),
	    'gray'=>get_string('gray', 'block_admin_stats'),
	    'green'=>get_string('green', 'block_admin_stats'),
	    'lime'=>get_string('lime', 'block_admin_stats'),
	    'maroon'=>get_string('maroon', 'block_admin_stats'),
	    'navy'=>get_string('navy', 'block_admin_stats'),
	    'olive'=>get_string('olive', 'block_admin_stats'),
	    'orange'=>get_string('orange', 'block_admin_stats'),
	    'purple'=>get_string('purple', 'block_admin_stats'),
	    'red'=>get_string('red', 'block_admin_stats'),
	    'white'=>get_string('white', 'block_admin_stats'),
	    'yellow'=>get_string('yellow', 'block_admin_stats')
	    );
	
	
	$settings->add(new admin_setting_configselect(
	            'outer_background',
	            get_string('outer_background', 'block_admin_stats'),
	            get_string('outer_background_help', 'block_admin_stats'),
	            'white',
	            $colors
	        ));
	
	$settings->add(new admin_setting_configselect(
	            'inner_background',
	            get_string('inner_background', 'block_admin_stats'),
	            get_string('inner_background_help', 'block_admin_stats'),
	            'white',
	            $colors
	        ));
	
	$settings->add(new admin_setting_configselect(
	            'inner_border',
	            get_string('inner_border', 'block_admin_stats'),
	            get_string('inner_border_help', 'block_admin_stats'),
	            'gray',
	            $colors
	        ));
	
	$settings->add(new admin_setting_configselect(
	            'axis_colour',
	            get_string('axis_colour', 'block_admin_stats'),
	            get_string('axis_colour_help', 'block_admin_stats'),
	            'gray',
	            $colors
	        ));
	
	$settings->add(new admin_setting_configselect(
	            'color1',
	            get_string('color1', 'block_admin_stats'),
	            get_string('color1_help', 'block_admin_stats'),
	            'blue',
	            $colors
	        ));
	
	$settings->add(new admin_setting_configselect(
	            'color2',
	            get_string('color2', 'block_admin_stats'),
	            get_string('color2_help', 'block_admin_stats'),
	            'green',
	            $colors
	        ));
?>