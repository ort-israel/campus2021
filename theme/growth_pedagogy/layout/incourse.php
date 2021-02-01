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
 * A two column layout for the boost theme.
 *
 * @package   theme_boost
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

$hasfhsdrawer = 1;
$navdraweropen = false;

$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;

$blockshtmla = $OUTPUT->blocks('fp-a');
$blockshtmlb = $OUTPUT->blocks('fp-b');
$blockshtmlc = $OUTPUT->blocks('fp-c');
$checkblocka = strpos($blockshtmla, 'data-block=') !== false;
$checkblockb = strpos($blockshtmlb, 'data-block=') !== false;
$checkblockc = strpos($blockshtmlc, 'data-block=') !== false;

$hasactivitynav = true;

$hascourseblocks = false;
if ($checkblocka || $checkblockb || $checkblockc) {
    $hascourseblocks = true;
}

$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();


$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'fpablocks' => $blockshtmla,
    'fpbblocks' => $blockshtmlb,
    'fpcblocks' => $blockshtmlc,
    'hasblocks' => $hasblocks,
    'hascourseblocks' => $hascourseblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'hasfhsdrawer' => $hasfhsdrawer,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'hasactivitynav' => $hasactivitynav
];

$PAGE->requires->jquery();
$PAGE->requires->js('/theme/growth_pedagogy/javascript/scrolltotop.js');
$PAGE->requires->js('/theme/growth_pedagogy/javascript/scrollspy.js');
$PAGE->requires->js('/theme/growth_pedagogy/javascript/blockslider.js');

/* Lea 2020/11 - add search functionality to the select element. Used on the question category select in the question bank screen */
$PAGE->requires->css('/theme/growth_pedagogy/style/select2.min.css');
$PAGE->requires->js('/theme/growth_pedagogy/javascript/select2.min.js', true); // Lea 2019/10 - without the "true", an error is thrown in console: "Error: Mismatched anonymous define() module"
$PAGE->requires->js('/theme/growth_pedagogy/javascript/applyselect2.js?ver=' . filemtime($CFG->dirroot . '/theme/growth_pedagogy/javascript/applyselect2.js'));

/* Lea 2020/11 - Add JS that injects classes into Category page elements */
$PAGE->requires->js('/theme/growth_pedagogy/javascript/categoryclasses.js');

$PAGE->requires->js('/theme/growth_pedagogy/javascript/courseblock.js');

$nav = $PAGE->flatnav;
$templatecontext['flatnavigation'] = $nav;
$templatecontext['firstcollectionlabel'] = $nav->get_collectionlabel();
echo $OUTPUT->render_from_template('theme_growth_pedagogy/columns2', $templatecontext);