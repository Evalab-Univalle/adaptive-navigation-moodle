<?php
    require_once($CFG->dirroot . '/blocks/navigation/renderer.php');
	require_once($CFG->libdir . '/coursecatlib.php');
	
	class theme_funny_block_navigation_renderer extends block_navigation_renderer {
	
	    protected function navigation_node($items, $attrs=array(), $expansionlimit=null, array $options = array(), $depth=1) {
	        // $items = (array) clone((object) $items);
	        foreach ($items as $key => $col) {
	            $col = $col->children;
	            foreach ($col->get_key_list() as $key) {
	                $item = $col->get($key);
	                if (in_array($item->key, array('currentcourse', 'mycourses', 'courses'))) {
	                    // $col->remove($key);
	                }
	            }
	        }
	        return parent::navigation_node($items, $attrs, $expansionlimit, $options, $depth);
	    }
	
	}
?>