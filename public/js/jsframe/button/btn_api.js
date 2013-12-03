/**
 * 开发版本的文件导入
 */
(function (){
    var paths  = [
            'base/xf.js',
            'base/browser.js',
            'base/utils.js',
            'base/EventBase.js',
            'base/domUtils.js',
            'ui/ui.js',
            'ui/uiutils.js',
            'ui/uibase.js',
            'ui/stateful.js',
            'ui/button.js'
        ],
        baseURL = '../';
    for (var i=0,pi;pi = paths[i++];) {
        document.write('<script type="text/javascript" src="'+ baseURL + pi +'"></script>');
    }
})();
