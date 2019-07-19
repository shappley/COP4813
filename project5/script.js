"use strict";

var project5 = project5 || {};

(function () {
    project5.confirmLogout = function () {
        return confirm("Are you sure you want to log out?")
            && !!window.location.replace("./logon.php?action=logoff");
    };

    project5.confirmRemove = function (title, movieId) {
        return confirm("Are you sure you want to remove " + title + "?")
            && !!window.location.replace("./index.php?action=remove&movie_id=" + movieId);
    };

    project5.confirmCheckout = function () {
        return confirm("Are you sure you want to checkout?")
            && !!window.location.replace("./index.php?action=checkout");
    };

    project5.addMovie = function (movieId) {
        window.location.replace("./index.php?action=add&movie_id=" + movieId);
        return true;
    };
})();