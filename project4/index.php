<?php
session_start();
require_once('/home/common/mail.php');
processPageRequest();

function getOmdbDataById($id)
{
    $url = "http://www.omdbapi.com/?apikey=178bb728&type=movie&r=json&i=" . $id;
    $json = file_get_contents($url);
    return json_decode($json, true);
}

function addMovieToCart($movieID)
{
    $arr = readMovieData();
    array_push($arr, $movieID);
    writeMovieData($arr);
    displayCart();
}

function checkout($name, $address)
{
    $movies = readMovieData();
    $message = "<table><tbody>";
    foreach ($movies as $movie) {
        $omdb = getOmdbDataById($movie);
        $message .= "
            <tr>
            <td><img style='height: 100px;' src='{$omdb['Poster']}'></td>
            <td><a href='https://www.imdb.com/title/{$omdb['imdbID']}/'>{$omdb['Title']} ({$omdb['Year']})</a></td>
            </tr>
        ";
    }
    $message .= "</tbody></table>";

    for ($i = 0; $i < 10; $i++) {
        $result = sendMail("854505548", $address, $name, "Your Receipt From myMovies Express!", $message);
        if ($result > 0) {
            sleep($result);
        } else {
            break;
        }
    }

    echo "Message sent with response " . $result;
}

function displayCart()
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

function writeMovieData($array)
{
    $csv = implode(",", $array);
    file_put_contents("./data/cart.db", $csv);
}