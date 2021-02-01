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
 * Category list block.
 *
 * @package    block_category_list
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

include_once($CFG->dirroot . '/course/lib.php');
include_once($CFG->dirroot . '/blocks/category_list/locallib.php');

class block_category_list extends block_list {
    function init() {
        $this->title = get_string('pluginname', 'block_category_list');
    }

    function has_config() {
        return true;
    }

    function get_content() {
        global $PAGE, $CFG;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $maincatid = (!empty($CFG->block_category_list_catid)) ? $CFG->block_category_list_catid : MAINCATID;
        $categories = \core_course_category::get($maincatid)->get_children(array('sort' => array('idnumber' => 1)));  // idnumber is defined in the editing screen of category
        $chelper = new coursecat_helper();
        // Prepare parameters for courses and categories lists in the tree
        $chelper->set_show_courses(\core_course_renderer::COURSECAT_SHOW_COURSES_COUNT)
            ->set_attributes(array('class' => 'category-browse category-browse-' . $maincatid));

        if ($categories) {   //Check we have categories
            $categories = array_values($categories);
            // Lea 2017 - Use the renderer that creates the sub categories on category screen
            $courserenderer = $PAGE->get_renderer('core', 'course');
            $countcategories = count($categories);
            for ($i = 0; $i < MAXNUMCATEGORIES && $i < $countcategories; $i++) {
                $category = $categories[$i];
                if (method_exists($courserenderer, 'course_category_wrapper_content')) {
                    $this->content->items[] = $courserenderer->course_category_wrapper_content($chelper, $category, 1);
                } else {
                    $this->content->items[] = $this->course_category_wrapper_content($category);
                }
            }
        }

        $this->title = get_string('disciplines', 'block_category_list');
        $this->content->footer .= html_writer::link($CFG->wwwroot . '/course/index.php?categoryid=' . $maincatid, get_string('fulllistofdisciplines', 'block_category_list'), array('class' => 'toslldisciplines campusbutton btn btn-secondary'));

        return $this->content;

    }

    function get_remote_courses() {
        global $CFG, $USER, $OUTPUT;

        if (!is_enabled_auth('mnet')) {
            // no need to query anything remote related
            return;
        }

        // shortcut - the rest is only for logged in users!
        if (!isloggedin() || isguestuser()) {
            return false;
        }

        if ($courses = get_my_remotecourses()) {
            $this->content->items[] = get_string('remotecourses', 'mnet');
            $this->content->icons[] = '';
            foreach ($courses as $course) {
                $this->content->items[] = "<a title=\"" . format_string($course->shortname, true) . "\" " .
                    "href=\"{$CFG->wwwroot}/auth/mnet/jump.php?hostid={$course->hostid}&amp;wantsurl=/course/view.php?id={$course->remoteid}\">"
                    . format_string(get_course_display_name_for_list($course)) . "</a>";
            }
            // if we listed courses, we are done
            return true;
        }

        if ($hosts = get_my_remotehosts()) {
            $this->content->items[] = get_string('remotehosts', 'mnet');
            $this->content->icons[] = '';
            foreach ($USER->mnet_foreign_host_array as $somehost) {
                $this->content->items[] = $somehost['count'] . get_string('courseson', 'mnet') . '<a title="' . $somehost['name'] . '" href="' . $somehost['url'] . '">' . $icon . $somehost['name'] . '</a>';
            }
            // if we listed hosts, done
            return true;
        }

        return false;
    }

    /**
     * Returns the role that best describes the course list block.
     *
     * @return string
     */
    public function get_aria_role() {
        return 'navigation';
    }

    public function course_category_wrapper_content($coursecat, $depth = 1) {
        global $CFG, $PAGE;
        // category name
        $categoryname = html_writer::tag('span', $coursecat->get_formatted_name(), array('class' => 'categoryname'));

        $coursescount = $coursecat->get_courses_count();

        $categoryname .= html_writer::tag('span', ' [' . $coursescount . ']',
            array('title' => get_string('numberofcourses'), 'class' => 'numberofcourse'));
        // Display metadata - IMAGE
        $headerbg = '';
        // check if there is a  dedicated image for this category
        $categoryidnum = $coursecat->idnumber;
        if (!empty($categoryidnum)) {
            $headerbgfile = $CFG->wwwroot . '/blocks/category_list/pix/cat_' . $categoryidnum . '.jpg';
            if (@getimagesize($headerbgfile)) {
                $headerbg = new moodle_url($headerbgfile);
            }
        }
        if (empty($headerbg)) {
            /* If category doesn't have an idnumber, or there isn't an image to correspond the that number, insert default image */
            $headerbg = new moodle_url($CFG->wwwroot . '/blocks/category_list/pix/category_default.jpg');
        }
        $featuredimage = html_writer::img($headerbg, '', array('class' => 'metadata metadatacateimage'));        /* Lea 2017/11 - Comment out metadata until it works*/

        $content = html_writer::link(new moodle_url('/course/index.php',
            array('categoryid' => $coursecat->id)), $featuredimage . $categoryname);

        return $content;
    }


}


