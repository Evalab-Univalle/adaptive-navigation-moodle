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


$string['pluginname'] = 'learning_paths';

//help buttons
$string['why_set_the_title'] = 'Why you might want to set the block instance title?';
$string['why_set_the_title_help'] = '
<p>There can be multiple instances of the Progress Bar block. You may use different Progress Bar blocks to monitor different sets of activities or resources. For instance you could track progress in assignments in one block and quizzes in another. For this reason you can override the default title and set a more appropriate block title for each instance.</p>
';
$string['why_use_icons'] = 'Why you might want to use icons?';
$string['why_use_icons_help'] = '
<p>You may wish to add tick and cross icons in the Progress Bar to make this block more visually accessible for students with colour-blindness.</p>
<p>It may also make the meaning of the block clearer if you believe colours are not intuitive, either for cultural or personal reasons.</p>
';
$string['why_display_now'] = 'Why you might want to hide/show the NOW indicator?';
$string['why_display_now_help'] = '
<p>Not all course are focussed on completion of tasks by specific times. Some courses may have an open-enrolment, allowing students to enrol and complete when they can.</p>
<p>To use the Progress Bar as a tool in such courses, create "Expected by" dates in the far-future and set the "Use NOW" setting to No.</p>
';
$string['what_does_monitored_mean'] = 'What monitored means?';
$string['what_does_monitored_mean_help'] = '
<p>The purpose of this block is to encourage students to manage their time effectively. Each student can monitor their progress in completing the activities and resources you have created.</p>
<p>On the configuration page you will see a list of all the modules that you have created which can be monitored by the Progress Bar block. Modules will only be monitored and appear as a small square in the progress bar if you select Yes to monitor the module.</p>
';
$string['what_locked_means'] = 'What locked to deadline means?';
$string['what_locked_means_help'] = '
<p>Where an activity can, in its own settings, have a deadline, and a deadline is set, it is optional to use the deadline of the activity, or to set another separate time used for the activity in the Progress Bar.</p>
<p>To lock the Progress Bar to an activity\'s deadline it must have a deadline enabled and set. If the deadline is locked, changing the deadline in the activity\'s settings will automatically change the time associated with the activity in the Progress Bar.</p>
<p>When an activity is not locked to a deadline of the activity, changing the date and time in the Progress Bar settings will not affect the deadline of the activity.</p>
';
$string['what_expected_by_means'] = 'What expected by means?';
$string['what_expected_by_means_help'] = '
<p>The <em>Expected by</em> date-time is when the related activity/resource is expected to be completed (viewed, submitted, posted-to, etc...).</p>
<p>If there is already a deadline associated with an activity, like an assignment deadline, this deadline can be used as the expected time for the event as long as the "Locked to Deadline" checkbox is checked. By deselecting locking an independent expected time can be created, and altering this will not affect the actual deadline of the activity.</p>
<p>When you first visit the configuration page for the Progress Bar, or if you create a new activity/resource and return to the configuration page, a guess will be made about the expected date-time for the activity/resource.
<ul>
    <li>For an activity with an existing deadline, this deadline will used.</li>
    <li>When there is no activity deadline, but the course format used is a weekly format, the end of the week (just before midnight Sunday) is assumed.</li>
    <li>For an activity/resource not used in a weekly course format, the end of the current week (just before midnight next Sunday) is used.</li>
</ul>
</p>
<p>Once an expected date-time is set, it is independent of any deadline or other information for that activity/resource.</p>
';
$string['what_actions_can_be_monitored'] = 'What actions can be monitored?';
$string['what_actions_can_be_monitored_help'] = '
<p>Different activities and resources can be monitored.</p>
<p>Because different activities and resources are used differently, what is monitored for each module varies. For example, for assignments, submission can be monitored; quizzes can be monitored on attempt; forums can be monitored for student postings; choice activities can monitored for answering and viewing resources is monitored.</p>
<p>For the assignment and quiz modules, the notion of passed relies on a "Grade to pass" being set for the grade item in the Gradebook. <a href="http://docs.moodle.org/en/Grade_items#Activity-based_grade_items" target="_blank">More help...</a></p>
';
$string['why_show_precentage'] = 'Why show a progress percentage to students?';
$string['why_show_precentage_help'] = '
<p>It is possible to show an overall percentage of progress to students.</p>
<p>This is calculated as the number of items complete divided by the total number of items in the bar.</p>
<p>The progress percentage appears until the student mouses over an item in the bar.</p>
';
$string['how_ordering_works'] = 'How ordering works';
$string['how_ordering_works_help'] = '<p>
There are two ways items in the Progress Bar can be ordered.</p>
<ul>
    <li><em>"Expected by" date-time</em> (default)<br />
    The due dates or manually set dates of activities/resources are used to order items shown in the Progress Bar.
    </li>
    <li><em>Ordering in course</em><br />
    Activities/resources are presented in the same order as they are on the course page. When this option is used, time-related aspects are disabled.
    </li>
</ul>';

$string['objective'] = 'Objective';
$string['learning_objective'] = 'Learning Objective';
$string['learningobjective'] = 'Learning Objectives';
$string['path'] = 'Learning Path';
$string['learningpath'] = 'Learning Path';
$string['pathname'] = 'Path Name';
$string['pathitems'] = 'Path Items';
$string['learningpathitems'] = 'Path Items';
$string['pathurserenrollments'] = 'Path User Enrrollments';
$string['report'] = 'Report';
$string['progress'] = 'Progress';
$string['learning_paths'] = 'Learning Paths';
$string['desc'] = 'Description';


//Lista

$string['number'] = 'Number';
$string['numberstudentsenrrolled'] = 'Numeber Students Enrrolled';

//Formularios
$string['addItem'] = 'Add Item';
$string['deadlineexpected'] = 'Deadline Expected';
$string['config_header_action'] = 'Action';
$string['viewed'] = 'Viewed';
$string['submitted'] = 'Submitted';
$string['marked'] = 'Marked';
$string['finished'] = 'Finished';
$string['weight'] = 'Weight';
$string['enrolluser'] = 'Enroll User';

//Felder Silverman Test
$string['question37'] = 'I am more likely to be considered';

$string['answer37a'] = 'outgoing';
$string['answer37b'] = 'reserved';

$string['question1'] = 'I understand something better after I';
$string['answer1a'] = 'try it out';
$string['answer1b'] = 'think it through';

$string['question13'] = 'In classes I have taken';
$string['answer13a'] = 'I have usually gotten to know many of the students';
$string['answer13b'] = 'I have rarely gotten to know many of the students';

$string['question25'] = 'I understand something better after I ';
$string['answer25a'] = 'try it out';
$string['answer25b'] = 'think it through';

$string['question21'] = 'I prefer to study';
$string['answer21a'] = 'in a study group';
$string['answer21b'] = 'alone';




$string['question6'] = 'If I were a teacher, I would rather teach a course ';
$string['answer6a'] = 'that deals with facts and real life situations';
$string['answer6b'] = 'that deals with ideas and theories';

$string['question38'] = 'I prefer courses that emphasize ';
$string['answer38a'] = 'concrete material';
$string['answer38b'] = 'abstract material (concepts, theories)';

$string['question18'] = 'I prefer the idea of .';
$string['answer18a'] = 'certainty';
$string['answer18b'] = 'theory';

$string['question10'] = 'I find it easier';
$string['answer18a'] = 'to learn facts';
$string['answer18b'] = 'to learn concepts';

$string['question2'] = 'I would rather be considered';
$string['answer18a'] = 'realistic';
$string['answer18b'] = 'innovative';



$string['question31'] = 'When someone is showing me data, I prefer ';
$string['answer18a'] = 'charts or graphs';
$string['answer18b'] = 'text summarizing the results';

$string['question38'] = 'In a book with lots of pictures and charts, I am likely to ';
$string['answer18a'] = 'look over the pictures and charts carefully';
$string['answer18b'] = 'focus on the written text';

$string['question7'] = 'I prefer to get new information in ';
$string['answer18a'] = 'pictures, diagrams, graphs, or maps';
$string['answer18b'] = 'written directions or verbal information';

$string['question19'] = 'I remember best ';
$string['answer18a'] = 'what I see';
$string['answer18b'] = 'what I hear';

$string['question3'] = 'When I think about what I did yesterday, I am most likely to get ';
$string['answer18a'] = 'picture';
$string['answer18b'] = 'words';




$string['question36'] = 'When I am learning a new subject, I prefer to';
$string['answer36a'] = 'picture';
$string['answer36b'] = 'words';

$string['question20'] = 'It is more important to me that an instructor';
$string['answer20a'] = 'lay out the material in clear sequential steps';
$string['answer20b'] = 'give me an overall picture and relate the material to other subjects';

$string['question8'] = 'Once I understand';
$string['answer18a'] = 'all the parts, I understand the whole thing';
$string['answer18b'] = 'he whole thing, I see how the parts fit';

$string['question44'] = 'When solving problems in a group, I would be more likely to';
$string['answer44a'] = 'I tend to';
$string['answer44b'] = 'I tend to';

$string['question4'] = 'I tend to';
$string['answer4a'] = 'understand details of a subject but may be fuzzy about its overall structure';
$string['answer4b'] = 'understand the overall structure but may be fuzzy about details.';


?>
