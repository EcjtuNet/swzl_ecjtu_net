/*
 * EcjtuNet browser.js
 *@author       Venshy at EcjtuNet
 *@last-time    2014-7-26
 */

function DOMContentLoad() {
    var url = window.location.href;
    var browser = function () {
            var w = window,ver = w.opera ? (opera.version().replace(/\d$/, "") - 0)
                : parseFloat((/(?:IE |fox\/|ome\/|ion\/)(\d+\.\d)/.
                    exec(navigator.userAgent) || [,0])[1]);
                return {
                    ie: !!w.VBArray && Math.max(document.documentMode||0, ver),
                    firefox: !!w.netscape && ver,
                    opera:  !!w.opera && ver,
                    chrome: !! w.chrome &&  ver ,
                    safari: /apple/i.test(navigator.vendor) && ver,
                    
                    isIphone: /iPhone/i.test( navigator.userAgent ),
                    isIpad: /iPad/i.test( navigator.userAgent ),
                    isAndroid: /android/i.test( navigator.userAgent ),
                }
        }
    var is = browser();
    if ( !is['isIphone'] && !is['isAndroid'] ) {
        return;
    } else {
        if ( url.charAt( url.length - 1 ) === '/' ) {
            window.location.href = url + 'm';
        } else {
            window.location.href = url + '/m';
        }
        if(window.event) {
            window.event.returnValue = false; 
        }
    }
}
HTMLElement.prototype.addEventListener.apply(window.document, ['DOMContentLoaded', DOMContentLoad, false]);