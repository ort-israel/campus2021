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
namespace theme_bediukcity\output;

use context_course;
use custom_menu;
use html_writer;
use moodle_url;
use navigation_node;
use stdClass;
use theme_config;

defined('MOODLE_INTERNAL') || die;
require_once($CFG->dirroot . "/course/renderer.php");

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package     theme_bediukcity
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_boost\output\core_renderer {

    public function standard_head_html() {
        global $SITE, $PAGE;

        $output = parent::standard_head_html();
        $output .= "<link href=\"https://fonts.googleapis.com/css?family=Assistant:400,700,800&amp;subset=hebrew\" rel=\"stylesheet\">\n";
        return $output;
    }

    public function full_header() {
        global $PAGE, $COURSE, $course, $OUTPUT;
        $theme = theme_config::load('bediukcity');
        $header = new stdClass();
        $header->headerimagelocation = false;

        $header->settingsmenu = $this->context_header_settings_menu();

        $header->contextheader = html_writer::link(new moodle_url('/course/view.php', array(
            'id' => $PAGE->course->id
        )), $this->context_header());
        $header->hasnavbar = empty($PAGE->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        $header->headeractions = $this->page->get_header_actions();

        return $this->render_from_template('theme_bediukcity/header', $header);
    }

    /**
     * Override to inject the header titles.
     *
     * @param array $headerinfo The header info.
     * @param int $headinglevel What level the 'h' tag will be.
     * @return string HTML for the header bar.
     */
    public function context_header($headerinfo = null, $headinglevel = 1) {
        global $CFG, $COURSE;

        $logo = $this->get_image_from_area_files('logo');

        if (empty($logo)) {
            $logo = new moodle_url($CFG->wwwroot . '/theme/bediukcity/pix/logo.png');
        }

        $sitename = format_string($COURSE->fullname, true);
        $ret = html_writer::img($logo, $sitename, array('class' => 'logo'));

        return $ret;
    }

    public function image_url($imagename, $component = 'moodle') {
        // Strip -24, -64, -256  etc from the end of filetype icons so we
        // only need to provide one SVG, see MDL-47082.
        $imagename = \preg_replace('/-\d\d\d?$/', '', $imagename);
        return $this->page->theme->image_url($imagename, $component);
    }

    /**
     * Add role to body class
     * @return string
     * @throws \coding_exception
     */
    public function header() {
        global $COURSE;
        $course = $this->page->course;
        $coursecontext = context_course::instance($course->id);
        if (is_siteadmin()) {
            $this->page->add_body_class('courserole-admin');
        }
        /* code taken from: https://moodle.org/mod/forum/discuss.php?d=362674#p1462631*/
        if ($roles = get_user_roles($coursecontext)) {
            foreach ($roles as $role) {
                $this->page->add_body_class('courserole-' . $role->shortname);
            }
        } else {
            if (count($roles) === 0 && !is_guest($coursecontext) && !is_siteadmin() && $COURSE->category > 0) {
                $this->page->add_body_class('courserole-none');
            }

        }
        return parent::header();

    }

    public function headerimage() {
        global $CFG, $PAGE, $OUTPUT;
        // Get course overview files.
        if (empty($CFG->courseoverviewfileslimit)) {
            return '';
        }
        require_once($CFG->libdir . '/filestorage/file_storage.php');
        require_once($CFG->dirroot . '/course/lib.php');

        // Get course overview files as images - set $courseimage.
        $courseimage = $this->get_image_from_area_files('cover');

        $headerbg = $PAGE->theme->setting_file_url('headerdefaultimage', 'headerdefaultimage');
        $headerbgimgurl = $PAGE->theme->setting_file_url('headerdefaultimage', 'headerdefaultimage', true);
        $defaultimgurl = $OUTPUT->image_url('headerbg', 'theme');
        // Create html for header.
        $html = html_writer::start_div('headerbkg');
        // If course image display it in separate div to allow css styling of inline style.
        if ($courseimage) {
            $html .= html_writer::start_div('withimage', array(
                'style' => 'background-image: url("' . $courseimage . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'
            ));
            $html .= html_writer::end_div(); // End withimage inline style div.

        } else if (!$courseimage && isset($headerbg)) {
            $html .= html_writer::start_div('customimage', array(
                'style' => 'background-image: url("' . $headerbgimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'
            ));
            $html .= html_writer::end_div(); // End withoutimage inline style div.

        } else if ($courseimage && isset($headerbg) && !theme_bediukcity_get_setting('showcourseheaderimage')) {
            $html .= html_writer::start_div('customimage', array(
                'style' => 'background-image: url("' . $headerbgimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'
            ));
            $html .= html_writer::end_div(); // End withoutimage inline style div.

        } else if (!$courseimage && isset($headerbg) && !theme_bediukcity_get_setting('showcourseheaderimage')) {
            $html .= html_writer::start_div('customimage', array(
                'style' => 'background-image: url("' . $headerbgimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'
            ));
            $html .= html_writer::end_div(); // End withoutimage inline style div.

        } else {
            $html .= html_writer::start_div('default', array(
                'style' => 'background-image: url("' . $defaultimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'
            ));
            $html .= html_writer::end_div(); // End default inline style div.

        }
        $html .= html_writer::end_div();
        return $html;
    }


    public function get_generated_image_for_id($id) {
        // See if user uploaded a custom header background to the theme.
        $headerbg = $this->page->theme->setting_file_url('headerdefaultimage', 'headerdefaultimage');
        if (isset($headerbg)) {
            return $headerbg;
        } else {
            // Use the default theme image when no course image is detected.
            return $this->image_url('noimg', 'theme')->out();
        }
    }

    public function edit_button(moodle_url $url) {
        return '';
    }

    public function edit_button_fhs() {
        global $SITE, $PAGE, $USER, $CFG, $COURSE;
        if (!$PAGE->user_allowed_editing() || $COURSE->id <= 1) {
            return '';
        }
        if ($PAGE->pagelayout == 'course') {
            $url = new moodle_url($PAGE->url);
            $url->param('sesskey', sesskey());
            if ($PAGE->user_is_editing()) {
                $url->param('edit', 'off');
                $btn = 'btn-danger editingbutton';
                $title = get_string('editoff', 'theme_campus');
                $icon = 'fa-power-off';
            } else {
                $url->param('edit', 'on');
                $btn = 'btn-success editingbutton';
                $title = get_string('editon', 'theme_campus');
                $icon = 'fa-edit';
            }
            return html_writer::tag('a', html_writer::start_tag('i', array(
                    'class' => $icon . ' fa fa-fw'
                )) . html_writer::end_tag('i'), array(
                'href' => $url,
                'class' => 'btn edit-btn ' . $btn,
                'data-tooltip' => "tooltip",
                'data-placement' => "bottom",
                'title' => $title,
            ));
            return $output;
        }
    }


    /**
     * Generates an array of sections and an array of activities for the given course.
     *
     * This method uses the cache to improve performance and avoid the get_fast_modinfo call
     *
     * @param stdClass $course
     * @return array Array($sections, $activities)
     */
    protected function generate_sections_and_activities(stdClass $course) {
        global $CFG;
        require_once($CFG->dirroot . '/course/lib.php');
        $modinfo = get_fast_modinfo($course);
        $sections = $modinfo->get_section_info_all();
        // For course formats using 'numsections' trim the sections list
        $courseformatoptions = course_get_format($course)->get_format_options();
        if (isset($courseformatoptions['numsections'])) {
            $sections = array_slice($sections, 0, $courseformatoptions['numsections'] + 1, true);
        }
        $activities = array();
        foreach ($sections as $key => $section) {
            // Clone and unset summary to prevent $SESSION bloat (MDL-31802).
            $sections[$key] = clone($section);
            unset($sections[$key]->summary);
            $sections[$key]->hasactivites = false;
            if (!array_key_exists($section->section, $modinfo->sections)) {
                continue;
            }
            foreach ($modinfo->sections[$section->section] as $cmid) {
                $cm = $modinfo->cms[$cmid];
                $activity = new stdClass;
                $activity->id = $cm->id;
                $activity->course = $course->id;
                $activity->section = $section->section;
                $activity->name = $cm->name;
                $activity->icon = $cm->icon;
                $activity->iconcomponent = $cm->iconcomponent;
                $activity->hidden = (!$cm->visible);
                $activity->modname = $cm->modname;
                $activity->nodetype = navigation_node::NODETYPE_LEAF;
                $activity->onclick = $cm->onclick;
                $url = $cm->url;
                if (!$url) {
                    $activity->url = null;
                    $activity->display = false;
                } else {
                    $activity->url = $url->out();
                    $activity->display = $cm->is_visible_on_course_page() ? true : false;
                }
                $activities[$cmid] = $activity;
                if ($activity->display) {
                    $sections[$key]->hasactivites = true;
                }
            }
        }
        return array(
            $sections,
            $activities
        );
    }

    protected static function timeaccesscompare($a, $b) {
        // Timeaccess is lastaccess entry and timestart an enrol entry.
        if ((!empty($a->timeaccess)) && (!empty($b->timeaccess))) {
            // Both last access.
            if ($a->timeaccess == $b->timeaccess) {
                return 0;
            }
            return ($a->timeaccess > $b->timeaccess) ? -1 : 1;
        } else if ((!empty($a->timestart)) && (!empty($b->timestart))) {
            // Both enrol.
            if ($a->timestart == $b->timestart) {
                return 0;
            }
            return ($a->timestart > $b->timestart) ? -1 : 1;
        }
        // Must be comparing an enrol with a last access.
        // -1 is to say that 'a' comes before 'b'.
        if (!empty($a->timestart)) {
            // 'a' is the enrol entry.
            return -1;
        }
        // 'b' must be the enrol entry.
        return 1;
    }

    public function fordson_custom_menu() {
        global $CFG, $COURSE, $PAGE, $OUTPUT;
        $context = $this->page->context;
        $menu = new custom_menu();
        $hasdisplaymycourses = (empty($this->page->theme->settings->displaymycourses)) ? false : $this->page->theme->settings->displaymycourses;
        if (isloggedin() && !isguestuser() && $hasdisplaymycourses) {
            $mycoursetitle = $this->page->theme->settings->mycoursetitle;
            if ($mycoursetitle == 'module') {
                $branchtitle = get_string('mymodules', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismymodules', 'theme_bediukcity');
                $homebranchtitle = get_string('homemymodules', 'theme_bediukcity');
            } else if ($mycoursetitle == 'unit') {
                $branchtitle = get_string('myunits', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismyunits', 'theme_bediukcity');
                $homebranchtitle = get_string('homemyunits', 'theme_bediukcity');
            } else if ($mycoursetitle == 'class') {
                $branchtitle = get_string('myclasses', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismyclasses', 'theme_bediukcity');
                $homebranchtitle = get_string('homemyclasses', 'theme_bediukcity');
            } else if ($mycoursetitle == 'training') {
                $branchtitle = get_string('mytraining', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismytraining', 'theme_bediukcity');
                $homebranchtitle = get_string('homemytraining', 'theme_bediukcity');
            } else if ($mycoursetitle == 'pd') {
                $branchtitle = get_string('myprofessionaldevelopment', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismyprofessionaldevelopment', 'theme_bediukcity');
                $homebranchtitle = get_string('homemyprofessionaldevelopment', 'theme_bediukcity');
            } else if ($mycoursetitle == 'cred') {
                $branchtitle = get_string('mycred', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismycred', 'theme_bediukcity');
                $homebranchtitle = get_string('homemycred', 'theme_bediukcity');
            } else if ($mycoursetitle == 'plan') {
                $branchtitle = get_string('myplans', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismyplans', 'theme_bediukcity');
                $homebranchtitle = get_string('homemyplans', 'theme_bediukcity');
            } else if ($mycoursetitle == 'comp') {
                $branchtitle = get_string('mycomp', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismycomp', 'theme_bediukcity');
                $homebranchtitle = get_string('homemycomp', 'theme_bediukcity');
            } else if ($mycoursetitle == 'program') {
                $branchtitle = get_string('myprograms', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismyprograms', 'theme_bediukcity');
                $homebranchtitle = get_string('homemyprograms', 'theme_bediukcity');
            } else if ($mycoursetitle == 'lecture') {
                $branchtitle = get_string('mylectures', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismylectures', 'theme_bediukcity');
                $homebranchtitle = get_string('homemylectures', 'theme_bediukcity');
            } else if ($mycoursetitle == 'lesson') {
                $branchtitle = get_string('mylessons', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismylessons', 'theme_bediukcity');
                $homebranchtitle = get_string('homemylessons', 'theme_bediukcity');
            } else {
                $branchtitle = get_string('mycourses', 'theme_bediukcity');
                $thisbranchtitle = get_string('thismycourses', 'theme_bediukcity');
                $homebranchtitle = get_string('homemycourses', 'theme_bediukcity');
            }

            $branchlabel = $branchtitle;
            $branchurl = new moodle_url('/my/index.php');
            $branchsort = 10000;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
            $dashlabel = get_string('mymoodle', 'my');
            $dashurl = new moodle_url("/my");
            $dashtitle = $dashlabel;
            $branch->add($dashlabel, $dashurl, $dashtitle);

            if ($courses = enrol_get_my_courses(NULL, 'fullname ASC')) {
                $courses = enrol_get_my_courses(null, 'sortorder ASC');
                $nomycourses = '<div class="alert alert-info alert-block">' . get_string('nomycourses', 'theme_bediukcity') . '</div>';
                if ($courses) {
                    // We have something to work with.  Get the last accessed information for the user and populate.
                    global $DB, $USER;
                    $lastaccess = $DB->get_records('user_lastaccess', array('userid' => $USER->id), '', 'courseid, timeaccess');
                    if ($lastaccess) {
                        foreach ($courses as $course) {
                            if (!empty($lastaccess[$course->id])) {
                                $course->timeaccess = $lastaccess[$course->id]->timeaccess;
                            }
                        }
                    }

                    uasort($courses, array($this, 'timeaccesscompare'));
                } else {
                    return $nomycourses;
                }
                $sortorder = $lastaccess;

                foreach ($courses as $course) {
                    if ($course->visible) {
                        $branch->add(format_string($course->fullname), new moodle_url('/course/view.php?id=' . $course->id), format_string($course->shortname));
                    }
                }
            } else {
                $noenrolments = get_string('noenrolments', 'theme_bediukcity');
                $branch->add('<em>' . $noenrolments . '</em>', new moodle_url('/'), $noenrolments);
            }

            $hasdisplaythiscourse = (empty($this->page->theme->settings->displaythiscourse)) ? false : $this->page->theme->settings->displaythiscourse;
            $sections = $this->generate_sections_and_activities($COURSE);
            if ($sections && $COURSE->id > 1 && $hasdisplaythiscourse) {
                $branchlabel = $thisbranchtitle;
                $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
                $course = course_get_format($COURSE)->get_course();
                $coursehomelabel = $homebranchtitle;
                $coursehomeurl = new moodle_url('/course/view.php?', array(
                    'id' => $PAGE->course->id
                ));
                $coursehometitle = $coursehomelabel;
                $branch->add($coursehomelabel, $coursehomeurl, $coursehometitle);
                $callabel = get_string('calendar', 'calendar');
                $calurl = new moodle_url('/calendar/view.php?view=month', array(
                    'course' => $PAGE->course->id
                ));
                $caltitle = $callabel;
                $branch->add($callabel, $calurl, $caltitle);
                $participantlabel = get_string('participants', 'moodle');
                $participanturl = new moodle_url('/user/index.php', array(
                    'id' => $PAGE->course->id
                ));
                $participanttitle = $participantlabel;
                $branch->add($participantlabel, $participanturl, $participanttitle);
                if ($CFG->enablebadges == 1) {
                    $badgelabel = get_string('badges', 'badges');
                    $badgeurl = new moodle_url('/badges/view.php?type=2', array(
                        'id' => $PAGE->course->id
                    ));
                    $badgetitle = $badgelabel;
                    $branch->add($badgelabel, $badgeurl, $badgetitle);
                }
                if (get_config('core_competency', 'enabled')) {
                    $complabel = get_string('competencies', 'competency');
                    $compurl = new moodle_url('/admin/tool/lp/coursecompetencies.php', array(
                        'courseid' => $PAGE->course->id
                    ));
                    $comptitle = $complabel;
                    $branch->add($complabel, $compurl, $comptitle);
                }
                foreach ($sections[0] as $sectionid => $section) {
                    $sectionname = get_section_name($COURSE, $section);
                    if (isset($course->coursedisplay) && $course->coursedisplay == COURSE_DISPLAY_MULTIPAGE) {
                        $sectionurl = '/course/view.php?id=' . $COURSE->id . '&section=' . $sectionid;
                    } else {
                        $sectionurl = '/course/view.php?id=' . $COURSE->id . '#section-' . $sectionid;
                    }
                    $branch->add(format_string($sectionname), new moodle_url($sectionurl), format_string($sectionname));
                }
            }
        }
        $content = '';
        foreach ($menu->get_children() as $item) {
            $context = $item->export_for_template($this);
            $content .= $this->render_from_template('core/custom_menu_item', $context);
        }
        return $content;
    }

    protected function render_courseactivities_menu(custom_menu $menu) {
        global $CFG;
        $content = '';
        foreach ($menu->get_children() as $item) {
            $context = $item->export_for_template($this);
            $content .= $this->render_from_template('theme_bediukcity/activitygroups', $context);
        }
        return $content;
    }

    public function courseactivities_menu() {
        global $PAGE, $COURSE, $OUTPUT, $CFG;
        $menu = new custom_menu();
        $context = $this->page->context;
        if (isset($COURSE->id) && $COURSE->id > 1) {
            $branchtitle = get_string('courseactivities', 'theme_bediukcity');
            $branchlabel = $branchtitle;
            $branchurl = new moodle_url('#');
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, 10002);
            $data = theme_bediukcity_get_course_activities();
            foreach ($data as $modname => $modfullname) {
                if ($modname === 'resources') {
                    $branch->add($modfullname, new moodle_url('/course/resources.php', array(
                        'id' => $PAGE->course->id
                    )));
                } else {
                    $branch->add($modfullname, new moodle_url('/mod/' . $modname . '/index.php', array(
                        'id' => $PAGE->course->id
                    )));
                }
            }
        }
        return $this->render_courseactivities_menu($menu);
    }

    public function social_icons() {
        global $PAGE;
        $hasfacebook = (empty($PAGE->theme->settings->facebook)) ? false : $PAGE->theme->settings->facebook;
        $hastwitter = (empty($PAGE->theme->settings->twitter)) ? false : $PAGE->theme->settings->twitter;
        $hasgoogleplus = (empty($PAGE->theme->settings->googleplus)) ? false : $PAGE->theme->settings->googleplus;
        $haslinkedin = (empty($PAGE->theme->settings->linkedin)) ? false : $PAGE->theme->settings->linkedin;
        $hasyoutube = (empty($PAGE->theme->settings->youtube)) ? false : $PAGE->theme->settings->youtube;
        $hasflickr = (empty($PAGE->theme->settings->flickr)) ? false : $PAGE->theme->settings->flickr;
        $hasvk = (empty($PAGE->theme->settings->vk)) ? false : $PAGE->theme->settings->vk;
        $haspinterest = (empty($PAGE->theme->settings->pinterest)) ? false : $PAGE->theme->settings->pinterest;
        $hasinstagram = (empty($PAGE->theme->settings->instagram)) ? false : $PAGE->theme->settings->instagram;
        $hasskype = (empty($PAGE->theme->settings->skype)) ? false : $PAGE->theme->settings->skype;
        $haswebsite = (empty($PAGE->theme->settings->website)) ? false : $PAGE->theme->settings->website;
        $hasblog = (empty($PAGE->theme->settings->blog)) ? false : $PAGE->theme->settings->blog;
        $hasvimeo = (empty($PAGE->theme->settings->vimeo)) ? false : $PAGE->theme->settings->vimeo;
        $hastumblr = (empty($PAGE->theme->settings->tumblr)) ? false : $PAGE->theme->settings->tumblr;
        $hassocial1 = (empty($PAGE->theme->settings->social1)) ? false : $PAGE->theme->settings->social1;
        $social1icon = (empty($PAGE->theme->settings->socialicon1)) ? 'globe' : $PAGE->theme->settings->socialicon1;
        $hassocial2 = (empty($PAGE->theme->settings->social2)) ? false : $PAGE->theme->settings->social2;
        $social2icon = (empty($PAGE->theme->settings->socialicon2)) ? 'globe' : $PAGE->theme->settings->socialicon2;
        $hassocial3 = (empty($PAGE->theme->settings->social3)) ? false : $PAGE->theme->settings->social3;
        $social3icon = (empty($PAGE->theme->settings->socialicon3)) ? 'globe' : $PAGE->theme->settings->socialicon3;
        $socialcontext = [
            // If any of the above social networks are true, sets this to true.
            'hassocialnetworks' => ($hasfacebook || $hastwitter || $hasgoogleplus || $hasflickr || $hasinstagram || $hasvk || $haslinkedin || $haspinterest || $hasskype || $haslinkedin || $haswebsite || $hasyoutube || $hasblog || $hasvimeo || $hastumblr || $hassocial1 || $hassocial2 || $hassocial3) ? true : false, 'socialicons' => array(
                array(
                    'haslink' => $hasfacebook,
                    'linkicon' => 'facebook'
                ),
                array(
                    'haslink' => $hastwitter,
                    'linkicon' => 'twitter'
                ),
                array(
                    'haslink' => $hasgoogleplus,
                    'linkicon' => 'google-plus'
                ),
                array(
                    'haslink' => $haslinkedin,
                    'linkicon' => 'linkedin'
                ),
                array(
                    'haslink' => $hasyoutube,
                    'linkicon' => 'youtube'
                ),
                array(
                    'haslink' => $hasflickr,
                    'linkicon' => 'flickr'
                ),
                array(
                    'haslink' => $hasvk,
                    'linkicon' => 'vk'
                ),
                array(
                    'haslink' => $haspinterest,
                    'linkicon' => 'pinterest'
                ),
                array(
                    'haslink' => $hasinstagram,
                    'linkicon' => 'instagram'
                ),
                array(
                    'haslink' => $hasskype,
                    'linkicon' => 'skype'
                ),
                array(
                    'haslink' => $haswebsite,
                    'linkicon' => 'globe'
                ),
                array(
                    'haslink' => $hasblog,
                    'linkicon' => 'bookmark'
                ),
                array(
                    'haslink' => $hasvimeo,
                    'linkicon' => 'vimeo-square'
                ),
                array(
                    'haslink' => $hastumblr,
                    'linkicon' => 'tumblr'
                ),
                array(
                    'haslink' => $hassocial1,
                    'linkicon' => $social1icon
                ),
                array(
                    'haslink' => $hassocial2,
                    'linkicon' => $social2icon
                ),
                array(
                    'haslink' => $hassocial3,
                    'linkicon' => $social3icon
                ),
            )];
        return $this->render_from_template('theme_bediukcity/socialicons', $socialcontext);
    }

    public function customlogin() {
        global $PAGE;
        $hasloginnav1icon = (empty($PAGE->theme->settings->loginnav1icon)) ? false : $PAGE->theme->settings->loginnav1icon;
        $hasloginnav2icon = (empty($PAGE->theme->settings->loginnav2icon)) ? false : $PAGE->theme->settings->loginnav2icon;
        $hasloginnav3icon = (empty($PAGE->theme->settings->loginnav3icon)) ? false : $PAGE->theme->settings->loginnav3icon;
        $hasloginnav4icon = (empty($PAGE->theme->settings->loginnav4icon)) ? false : $PAGE->theme->settings->loginnav4icon;
        $loginnav1titletext = (empty($PAGE->theme->settings->loginnav1titletext)) ? false : format_text($PAGE->theme->settings->loginnav1titletext);
        $loginnav2titletext = (empty($PAGE->theme->settings->loginnav2titletext)) ? false : format_text($PAGE->theme->settings->loginnav2titletext);
        $loginnav3titletext = (empty($PAGE->theme->settings->loginnav3titletext)) ? false : format_text($PAGE->theme->settings->loginnav3titletext);
        $loginnav4titletext = (empty($PAGE->theme->settings->loginnav4titletext)) ? false : format_text($PAGE->theme->settings->loginnav4titletext);
        $loginnav1icontext = (empty($PAGE->theme->settings->loginnav1icontext)) ? false : format_text($PAGE->theme->settings->loginnav1icontext);
        $loginnav2icontext = (empty($PAGE->theme->settings->loginnav2icontext)) ? false : format_text($PAGE->theme->settings->loginnav2icontext);
        $loginnav3icontext = (empty($PAGE->theme->settings->loginnav3icontext)) ? false : format_text($PAGE->theme->settings->loginnav3icontext);
        $loginnav4icontext = (empty($PAGE->theme->settings->loginnav4icontext)) ? false : format_text($PAGE->theme->settings->loginnav4icontext);
        $hascustomlogin = $PAGE->theme->settings->showcustomlogin == 1;
        $hasdefaultlogin = $PAGE->theme->settings->showcustomlogin == 0;
        $customlogin_context = ['hascustomlogin' => $hascustomlogin, 'hasdefaultlogin' => $hasdefaultlogin, 'hasfeature1' => !empty($PAGE->theme->setting_file_url('feature1image', 'feature1image')) && !empty($PAGE->theme->settings->feature1text), 'hasfeature2' => !empty($PAGE->theme->setting_file_url('feature2image', 'feature2image')) && !empty($PAGE->theme->settings->feature2text), 'hasfeature3' => !empty($PAGE->theme->setting_file_url('feature3image', 'feature3image')) && !empty($PAGE->theme->settings->feature3text), 'feature1image' => $PAGE->theme->setting_file_url('feature1image', 'feature1image'), 'feature2image' => $PAGE->theme->setting_file_url('feature2image', 'feature2image'), 'feature3image' => $PAGE->theme->setting_file_url('feature3image', 'feature3image'), 'feature1text' => (empty($PAGE->theme->settings->feature1text)) ? false : format_text($PAGE->theme->settings->feature1text, FORMAT_HTML, array(
            'noclean' => true
        )), 'feature2text' => (empty($PAGE->theme->settings->feature2text)) ? false : format_text($PAGE->theme->settings->feature2text, FORMAT_HTML, array(
            'noclean' => true
        )), 'feature3text' => (empty($PAGE->theme->settings->feature3text)) ? false : format_text($PAGE->theme->settings->feature3text, FORMAT_HTML, array(
            'noclean' => true
        )),
            // If any of the above social networks are true, sets this to true.
            'hasfpiconnav' => ($hasloginnav1icon || $hasloginnav2icon || $hasloginnav3icon || $hasloginnav4icon) ? true : false, 'fpiconnav' => array(
                array(
                    'hasicon' => $hasloginnav1icon,
                    'icon' => $hasloginnav1icon,
                    'title' => $loginnav1titletext,
                    'text' => $loginnav1icontext
                ),
                array(
                    'hasicon' => $hasloginnav2icon,
                    'icon' => $hasloginnav2icon,
                    'title' => $loginnav2titletext,
                    'text' => $loginnav2icontext
                ),
                array(
                    'hasicon' => $hasloginnav3icon,
                    'icon' => $hasloginnav3icon,
                    'title' => $loginnav3titletext,
                    'text' => $loginnav3icontext
                ),
                array(
                    'hasicon' => $hasloginnav4icon,
                    'icon' => $hasloginnav4icon,
                    'title' => $loginnav4titletext,
                    'text' => $loginnav4icontext
                ),
            ),];
        return $this->render_from_template('theme_bediukcity/customlogin', $customlogin_context);
    }

    public function teacherdash() {
        global $PAGE, $COURSE, $CFG, $DB, $OUTPUT, $USER;
        require_once($CFG->dirroot . '/completion/classes/progress.php');
        $togglebutton = '';
        $togglebuttonstudent = '';
        $hasteacherdash = '';
        $hasstudentdash = '';
        $editcog = html_writer::div($this->context_header_settings_menu(), 'pull-xs-right context-header-settings-menu');
        if (isloggedin() && isset($COURSE->id) && $COURSE->id > 1) {
            $course = $this->page->course;
            $context = context_course::instance($course->id);
            $hasteacherdash = has_capability('moodle/course:viewhiddenactivities', $context);
            $hasstudentdash = !has_capability('moodle/course:viewhiddenactivities', $context);
            if (has_capability('moodle/course:viewhiddenactivities', $context)) {
                $togglebutton = get_string('coursemanagementbutton', 'theme_bediukcity');
            } else {
                $togglebuttonstudent = get_string('studentdashbutton', 'theme_bediukcity');
            }
        }
        $course = $this->page->course;
        $context = context_course::instance($course->id);
        $courseactivities = $this->courseactivities_menu();
        $showincourseonly = isset($COURSE->id) && $COURSE->id > 1 && isloggedin() && !isguestuser();
        $globalhaseasyenrollment = enrol_get_plugin('easy');
        $coursehaseasyenrollment = '';
        if ($globalhaseasyenrollment) {
            $coursehaseasyenrollment = $DB->record_exists('enrol', array(
                'courseid' => $COURSE->id,
                'enrol' => 'easy'
            ));
            $easyenrollinstance = $DB->get_record('enrol', array(
                'courseid' => $COURSE->id,
                'enrol' => 'easy'
            ));
        }
        // Link catagories.
        $haspermission = has_capability('enrol/category:config', $context) && isset($COURSE->id) && $COURSE->id > 1;
        $userlinks = get_string('userlinks', 'theme_bediukcity');
        $userlinksdesc = get_string('userlinks_desc', 'theme_bediukcity');
        $qbank = get_string('qbank', 'theme_bediukcity');
        $qbankdesc = get_string('qbank_desc', 'theme_bediukcity');
        $badges = get_string('badges', 'theme_bediukcity');
        $badgesdesc = get_string('badges_desc', 'theme_bediukcity');
        $coursemanage = get_string('coursemanage', 'theme_bediukcity');
        $coursemanagedesc = get_string('coursemanage_desc', 'theme_bediukcity');
        $coursemanagementmessage = (empty($PAGE->theme->settings->coursemanagementtextbox)) ? false : format_text($PAGE->theme->settings->coursemanagementtextbox, FORMAT_HTML, array(
            'noclean' => true
        ));
        $studentdashboardtextbox = (empty($PAGE->theme->settings->studentdashboardtextbox)) ? false : format_text($PAGE->theme->settings->studentdashboardtextbox, FORMAT_HTML, array(
            'noclean' => true
        ));
        // User links.
        if ($coursehaseasyenrollment && isset($COURSE->id) && $COURSE->id > 1) {
            $easycodetitle = get_string('header_coursecodes', 'enrol_easy');
            $easycodelink = new moodle_url('/enrol/editinstance.php', array(
                'courseid' => $PAGE->course->id,
                'id' => $easyenrollinstance->id,
                'type' => 'easy'
            ));
        }
        $gradestitle = get_string('gradebooksetup', 'grades');
        $gradeslink = new moodle_url('/grade/edit/tree/index.php', array(
            'id' => $PAGE->course->id
        ));
        $gradebooktitle = get_string('gradebook', 'grades');
        $gradebooklink = new moodle_url('/grade/report/grader/index.php', array(
            'id' => $PAGE->course->id
        ));
        $participantstitle = get_string('participants', 'moodle');
        $participantslink = new moodle_url('/user/index.php', array(
            'id' => $PAGE->course->id
        ));
        (empty($participantstitle)) ? false : get_string('participants', 'moodle');
        $activitycompletiontitle = get_string('activitycompletion', 'completion');
        $activitycompletionlink = new moodle_url('/report/progress/index.php', array(
            'course' => $PAGE->course->id
        ));
        $grouptitle = get_string('groups', 'group');
        $grouplink = new moodle_url('/group/index.php', array(
            'id' => $PAGE->course->id
        ));
        $enrolmethodtitle = get_string('enrolmentinstances', 'enrol');
        $enrolmethodlink = new moodle_url('/enrol/instances.php', array(
            'id' => $PAGE->course->id
        ));
        // User reports.
        $logstitle = get_string('logs', 'moodle');
        $logslink = new moodle_url('/report/log/index.php', array(
            'id' => $PAGE->course->id
        ));
        $livelogstitle = get_string('loglive:view', 'report_loglive');
        $livelogslink = new moodle_url('/report/loglive/index.php', array(
            'id' => $PAGE->course->id
        ));
        $participationtitle = get_string('participation:view', 'report_participation');
        $participationlink = new moodle_url('/report/participation/index.php', array(
            'id' => $PAGE->course->id
        ));
        $activitytitle = get_string('outline:view', 'report_outline');
        $activitylink = new moodle_url('/report/outline/index.php', array(
            'id' => $PAGE->course->id
        ));
        $completionreporttitle = get_string('coursecompletion', 'completion');
        $completionreportlink = new moodle_url('/report/completion/index.php', array(
            'course' => $PAGE->course->id
        ));
        // Questionbank.
        $qbanktitle = get_string('questionbank', 'question');
        $qbanklink = new moodle_url('/question/edit.php', array(
            'courseid' => $PAGE->course->id
        ));
        $qcattitle = get_string('questioncategory', 'question');
        $qcatlink = new moodle_url('/question/category.php', array(
            'courseid' => $PAGE->course->id
        ));
        $qimporttitle = get_string('import', 'question');
        $qimportlink = new moodle_url('/question/import.php', array(
            'courseid' => $PAGE->course->id
        ));
        $qexporttitle = get_string('export', 'question');
        $qexportlink = new moodle_url('/question/export.php', array(
            'courseid' => $PAGE->course->id
        ));
        // Manage course.
        $courseadmintitle = get_string('courseadministration', 'moodle');
        $courseadminlink = new moodle_url('/course/admin.php', array(
            'courseid' => $PAGE->course->id
        ));
        $coursecompletiontitle = get_string('editcoursecompletionsettings', 'completion');
        $coursecompletionlink = new moodle_url('/course/completion.php', array(
            'id' => $PAGE->course->id
        ));
        $competencytitle = get_string('competencies', 'competency');
        $competencyurl = new moodle_url('/admin/tool/lp/coursecompetencies.php', array(
            'courseid' => $PAGE->course->id
        ));
        $courseresettitle = get_string('reset', 'moodle');
        $courseresetlink = new moodle_url('/course/reset.php', array(
            'id' => $PAGE->course->id
        ));
        $coursebackuptitle = get_string('backup', 'moodle');
        $coursebackuplink = new moodle_url('/backup/backup.php', array(
            'id' => $PAGE->course->id
        ));
        $courserestoretitle = get_string('restore', 'moodle');
        $courserestorelink = new moodle_url('/backup/restorefile.php', array(
            'contextid' => $PAGE->context->id
        ));
        $courseimporttitle = get_string('import', 'moodle');
        $courseimportlink = new moodle_url('/backup/import.php', array(
            'id' => $PAGE->course->id
        ));
        $courseedittitle = get_string('editcoursesettings', 'moodle');
        $courseeditlink = new moodle_url('/course/edit.php', array(
            'id' => $PAGE->course->id
        ));
        $badgemanagetitle = get_string('managebadges', 'badges');
        $badgemanagelink = new moodle_url('/badges/index.php?type=2', array(
            'id' => $PAGE->course->id
        ));
        $badgeaddtitle = get_string('newbadge', 'badges');
        $badgeaddlink = new moodle_url('/badges/newbadge.php?type=2', array(
            'id' => $PAGE->course->id
        ));
        $recyclebintitle = get_string('pluginname', 'tool_recyclebin');
        $recyclebinlink = new moodle_url('/admin/tool/recyclebin/index.php', array(
            'contextid' => $PAGE->context->id
        ));
        $filtertitle = get_string('filtersettings', 'filters');
        $filterlink = new moodle_url('/filter/manage.php', array(
            'contextid' => $PAGE->context->id
        ));
        $eventmonitoringtitle = get_string('managesubscriptions', 'tool_monitor');
        $eventmonitoringlink = new moodle_url('/admin/tool/monitor/managerules.php', array(
            'courseid' => $PAGE->course->id
        ));
        $copycoursetitle = get_string('copycourse', 'moodle');
        $copycourselink = new moodle_url('/backup/copy.php', array(
            'id' => $PAGE->course->id
        ));

        // Student Dash
        if (\core_completion\progress::get_course_progress_percentage($PAGE->course)) {
            $comppc = \core_completion\progress::get_course_progress_percentage($PAGE->course);
            $comppercent = number_format($comppc, 0);
        } else {
            $comppercent = 0;
        }

        $progresschartcontext = ['progress' => $comppercent];
        $progress = $this->render_from_template('theme_bediukcity/progress-bar', $progresschartcontext);

        $gradeslinkstudent = new moodle_url('/grade/report/user/index.php', array(
            'id' => $PAGE->course->id
        ));
        $hascourseinfogroup = array(
            'title' => get_string('courseinfo', 'theme_bediukcity'),
            'icon' => 'map'
        );
        $summary = theme_bediukcity_strip_html_tags($COURSE->summary);
        $summarytrim = theme_bediukcity_course_trim_char($summary, 300);
        $courseinfo = array(
            array(
                'content' => format_text($summarytrim),
            )
        );
        $hascoursestaff = array(
            'title' => get_string('coursestaff', 'theme_bediukcity'),
            'icon' => 'users'
        );
        $courseteachers = array();
        $courseother = array();

        $showonlygroupteachers = !empty(groups_get_all_groups($course->id, $USER->id)) && $PAGE->theme->settings->showonlygroupteachers == 1;
        if ($showonlygroupteachers) {
            $groupids = array();
            $studentgroups = groups_get_all_groups($course->id, $USER->id);
            foreach ($studentgroups as $grp) {
                $groupids[] = $grp->id;
            }
        }

        // If you created custom roles, please change the shortname value to match the name of your role.  This is teacher.
        $role = $DB->get_record('role', array(
            'shortname' => 'editingteacher'
        ));
        if ($role) {
            $context = context_course::instance($PAGE->course->id);
            $teachers = get_role_users($role->id, $context, false, 'u.id, u.firstname, u.middlename, u.lastname, u.alternatename,
                    u.firstnamephonetic, u.lastnamephonetic, u.email, u.picture, u.maildisplay,
                    u.imagealt');
            foreach ($teachers as $staff) {
                if ($showonlygroupteachers) {
                    $staffgroups = groups_get_all_groups($course->id, $staff->id);
                    $found = false;
                    foreach ($staffgroups as $grp) {
                        if (in_array($grp->id, $groupids)) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        continue;
                    }
                }
                $picture = $OUTPUT->user_picture($staff, array(
                    'size' => 50
                ));
                $messaging = new moodle_url('/message/index.php', array(
                    'id' => $staff->id
                ));
                $hasmessaging = $CFG->messaging == 1;
                $courseteachers[] = array(
                    'name' => $staff->firstname . ' ' . $staff->lastname . ' ' . $staff->alternatename,
                    'email' => $staff->email,
                    'picture' => $picture,
                    'messaging' => $messaging,
                    'hasmessaging' => $hasmessaging,
                    'hasemail' => $staff->maildisplay
                );
            }
        }

        // If you created custom roles, please change the shortname value to match the name of your role.  This is non-editing teacher.
        $role = $DB->get_record('role', array(
            'shortname' => 'teacher'
        ));
        if ($role) {
            $context = context_course::instance($PAGE->course->id);
            $teachers = get_role_users($role->id, $context, false, 'u.id, u.firstname, u.middlename, u.lastname, u.alternatename,
                    u.firstnamephonetic, u.lastnamephonetic, u.email, u.picture, u.maildisplay,
                    u.imagealt');
            foreach ($teachers as $staff) {
                if ($showonlygroupteachers) {
                    $staffgroups = groups_get_all_groups($course->id, $staff->id);
                    $found = false;
                    foreach ($staffgroups as $grp) {
                        if (in_array($grp->id, $groupids)) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        continue;
                    }
                }
                $picture = $OUTPUT->user_picture($staff, array(
                    'size' => 50
                ));
                $messaging = new moodle_url('/message/index.php', array(
                    'id' => $staff->id
                ));
                $hasmessaging = $CFG->messaging == 1;
                $courseother[] = array(
                    'name' => $staff->firstname . ' ' . $staff->lastname,
                    'email' => $staff->email,
                    'picture' => $picture,
                    'messaging' => $messaging,
                    'hasmessaging' => $hasmessaging,
                    'hasemail' => $staff->maildisplay
                );
            }
        }
        $activitylinkstitle = get_string('activitylinkstitle', 'theme_bediukcity');
        $activitylinkstitle_desc = get_string('activitylinkstitle_desc', 'theme_bediukcity');
        $mygradestext = get_string('mygradestext', 'theme_bediukcity');
        $studentcoursemanage = get_string('courseadministration', 'moodle');
        // Permissionchecks for teacher access.
        $hasquestionpermission = has_capability('moodle/question:add', $context);
        $hasbadgepermission = has_capability('moodle/badges:awardbadge', $context);
        $hascoursepermission = has_capability('moodle/backup:backupcourse', $context);
        $hasuserpermission = has_capability('moodle/course:viewhiddenactivities', $context);
        $hasgradebookshow = $PAGE->course->showgrades == 1 && $PAGE->theme->settings->showstudentgrades == 1;
        $hascompletionshow = $PAGE->course->enablecompletion == 1 && $PAGE->theme->settings->showstudentcompletion == 1;
        $hascourseadminshow = true;
        $hascompetency = get_config('core_competency', 'enabled');
        // Send to template.
        $haseditcog = true;
        $editcog = html_writer::div($this->context_header_settings_menu(), 'pull-xs-right context-header-settings-menu');
        $dashlinks = [
            'showincourseonly' => $showincourseonly,
            'haspermission' => $haspermission,
            'courseactivities' => $courseactivities,
            'togglebutton' => $togglebutton,
            'togglebuttonstudent' => $togglebuttonstudent,
            'userlinkstitle' => $userlinks,
            'userlinksdesc' => $userlinksdesc,
            'qbanktitle' => $qbank,
            'activitylinkstitle' => $activitylinkstitle,
            'activitylinkstitle_desc' => $activitylinkstitle_desc,
            'qbankdesc' => $qbankdesc,
            'badgestitle' => $badges,
            'badgesdesc' => $badgesdesc,
            'coursemanagetitle' => $coursemanage,
            'coursemanagedesc' => $coursemanagedesc,
            'coursemanagementmessage' => $coursemanagementmessage,
            'progress' => $progress,
            'gradeslink' => $gradeslink,
            'gradeslinkstudent' => $gradeslinkstudent,
            'hascourseinfogroup' => $hascourseinfogroup,
            'courseinfo' => $courseinfo,
            'hascoursestaffgroup' => $hascoursestaff,
            'courseteachers' => $courseteachers,
            'courseother' => $courseother,
            'mygradestext' => $mygradestext,
            'studentdashboardtextbox' => $studentdashboardtextbox,
            'hasteacherdash' => $hasteacherdash,
            'haseditcog' => $haseditcog,
            'editcog' => $editcog,
            'teacherdash' => array(
                'hasquestionpermission' => $hasquestionpermission,
                'hasbadgepermission' => $hasbadgepermission,
                'hascoursepermission' => $hascoursepermission,
                'hasuserpermission' => $hasuserpermission
            ),
            'hasstudentdash' => $hasstudentdash,
            'hasgradebookshow' => $hasgradebookshow,
            'hascompletionshow' => $hascompletionshow,
            'studentcourseadminlink' => $courseadminlink,
            'studentcoursemanage' => $studentcoursemanage,
            'hascourseadminshow' => $hascourseadminshow,
            'hascompetency' => $hascompetency,
            'competencytitle' => $competencytitle,
            'competencyurl' => $competencyurl,
            'dashlinks' => array(
                array(
                    'hasuserlinks' => $gradebooktitle,
                    'title' => $gradebooktitle,
                    'url' => $gradebooklink
                ),
                array(
                    'hasuserlinks' => $participantstitle,
                    'title' => $participantstitle,
                    'url' => $participantslink
                ),
                array(
                    'hasuserlinks' => $grouptitle,
                    'title' => $grouptitle,
                    'url' => $grouplink
                ),
                array(
                    'hasuserlinks' => $enrolmethodtitle,
                    'title' => $enrolmethodtitle,
                    'url' => $enrolmethodlink
                ),
                array(
                    'hasuserlinks' => $activitycompletiontitle,
                    'title' => $activitycompletiontitle,
                    'url' => $activitycompletionlink
                ),
                array(
                    'hasuserlinks' => $completionreporttitle,
                    'title' => $completionreporttitle,
                    'url' => $completionreportlink
                ),
                array(
                    'hasuserlinks' => $logstitle,
                    'title' => $logstitle,
                    'url' => $logslink
                ),
                array(
                    'hasuserlinks' => $livelogstitle,
                    'title' => $livelogstitle,
                    'url' => $livelogslink
                ),
                array(
                    'hasuserlinks' => $participationtitle,
                    'title' => $participationtitle,
                    'url' => $participationlink
                ),
                array(
                    'hasuserlinks' => $activitytitle,
                    'title' => $activitytitle,
                    'url' => $activitylink
                ),
                array(
                    'hasqbanklinks' => $qbanktitle,
                    'title' => $qbanktitle,
                    'url' => $qbanklink
                ),
                array(
                    'hasqbanklinks' => $qcattitle,
                    'title' => $qcattitle,
                    'url' => $qcatlink
                ),
                array(
                    'hasqbanklinks' => $qimporttitle,
                    'title' => $qimporttitle,
                    'url' => $qimportlink
                ),
                array(
                    'hasqbanklinks' => $qexporttitle,
                    'title' => $qexporttitle,
                    'url' => $qexportlink
                ),
                array(
                    'hascoursemanagelinks' => $courseedittitle,
                    'title' => $courseedittitle,
                    'url' => $courseeditlink
                ),
                array(
                    'hascoursemanagelinks' => $gradestitle,
                    'title' => $gradestitle,
                    'url' => $gradeslink
                ),
                array(
                    'hascoursemanagelinks' => $coursecompletiontitle,
                    'title' => $coursecompletiontitle,
                    'url' => $coursecompletionlink
                ),
                array(
                    'hascoursemanagelinks' => $hascompetency,
                    'title' => $competencytitle,
                    'url' => $competencyurl
                ),
                array(
                    'hascoursemanagelinks' => $courseadmintitle,
                    'title' => $courseadmintitle,
                    'url' => $courseadminlink
                ),
                array(
                    'hascoursemanagelinks' => $copycoursetitle,
                    'title' => $copycoursetitle,
                    'url' => $copycourselink
                ),
                array(
                    'hascoursemanagelinks' => $courseresettitle,
                    'title' => $courseresettitle,
                    'url' => $courseresetlink
                ),
                array(
                    'hascoursemanagelinks' => $coursebackuptitle,
                    'title' => $coursebackuptitle,
                    'url' => $coursebackuplink
                ),
                array(
                    'hascoursemanagelinks' => $courserestoretitle,
                    'title' => $courserestoretitle,
                    'url' => $courserestorelink
                ),
                array(
                    'hascoursemanagelinks' => $courseimporttitle,
                    'title' => $courseimporttitle,
                    'url' => $courseimportlink
                ),
                array(
                    'hascoursemanagelinks' => $recyclebintitle,
                    'title' => $recyclebintitle,
                    'url' => $recyclebinlink
                ),
                array(
                    'hascoursemanagelinks' => $filtertitle,
                    'title' => $filtertitle,
                    'url' => $filterlink
                ),
                array(
                    'hascoursemanagelinks' => $eventmonitoringtitle,
                    'title' => $eventmonitoringtitle,
                    'url' => $eventmonitoringlink
                ),
                array(
                    'hasbadgelinks' => $badgemanagetitle,
                    'title' => $badgemanagetitle,
                    'url' => $badgemanagelink
                ),
                array(
                    'hasbadgelinks' => $badgeaddtitle,
                    'title' => $badgeaddtitle,
                    'url' => $badgeaddlink
                ),
            ),
        ];
        // Attach easy enrollment links if active.
        if ($globalhaseasyenrollment && $coursehaseasyenrollment) {
            $dashlinks['dashlinks'][] = array(
                'haseasyenrollment' => $coursehaseasyenrollment,
                'title' => $easycodetitle,
                'url' => $easycodelink
            );
        }
        return $this->render_from_template('theme_bediukcity/teacherdash', $dashlinks);
    }

    public function footnote() {
        global $PAGE;
        $footnote = '';
        $footnote = (empty($PAGE->theme->settings->footnote)) ? false : format_text($PAGE->theme->settings->footnote);
        return $footnote;
    }

    public function footer_about() {
        $theme = theme_config::load('campus');
        $setting = $theme->settings->footnote_about;
        return $setting != '' ? $setting : '';
    }


    public function footer_details_title() {
        return get_string('contactandsupporttitle', 'theme_bediukcity');
    }

    public function footer_address() {
        $theme = theme_config::load('campus');
        $setting = $theme->settings->address;
        return $setting != '' ? $setting : '';
    }

    public function footer_email() {
        $theme = theme_config::load('campus');
        $setting = $theme->settings->email;
        return $setting != '' ? $setting : '';
    }

    public function footer_phone() {
        $theme = theme_config::load('campus');
        $setting = $theme->settings->phone;
        return $setting != '' ? $setting : '';
    }

    public function footer_tutorials_link_url() {
        $theme = theme_config::load('campus');
        $setting = $theme->settings->tutorials;
        return $setting != '' ? $setting : '';
    }

    public function footer_facebook() {
        $theme = theme_config::load('campus');
        $setting = $theme->settings->facebook;
        return $setting != '' ? $setting : '';
    }

    public function footer_siteregulation_url() {
        $theme = theme_config::load('campus');
        $setting = $theme->settings->siteregulation;
        return $setting != '' ? $setting : '';
    }

    public function logintext_custom() {
        global $PAGE;
        $logintext_custom = '';
        $logintext_custom = (empty($PAGE->theme->settings->fptextboxlogout)) ? false : format_text($PAGE->theme->settings->fptextboxlogout);
        return $logintext_custom;
    }

    public function render_login(\core_auth\output\login $form) {
        global $SITE, $PAGE;
        $context = $form->export_for_template($this);
        // Override because rendering is not supported in template yet.
        $context->cookieshelpiconformatted = $this->help_icon('cookiesenabled');
        $context->errorformatted = $this->error_text($context->error);
        $url = $this->get_logo_url();
        // Custom logins.
        $context->logintext_custom = format_text($PAGE->theme->settings->fptextboxlogout);
        $context->logintopimage = $PAGE->theme->setting_file_url('logintopimage', 'logintopimage');
        $context->hascustomlogin = $PAGE->theme->settings->showcustomlogin == 1;
        $context->hasdefaultlogin = $PAGE->theme->settings->showcustomlogin == 0;
        $context->alertbox = format_text($PAGE->theme->settings->alertbox, FORMAT_HTML, array(
            'noclean' => true
        ));
        if ($url) {
            $url = $url->out(false);
        }
        $context->logourl = $url;
        $context->sitename = format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID), "escape" => false]);
        return $this->render_from_template('core/loginform', $context);
    }

    public function favicon() {
        $favicon = $this->page->theme->setting_file_url('favicon', 'favicon');

        if (empty($favicon)) {
            return $this->page->theme->image_url('favicon', 'theme');
        } else {
            return $favicon;
        }
    }

    public function show_student_navbarcolor() {
        global $PAGE;
        $theme = theme_config::load('bediukcity');
        $context = $this->page->context;
        $hasstudentrole = !has_capability('moodle/course:viewhiddenactivities', $context);

        if ($PAGE->theme->settings->navbarcolorswitch == 1 && $hasstudentrole) {
            return true;
        }
        return false;
    }

    /**
     * Render the contents of a block_list.
     * Lea 2017/9 - I overrid this function so I could add BS classes to the html elements
     */
    public function list_block_contents($icons, $items) {
        $row = 0;
        $lis = array();
        foreach ($items as $key => $string) {
            $item = html_writer::start_tag('li', array('class' => 'r' . $row . ' '));
            $item .= $string;
            //$item .= html_writer::tag('div', $string, array('class' => 'column c1'));
            $item .= html_writer::end_tag('li');
            $lis[] = $item;
            $row = 1 - $row; // Flip even/odd.
        }
        return html_writer::tag('ul', implode("\n", $lis), array('class' => 'card-group content'));
    }


    public function current_year() {
        return date("Y");
    }

    public function course_matadata_section() {
        global $COURSE, $CFG;
        $ret = '';
        // get course summary

        // Display metadata - AUDIENCE
        require_once($CFG->dirroot . '/ort/ort_util.php');
        $ret .= \ort_util::get_metadata_course_by_field_as_list($COURSE->id, array('discipline', 'topic', 'audience', 'language', 'development'));
        $ret .= \ort_util::get_metadata_course_by_field_as_link($COURSE->id, array('contact'));
        return $ret;
    }

    public function course_summary_section() {
        global $COURSE;
        return $COURSE->summary;
    }

    public function teacherdashmenu() {
        global $PAGE, $COURSE, $CFG, $DB, $OUTPUT;
        $course = $this->page->course;
        $context = context_course::instance($course->id);
        $showincourseonly = isset($COURSE->id) && $COURSE->id > 1 && isloggedin() && !isguestuser();
        $haspermission = has_capability('enrol/category:config', $context) && isset($COURSE->id) && $COURSE->id > 1;
        $togglebutton = '';
        $togglebuttonstudent = '';
        $hasteacherdash = '';
        $hasstudentdash = '';
        $globalhaseasyenrollment = enrol_get_plugin('easy');
        $coursehaseasyenrollment = '';
        if ($globalhaseasyenrollment) {
            $coursehaseasyenrollment = $DB->record_exists('enrol', array(
                'courseid' => $COURSE->id,
                'enrol' => 'easy'
            ));
            $easyenrollinstance = $DB->get_record('enrol', array(
                'courseid' => $COURSE->id,
                'enrol' => 'easy'
            ));
        }
        if ($coursehaseasyenrollment && isset($COURSE->id) && $COURSE->id > 1) {
            $easycodetitle = get_string('header_coursecodes', 'enrol_easy');
            $easycodelink = new moodle_url('/enrol/editinstance.php', array(
                'courseid' => $PAGE->course->id,
                'id' => $easyenrollinstance->id,
                'type' => 'easy'
            ));
        }
        if (isloggedin() && isset($COURSE->id) && $COURSE->id > 1) {
            $course = $this->page->course;
            $context = context_course::instance($course->id);
            $hasteacherdash = has_capability('moodle/course:viewhiddenactivities', $context);
            $hasstudentdash = !has_capability('moodle/course:viewhiddenactivities', $context);
            if (has_capability('moodle/course:viewhiddenactivities', $context)) {
                $togglebutton = get_string('coursemanagementbutton', 'theme_bediukcity');
            } else {
                $togglebuttonstudent = get_string('studentdashbutton', 'theme_bediukcity');
            }
        }
        $siteadmintitle = get_string('siteadminquicklink', 'theme_bediukcity');
        $siteadminurl = new moodle_url('/admin/search.php');
        $hasadminlink = has_capability('moodle/site:configview', $context);
        $course = $this->page->course;
        // Send to template.
        $dashmenu = ['showincourseonly' => $showincourseonly, 'togglebutton' => $togglebutton, 'togglebuttonstudent' => $togglebuttonstudent, 'hasteacherdash' => $hasteacherdash, 'hasstudentdash' => $hasstudentdash, 'haspermission' => $haspermission, 'hasadminlink' => $hasadminlink, 'siteadmintitle' => $siteadmintitle, 'siteadminurl' => $siteadminurl,];
        // Attach easy enrollment links if active.
        if ($globalhaseasyenrollment && $coursehaseasyenrollment) {
            $dashmenu['dashmenu'][] = array(
                'haseasyenrollment' => $coursehaseasyenrollment,
                'title' => $easycodetitle,
                'url' => $easycodelink
            );
        }
        return $this->render_from_template('theme_bediukcity/teacherdashmenu', $dashmenu);
    }

    /**
     * @param \stdClass $CFG
     * @param \stdClass $COURSE
     * @return string
     * @throws \coding_exception
     */
    private function get_image_from_area_files($imgname) {
        global $CFG, $COURSE;
        require_once($CFG->libdir . '/filestorage/file_storage.php');
        require_once($CFG->dirroot . '/course/lib.php');

        // Get course overview files.

        if (empty($CFG->courseoverviewfileslimit)) {
            return '';
        }

        $fs = get_file_storage();
        $context = context_course::instance($COURSE->id);
        $files = $fs->get_area_files($context->id, 'course', 'overviewfiles', false, 'filename', false);
        if (count($files)) {
            $overviewfilesoptions = course_overviewfiles_options($COURSE->id);
            $acceptedtypes = $overviewfilesoptions['accepted_types'];
            if ($acceptedtypes !== '*') {
                // Filter only files with allowed extensions.
                require_once($CFG->libdir . '/filelib.php');
                foreach ($files as $key => $file) {
                    if (!file_extension_in_typegroup($file->get_filename(), $acceptedtypes)) {
                        unset($files[$key]);
                    }
                }
            }
            if (count($files) > $CFG->courseoverviewfileslimit) {
                // Return no more than $CFG->courseoverviewfileslimit files.
                $files = array_slice($files, 0, $CFG->courseoverviewfileslimit, true);
            }
        }
        $image = '';
        foreach ($files as $file) {
            $isimage = $file->is_valid_image();
            if ($isimage) {
                if (strpos($file->get_filename(), $imgname) !== false) {
                    $image = new moodle_url("$CFG->wwwroot/pluginfile.php" .
                        '/' . $file->get_contextid() . '/' . $file->get_component() . '/' .
                        $file->get_filearea() . $file->get_filepath() . $file->get_filename());
                }
            }
        }
        return $image;
    }
}