"use strict";

var project3 = project3 || {};

(function () {
    var id = function (id) {
        return document.getElementById(id);
    };

    var sorted = function (array) {
        return array.slice(0).sort(function (a, b) {
            return a - b;
        });
    };

    var calcMean = function (array) {
        return (calcSum(array) / array.length).toFixed(2);
    };

    var calcMedian = function (array) {
        var sort = sorted(array);
        if (sort.length % 2 === 0) {
            //minus 1 since arrays are zero-based
            var middle = (sort.length / 2) - 1;
            return calcMean([sort[middle], sort[middle + 1]]);
        } else {
            return sort[Math.ceil(array.length / 2)].toFixed(2);
        }
    };

    var calcMode = function (array) {
        var counts = {};
        var modes = [];
        //get the number of occurrences for each number
        array.forEach(function (value) {
            counts[value] ? counts[value]++ : counts[value] = 1;
        });
        //sort the keys by the values - highest first
        //gets the highest frequency item
        var mostFrequent = Object.keys(counts).sort(function (a, b) {
            return counts[b] - counts[a];
        })[0];
        //find any elements who appears the same number of times
        //as the most frequent (to get all modal values)
        Object.keys(counts).forEach(function (value) {
            if (counts[value] === counts[mostFrequent]) {
                modes.push(value);
            }
        });
        return modes;
    };

    var calcStdDev = function (array) {
        return Math.sqrt(calcVariance(array)).toFixed(2);
    };

    var calcSum = function (array) {
        var val = 0;
        array.forEach(function (value) {
            val += value;
        });
        return val.toFixed(2);
    };

    var calcVariance = function (array) {
        var mean = calcMean(array);
        var variance = 0;
        array.forEach(function (value) {
            variance += Math.pow((value - mean), 2);
        });
        variance /= array.length;
        return variance.toFixed(2);
    };

    var findMax = function (array) {
        var max = Number.MIN_VALUE;
        array.forEach(function (value) {
            if (value > max) max = value;
        });
        return max.toFixed(2);
    };

    var findMin = function (array) {
        var min = Number.MAX_VALUE;
        array.forEach(function (value) {
            if (value < min) min = value;
        });
        return min.toFixed(2);
    };

    project3.performStatistics = function () {
        var numbers = id("numbers").value.split(" ").map(function (value) {
            return parseFloat(value);
        });
        var min, max;
        //from the instructions: "users can enter a series of numbers (5 to 20 numbers ranging in value between 0 and 100)"
        if (numbers.length < 5 || numbers.length > 20 || (min = findMin(numbers)) < 0 || (max = findMax(numbers)) > 100) {
            alert("You must enter 5 to 20 numbers between 0 and 100.");
            return false;
        }

        id("max").value = max;
        id("min").value = min;
        id("sum").value = calcSum(numbers);
        id("mean").value = calcMean(numbers);
        id("median").value = calcMedian(numbers);
        id("mode").value = calcMode(numbers);
        id("stddev").value = calcStdDev(numbers);
        id("variance").value = calcVariance(numbers);

        return false;
    };
})();