<?php
    

		$capabilities = array(
		
		'block/learning_paths:view' => array(
	        'captype' => 'read',
	        'contextlevel' => CONTEXT_BLOCK,
	        'legacy' => array(
	            'guest' => CAP_PREVENT,
	            'student' => CAP_ALLOW,
	            'user' => CAP_ALLOW,
	            'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'coursecreator' => CAP_ALLOW,
	            'manager' => CAP_ALLOW
	        )
	    ),
	   'block/learning_paths:edit_objective' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	   'block/learning_paths:edit_path' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	    'block/learning_paths:view_items' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	    'block/learning_paths:edit_items' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	    'block/learning_paths:view_users' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	     'block/learning_paths:view_progress_users' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	     'block/learning_paths:edit_users' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	     'block/learning_paths:view_statistics' => array(
	        'riskbitmask' => RISK_SPAM | RISK_XSS,
	 
	        'captype' => 'write',
	        'contextlevel' => CONTEXT_BLOCK,
	        'archetypes' => array(
	        	'teacher' => CAP_ALLOW,
	            'editingteacher' => CAP_ALLOW,
	            'manager' => CAP_ALLOW,
	            ),
	 
	    ),
	    'block/learning_paths:addinstance' => array(
					'riskbitmask' => RISK_SPAM | RISK_XSS,
			 
					'captype' => 'write',
					'contextlevel' => CONTEXT_BLOCK,
					'archetypes' => array(
						'editingteacher' => CAP_ALLOW,
						'manager' => CAP_ALLOW
					),
			 
					'clonepermissionsfrom' => 'moodle/site:manageblocks'
				)
	);
?>
