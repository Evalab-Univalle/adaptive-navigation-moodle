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


$capabilities = array(
				   'block/score_item:view' => array( // navigate by items scores
								'captype' => 'read',
								'contextlevel' => CONTEXT_BLOCK,
								'legacy' => array (
										   'guest' => CAP_PREVENT,
										   'student' => CAP_ALLOW,
										   'teacher' => CAP_ALLOW,
										   'editingteacher' => CAP_ALLOW,
										   'coursecreator' => CAP_ALLOW,
										   'manager' => CAP_ALLOW
										   )
								),
				   'block/score_item:edit' => array( // edit items scores
								     'captype' => 'write',
								     'contextlevel' => CONTEXT_BLOCK,
								     'legacy' => array (
											'guest' => CAP_PREVENT,
											'student' => CAP_PREVENT,
											'teacher' => CAP_ALLOW,
											'editingteacher' => CAP_ALLOW,
											'coursecreator' => CAP_ALLOW,
											'manager' => CAP_ALLOW
											)
								     ),
				   'block/score_item:addinstance' => array( // add block score item
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
				   
