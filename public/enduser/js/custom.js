$('.edit-btn').click(function(){

    $('.report').slideUp();
    $('.replay').slideUp();
    $('.delete').slideUp();
    $('.comment-text').not($(this).siblings('.comment-text')).slideDown();
    $('.edit').not($(this).siblings('.edit')).slideUp();
    $(this).siblings('.edit').slideToggle();
    $(this).siblings('.comment-text').slideToggle();

});

$('.replay-btn').click(function(){

    $('.comment-text').slideDown();
    $('.report').slideUp();
    $('.edit').slideUp();
    $('.delete').slideUp();
    $('.replay').not($(this).siblings('.replay')).slideUp();
    $(this).siblings('.replay').slideToggle();

});
$('.delete-btn').click(function(){

    $('.delete').not($(this).siblings('.delete')).slideUp();
    $('.report').slideUp();
    $('.edit').slideUp();
    $('.replay').slideUp();
    $(this).siblings('.delete').slideToggle();

});
$('.report-btn').click(function(){

    $('.comment-text').slideDown();
    $('.report').not($(this).siblings('.report')).slideUp();
    $('.delete').slideUp();
    $('.edit').slideUp();
    $('.replay').slideUp();
    $(this).siblings('.report').slideToggle();

});
$(function() {
    $('[data-src]').Lazy();
});
toastr.options = {
"closeButton": false,
"debug": false,
"newestOnTop": false,
"progressBar": false,
"positionClass": "toast-top-right",
"preventDuplicates": false,
"onclick": null,
"showDuration": "300",
"hideDuration": "1000",
"timeOut": "3000",
"extendedTimeOut": "1000",
"showEasing": "swing",
"hideEasing": "linear",
"showMethod": "fadeIn",
"hideMethod": "fadeOut"
}


if (window.location.hash == "#_=_"){
    window.location.hash = "";
}
