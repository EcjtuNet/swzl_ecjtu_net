/**
 * Created by skycheung on 2017/3/13.
 */

exports.ball  = function () {
    var canvas = $("#particles");
    var context = canvas.get(0).getContext("2d");
    var canvasWidth = canvas.width();
    var canvasHeight = canvas.height();
    $(window).resize(resizeCanvas);

    function resizeCanvas() {
        canvas.attr("width", $(window).get(0).innerWidth);
        canvas.attr("height", $(window).get(0).innerHeight);
        canvasWidth = canvas.width();
        canvasHeight = canvas.height();
    }
    resizeCanvas();

    var Item = function (x, y, radius, vX , vY) {
        this.x = x;
        this.y = y;
        this.radius = radius;
        this.vX = vX;
        this.vY = vY;
    };
    var items = new Array();
    for (var i = 0; i < 30; i++) {
        var x = 20 + (Math.random() * (canvasWidth -40));
        var y = 20 + (Math.random() * (canvasHeight -40));
        var radius = 5 + Math.random() * 4 - 2;
        var vX = Math.random() * 4 - 2;
        var vY = Math.random() * 4 - 2;

        items.push(new Item(x, y ,radius, vX, vY));
    }

    function animate() {
       context.clearRect(0, 0, canvasWidth, canvasHeight);
        context.fillStyle = "rgb(255, 255, 255)";

        var itemLength = items.length;
        for (var i = 0; i < itemLength; i++) {
            var tmpItem = items[i];
            tmpItem.x += tmpItem.vX;
            tmpItem.y += tmpItem.vY;

            if (tmpItem.x - tmpItem.radius < 0) {
                tmpItem.x = tmpItem.radius;
                tmpItem.vX *= -1;
            } else if (tmpItem.x + tmpItem.radius > canvasWidth) {
                tmpItem.x = canvasWidth - tmpItem.radius;
                tmpItem.vX = -1;
            }

            if (tmpItem.y - tmpItem.radius < 0) {
                tmpItem.y = tmpItem.radius;
                tmpItem.vY *= -1;
            } else if (tmpItem.y + tmpItem.radius > canvasHeight) {
                tmpItem.y = canvasHeight - tmpItem.radius;
                tmpItem.vY = -1;
            }

            context.beginPath();
            context.arc(tmpItem.x, tmpItem.y, tmpItem.radius, 0, Math.PI * 2, false);
            context.closePath();
            context.fill();
        }

        setTimeout(animate, 33);
    }

    animate();
};
