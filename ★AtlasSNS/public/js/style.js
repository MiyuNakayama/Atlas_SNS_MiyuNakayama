$(function () {
  //クリックで動く
  $('.ac-arrow').click(function () {
    $(this).toggleClass('active');
    $(this).next('ac-child').slideToggle();
  });
});
