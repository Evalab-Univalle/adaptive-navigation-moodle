<?php
    require_once("{$CFG->libdir}/formslib.php");
	require_once("lib.php");	
	
	class scoreitem_form extends moodleform {
		
		public function definition() {	
			
			$mform = $this->_form;
			
			// add the radio button for the score
			$radioarray[] =& $mform->createElement('radio', 'score', '','0', 0, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','1', 1, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','2', 2, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','3', 3, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','4', 4, null);
			$radioarray[] =& $mform->createElement('radio', 'score', '','5', 5, null);
			
			$mform->addGroup($radioarray, 'score', 'score', array(' '), false);
			$mform->setDefault('score', 'current');
			
			// comments
			$mform->addElement('textarea', 'comment', get_string("comments", "block_score_item"), 'rows="5" cols="50"');
			$mform->setType('comment', PARAM_TEXT);
			
			$mform->addElement('hidden', 'item_id');
			$mform->addElement('hidden', 'user_id');
			$mform->addElement('hidden', 'module');
			$mform->addElement('hidden', 'id');
			
			$this->add_action_buttons(false);
		}
	}
	
	class learning_styles_form extends moodleform {
    	
    public function definition() {
    	
			$mform = $this->_form;
			
    		$mform->addElement('header', 'learning_styles', get_string('learning_styles', 'block_score_item'));	
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio1', '', 'think it out.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio1', '', 'try it out.', b, null);
			$mform->addGroup($radioarray, '1', 'I understand something better after I', array(' '), false);
			$mform->addRule('1', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio2', '', 'realistic.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio2', '', 'innovative.', b, null);
			$mform->addGroup($radioarray, '2', 'I would rather be considered', array(' '), false);
			$mform->addRule('2', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio3', '', 'pictures.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio3', '', 'words.', b, null);
			$mform->addGroup($radioarray, '3', 'When I think about what I did yesterday, I am most likely to get', array(' '), false);
			$mform->addRule('3', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio4', '', 'understand details of a subject but may be fuzzy about its overall structure.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio4', '', 'understand the overall structure but may be fuzzy about details.', b, null);
			$mform->addGroup($radioarray, '4', 'I tend to', array(' '), false);
			$mform->addRule('4', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio5', '', 'talk about it.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio5', '', 'think about it.', b, null);
			$mform->addGroup($radioarray, '5', 'When I am learning something new, it helps me to', array(' '), false);
			$mform->addRule('5', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio6', '', 'that deals with facts and real life situations.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio6', '', 'that deals with ideas and theories.', b, null);
			$mform->addGroup($radioarray, '6', 'If I were a teacher, I would rather teach a course', array(' '), false);
			$mform->addRule('6', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio7', '', 'pictures, diagrams, graphs, or maps.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio7', '', 'written directions or verbal information.', b, null);
			$mform->addGroup($radioarray, '7', 'I prefer to get new information in', array(' '), false);
			$mform->addRule('7', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio8', '', 'all the parts, I understand the whole thing.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio8', '', 'the whole thing, I see how the parts fit.', b, null);
			$mform->addGroup($radioarray, '8', 'Once I understand', array(' '), false);
			$mform->addRule('8', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio9', '', 'jump in and contribute ideas.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio9', '', 'sit back and listen.', b, null);
			$mform->addGroup($radioarray, '9', 'In a study group working on difficult material, I am more likely to', array(' '), false);
			$mform->addRule('9', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio10', '', 'to learn facts.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio10', '', 'to learn concepts.', b, null);
			$mform->addGroup($radioarray, '10', 'I tend to', array(' '), false);
			$mform->addRule('10', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio11', '', 'look over the pictures and charts carefully.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio11', '', ' focus on the written text.', b, null);
			$mform->addGroup($radioarray, '11', 'In a book with lots of pictures and charts, I am likely to', array(' '), false);
			$mform->addRule('11', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio12', '', 'I usually work my way to the solutions one step at a time.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio12', '', 'I often just see the solutions but then have to struggle to figure out the steps to get to them.', b, null);
			$mform->addGroup($radioarray, '12', 'When I solve math problems', array(' '), false);
			$mform->addRule('12', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio13', '', 'have usually gotten to know many of the students.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio13', '', 'I have rarely gotten to know many of the students.', b, null);
			$mform->addGroup($radioarray, '13', 'In classes I have taken', array(' '), false);
			$mform->addRule('13', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio14', '', 'something that teaches me new facts or tells me how to do something.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio14', '', 'something that gives me new ideas to think about.', b, null);
			$mform->addGroup($radioarray, '14', 'In reading nonfiction, I prefer', array(' '), false);
			$mform->addRule('14', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio15', '', 'who put a lot of diagrams on the board.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio15', '', 'who spend a lot of time explaining.', b, null);
			$mform->addGroup($radioarray, '15', 'I like teachers', array(' '), false);
			$mform->addRule('15', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio16', '', ' I think of the incidents and try to put them together to figure out the themes.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio16', '', ' I just know what the themes are when I finish reading and then I have to go back and find the incidents that demonstrate them.', b, null);
			$mform->addGroup($radioarray, '16', 'When I am analyzing a story or a novel', array(' '), false);
			$mform->addRule('16', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio17', '', 'start working on the solution immediately.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio17', '', 'try to fully understand the problem first.', b, null);
			$mform->addGroup($radioarray, '17', ' I just know what the themes are when I finish reading and then I have to go back and find the incidents that demonstrate them.', array(' '), false);
			$mform->addRule('17', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio18', '', 'all the parts, I understand the whole thing.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio18', '', 'the whole thing, I see how the parts fit.', b, null);
			$mform->addGroup($radioarray, '18', 'Once I understand', array(' '), false);
			$mform->addRule('18', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio19', '', 'certainty.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio19', '', 'theory.', b, null);
			$mform->addGroup($radioarray, '19', 'I prefer the idea of', array(' '), false);
			$mform->addRule('19', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio20', '', ' lay out the material in clear sequential steps.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio20', '', 'give me an overall picture and relate the material to other subjects.', b, null);
			$mform->addGroup($radioarray, '20', 'It is more important to me that an instructor', array(' '), false);
			$mform->addRule('20', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio21', '', 'in a study group.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio21', '', 'alone.', b, null);
			$mform->addGroup($radioarray, '21', 'I prefer to study', array(' '), false);
			$mform->addRule('21', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio22', '', 'careful about the details of my work.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio22', '', 'creative about how to do my work.', b, null);
			$mform->addGroup($radioarray, '22', 'I am more likely to be considered', array(' '), false);
			$mform->addRule('12', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio23', '', 'a map.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio23', '', 'written instructions.', b, null);
			$mform->addGroup($radioarray, '23', 'When I get directions to a new place, I prefer', array(' '), false);
			$mform->addRule('23', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio24', '', 'in fits and starts. I will be totally confused and then suddenly it all "clicks."', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio24', '', 'at a fairly regular pace. If I study hard, I will "get it."', b, null);
			$mform->addGroup($radioarray, '24', 'I learn', array(' '), false);
			$mform->addRule('24', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio25', '', 'try things out.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio25', '', 'think about how I am going to do it.', b, null);
			$mform->addGroup($radioarray, '25', 'I would rather first', array(' '), false);
			$mform->addRule('25', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio26', '', ' clearly say what they mean.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio26', '', ' say things in creative, interesting ways.', b, null);
			$mform->addGroup($radioarray, '26', 'When I am reading for enjoyment, I like writers to', array(' '), false);
			$mform->addRule('26', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio27', '', 'the picture.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio27', '', 'what the instructor said about it.', b, null);
			$mform->addGroup($radioarray, '27', 'When I see a diagram or sketch in class, I am most likely to remember', array(' '), false);
			$mform->addRule('27', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio28', '', 'focus on details and miss the big picture.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio28', '', 'try to understand the big picture before getting into the details.', b, null);
			$mform->addGroup($radioarray, '28', 'When considering a body of information, I am more likely to', array(' '), false);
			$mform->addRule('28', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio29', '', 'something I have done.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio29', '', 'something I have thought a lot about.', b, null);
			$mform->addGroup($radioarray, '29', 'I more easily remember', array(' '), false);
			$mform->addRule('29', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio30', '', ' master one way of doing it.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio30', '', 'come up with new ways of doing it.', b, null);
			$mform->addGroup($radioarray, '30', 'When I have to perform a task, I prefer to', array(' '), false);
			$mform->addRule('30', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio31', '', ' charts or graphs.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio31', '', 'text summarizing the results.', b, null);
			$mform->addGroup($radioarray, '31', 'When someone is showing me data, I prefer', array(' '), false);
			$mform->addRule('31', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio32', '', 'work on (think about or write) the beginning of the paper and progress forward.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio32', '', 'work on (think about or write) different parts of the paper and then order them.', b, null);
			$mform->addGroup($radioarray, '32', 'When writing a paper, I am more likely to', array(' '), false);
			$mform->addRule('32', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio33', '', ' brainstorm individually and then come together as a group to compare ideas.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio33', '', 'have "group brainstorming" where everyone contributes ideas..', b, null);
			$mform->addGroup($radioarray, '33', 'When I have to work on a group project, I first want to', array(' '), false);
			$mform->addRule('33', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio34', '', 'sensible', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio34', '', 'imaginative."', b, null);
			$mform->addGroup($radioarray, '34', 'I consider it higher praise to call someone', array(' '), false);
			$mform->addRule('34', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio35', '', 'what they looked like.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio35', '', 'what they said about themselves.', b, null);
			$mform->addGroup($radioarray, '35', 'When I meet people at a party, I am more likely to remember', array(' '), false);
			$mform->addRule('35', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio36', '', 'stay focused on that subject, learning as much about it as I can.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio36', '', 'try to make connections between that subject and related subjects.', b, null);
			$mform->addGroup($radioarray, '36', 'When I am learning a new subject, I prefer to', array(' '), false);
			$mform->addRule('36', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio37', '', 'outgoing.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio37', '', 'reserved.', b, null);
			$mform->addGroup($radioarray, '37', 'I am more likely to be considered', array(' '), false);
			$mform->addRule('37', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio38', '', 'concrete material (facts, data).', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio38', '', 'abstract material (concepts, theories).', b, null);
			$mform->addGroup($radioarray, '38', 'I prefer courses that emphasize', array(' '), false);
			$mform->addRule('38', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio39', '', 'watch television..', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio39', '', 'read a book.', b, null);
			$mform->addGroup($radioarray, '39', 'For entertainment, I would rather', array(' '), false);
			$mform->addRule('39', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio40', '', ' somewhat helpful to me.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio40', '', 'very helpful to me.', b, null);
			$mform->addGroup($radioarray, '40', 'Some teachers start their lectures with an outline of what they will cover. Such outlines are', array(' '), false);
			$mform->addRule('40', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio41', '', 'appeals to me.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio41', '', 'does not appeal to me.', b, null);
			$mform->addGroup($radioarray, '41', 'The idea of doing homework in groups, with one grade for the entire group,', array(' '), false);
			$mform->addRule('41', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio42', '', 'I tend to repeat all my steps and check my work carefully.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio42', '', 'I find checking my work tiresome and have to force myself to do it.', b, null);
			$mform->addGroup($radioarray, '42', 'When I am doing long calculations,', array(' '), false);
			$mform->addRule('42', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio43', '', 'easily and fairly accurately.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio43', '', 'with difficulty and without much detail.', b, null);
			$mform->addGroup($radioarray, '43', 'I tend to picture places I have been', array(' '), false);
			$mform->addRule('43', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$radioarray = array();
			$radioarray[] =& $mform->createElement('radio', 'radio44', '', 'think of the steps in the solution process.', a, null);
			$radioarray[] =& $mform->createElement('radio', 'radio44', '', 'think of possible consequences or applications of the solution in a wide range of areas.', b, null);
			$mform->addGroup($radioarray, '44', 'When solving problems in a group, I would be more likely to', array(' '), false);
			$mform->addRule('44', get_string('mustselectone','block_score_item'), 'required', null, 'server');
			
			$mform->addElement('hidden', 'id');
			$mform->addElement('hidden', 'user_id');
			$mform->addElement('hidden', 'date');
			
			$this->add_action_buttons();
	}

	}
	class user_sessions_form extends moodleform {
    public function definition() {
    	global $COURSE;
		
        $mform =& $this->_form;
		
		//start date
		/*$coursestart = user_sessions_get_course_startdate($COURSE->id);
		$options = 
		array(
				'startyear'	=> $coursestart->year,
				'startmonth'	=> $coursestart->month,	
				'startday'	=> $coursestart->day,	
		);*/
		$mform->addElement('date_time_selector', 'datestart', get_string('datestart','block_user_sessions'));
		
		// end date
		/*$now = time();
		print_object($now);
		$now = format_time($now);
		print_object($now);
		$options=array(
				'startyear'	=> $now->year,
				'startmonth'	=> $now->month,	
				'startday'	=> $now->day,	
		);*/
		$mform->addElement('date_time_selector', 'datefinish', get_string('datefinish','block_user_sessions'));
		$form->addRule(array ('datestart', 'datefinish'), get_string('StartDateShouldBeBeforeEndDate','block_user_sessions'), 'date_compare', 'lte');
		
		//lista de usuarios
		$userlist = user_sessions_get_users($COURSE->id);
		print_object($userlist);
		$mform->addElement('select', 'user_list', get_string('userlist', 'block_user_sessions'), $userlist);
		$mform->getElement('user_list')->setMultiple(true);
		
		// lista de modulos
		$modules = user_sessions_get_modules();
		$mform->addElement('select', 'modules', get_string('modules', 'block_user_sessions'), $modules);
		$mform->getElement('modules')->setMultiple(true);
		
		$actions = array('view' => get_string('view'),'update' => get_string('update'));
		$mform->addElement('select', 'action', get_string('action', 'block_user_sessions'), $actions);
		
		$this->add_action_buttons();		
	}
	
	public function display_list(){
		global $OUTPUT;
		
		$table = new html_table();
		$table->head = array('Items','Module','Time Elapsed','hits');
		
	}
	
	}
?>
