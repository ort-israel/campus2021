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
 * @package    theme_classic_brain
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_classic_brain\output;

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
 * @package    theme_classic_brain
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_classic\output\core_renderer {
    protected $course_bigbrain = 144;

    public function standard_head_html() {
        global $SITE, $PAGE;

        $output = parent::standard_head_html();
        $output .= "<link href='https://fonts.googleapis.com/css2?family=Alef:wght@400;700&display=swap' rel='stylesheet'>\n";
        return $output;
    }

    protected function sitetitle(){
        global $COURSE;
        $html = '';

        /* Tsofiya 2018: navigate to the correct landing page according to course id */
        if($COURSE->id == $this->course_bigbrain ){
            $html .= html_writer::start_tag('a',array('href'=>'http://bigbrain.ort.org.il/', 'class'=>'logo logo-brain'));
        }
        else{
            $html .= html_writer::start_tag('a',array('href'=>'http://brain.ort.org.il/', 'class'=>'logo logo-brain'));
        }

        $html .= html_writer::tag('h1', $COURSE->shortname);
        $html .= html_writer::end_tag('a');
        return $html;
    }

    protected function logos(){
        $html = '';
        $html .= html_writer::link('http://www.ort.org.il/', get_string('ort-israel','theme_classic_brain'), array('class' => 'logo logo-ort'));

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
        $header->sitetitle = $this->sitetitle();
        $header->logos = $this->logos();
        $header->hasnavbar = empty($this->page->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        $header->headeractions = $this->page->get_header_actions();
        $header->login_info = $this->login_info();


        return $this->render_from_template('theme_classic_brain/full_header', $header);
    }

    public function footer_credit(){
        global $OUTPUT;

        $footer = new stdClass();
        $footer->output = $OUTPUT;
        $footer->credittitle = get_string('copyright','theme_classic_brain').' ';
        $footer->ort_link =  html_writer::link('http://www.ort.org.il/', get_string('ort-israel','theme_classic_brain'));

        return $this->render_from_template('theme_classic_brain/footer', $footer);
    }

}
