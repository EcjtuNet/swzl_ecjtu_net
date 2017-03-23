/**
 * Created by skycheung on 2017/3/11.
 */
import 'normalize.css';
import '../src/style/style.less';
import ball from './js/particles';
import render from './js/query';
import {waterfall} from './js/masonry';

$(document).ready( function () {
    (function () {
        var contentWrap = $(".content__wrap");
        var template = $("#template").html();

        ball();

        (function () {
            var baseUrl = 'api.php/';
            render(baseUrl, template, contentWrap);
        })();

        (function () {
            waterfall(contentWrap);
        })();

    })()
});