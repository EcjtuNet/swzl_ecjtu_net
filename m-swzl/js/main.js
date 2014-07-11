$( document ).ready( function () {
    var kindlist = $( '#kindlist' )
    ,   timelist = $( '#timelist' )
    ,   contentlist = $( '#contentlist' )
    ,   searchInput = $( '#searchInput' )
    ,   noticekindBtn = $( '.noticekind-btn' );
    
    //搜索启事切换
    noticekindBtn.click( function () {
        var classname = $( this ).attr( 'class' );
        if ( classname.search( /active/ ) === -1 ) {
            $( '.active').removeClass( 'active' );
            $( this ).addClass( 'active' );
        }
    } );
    
    //搜索框聚失焦
    var initval = '搜索您丢失或捡到的物品';
    searchInput.focus( function () {
        if ( $( this ).val() === initval) {
            $( this ).val( '' );
        }
    } );
    searchInput.blur( function () {
        if ( $( this ).val() === '' ) {
            $( this ).val( initval );
        }
    } );
    //分类查询按钮事件
    kindlist.add( timelist ).click( function () {
        var ul = $( this ).find( 'ul' )
        ,   disp = ul.css( 'display' );
        if ( disp === 'none') {
            ul.show();
        } else {
            ul.hide();
        }
    });
    
    //联系按钮事件
    contentlist.on( 'click', '.tel', function () {
        $( this ).parent().parent().next().show();
    });
    
    //联系人弹出框消失
    contentlist.on( 'click', '.close', function () {
        $( this ).parent().hide();
    });
});