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
 * Classic Hashmal theme.
 *
 * @package    theme_classic_hashmal
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Top menu settings.
    $name = 'theme_classic_hashmal/topmenu';
    $heading = get_string('topmenu', 'theme_classic_hashmal');
    $information = get_string('topmenudesc', 'theme_classic_hashmal');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    // First item name setting.
    $name = 'theme_classic_hashmal/item1label';
    $title = get_string('item1label', 'theme_classic_hashmal');
    $description = get_string('item1labeldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Second item URL setting.
    $name = 'theme_classic_hashmal/item1url';
    $title = get_string('item1url', 'theme_classic_hashmal');
    $description = get_string('item1urldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Second item name setting.
    $name = 'theme_classic_hashmal/item2label';
    $title = get_string('item2label', 'theme_classic_hashmal');
    $description = get_string('item2labeldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Third item URL setting.
    $name = 'theme_classic_hashmal/item2url';
    $title = get_string('item2url', 'theme_classic_hashmal');
    $description = get_string('item2urldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Third item name setting.
    $name = 'theme_classic_hashmal/item3label';
    $title = get_string('item3label', 'theme_classic_hashmal');
    $description = get_string('item3labeldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Forth item URL setting.
    $name = 'theme_classic_hashmal/item3url';
    $title = get_string('item3url', 'theme_classic_hashmal');
    $description = get_string('item3urldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Forth item name setting.
    $name = 'theme_classic_hashmal/item4label';
    $title = get_string('item4label', 'theme_classic_hashmal');
    $description = get_string('item4labeldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Fifth item URL setting.
    $name = 'theme_classic_hashmal/item4url';
    $title = get_string('item4url', 'theme_classic_hashmal');
    $description = get_string('item4urldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Fifth item name setting.
    $name = 'theme_classic_hashmal/item5label';
    $title = get_string('item5label', 'theme_classic_hashmal');
    $description = get_string('item5labeldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // First item URL setting.
    $name = 'theme_classic_hashmal/item5url';
    $title = get_string('item5url', 'theme_classic_hashmal');
    $description = get_string('item5urldesc', 'theme_classic_hashmal');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

}
