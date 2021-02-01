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
* @package     theme_campus_alternative
* @copyright  2016 Chris Kenniburg
* 
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

// Icon Navigation);
$page = new admin_settingpage('theme_campus_iconnavheading', get_string('iconnavheading',  'theme_campus_alternative'));

// This is the descriptor for icon One
$name =  'theme_campus_alternative/iconwidthinfo';
$heading = get_string('iconwidthinfo',  'theme_campus_alternative');
$information = get_string('iconwidthinfodesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Icon width setting.
$name =  'theme_campus_alternative/iconwidth';
$title = get_string('iconwidth',  'theme_campus_alternative');
$description = get_string('iconwidth_desc',  'theme_campus_alternative');;
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
$name =  'theme_campus_alternative/createinfo';
$heading = get_string('createinfo',  'theme_campus_alternative');
$information = get_string('createinfodesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Creator Icon
$name =  'theme_campus_alternative/createicon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = 'edit';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/createbuttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = get_string('naviconbuttoncreatetextdefault',  'theme_campus_alternative');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/createbuttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default =  $CFG->wwwroot.'/course/edit.php?category=1';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for teacher create a course
$name =  'theme_campus_alternative/sliderinfo';
$heading = get_string('sliderinfo',  'theme_campus_alternative');
$information = get_string('sliderinfodesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Creator Icon
$name =  'theme_campus_alternative/slideicon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('naviconslidedesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/slideiconbuttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Slide Textbox.
$name =  'theme_campus_alternative/slidetextbox';
$title = get_string('slidetextbox',  'theme_campus_alternative');
$description = get_string('slidetextbox_desc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon One
$name =  'theme_campus_alternative/navicon1info';
$heading = get_string('navicon1',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// icon One
$name =  'theme_campus_alternative/nav1icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav1buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = get_string('naviconbutton1textdefault',  'theme_campus_alternative');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav1buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default =  $CFG->wwwroot.'/my/';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav1target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon One
$name =  'theme_campus_alternative/navicon2info';
$heading = get_string('navicon2',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name =  'theme_campus_alternative/nav2icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = 'calendar';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav2buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = get_string('naviconbutton2textdefault',  'theme_campus_alternative');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav2buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default =  $CFG->wwwroot.'/calendar/view.php?view=month';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav2target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon three
$name =  'theme_campus_alternative/navicon3info';
$heading = get_string('navicon3',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name =  'theme_campus_alternative/nav3icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = 'bookmark';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav3buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = get_string('naviconbutton3textdefault',  'theme_campus_alternative');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav3buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default =  $CFG->wwwroot.'/badges/mybadges.php';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav3target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon four
$name =  'theme_campus_alternative/navicon4info';
$heading = get_string('navicon4',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name =  'theme_campus_alternative/nav4icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = 'book';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav4buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = get_string('naviconbutton4textdefault',  'theme_campus_alternative');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav4buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default =  $CFG->wwwroot.'/course/';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav4target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon four
$name =  'theme_campus_alternative/navicon5info';
$heading = get_string('navicon5',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name =  'theme_campus_alternative/nav5icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav5buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav5buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav5target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon six
$name =  'theme_campus_alternative/navicon6info';
$heading = get_string('navicon6',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name =  'theme_campus_alternative/nav6icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav6buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav6buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav6target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon seven
$name =  'theme_campus_alternative/navicon7info';
$heading = get_string('navicon7',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name =  'theme_campus_alternative/nav7icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav7buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav7buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav7target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for icon eight
$name =  'theme_campus_alternative/navicon8info';
$heading = get_string('navicon8',  'theme_campus_alternative');
$information = get_string('navicondesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

$name =  'theme_campus_alternative/nav8icon';
$title = get_string('navicon',  'theme_campus_alternative');
$description = get_string('navicondesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav8buttontext';
$title = get_string('naviconbuttontext',  'theme_campus_alternative');
$description = get_string('naviconbuttontextdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav8buttonurl';
$title = get_string('naviconbuttonurl',  'theme_campus_alternative');
$description = get_string('naviconbuttonurldesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/nav8target';
$title = get_string('marketingurltarget' ,  'theme_campus_alternative');
$description = get_string('marketingurltargetdesc',  'theme_campus_alternative');
$target1 = get_string('marketingurltargetself',  'theme_campus_alternative');
$target2 = get_string('marketingurltargetnew',  'theme_campus_alternative');
$target3 = get_string('marketingurltargetparent',  'theme_campus_alternative');
$default = 'target1';
$choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
