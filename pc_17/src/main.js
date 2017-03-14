/**
 * Created by skycheung on 2017/3/11.
 */
import 'normalize.css';
import '../src/style/style.less';
import particles from './js/particles';
import masonry from './js/masonry';
import query from './js/query';

$(document).ready(
    particles.ball(),
    (function () {
        var baseUrl = 'api.php/';
        var contentWrap = 'content__wrap';
        var template = require('../src/template.html');
        var info = query.render(baseUrl, contentWrap, template);
        console.log(info);
    })()
);