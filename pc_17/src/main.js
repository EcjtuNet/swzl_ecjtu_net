/**
 * Created by skycheung on 2017/3/11.
 */
import 'normalize.css';
import '../src/style/style.less';
import ball from './js/particles';
import render from './js/query';

$(document).ready(
    ball(),
    (function () {
        var baseUrl = 'api.php/';
        var template = require('../src/template.html');
        render(baseUrl, template);
    })()
);