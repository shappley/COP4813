"use strict";

var project5 = project5 || {};

(function () {
    var $get = function (url, callback) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = callback;
        request.open("GET", url, true);
        request.send();
    };

    var $id = function (id) {
        return document.getElementById(id);
    };

    project5.addMovie = function (movieId) {
        return !!window.location.replace("./index.php?action=add&movieId=" + movieId);
    };

    project5.confirmCancel = function (form) {
        var location = "./index.php";
        if (form === "create" || form === "forgot" || form === "reset") {
            location = "./logon.php";
        }
        return confirm("Are you sure you want to cancel?")
            && !!window.location.replace(location);
    };

    project5.changeMovieDisplay = function () {
        var selected = document.getElementById("select_order").value;
        var url = "./index.php?action=update&order=" + selected;
        $get(url, function () {
            document.getElementById("shopping_cart").innerHTML = this.responseText;
        });
    };

    project5.confirmCheckout = function () {
        return confirm("Are you sure you want to checkout?")
            && !!window.location.replace("./index.php?action=checkout");
    };

    project5.confirmLogout = function () {
        return confirm("Are you sure you want to log out?")
            && !!window.location.replace("./logon.php?action=logoff");
    };

    project5.confirmRemove = function (title, movieId) {
        return confirm("Are you sure you want to remove " + title + "?")
            && !!window.location.replace("./index.php?action=remove&movieId=" + movieId);
    };

    project5.displayMovieInformation = function (movieId) {
        $get("./movieinfo.php?movieId=" + movieId, function () {
            document.getElementById("modalWindowContent").innerHTML = this.responseText;
            project5.showModalWindow();
        });
    };

    project5.forgotPassword = function () {
        return !!window.location.replace("./logon.php?action=forgot");
    };

    project5.showModalWindow = function () {
        var modal = document.getElementById('modalWindow');
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function () {
            modal.style.display = "none";
        };
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
        modal.style.display = "block";
    };

    var anyContainSpace = function (values) {
        for (var i = 0; i < values.length; i++) {
            if (values[i].indexOf(" ") >= 0) {
                return true;
            }
        }
        return false;
    };

    project5.validateCreateAccountForm = function () {
        var email = $id("emailAddress").value;
        var confirmEmail = $id("confirmEmail").value;
        var username = $id("username").value;
        var password = $id("password").value;
        var confirmPassword = $id("confirmPassword").value;

        if (anyContainSpace([email, confirmEmail, username, password, confirmPassword])) {
            alert("No value except Display Name can contain a space.");
            return false;
        } else if (email !== confirmEmail) {
            alert("Confirmation Email not equal to Email");
            return false;
        } else if (password !== confirmPassword) {
            alert("Confirmation Password not equal to Password");
            return false;
        }
        return true;
    };

    project5.validateResetPasswordForm = function () {
        var password = $id("password").value;
        var confirmPassword = $id("confirmPassword").value;
        if (anyContainSpace([password, confirmPassword])) {
            alert("Password cannot contain spaces");
            return false;
        } else if (password !== confirmPassword) {
            alert("Confirmation Password not equal to Password");
            return false;
        }
        return true;
    };
})
();