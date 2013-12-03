(function(){
    var utils = XF.utils,
        domUtils = XF.domUtils,
        UIBase = XF.UIBase,
        pop = XF.ui.Popup,
        mask = XF.ui.Mask,
        uiUtils = XF.uiUtils;

    var allPopups = [];
    function closeAllPopup( el ){
        for ( var i = 0; i < allPopups.length; i++ ) {
            var pop = allPopups[i];
            if (!pop.isHidden()) {
                if (pop.queryAutoHide(el) !== false) {
                    pop.hide();
                }
            }
        }
    }
    var PopMask = XF.ui.PopMask = function (options){
        this.initOptions(options);
        this.initUIBase();
        allPopups.push(this);
    };
    PopMask.prototype = {
        content:"",
        getHtmlTpl: function (){
            return '<div id="##" class="xfui-popmask %%" onmousedown="return $$._onMouseDown(event, this);">' +
                '<div id="##_body" ><div id="##_content"> '+this.content+'</div></div>' +
                '</div>';
        }
    }
    utils.inherits(PopMask, pop);
    utils.inherits(PopMask, mask);

    domUtils.on( window, 'scroll', function ( evt ) {
        closeAllPopup(  );
    } );
    domUtils.on( document, 'mousedown', function ( evt ) {
        closeAllPopup(  );
    } );
})();