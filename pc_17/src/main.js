/**
 * Created by skycheung on 2017/3/11.
 */
require('normalize.css');
require('../src/style/style.less');
var particles = require('./particles.js');
var masonry = require('./masonry.js');

$(document).ready(
   particles.ball()
);