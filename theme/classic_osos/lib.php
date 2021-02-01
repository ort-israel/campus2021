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
 * Classic OSOS theme callbacks.
 *
 * @package    theme_classic_osos
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string All fixed Sass for this theme.
 */
function theme_classic_osos_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $theme_scss = '';

    $fs = get_file_storage();

    // Main CSS - Get the CSS from theme Classic.
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/classic/pre.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/preset/default.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/classic/post.scss');

    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
    $pre = file_get_contents($CFG->dirroot . '/theme/classic_osos/scss/pre.scss');

    // Theme specific scss before our post.scss
    $theme_scss .= file_get_contents($CFG->dirroot . '/theme/classic_osos/scss/styles.scss');
    $theme_scss .= file_get_contents($CFG->dirroot . '/theme/classic_osos/scss/header.scss');
    $theme_scss .= file_get_contents($CFG->dirroot . '/theme/classic_osos/scss/sidebar.scss');
    $theme_scss .= file_get_contents($CFG->dirroot . '/theme/classic_osos/scss/content.scss');
    $theme_scss .= file_get_contents($CFG->dirroot . '/theme/classic_osos/scss/footer.scss');

    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
    $post = file_get_contents($CFG->dirroot . '/theme/classic_osos/scss/post.scss');

    // Combine them together.
    return $pre . "\n" . $scss . $theme_scss . "\n" . $post;
}
