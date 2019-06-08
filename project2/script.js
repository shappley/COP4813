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
        input.value = date.getFullYear() + "-"
            + ("" + (date.getUTCMonth() + 1)).leftPad(2, "0")
            + "-" + "01";
    };

    project2.validateForm = function () {
        if ($id("paymentTypeCreditCard").checked) {
            var zip = $id("zip");
            var email = $id("ccEmailAddress").value;
            var cardNumber = $id("cardNumber").value;
            var securityCode = $id("securityCode");
            var expirationDate = $id("expirationDate").value;
            if (!validateState()) {
                alert("You must select a state");
            } else if (!validateControl(zip, "zip", 5)) {
                alert("You must enter a valid, 5-digit Zip Code");
            } else if (!validateEmail(email)) {
                alert("Enter a valid email address");
            } else if (!validateCreditCard(cardNumber)) {
                alert("You must enter a valid Credit Card number");
            } else if (!validateControl(securityCode, "cvc", 3)) {
                alert("You must enter a valid, 3-digit Security Code")
            } else if (!validateDate(expirationDate)) {
                alert("You must enter an Expiration Date of at least one (1) month in the future.")
            } else {
                alert("Payment Submitted");
            }
        }
        else if ($id("paymentTypePaypal").checked) {
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
        return /^\d+$/.test("" + value);
    };

    var validateControl = function (control, name, length) {
        var val = control.value;
        return testLength(val, length, true) && testNumber(val);
    };

    var validateCreditCard = function (value) {
        return /^(3\d{14}|[4-6]\d{15})$/.test(value.replace(/\s/g, ""));
    };

    var validateDate = function (value) {
        var date = new Date(value);
        var today = new Date();
        var years = (date.getFullYear() - today.getFullYear());
        var months = (date.getMonth() + 2) - (today.getMonth() + 1);
        return ((years * 12) + months) >= 1;
    };

    var validateEmail = function (value) {
        return /^[A-Za-z0-9-_+.]+@([A-Za-z0-9-_+]+\.)*[A-Za-z0-9-_+]+\.[A-Za-z0-9-_]+$/.test(value);
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