<?php
session_start();
require_once '/home/common/mail.php';
require_once '/home/common/dbInterface.php';
require_once("Template.php");
require_once("Util.php");
processPageRequest();

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
    echo displayCart();
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
    if ($count === false) {
        header("Location: ./logon.php");
        exit;
    }
    $movieList = createMovieList($forEmail);
    //i'm using my own template file
    //it does the same thing with ob_start()
    $template = new Template(
        "./templates/template.php",
        "./templates/cart/cart_form.php",
        array("count" => $count, "movieList" => $movieList, "title" => "Shopping Cart")
    );
    return $template->render();
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
        } else if ($action === "checkout") {
            checkout($_SESSION["displayName"], $_SESSION["emailAddress"]);
        } else if ($action === "remove") {
            removeMovieFromCart($_GET["movieId"]);
            echo displayCart();
        } else if ($action === "update") {
            updateMovieListing($_GET["order"]);
        } else {
            echo displayCart();
        }
    } else {
        echo displayCart();
    }
}

function removeMovieFromCart($movieID)
{
    removeMovieFromShoppingCart($_SESSION["userId"], $movieID);
    displayCart();
}

function updateMovieListing($order)
{
    $_SESSION["order"] = $order;
    echo createMovieList(false);
}