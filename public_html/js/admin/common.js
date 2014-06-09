/**
 * Created by Mario on 13.05.14..
 */

"use strict";

var FRIZERADMIN = FRIZERADMIN || {};

FRIZERADMIN.namespace = function (ns_string) {
    var parts = ns_string.split('.'),
        parent = FRIZERADMIN,
        i;

    if (parts[0] === "FRIZERADMIN") {
        parts = parts.slice(1);
    }
    for (i = 0; i < parts.length; i += 1) {
        if (typeof parent[parts[i]] === "undefined") {
            parent[parts[i]] = {};
        }

        parent = parent[parts[i]];
    }
    return parent;
};

FRIZERADMIN.namespace('FRIZERADMIN.EventFunctions');

(function() {
    var event = FRIZERADMIN.EventFunctions;

    event.catchEvent = function(eventObj, event, eventHandler) {
        if (eventObj !== null) {
            if (eventObj.addEventListener) {
                eventObj.addEventListener(event, eventHandler, false);
            } else if (eventObj.attachEvent) {
                event = "on" + event;
                eventObj.attachEvent(event, eventHandler);
            }
        }
    };

    event.cancelEvent = function(evn) {
        var event = evn ? evn : window.event;

        if (event.preventDefault) {
            event.preventDefault();    // za ostale browsere, sprječava početno ponašanje eventa, u ovom slučaju submit
            event.stopPropagation();   // za ostale browsere spječava ekspanziju evenata na ostale elemente
        } else {
            event.returnValue = false;  // za IE, ukida event, isto kao i return false;
            event.cancelBubble = true;   // za IE, sprječava ekspanziju evenata na ostale elemente
        }
    };
} () );

FRIZERADMIN.namespace('FRIZERADMIN.globals');

( function() {
    var globals = FRIZERADMIN.globals;

    globals.getWidth = function() {
        var xWidth = null;
        if(window.screen != null)
            xWidth = window.screen.availWidth;

        if(window.innerWidth != null)
            xWidth = window.innerWidth;

        if(document.body != null)
            xWidth = document.body.clientWidth;

        return xWidth;
    };

    globals.getHeight = function() {
        var xHeight = null;
        if(window.screen != null)
            xHeight = window.screen.availHeight;

        if(window.innerHeight != null)
            xHeight =   window.innerHeight;

        if(document.body != null)
            xHeight = document.body.clientHeight;

        return xHeight;
    };
} () );

FRIZERADMIN.namespace('FRIZERADMIN.cache');

( function() {
    var cache = FRIZERADMIN.cache;

    cache.flash = {};
    cache.local = {};

    cache.createCache = function(cacheName) {
        if( ! cache.hasOwnProperty(cacheName)) {
            console.log('Cache ' + cacheName + ' has been created');
            cache[cacheName] = {};
        }

        return cache;
    };

    cache.getCache = function(cacheName) {
        if(cache.hasOwnProperty(cacheName)) {
            return cache[cacheName];
        }

        return false;
    };

    cache.save = function(propName, propValue, cacheName) {
        if( ! cache.hasOwnProperty(cacheName)) {
            console.log('save() : Cache ' + cacheName + ' does not exist');
            return false;
        }

        if(cache[cacheName].hasOwnProperty(propName)) {
            console.log('Cache ' + cacheName + ' already has that property');
            return false;
        }

        cache[cacheName][propName] = propValue;
        return true;
    };

    cache.update = function(propName, propValue, cacheName) {
        if(  ! cache.hasOwnProperty(cacheName)) {
            console.log('save() : Cache ' + cacheName + ' does not exist');
            return false;
        }

        if(cache[cacheName].hasOwnProperty(propName)) {
            cache[cacheName][propName] = propValue;
            return true;
        }

        return false;
    }

    cache.getStored = function(propName, cacheName) {
        if( ! cache.hasOwnProperty(cacheName)) {
            console.log('getStored(): ' + cacheName + ' doesnt have the property ' + propName);
            return false;
        }

        return cache[cacheName][propName];
    };

    cache.removeStored = function(propName, cacheName) {
        if( ! cache.hasOwnProperty(cacheName)) {
            console.log('removeStored(): ' + cacheName + ' doesnt have the property ' + propName);
            return false;
        }

        delete cache[cacheName][propName];
    };

    cache.hasProperty = function(propName, cacheName) {
        if(cache[cacheName].hasOwnProperty(propName) && cache[cacheName] != 'undefined' && cache[cacheName] !== null) {
            return true;
        }

        return false;
    };

    cache.setFlash = function(propName, propValue) {
        cache.flash[propName] = propValue;
    };

    cache.getFlash = function(propName) {
        if(cache.flash.hasOwnProperty(propName)) {
            var prop = cache.flash[propName];
            delete cache.flash[propName];

            return prop;
        }

        return false;
    };

    cache.setCallback = function(callback) {

    }
}());

FRIZERADMIN.namespace('FRIZERADMIN.ajax');

( function() {
    var ajax = FRIZERADMIN.ajax;
    var xmlhttp;

    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }

    ajax.request = xmlhttp;
} () );
