/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
(function () {
  function fn() {
    $('#a3rt-talk-button').click(function () {
      var params = {
        apikey: $('#a3rt-talk-api-key').val(),
        query: $('#a3rt-talk-message').val()
      };
      $.post('https://api.a3rt.recruit-tech.co.jp/talk/v1/smalltalk', params, function (result) {
        var tag = "<div>status: ".concat(result.status, "</div>\n        <div>message: ").concat(result.message, "</div>\n        ");

        if (result.status == 0) {
          tag += "<div>".concat(result.results[0].reply, "</div>");
        }

        $('#a3rt-talk-result').html(tag);
      }, 'json');
      return false;
    });
  }

  ;

  if (document.readyState != 'loading') {
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
})();
/******/ })()
;