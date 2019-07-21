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
    $order = 0;
    if (isset($_SESSION["order"])) {
        $order = $_SESSION["order"];
    }
    $movies = getMoviesInCart($_SESSION["userId"], $order);
    ob_start();
    require_once './templates/cart/movie_list.php';
    $message = ob_get_contents();
    ob_end_clean();
    return $message;
}

function displayCart($forEmail = false)
{
    $count = countMoviesInCart($_SESSION["userId"]);
    if (!$count) {
        header("Location: ./logon.php");
        exit;
    }
    $movieList = createMovieList($forEmail);
    ob_start();
    require_once './templates/cart/cart_form.html';
    $message = ob_get_contents();
    ob_end_clean();
    return $message;
}

function processPageRequest()
{
    if (!isset($_SESSION["displayName"])) {
        header("Location: ./logon.php");
        exit;
    }
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        if ($action === "add") {
            addMovieToCart($_GET["movieId"]);
            echo displayCart();
        } else if ($action === "checkout") {
            checkout($_SESSION["displayName"], $_SESSION["emailAddress"]);
        } else if ($action === "remove") {
            removeMovieFromCart($_GET["movieId"]);
            echo displayCart();
        } else if ($action === "update") {
            updateMovieListing($_GET["order"]);
        } else {
            displayCart();
        }
    } else {
        displayCart();
    }
}

function removeMovieFromCart($movieID)
{
    removeMovieFromShoppingCart($_SESSION["userId"], $movieID);
    displayCart();
}

function updateMovieListing($order)
{

}