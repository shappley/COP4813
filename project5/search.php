<?php
require_once("Util.php");
session_start();
processPageRequest();

function displaySearchForm()
{
    template("./templates/search/search_form.php", array("title" => "Search for a Movie"));
}

function displaySearchResults($searchString)
{
    $results = getOmdbSearchResults($searchString);
    template("./templates/search/results_form.php", array("title" => "Search Results", "searchResults" => $results));
}

function processPageRequest()
{
    if (!isset($_SESSION["displayName"])) {
        header("Location: ./logon.php");
        exit;
    }

    if (isset($_POST["search"]) && !empty($_POST["search"])) {
        displaySearchResults($_POST["search"]);
    } else {
        displaySearchForm();
    }
}