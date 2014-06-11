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

$(document).ready(function() {

    var form = new Form();

    $('#form-upit-id').submit(function(evn) {
        form.setup();
        form.handleForm();
        if(form.isValid() === false) {
            evn.preventDefault();
            form.handleErrors();
        }
    });

    function Form() {
        var fields = {
            ime : {
                value : null,
                id : '#form_ime',
                object : null,
                valid : false
            },

            email : {
                value : null,
                id : '#form_email',
                object : null,
                valid : false
            }
        };

        this.setup = function() {
            for(var prop in fields) {
                if(fields.hasOwnProperty(prop)) {
                    fields[prop].object = $(fields[prop].id);
                    fields[prop].value = $(fields[prop].id).val();
                }
            }
        };

        this.handleForm = function() {
            var fieldValue;
            for(var prop in fields) {
                if(fields.hasOwnProperty(prop)) {
                    fieldValue = fields[prop].value;
                    if(fieldValue) {
                        fields[prop].valid = true;
                    }
                }
            }
        };

        this.isValid = function() {
            for(var prop in fields) {
                if(fields.hasOwnProperty(prop)) {
                    if(fields[prop].valid === false) {
                        return false;
                    }
                }
            }

            return true;
        };

        this.handleErrors = function() {
            var valid, error;
            for(var prop in fields) {
                if(fields.hasOwnProperty(prop)) {
                    valid = fields[prop].valid;
                    if(valid === false) {
                        error = '#' + 'js-error-' + $(fields[prop].object).attr('id');
                        $(error).fadeIn();
                    }
                    else if(valid === true) {
                        error = '#' + 'js-error-' + $(fields[prop].object).attr('id');
                        $(error).fadeOut();
                    }
                }
            }
        }
    }

    $('#form_upit').keypress(function() {
        var element = $(this).get(0);
        if(element.scrollHeight > element.clientHeight) {
            var height = $(this).height();
            $(this).animate({
                height : (element.clientHeight + 30) + 'px'
            })
        }

        if($(this).val() == '' && element.clientHeight > 150) {
            $(this).animate({
                height : '150px'
            })
        }
    });

    /* BROJAČ ZNAKOVA */

    ( function() {
        var brojac = $("<p class='brojac-znakova'>Preostalo znakova: <span id='trenutno'>0</span> od <span id='ukupno'>5000</span></p>");
        $('#form-submit-wrap-id').append(brojac);

        var textarea = document.getElementById('form_upit');
        var textareaCount = textarea.textLength;

        $('#form_upit').keypress(function(evn) {
            var trenutnoElem = document.getElementById('trenutno');
            var trenutniBroj = parseInt(trenutnoElem.textContent)

            if(textareaCount > 0) {
                trenutnoElem.textContent = textareaCount;
            }

            if(evn.keyCode == 8) {
                console.log('kreten');
                trenutnoElem.textContent = current - 1;
                previous = trenutniBroj - 1;
            }
            else {
                trenutnoElem.textContent = current + 1;
                previous = trenutniBroj + 1;
            }
        });
    } () );

    /* UREĐENJA NA NAJČEŠĆIM PITANJIMA */

    ( function() {
        $('.answer-list').addClass('answer-list-display');
        $('.question button').click(function() {
            $(this).next().slideToggle(300);
        })
    } () )
});