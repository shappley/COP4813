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

    var $id = function (e) {
        return document.getElementById(e);
    };

    project2.updateForm = function (selected) {
        if (selected) {
            var paypal = $id("paypalInfo");
            var cc = $id("creditCardInfo");
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

    project2.validateForm = function () {
        if ($id("paymentTypeCreditCard").checked) {
            //TODO
        } else if ($id("paymentTypePaypal").checked) {
            var email = $id("paypalEmail").value;
            var password = $id("paypalPassword").value;
            if (!validateEmail(email)) {
                alert("Enter a valid email address");
            } else if (!validatePassword(password, 8)) {
                alert("Password must be >= 8 characters");
            } else {
                alert("Payment Submitted");
            }
        }
        return false;
    };

    var testLength = function (value, length, exactLength) {
        return (exactLength && value.length === length) || value.length >= length;
    };

    var testNumber = function (value) {
        return !isNaN(parseFloat(value));
    };

    var validateControl = function (control, name, length) {
        var val = control.value;
        return testNumber(val)
            && ((name === "zip" && testLength(val, 5, true))
                || (name === "cvc" && testLength(val, 3, true)));
    };

    var validateCreditCard = function (value) {
        return /^3\d{15}|[4-6]\d{16}$/.test(value.replace(/\s/g, ""));
    };

    var validateDate = function (value) {
        var date = new Date(value);
        var today = new Date();
        return date.getFullYear() >= today.getFullYear()
            && date.getMonth() > today.getMonth();
    };

    var validateEmail = function (value) {
        return /^[A-Za-z0-9_+.]+@[A-Za-z0-9_+.]+\.[A-Za-z0-9-_]+$/.test(value);
    };

    var validatePassword = function (value, minLength) {
        return testLength(value, minLength, false);
    };

    var validateState = function () {
        var state = $id("state");
        return state.selectedIndex !== 0;
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