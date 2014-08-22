/*
    jQuery PreventPasswordTypo v1.0.2
    https://github.com/Lacosta/jQuery-preventPasswordTypo
    
    Copyright 2013, Dominic Vonk
    Licensed under the MIT license.
    https://github.com/Lacosta/jQuery-preventPasswordTypo/blob/master/LICENSE.md
  
    Date: Fri April 5 02:45:00 2013 +0100
 */
(function( $ ) {
    preventppisdisal = true;
     $.fn.preventPasswordTypo = function (onkey) {
        if (typeof onkey === "undefined") {
            $(this).keydown(function () {
                checkwhat = event.keyCode ? event.keyCode : event.which;
                var c = String.fromCharCode(checkwhat);
                var isWordcharacter = (/\w/.test(c));
                var isBackspaceOrDelete = (checkwhat == 8 || checkwhat == 46);
                var isPaste = ((event.ctrlKey || event.metaKey) && checkwhat == 86);
                if (isWordcharacter || isBackspaceOrDelete || isPaste) {
                    $(this).removeAttr("type");
                    $(this).prop("type", "text");
                }
            }).keyup(function () {
                what = this;
                if (typeof themastertimerofpreventtypo !== "undefined") {
                    clearTimeout(themastertimerofpreventtypo);
                }
                themastertimerofpreventtypo = setTimeout(function () {
                    if (preventppisdisal) {
                        $(what).removeAttr("type");
                        $(what).prop("type", "password");
                    }
                }, 1000);
            });
        } else {
            $(this).keydown(function (event) {
                checkwhat = event.keyCode ? event.keyCode : event.which;
                if (checkwhat == onkey) {
                    $(this).removeAttr("type");
                    $(this).prop("type", "text");
                }
            }).keyup(function (event) {
                checkwhat = event.keyCode ? event.keyCode : event.which;
                if (checkwhat == onkey) {
                    what = this;
                    if (preventppisdisal) {
                        $(what).removeAttr("type");
                        $(what).prop("type", "password");
                    }
                }
            });
        }
    };
    $.fn.preventPasswordTypoOn = function (onpass, onkey) {
        var what = this;
        if ($(what).prop('type') == "checkbox") {
            $(what).change(function () {
                if ($(what).is("input:checked")) {
                    $(onpass).removeAttr("type");
                    $(onpass).prop("type", "text");
                    preventppisdisal = false;
                } else {
                    $(onpass).removeAttr("type");
                    $(onpass).prop("type", "password");
                    preventppisdisal = true;
                }
            });
        }
        else {
            $(what).mousedown(function(){
                $(onpass).removeAttr("type");
                $(onpass).prop("type", "text");

            }).mouseup(function(){
                $(onpass).removeAttr("type");
                $(onpass).prop("type", "password");
            });
        }
    };
})( jQuery );