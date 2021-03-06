/**
 * Created by skycheung on 2017/3/14.
 */
import Mustache from './mustache';

var render = function (url, template, contentWrap) {
    $.ajax({
        url: url,
        type: 'GET',
        async: false,
        success: function (data) {
            if (data.count) {
                var count = data.count,
                    list = data.list,
                    i = 0;
                for (i; i < count; i++) {
                    var unix = list[i]['time'];
                    list[i]['time'] = handleTime(unix);
                    list[i]['type'] = list.type === 'found' ? '招领' : '丢失';
                    var content = Mustache.to_html(template, list[i]);
                    contentWrap.append(content);
                }
            } else {
                contentWrap.text("好像没有信息～～");
            }
        }
    });


    function handleTime(unix) {
        var time = new Date( unix*1000 );
        var year = time.getFullYear(),
            month = time.getMonth() + 1,
            date = time.getDate();
        return year + '-' + month + '-' + date;
    }
};

export default render
