"use strict";

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