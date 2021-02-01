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
* @credits    theme_boost - MoodleHQ
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

/* Social Network Settings */
$page = new admin_settingpage('theme_campus_footer', get_string('footerheading', 'theme_campus'));
$page->add(new admin_setting_heading('theme_campus_footer', get_string('footerheadingsub', 'theme_campus'), format_text(get_string('footerdesc' , 'theme_campus'), FORMAT_MARKDOWN)));

// Footnote About setting.
$name = 'theme_campus/footnote_about';
$title = get_string('footnoteabout', 'theme_campus');
$description = get_string('footnoteaboutdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);


// Details
$name = 'theme_campus/details';
$heading = get_string('footerdetails', 'theme_campus');
$information = get_string('footerdetailsdesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Address
$name = 'theme_campus/address';
$heading = get_string('footeraddress', 'theme_campus');
$information = get_string('footeraddressdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $heading, $information, $default);
$page->add($setting);

// R&D support email.
$name = 'theme_campus/email';
$title = get_string('footeremail', 'theme_campus');
$description = get_string('footeremaildesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// R&D support phone number.
$name = 'theme_campus/phone';
$title = get_string('footerphone', 'theme_campus');
$description = get_string('footerphonedesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//  Tutorials url setting.
$name = 'theme_campus/tutorials';
$title = get_string('footertutorials', 'theme_campus');
$description = get_string('footertutorialsdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Facebook url setting.
$name = 'theme_campus/facebook';
$title = get_string('footerfacebook', 'theme_campus');
$description = get_string('footerfacebookdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Site rgulation url setting.
$name = 'theme_campus/siteregulation';
$title = get_string('footersiteregulation', 'theme_campus');
$description = get_string('footersiteregulationdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
