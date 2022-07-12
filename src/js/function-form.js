jQuery(function ($) {
  if ($('.mw_wp_form_confirm, .mw_wp_form_complete').length) {
    $('body').addClass('preview-form_confirm');
  } else {
    $('body').addClass('preview-form_input');
  }
});



jQuery(function ($) {
  var changeFlg = false;
  $(window).on('beforeunload', function () {
    //変更がある場合のみ警告をだす
    if (changeFlg) {
      return "ページを閉じようとしています。入力した情報が失われますがよろしいですか？";
    }
  });

  //フォームの内容が変更されたらフラグを立てる
  $("form input, form textarea, form select").change(function () {
    changeFlg = true;
  });

  //特定のボタンが押された場合はフラグを落とす
  $("input[type=submit]").click(function () {
    changeFlg = false;
  });
});

jQuery(function ($) {
  if ($('.mw_wp_form .error')[0]) {
    $('.mw_wp_form').addClass('mw_wp_form_error');
  }
});