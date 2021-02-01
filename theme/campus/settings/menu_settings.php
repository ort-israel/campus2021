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
 * Heading and course images settings page file.
 *
 * @packagetheme_campus
 * @copyright  2016 Chris Kenniburg
 * @creditstheme_boost - MoodleHQ
 * @licensehttp://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_campus_menusettings', get_string('menusettings', 'theme_campus'));

// This is the descriptor for Course Management Panel
$name = 'theme_campus/coursemanagementinfo';
$heading = get_string('coursemanagementinfo', 'theme_campus');
$information = get_string('coursemanagementinfodesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Show/hide coursemanagement slider toggle.
$name = 'theme_campus/coursemanagementtoggle';
$title = get_string('coursemanagementtoggle', 'theme_campus');
$description = get_string('coursemanagementtoggle_desc', 'theme_campus');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Dashboard Teacher Textbox.
$name = 'theme_campus/coursemanagementtextbox';
$title = get_string('coursemanagementtextbox', 'theme_campus');
$description = get_string('coursemanagementtextbox_desc', 'theme_campus');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Dashboard Student Textbox.
$name = 'theme_campus/studentdashboardtextbox';
$title = get_string('studentdashboardtextbox', 'theme_campus');
$description = get_string('studentdashboardtextbox_desc', 'theme_campus');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Navbar Color switch toggle based on role
$name = 'theme_campus/navbarcolorswitch';
$title = get_string('navbarcolorswitch','theme_campus');
$description = get_string('navbarcolorswitch_desc', 'theme_campus');
$default = '2';
$choices = array(
	'1' => get_string('navbarcolorswitch_on', 'theme_campus'),
	'2' => get_string('navbarcolorswitch_off', 'theme_campus'),
	);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide course editing cog.
$name = 'theme_campus/showactivitynav';
$title = get_string('showactivitynav', 'theme_campus');
$description = get_string('showactivitynav_desc', 'theme_campus');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide course editing cog.
$name = 'theme_campus/courseeditingcog';
$title = get_string('courseeditingcog', 'theme_campus');
$description = get_string('courseeditingcog_desc', 'theme_campus');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide student grades.
$name = 'theme_campus/showstudentgrades';
$title = get_string('showstudentgrades', 'theme_campus');
$description = get_string('showstudentgrades_desc', 'theme_campus');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide student completion.
$name = 'theme_campus/showstudentcompletion';
$title = get_string('showstudentcompletion', 'theme_campus');
$description = get_string('showstudentcompletion_desc', 'theme_campus');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Toggle show only your Group teachers in student course management panel.
$name = 'theme_campus/showonlygroupteachers';
$title = get_string('showonlygroupteachers', 'theme_campus');
$description = get_string('showonlygroupteachers_desc', 'theme_campus');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/hide course settings for students.
$name = 'theme_campus/showcourseadminstudents';
$title = get_string('showcourseadminstudents', 'theme_campus');
$description = get_string('showcourseadminstudents_desc', 'theme_campus');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for course menu
$name = 'theme_campus/mycoursesmenuinfo';
$heading = get_string('mycoursesinfo', 'theme_campus');
$information = get_string('mycoursesinfodesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Toggle courses display in custommenu.
$name = 'theme_campus/displaymycourses';
$title = get_string('displaymycourses', 'theme_campus');
$description = get_string('displaymycoursesdesc', 'theme_campus');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Toggle courses display in custommenu.
$name = 'theme_campus/displaythiscourse';
$title = get_string('displaythiscourse', 'theme_campus');
$description = get_string('displaythiscoursedesc', 'theme_campus');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Set terminology for dropdown course list
$name = 'theme_campus/mycoursetitle';
$title = get_string('mycoursetitle','theme_campus');
$description = get_string('mycoursetitledesc', 'theme_campus');
$default = 'course';
$choices = array(
	'course' => get_string('mycourses', 'theme_campus'),
	'module' => get_string('mymodules', 'theme_campus'),
	'unit' => get_string('myunits', 'theme_campus'),
	'class' => get_string('myclasses', 'theme_campus'),
	'training' => get_string('mytraining', 'theme_campus'),
	'pd' => get_string('myprofessionaldevelopment', 'theme_campus'),
	'cred' => get_string('mycred', 'theme_campus'),
	'plan' => get_string('myplans', 'theme_campus'),
	'comp' => get_string('mycomp', 'theme_campus'),
	'program' => get_string('myprograms', 'theme_campus'),
	'lecture' => get_string('mylectures', 'theme_campus'),
	'lesson' => get_string('mylessons', 'theme_campus'),
	);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//Drawer Menu
// This is the descriptor for nav drawer
$name = 'theme_campus/drawermenuinfo';
$heading = get_string('setting_navdrawersettings', 'theme_campus');
$information = get_string('setting_navdrawersettings_desc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/shownavdrawer';
$title = get_string('shownavdrawer', 'theme_campus');
$description = get_string('shownavdrawer_desc', 'theme_campus');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/shownavclosed';
$title = get_string('shownavclosed', 'theme_campus');
$description = get_string('shownavclosed_desc', 'theme_campus');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);



// Must add the page after definiting all the settings!
$settings->add($page);
