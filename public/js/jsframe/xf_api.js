(function (){
    var paths  = [
            'base/xf.js',
            'base/browser.js',
            'base/utils.js',
            'base/EventBase.js',
            'base/domUtils.js',
            'base/ajax.js',
            'ui/ui.js',
            'ui/uiutils.js',
            'ui/uibase.js',
            'ui/stateful.js',
            'ui/button.js',
            'ui/popup.js',
            'ui/mask.js',
            'ui/dialog.js'
        ],
        baseURL = 'public/js/jsframe/';
    for (var i=0,pi;pi = paths[i++];) {
        document.write('<script type="text/javascript" src="'+ baseURL + pi +'"></script>');
    }
})();
