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
* Social networking settings page file.
*
* @package    theme_campus
* @copyright  2016 Chris Kenniburg
* 
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

// Icon Navigation);
$page = new admin_settingpage('theme_campus_iconnavheading', get_string('iconnavheading', 'theme_campus'));

// This is the descriptor for icon One
$name = 'theme_campus/iconwidthinfo';
$heading = get_string('iconwidthinfo', 'theme_campus');
$information = get_string('iconwidthinfodesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Icon width setting.
$name = 'theme_campus/iconwidth';
$title = get_string('iconwidth', 'theme_campus');
$description = get_string('iconwidth_desc', 'theme_campus');;
$default = '100px';
$choices = array(
    '75px' => '75px',
    '85px' => '85px',
    '95px' => '95px',
    '100px' => '100px',
    '105px' => '105px',
    '110px' => '110px',
    '115px' => '115px',
    '120px' => '120px',
    '125px' => '125px',
    '130px' => '130px',
    '135px' => '135px',
    '140px' => '140px',
    '145px' => '145px',
    '150px' => '150px',
);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for teacher create a course
$name = 'theme_campus/createinfo';
$heading = get_string('createinfo', 'theme_campus');
$information = get_string('createinfodesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Creator Icon
$name = 'theme_campus/createicon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = 'edit';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/createbuttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = get_string('naviconbuttoncreatetextdefault', 'theme_campus');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/createbuttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default =  $CFG->wwwroot.'/course/edit.php?category=1';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for teacher create a course
$name = 'theme_campus/sliderinfo';
$heading = get_string('sliderinfo', 'theme_campus');
$information = get_string('sliderinfodesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Creator Icon
$name = 'theme_campus/slideicon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('naviconslidedesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/slideiconbuttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Slide Textbox.
$name = 'theme_campus/slidetextbox';
$title = get_string('slidetextbox', 'theme_campus');
$description = get_string('slidetextbox_desc', 'theme_campus');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon One
$name = 'theme_campus/navicon1info';
$heading = get_string('navicon1', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// icon One
$name = 'theme_campus/nav1icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav1buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = get_string('naviconbutton1textdefault', 'theme_campus');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav1buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default =  $CFG->wwwroot.'/my/';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav1target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon One
$name = 'theme_campus/navicon2info';
$heading = get_string('navicon2', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/nav2icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = 'calendar';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav2buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = get_string('naviconbutton2textdefault', 'theme_campus');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav2buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default =  $CFG->wwwroot.'/calendar/view.php?view=month';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav2target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon three
$name = 'theme_campus/navicon3info';
$heading = get_string('navicon3', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/nav3icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = 'bookmark';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav3buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = get_string('naviconbutton3textdefault', 'theme_campus');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav3buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default =  $CFG->wwwroot.'/badges/mybadges.php';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav3target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon four
$name = 'theme_campus/navicon4info';
$heading = get_string('navicon4', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/nav4icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = 'book';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav4buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = get_string('naviconbutton4textdefault', 'theme_campus');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav4buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default =  $CFG->wwwroot.'/course/';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav4target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon four
$name = 'theme_campus/navicon5info';
$heading = get_string('navicon5', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/nav5icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav5buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav5buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav5target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon six
$name = 'theme_campus/navicon6info';
$heading = get_string('navicon6', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/nav6icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav6buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav6buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav6target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon seven
$name = 'theme_campus/navicon7info';
$heading = get_string('navicon7', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/nav7icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav7buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav7buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav7target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon eight
$name = 'theme_campus/navicon8info';
$heading = get_string('navicon8', 'theme_campus');
$information = get_string('navicondesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name = 'theme_campus/nav8icon';
$title = get_string('navicon', 'theme_campus');
$description = get_string('navicondesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav8buttontext';
$title = get_string('naviconbuttontext', 'theme_campus');
$description = get_string('naviconbuttontextdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav8buttonurl';
$title = get_string('naviconbuttonurl', 'theme_campus');
$description = get_string('naviconbuttonurldesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/nav8target';
$title = get_string('marketingurltarget' , 'theme_campus');
$description = get_string('marketingurltargetdesc', 'theme_campus');
$target1 = get_string('marketingurltargetself', 'theme_campus');
$target2 = get_string('marketingurltargetnew', 'theme_campus');
$target3 = get_string('marketingurltargetparent', 'theme_campus');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
