"use strict";

var project4 = project4 || {};

(function () {
    project4.confirmLogout = function () {
        return confirm("Are you sure you want to log out?");
    };

    project4.confirmRemove = function (title, movieId) {
        return confirm("Are you sure you want to remove " + title + "?")
    };
})();