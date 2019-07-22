<?php
session_start();
require_once '/home/common/dbInterface.php';
processPageRequest();

function createMessage($movieId)
{
    $movie = getMovieData($movieId);
    ob_start();
    require_once './templates/movie_info.php';
    $message = ob_get_contents();
    ob_end_clean();
    echo $message;
}

function processPageRequest()
{
    if (!isset($_SESSION["displayName"])) {
        header("Location: ./logon.php");
        exit;
    }

    $movieId = 0;
    if (isset($_GET["movieId"])) {
        $movieId = $_GET["movieId"];
    }
    createMessage($movieId);
}