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
 * @package     theme_campus_alternative
 * @copyright  2016 Chris Kenniburg
 * @credits    theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_campus_presets', get_string('presets_settings',  'theme_campus_alternative'));

// Preset files setting.
$name = 'theme_campus_alternative/presetfiles';
$title = get_string('presetfiles',  'theme_campus_alternative');
$description = get_string('presetfiles_desc',  'theme_campus_alternative');

$setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
array('maxfiles' => 20, 'accepted_types' => array('.scss')));
$page->add($setting);


// Layout Info
$name =  'theme_campus_alternative/layoutinfo';
$heading = get_string('layoutinfo',  'theme_campus_alternative');
$information = get_string('layoutinfodesc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);


// Course Tile Display Styles
$name =  'theme_campus_alternative/coursetilestyle';
$title = get_string('coursetilestyle' ,  'theme_campus_alternative');
$description = get_string('coursetilestyle_desc',  'theme_campus_alternative');
$coursestyle1 = get_string('coursestyle1',  'theme_campus_alternative');
$coursestyle2 = get_string('coursestyle2',  'theme_campus_alternative');
$coursestyle3 = get_string('coursestyle3',  'theme_campus_alternative');
$coursestyle4 = get_string('coursestyle4',  'theme_campus_alternative');
$coursestyle5 = get_string('coursestyle5',  'theme_campus_alternative');
$coursestyle6 = get_string('coursestyle6',  'theme_campus_alternative');
$coursestyle7 = get_string('coursestyle7',  'theme_campus_alternative');
$coursestyle8 = get_string('coursestyle8',  'theme_campus_alternative');
$coursestyle9 = get_string('coursestyle9',  'theme_campus_alternative');
$coursestyle10 = get_string('coursestyle10',  'theme_campus_alternative');
$default = '10';
$choices = array('1'=>$coursestyle1, '2'=>$coursestyle2, '3'=>$coursestyle3, '4'=>$coursestyle4, '5'=>$coursestyle5, '6'=>$coursestyle6, '7'=>$coursestyle7, '8'=>$coursestyle8, '9'=>$coursestyle9, '10'=>$coursestyle10);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Toggle Marketing Tile styles.
$name =  'theme_campus_alternative/marketingstyle';
$title = get_string('marketingstyle' ,  'theme_campus_alternative');
$description = get_string('marketingstyle_desc',  'theme_campus_alternative');
$marketingstyle1 = get_string('marketingstyle1',  'theme_campus_alternative');
$marketingstyle2 = get_string('marketingstyle2',  'theme_campus_alternative');
$marketingstyle3 = get_string('marketingstyle3',  'theme_campus_alternative');
$marketingstyle4 = get_string('marketingstyle4',  'theme_campus_alternative');
$default = '3';
$choices = array('1'=>$marketingstyle1, '2'=>$marketingstyle2, '3'=>$marketingstyle3, '4'=>$marketingstyle4);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Block Display Options.
$name =  'theme_campus_alternative/blockdisplay';
$title = get_string('blockdisplay' ,  'theme_campus_alternative');
$description = get_string('blockdisplay_desc',  'theme_campus_alternative');
$blockdisplay_on = get_string('blockdisplay_on',  'theme_campus_alternative');
$blockdisplay_off = get_string('blockdisplay_off',  'theme_campus_alternative');
$default = '1';
$choices = array('1'=>$blockdisplay_on, '2'=>$blockdisplay_off);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Integration Info.
$name =  'theme_campus_alternative/integrationinfo';
$heading = get_string('integrationinfo',  'theme_campus_alternative');
$information = get_string('integrationinfo_desc',  'theme_campus_alternative');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Collapsible Topic Course Format https://moodle.org/plugins/format_collapsibletopics.
$name =  'theme_campus_alternative/integrationcollapsibletopics';
$title = get_string('collapsibletopics' ,  'theme_campus_alternative');
$description = get_string('collapsibletopics_desc',  'theme_campus_alternative');
$integration_on = get_string('integrationon',  'theme_campus_alternative');
$integration_off = get_string('integrationoff',  'theme_campus_alternative');
$default = '2';
$choices = array('1'=>$integration_on, '2'=>$integration_off);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Collapsible Topic Course Format https://moodle.org/plugins/format_collapsibletopics.
$name =  'theme_campus_alternative/easyenrollmentintegration';
$title = get_string('easyenrollmentintegration' ,  'theme_campus_alternative');
$description = get_string('easyenrollmentintegration_desc',  'theme_campus_alternative');
$integration_on = get_string('integrationon',  'theme_campus_alternative');
$default = '1';
$choices = array('1'=>$integration_on);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/jitsibuttontext';
$title = get_string('jitsibuttontext',  'theme_campus_alternative');
$description = get_string('jitsibuttontextdesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name =  'theme_campus_alternative/jitsibuttonurl';
$title = get_string('jitsibuttonurl',  'theme_campus_alternative');
$description = get_string('jitsibuttonurldesc',  'theme_campus_alternative');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);


// Must add the page after definiting all the settings!
$settings->add($page);
