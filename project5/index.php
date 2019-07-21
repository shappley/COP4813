<?php
session_start();
require_once '/home/common/mail.php';
require_once '/home/common/dbInterface.php';
require_once("Template.php");
require_once("Util.php");
processPageRequest();

function getOmdbDataById($id)
{
    $url = "http://www.omdbapi.com/?apikey=178bb728&type=movie&r=json&i={$id}";
    $json = file_get_contents($url);
    return json_decode($json, true);
}

function addMovieToCart($movieID)
{
    $result = movieExistsInDB($movieID);
    if ($result === 0) {
        $movie = getOmdbDataById($movieID);
        $result = addMovie(
            $movie["imdbID"], $movie["Title"], $movie["Year"],
            $movie["Rated"], $movie["Runtime"], $movie["Genre"],
            $movie["Actors"], $movie["Director"], $movie["Writer"],
            $movie["Plot"], $movie["Poster"]
        );
    }
    addMovieToShoppingCart($_SESSION["userId"], $result);
    displayCart();
}

function checkout($name, $address)
{
    $message = displayCart(true);
    $result = keepSendingMailUntilItActuallyWorks($address, $name, "Your receipt from myMovies Express", $message);
    echo "
        <script>
            window.onload = function (ev) { 
                setTimeout(function() {
                    window.location.replace('./index.php')
                }, 5000);
            };
        </script>
        <p>Message sent with response {$result}. You will be redirected in 5 seconds.</p>
    ";
}

function createMovieList($forEmail = false)
{

}

function displayCart($forEmail = false)
{
    $movies = readMovieData();
    require_once("./templates/cart_form.php");
}

function processPageRequest()
{
    if (isset($_GET["action"]) && !empty($_GET["action"])) {
        $action = $_GET["action"];
        if ($action === "add") {
            addMovieToCart($_GET["movie_id"]);
        } else if ($action === "remove") {
            removeMovieFromCart($_GET["movie_id"]);
        } else if ($action === "checkout") {
            checkout($_SESSION["username"], $_SESSION["email"]);
        }
    } else {
        displayCart();
    }
}

function readMovieData()
{
    $csv = array_map('str_getcsv', file('./data/cart.db'));
    return $csv != null ? $csv[0] : [];
}

function removeMovieFromCart($movieID)
{
    $array = readMovieData();
    $diff = array_diff($array, [$movieID]);
    writeMovieData($diff);
    displayCart();
}

function updateMovieListing($order)
{

}

function writeMovieData($array)
{
    $csv = implode(",", $array);
    file_put_contents("./data/cart.db", $csv);
}