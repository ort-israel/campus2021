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
 * Presets settings page file.
 *
 * @package    theme_campus
 * @copyright  2016 Chris Kenniburg
 * @credits    theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_campus_presets', get_string('presets_settings', 'theme_campus'));

// Preset files setting.
$name = 'theme_campus/presetfiles';
$title = get_string('presetfiles', 'theme_campus');
$description = get_string('presetfiles_desc', 'theme_campus');

$setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
array('maxfiles' => 20, 'accepted_types' => array('.scss')));
$page->add($setting);


// Layout Info
$name = 'theme_campus/layoutinfo';
$heading = get_string('layoutinfo', 'theme_campus');
$information = get_string('layoutinfodesc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);


// Course Tile Display Styles
$name = 'theme_campus/coursetilestyle';
$title = get_string('coursetilestyle' , 'theme_campus');
$description = get_string('coursetilestyle_desc', 'theme_campus');
$coursestyle1 = get_string('coursestyle1', 'theme_campus');
$coursestyle2 = get_string('coursestyle2', 'theme_campus');
$coursestyle3 = get_string('coursestyle3', 'theme_campus');
$coursestyle4 = get_string('coursestyle4', 'theme_campus');
$coursestyle5 = get_string('coursestyle5', 'theme_campus');
$coursestyle6 = get_string('coursestyle6', 'theme_campus');
$coursestyle7 = get_string('coursestyle7', 'theme_campus');
$coursestyle8 = get_string('coursestyle8', 'theme_campus');
$coursestyle9 = get_string('coursestyle9', 'theme_campus');
$coursestyle10 = get_string('coursestyle10', 'theme_campus');
$default = '10';
$choices = array('1'=>$coursestyle1, '2'=>$coursestyle2, '3'=>$coursestyle3, '4'=>$coursestyle4, '5'=>$coursestyle5, '6'=>$coursestyle6, '7'=>$coursestyle7, '8'=>$coursestyle8, '9'=>$coursestyle9, '10'=>$coursestyle10);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Toggle Marketing Tile styles.
$name = 'theme_campus/marketingstyle';
$title = get_string('marketingstyle' , 'theme_campus');
$description = get_string('marketingstyle_desc', 'theme_campus');
$marketingstyle1 = get_string('marketingstyle1', 'theme_campus');
$marketingstyle2 = get_string('marketingstyle2', 'theme_campus');
$marketingstyle3 = get_string('marketingstyle3', 'theme_campus');
$marketingstyle4 = get_string('marketingstyle4', 'theme_campus');
$default = '3';
$choices = array('1'=>$marketingstyle1, '2'=>$marketingstyle2, '3'=>$marketingstyle3, '4'=>$marketingstyle4);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Block Display Options.
$name = 'theme_campus/blockdisplay';
$title = get_string('blockdisplay' , 'theme_campus');
$description = get_string('blockdisplay_desc', 'theme_campus');
$blockdisplay_on = get_string('blockdisplay_on', 'theme_campus');
$blockdisplay_off = get_string('blockdisplay_off', 'theme_campus');
$default = '1';
$choices = array('1'=>$blockdisplay_on, '2'=>$blockdisplay_off);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Integration Info.
$name = 'theme_campus/integrationinfo';
$heading = get_string('integrationinfo', 'theme_campus');
$information = get_string('integrationinfo_desc', 'theme_campus');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Collapsible Topic Course Format https://moodle.org/plugins/format_collapsibletopics.
$name = 'theme_campus/integrationcollapsibletopics';
$title = get_string('collapsibletopics' , 'theme_campus');
$description = get_string('collapsibletopics_desc', 'theme_campus');
$integration_on = get_string('integrationon', 'theme_campus');
$integration_off = get_string('integrationoff', 'theme_campus');
$default = '2';
$choices = array('1'=>$integration_on, '2'=>$integration_off);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Collapsible Topic Course Format https://moodle.org/plugins/format_collapsibletopics.
$name = 'theme_campus/easyenrollmentintegration';
$title = get_string('easyenrollmentintegration' , 'theme_campus');
$description = get_string('easyenrollmentintegration_desc', 'theme_campus');
$integration_on = get_string('integrationon', 'theme_campus');
$default = '1';
$choices = array('1'=>$integration_on);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/jitsibuttontext';
$title = get_string('jitsibuttontext', 'theme_campus');
$description = get_string('jitsibuttontextdesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_campus/jitsibuttonurl';
$title = get_string('jitsibuttonurl', 'theme_campus');
$description = get_string('jitsibuttonurldesc', 'theme_campus');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);


// Must add the page after definiting all the settings!
$settings->add($page);
