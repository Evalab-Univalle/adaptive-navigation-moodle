<?php
	require_once('../../config.php');
	require_once('lib.php');
	require_once("{$CFG->libdir}/formslib.php");
	include $CFG->dirroot.'/lib/graphlib.php';

	global $CFG,$DB;

    // Graph Parameters
	
	/**
	 * width of the the graph
	 * @var integer 
	 */
	$graphwidth = $CFG->graphwidth;
	
	/**
	 * height of the the graph
	 * @var integer 
	 */
	$graphheight = $CFG->graphheight;
		
	/**
	 * color of outer background
	 * @var string 
	 */
	$color_outer_background = $CFG->outer_background;
	
	/**
	 * color of inner background
	 * @var string 
	 */
	$color_inner_background = $CFG->inner_background;
	
	/**
	 * color of inner border
	 * @var string 
	 */
	$color_inner_border = $CFG->inner_border;
	
	/**
	 * color of axis
	 * @var string 
	 */
	$color_axis_colour = $CFG->axis_colour;
	
	/**
	 * color of the graph
	 * @var string 
	 */
	 $color1 = $CFG->color1;
	 
	 // Parameters
	 $categoryid = optional_param('categoryid', null, PARAM_INT);
	 $courseid = optional_param('courseid', null, PARAM_INT);
	 $cmid = optional_param('cmid', null, PARAM_INT);
	 $startdate = optional_param('startdate', null, PARAM_INT);
	 $enddate = optional_param('startdate', null, PARAM_INT);
	 $action = optional_param('action', 0, PARAM_INT);
	 $type = optional_param('type', 0, PARAM_INT);
	 $order = optional_param('order', 0, PARAM_INT);
	 
	 //Generate the graph
	 if($categoryid){
	 	if($action == 0){ // number of visits
			    	$results = admin_stats_views_coursecategory($categoryid, $startdate, $enddate, $order); 
		}
	 }
	 else if($courseid){
	 	if($action == 0){
				$title = get_string('numviews','block_admin_stats').get_string('course').'('.admin_stats_get_course_url($courseid).')';
				$results = admin_stats_views_course($courseid, null, null, $order); 				
			}else{
				$title = get_string('timespent','block_admin_stats').get_string('category');
			}
			
			$labels = array();
			$values = array();
		
			foreach($results as $result){
					$label = $result->label;
					print_object("order: ".$order);
					switch($order){
						case 3:
							$labels[] = admin_stats_get_user_url($label);
							break;
						case 4:
							$labels[] = admin_stats_get_module_name($label);
							break;	
						case 5:
							$labels[] = admin_stats_get_url_module($courseid, $label);
							break;
						default:
							$labels[] = $label;
					}
					$values[] = $result->numviews;
			}
			
	 }
	 else if($cmid){
	 	if($action == 0){
				$title = get_string('numviews','block_admin_stats').get_string('course').'('.admin_stats_get_url_module($courseid, $cmid).')';
				$results = admin_stats_views_module($cmid, $startdate, $enddate, $order); 			
			}
			else{
				$title = get_string('timespent','block_admin_stats').get_string('course').'('.admin_stats_get_course_url($courseid).')';
			}
			$labels = array();
			$values = array();
			foreach($results as $result){
					$label = $result->label;
					if($order == 3){
							$labels[] = admin_stats_get_user_url($label);
						}
						else{
							$labels[] = $label;
						}
					$values[] = $result->numviews;
			}
	 }
	 print_object($labels);
	 print_object($values);
	 
	/*
	 if(count($results)>0){		
					$graph = new graph(600, 400);
					$graph->parameter['title'] 			    = $title;
					$graph->x_data           				= $labels;
					$graph->y_data['visits']   				= $values;
					
					$graph->y_order = array('visits');
					
					if ($data->graphtype == 0) {
						$graph->y_format['visits'] 				= array('colour' => 'blue', 'line' => 'line');						
					} else {
						$graph->y_format['visits'] 				= array('colour' => 'blue', 'area' => 'fill');
					}
					
					
					$graph->parameter['outer_background'] 	= 'white';
					$graph->parameter['inner_background'] 	= 'white';
					$graph->parameter['inner_border'] 		= 'gray';
					$graph->parameter['axis_colour'] 		= 'gray';
					$graph->parameter['bar_spacing'] 		= 0;
					$graph->parameter['y_label_left']   	= '';
					$graph->parameter['label_size']		    = '1';
					$graph->parameter['x_axis_angle']		= 90;
					$graph->parameter['x_label_angle']  	= 0;
					$graph->parameter['tick_length'] 		= 0;
					$graph->parameter['shadow']         	= 'none'; 
					error_reporting(5);
					//$graph->draw_stack();					
	}*/
?>
