$(document).ready(function () {
    $('.course_category_tree .category-browse').addClass('card-group');
    $('.course_category_tree .category-browse .coursebox').addClass('card');
    $('.course_category_tree .category-browse .coursebox .content').addClass('card-block');
    // move the image from the content element to the info element so the image is the first element shown in block:
    let infoUncle = $('.course_category_tree .category-browse .coursebox .info');
    infoUncle.each(function () {
        $(this).prepend($(this).siblings('.content').children('.courseimage'));
    });
});
