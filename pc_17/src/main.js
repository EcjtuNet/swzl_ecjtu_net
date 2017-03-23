/**
 * Created by skycheung on 2017/3/11.
 */
import 'normalize.css';
import '../src/style/style.less';
import ball from './js/ball';
import render from './js/query';
import waterfall from './js/waterfall';

$(document).ready( function () {
    (function () {
        var contentWrap = $(".content__wrap"),
            template = $("#template").html(),
            navFind = $(".nav__menu li")[0],
            navLost = $(".nav__menu li")[1],
            navNew = $(".nav__menu li")[2],
            mask = $("#mask");

        ball();

        (function () {
            var baseUrl = 'api.php/';
            render(baseUrl, template, contentWrap);
        })();

        (function () {
            waterfall(contentWrap);
        })();

        navNew.addEventListener('click', function () {
            mask.css("height",$(document).height());
            mask.css("width",$(document).width());
            mask.show();
        });

    })()
});
