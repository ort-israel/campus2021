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
* @creditstheme_campus - MoodleHQ
* @licensehttp://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_campus_content', get_string('contentsettings',  'theme_campus_alternative'));
// Content Info
$name =  'theme_campus_alternative/textcontentinfo';
$heading = get_string('textcontentinfo',  'theme_campus_alternative');
$information = get_string('textcontentinfodesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Frontpage Textbox.
$name =  'theme_campus_alternative/fptextbox';
$title = get_string('fptextbox',  'theme_campus_alternative');
$description = get_string('fptextbox_desc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Frontpage Textbox Logged Out.
$name =  'theme_campus_alternative/fptextboxlogout';
$title = get_string('fptextboxlogout',  'theme_campus_alternative');
$description = get_string('fptextboxlogout_desc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Alert setting.
$name =  'theme_campus_alternative/alertbox';
$title = get_string('alert',  'theme_campus_alternative');
$description = get_string('alert_desc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
