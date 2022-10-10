$(function () {
  //クリックで動く
  $('.ac-parent').click(function () {
    $(this).children('.ac-arrow').toggleClass('active');
    $(this).next().toggleClass('active');
  });
});
//$(this).children('.ac-arrow')→$thisの中のクラス名をさらに指定できる
