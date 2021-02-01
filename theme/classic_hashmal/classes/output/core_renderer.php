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
 * Renderers to align Moodle's HTML with that expected by Bootstrap

 *
 * @package    theme_classic_hashmal
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_classic_hashmal\output;

use html_writer;
use stdClass;

defined('MOODLE_INTERNAL') || die;
require_once ($CFG->dirroot . "/course/renderer.php");
/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * Note: This class is required to avoid inheriting Boost's core_renderer,
 *       which removes the edit button required by Classic.
 *
 * @package    theme_classic_hashmal
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_classic\output\core_renderer {

    public function standard_head_html() {
        global $SITE, $PAGE;

        $output = parent::standard_head_html();
        $output .= "<link href='https://fonts.googleapis.com/css2?family=Alef:wght@400;700&display=swap' rel='stylesheet'>\n";
        return $output;
    }

    protected function sitetitle(){
        global $COURSE;
        $html = '';
        $html .= html_writer::tag('h1', get_string('site-title','theme_classic_hashmal'), array('class'=>''));
        return $html;
    }

    protected function logos(){
        global $COURSE;
        $html = '';
        $html .= html_writer::link('http://www.ort.org.il/', get_string('ort-israel','theme_classic_hashmal'), array('class' => 'logo-ort'));

        return $html;
    }

    protected function get_settings_navbar() {
        global $PAGE;

        $num_of_items = 5;
        $settings_items = array();
        // convert to array for easier access
        $settings_arr = (array)$PAGE->theme->settings;

        for ($i = 0; $i < $num_of_items; $i++) {
            $item = new stdClass();
            $item->id = 'item' . ($i + 1);
            $item->label_setting_name = $item->id . 'label';
            $item->url_setting_name = $item->id . 'url';

            // get the label and url
            $item->label_setting_value =
                !empty($settings_arr[$item->label_setting_name]) && !empty($settings_arr[$item->url_setting_name]) ? $settings_arr[$item->label_setting_name] : '';
            $item->url_setting_value =
                !empty($settings_arr[$item->label_setting_name]) && !empty($settings_arr[$item->url_setting_name]) ? $settings_arr[$item->url_setting_name] : '';

            //create an html element if there are values
            if (!empty($item->label_setting_value) && !empty($item->url_setting_value)) {
                $item->link = html_writer::link($item->url_setting_value, $item->label_setting_value);
                array_push($settings_items, $item->link);
            }
        }

        $str = html_writer::alist($settings_items, array('class' => 'links-navigation', 'id' => 'hashmal-links-navigation'));
        return $str;
    }

    public function full_header() {
        global $COURSE;
        if ($this->page->include_region_main_settings_in_header_actions() &&
            !$this->page->blocks->is_block_present('settings')) {
            // Only include the region main settings if the page has requested it and it doesn't already have
            // the settings block on it. The region main settings are included in the settings block and
            // duplicating the content causes behat failures.
            $this->page->add_header_action(html_writer::div(
                $this->region_main_settings_menu(),
                'd-print-none',
                ['id' => 'region-main-settings-menu']
            ));
        }

        $header = new stdClass();
        $header->settingsmenu = $this->context_header_settings_menu();
        $header->contextheader = $this->sitetitle();
        $header->logos = $this->logos();
        $header->links_nav = $this->get_settings_navbar();
        $header->hasnavbar = empty($this->page->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        $header->headeractions = $this->page->get_header_actions();

        return $this->render_from_template('theme_classic_hashmal/full_header', $header);
    }

}
