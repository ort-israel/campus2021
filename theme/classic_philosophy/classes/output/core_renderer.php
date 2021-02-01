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
 * @package    theme_classic_philosophy
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_classic_philosophy\output;

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
 * @package    theme_classic_philosophy
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
        $course_url = course_get_url($COURSE->id);

        $html .= html_writer::start_tag('a',array('href'=>$course_url->out(), 'class'=>''));
        $html .= html_writer::tag('h1', get_string('site-title','theme_classic_philosophy'));
        $html .= html_writer::end_tag('a');
        return $html;
    }

    protected function logos(){
        global $COURSE;
        $html = '';
        $html .= html_writer::link('https://www.bankhapoalim.co.il/', get_string('hapoalim-bank','theme_classic_philosophy'), array('class' => 'logo logo-poalim'));
        $html .= html_writer::link('http://www.ort.org.il/', get_string('ort-israel','theme_classic_philosophy'), array('class' => 'logo logo-ort'));
        $html .= html_writer::link('http://www.de-nur.com/', get_string('de-nur','theme_classic_philosophy'), array('class' => 'logo logo-denur'));

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
        $header->contextheader = $this->sitetitle();
        $header->logos = $this->logos();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();

        return $this->render_from_template('theme_classic_philosophy/full_header', $header);
    }

    public function footer_credit(){
        global $OUTPUT;

        $links = [];

        /* Campus Link*/
        $ort  = new stdClass();
        $ort->link = html_writer::link('https://campus.ort.org.il/', get_string('main-campus','theme_classic_philosophy'));
        $links[] = $ort;

        /* Site Rules Link*/
        $rules  = new stdClass();
        $rules->link = html_writer::link('https://www.ort.org.il/right/rights/', get_string('site-rules','theme_classic_philosophy'));
        $links[] = $rules;

        $footer = new stdClass();
        $footer->output = $OUTPUT;
        $footer->help_info = $this->page_doc_link();
        $footer->login_info = $this->login_info();
        $footer->links =  $links;

        return $this->render_from_template('theme_classic_philosophy/footer', $footer);
    }

}
