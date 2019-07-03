"use strict";

var project4 = project4 || {};

(function () {
    project4.confirmLogout = function () {
        return confirm("Are you sure you want to log out?")
            && !!window.location.replace("./logon.php?action=logoff");
    };

    project4.confirmRemove = function (title, movieId) {
        return confirm("Are you sure you want to remove " + title + "?")
            && !!window.location.replace("./index.php?action=remove&movie_id=" + movieId);
    };

    project4.confirmCheckout = function () {
        return confirm("Are you sure you want to checkout?")
            && !!window.location.replace("./index.php?action=checkout");
    };

    project4.addMovie = function (movieId) {
        window.location.replace("./index.php?action=add&movie_id=" + movieId);
        return true;
    };
})();