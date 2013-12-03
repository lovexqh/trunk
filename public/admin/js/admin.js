var currpage = function () {
    var url = document.getElementById( 'nowpagehidden' ).value;
    var go = document.getElementById( 'currentpage' ).value;
    var first = url.lastIndexOf( '=' );
    var newurl = url.substring( 0, first + 1 );
    location.href = newurl + go;
}
var tmpinput = document.getElementById( 'selectstate' );
if(tmpinput){
    var allInput = tmpinput.getElementsByTagName( 'input' );
    var selectid = new Array();
    for ( var obj = 0; obj < allInput.length; obj++ ) {
        if ( allInput[obj].getAttribute( 'type' ) == 'checkbox' ) {
            selectid.push( allInput[obj] );
        }
    }
}

//全选
function allSelect() {
    for ( var obj = 0; obj < selectid.length; obj++ ) {
        if ( !selectid[obj].checked ) {
            selectid[obj].checked = true;
        }
    }

}
//反选
function InverSelect() {
    for ( var obj = 0; obj < selectid.length; obj++ ) {
        if ( !selectid[obj].checked ) {
            selectid[obj].checked = true;
        } else {
            selectid[obj].checked = false;

        }
    }
}
//全否
function allUnSelect() {
    for ( var obj = 0; obj < selectid.length; obj++ ) {
        if ( selectid[obj].checked ) {
            selectid[obj].checked = false;
        }
    }
}
function deleteSelect( url ) {
    var result = false;
    var sum = '';
    for ( var a = 0; a < selectid.length; a++ ) {
        if ( selectid[a].checked == true ) {
            result = true;
            sum += selectid[a].value + ',';
        }
    }
    if ( result ) {
        if ( confirm( '你确定要删除该项信息？' ) ) {
            location.href = url + '/delete/id/' + sum;
        }
    } else {
        alert( '请选择要删除的选项！' );
    }
}