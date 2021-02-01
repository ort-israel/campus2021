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
* @credits    theme_boost - MoodleHQ
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

/* Social Network Settings */
$page = new admin_settingpage('theme_campus_footer', get_string('footerheading',  'theme_campus_alternative'));
$page->add(new admin_setting_heading('theme_campus_footer', get_string('footerheadingsub',  'theme_campus_alternative'), format_text(get_string('footerdesc' ,  'theme_campus_alternative'), FORMAT_MARKDOWN)));

// Footnote About setting.
$name =  'theme_campus_alternative/footnote_about';
$title = get_string('footnoteabout',  'theme_campus_alternative');
$description = get_string('footnoteaboutdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);


// Details
$name =  'theme_campus_alternative/details';
$heading = get_string('footerdetails',  'theme_campus_alternative');
$information = get_string('footerdetailsdesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Address
$name =  'theme_campus_alternative/address';
$heading = get_string('footeraddress',  'theme_campus_alternative');
$information = get_string('footeraddressdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $heading, $information, $default);
$page->add($setting);

// R&D support email.
$name =  'theme_campus_alternative/email';
$title = get_string('footeremail',  'theme_campus_alternative');
$description = get_string('footeremaildesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// R&D support phone number.
$name =  'theme_campus_alternative/phone';
$title = get_string('footerphone',  'theme_campus_alternative');
$description = get_string('footerphonedesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//  Tutorials url setting.
$name =  'theme_campus_alternative/tutorials';
$title = get_string('footertutorials',  'theme_campus_alternative');
$description = get_string('footertutorialsdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Facebook url setting.
$name =  'theme_campus_alternative/facebook';
$title = get_string('footerfacebook',  'theme_campus_alternative');
$description = get_string('footerfacebookdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Site rgulation url setting.
$name =  'theme_campus_alternative/siteregulation';
$title = get_string('footersiteregulation',  'theme_campus_alternative');
$description = get_string('footersiteregulationdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
