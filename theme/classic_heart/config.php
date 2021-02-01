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
 * classic heart config.
 *
 * @package   theme_classic_heart
 * @copyright 2018 Bas Brands
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

$THEME->name = 'classic_heart';

$THEME->sheets = [];

$THEME->layouts = [
    // Main course page.
    'course' => array(
        /*'theme' => 'classic_heart',*/
        'file' => 'columns.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true),
    ),
    'coursecategory' => array(
        /*'theme' => 'classic',*/
        'file' => 'columns.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // Part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        /*'theme' => 'classic',*/
        'file' => 'columns.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // The site home page.
    'frontpage' => array(
        /*'theme' => 'classic',*/
        'file' => 'columns.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('nofullheader' => true),
    ),
    // Server administration scripts.
    'admin' => array(
        /*'theme' => 'classic',*/
        'file' => 'columns.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // My dashboard page.
    'mydashboard' => array(
        /*'theme' => 'classic',*/
        'file' => 'columns.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true, 'langmenu' => true, 'nocontextheader' => true),
    ),

];

$THEME->editor_sheets = [];
$THEME->parents = ['boost', 'classic'];
$THEME->enable_dock = false;
//$THEME->extrascsscallback = 'theme_classic_heart_get_extra_scss';
$THEME->prescsscallback = 'theme_classic_heart_get_pre_scss';
//$THEME->precompiledcsscallback = 'theme_classic_heart_get_precompiled_css';
$THEME->yuicssmodules = array();
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->scss = function($theme) {
    return theme_classic_heart_get_main_scss_content($theme);
};
//$THEME->usefallback = true;
//$THEME->iconsystem = '\\theme_classic\\output\\icon_system_fontawesome';
