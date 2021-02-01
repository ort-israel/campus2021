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
 * @package    theme_classic_finance
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_classic_finance\output;

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
 * @package    theme_classic_finance
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_classic\output\core_renderer {

    public function standard_head_html() {
        global $SITE, $PAGE;

        $output = parent::standard_head_html();
        //$output .= "<link href='https://fonts.googleapis.com/css2?family=Alef:wght@400;700&display=swap' rel='stylesheet'>\n";
        return $output;
    }

    protected function sitetitle(){
        global $COURSE;
        $html = '';
        $html .= html_writer::start_tag('h1',array('class'=>'logo'));
        $html .= html_writer::link('http://www.lev.ort.org.il/', get_string('site-title','theme_classic_finance'));
        $html .= html_writer::end_tag('h1');
        return $html;
    }

    protected function logos(){
        global $COURSE;
        $html = '';
        $text = get_string('back-to-catch-cash','theme_classic_finance');
        $new_tab_txt = get_string('new_tab_txt','theme_classic_finance');
        $html .= html_writer::link('http://www.catch-cash.ort.org.il/',
            $text,
            array('class' => 'logo logo-catchcache', 'target' => '_blank','aria-label' => $text.' '.$new_tab_txt));

        $text = get_string('Bank-Hapoalim','theme_classic_finance');
        $html .= html_writer::link('https://www.bankhapoalim.co.il/',
            $text,
            array('class' => 'logo logo-bank', 'target' => '_blank','aria-label' => $text.' '.$new_tab_txt));

        $text = get_string('ort-israel','theme_classic_finance');
        $html .= html_writer::link('http://www.ort.org.il/',
            $text,
            array('class' => 'logo logo-ort', 'target' => '_blank','aria-label' => $text.' '.$new_tab_txt));

        return $html;
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
        $header->contextheader = $this->context_header();
        $header->logos = $this->logos();
        $header->hasnavbar = empty($this->page->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        $header->headeractions = $this->page->get_header_actions();
        $header->user = $this->user_menu();


        return $this->render_from_template('theme_classic_finance/full_header', $header);
    }

}
