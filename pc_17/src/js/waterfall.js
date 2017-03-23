/**
 * Created by skycheung on 2017/3/13.
 */

var waterfall = function (contentWrap) {
    var wrap = contentWrap[0],
        boxNumber = wrap.children.length,
        colNumber,
        gapWidth = 10,
        containPadding = 2,
        totalWidth = wrap.offsetWidth,
        singleWidth,
        column = [];

    function getColNumber(columns, totalWidth) {
        if ( totalWidth <= 1200) {
            columns--;
            if ( totalWidth <= 992) {
                columns--;
                if (totalWidth <= 768) {
                    columns--;
                }
            }
        }
        return columns;
    }

    function countSingleWidth(columns, totalWidth, gapWidth, containerPadding) {
        return (totalWidth - (columns - 1)*gapWidth - containerPadding*2) / columns;
    }

    function columnInit(column, columns) {
        for(var i=0; i<columns; i++) {
            column[i] = 0;
        }
    }

    function findMaxHeight(column) {
        var maxHeight = column[0];
        var maxColum = 0;
        for (var i=1; i<column.length; i++) {
            if(maxHeight < column[i]) {
                maxHeight = column[i];
                maxColum = i;
            }
        }
        return {"maxHeight": maxHeight, "maxColum": maxColum};
    }

    function findMinHeight(column) {
        var minHeight=column[0];
        var minColum=0;
        for(var i=1;i<column.length;i++){
            if(minHeight>column[i]){
                minHeight=column[i];
                minColum=i;
            }
        }
        return {"minHeight":minHeight, "minColum":minColum }
    }

    function waterfallInit(boxNumber, wrap, column, singleWidth, gapWidth, containerPadding) {
        for (var num=0; num<boxNumber; num++) {
            var atColum = findMinHeight(column).minColum;
            var atHeight = findMinHeight(column).minHeight;
            wrap.children[num].style.left = atColum * (singleWidth + gapWidth) + containerPadding + 'px';
            wrap.children[num].style.top = gapWidth + atHeight + 'px';
            column[atColum] += wrap.children[num].offsetHeight + gapWidth;
        }
    }

    function run() {
        var columns = 4,
            totalWidth = wrap.offsetWidth;
        colNumber = getColNumber(columns, totalWidth);
        contentWrap.removeClass();
        contentWrap.addClass('content__wrap');
        contentWrap.addClass('col'+colNumber);
        singleWidth = countSingleWidth(colNumber, totalWidth, gapWidth, containPadding);
        columnInit(column, colNumber);
        waterfallInit(boxNumber, wrap, column, singleWidth, gapWidth, containPadding);

    }

    run();

    window.addEventListener('resize', function () {
       run();
    }, 800);

};

export default waterfall
