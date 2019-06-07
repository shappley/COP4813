"use strict";

//quick helper function to leftpad a string
//the month variable returned by a Date object can be single digits
//which doesn't work when used in the "value" attribute
String.prototype.leftPad = function (len, str) {
    var s = "";
    for (var i = this.length; i < len; i++) {
        s += str;
    }
    return s + this;
};

//scope the project because polluting global namespace = bad
var project2 = project2 || {};

(function () {
    project2.validateForm = function () {
        return false;
    };

    project2.updateForm = function (selected) {
        if (selected) {
            var paypal = document.getElementById("paypalInfo");
            var cc = document.getElementById("creditCardInfo");
            if (selected.id === "paymentTypePaypal") {
                paypal.style.display = ("block");
                cc.style.display = ("none");
                toggleRequired(paypal, true);
                toggleRequired(cc, false);
            } else if (selected.id === "paymentTypeCreditCard") {
                paypal.style.display = ("none");
                cc.style.display = ("block");
                toggleRequired(paypal, false);
                toggleRequired(cc, true);
            }
        }
    };

    project2.formatDateInput = function (input) {
        var date = new Date(input.value);
        var ds = date.getFullYear() + "-"
            + ("" + (date.getUTCMonth() + 1)).leftPad(2, "0")
            + "-" + "01";
        input.value = ds;
    };

    //helper function that recursively adds/removes the `required` attribute.
    //this was done so i didn't need to put the entire form into a string variable like your video suggested
    var toggleRequired = function (section, required) {
        var children = section.childNodes;
        for (var i in children) {
            var c = children[i];
            if (c && c.nodeName) {
                if (c.nodeName.toLowerCase() === "input" || c.nodeName.toLowerCase() === "select") {
                    if (required) {
                        c.setAttribute("required", "");
                    } else {
                        c.removeAttribute("required");
                    }
                } else if (c.hasChildNodes()) {
                    toggleRequired(c, required);
                }
            }
        }
    };
})();