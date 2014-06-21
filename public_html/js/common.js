/**
 * Created by Mario on 14.05.14..
 */

"use strict";

var ICOOAPP = ICOOAPP || {};

ICOOAPP.namespace = function (ns_string) {
    var parts = ns_string.split('.'),
        parent = ICOOAPP,
        i;

    if (parts[0] === "ICOOAPP") {
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

ICOOAPP.namespace('ICOOAPP.EventFunctions');

(function() {
    var event = ICOOAPP.EventFunctions;

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

    event.removeEvent = function(elem, eventType, handler) {
        if (elem.removeEventListener)
            elem.removeEventListener(eventType, handler, false);
        if (elem.detachEvent)
            elem.detachEvent('on' + eventType, handler);
    };

    event.hover = function() {

    }
} () );

ICOOAPP.namespace('ICOOAPP.cache');

( function() {
    var cache = ICOOAPP.cache;

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

ICOOAPP.namespace('ICOOAPP.globals');

( function() {
    var globals = ICOOAPP.globals;

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

