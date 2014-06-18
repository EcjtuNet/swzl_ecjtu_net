$(document).ready(function () {

    
});



function GetAjaxData(url, path, page, hash) {
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            path: path,
            page: page,
            csrf_name: hash
        },
        success: function (msg) {}
    });
}