<?php
session_start();
processPageRequest();

function displaySearchForm()
{
    require_once("./templates/search_form.php");
}

function displaySearchResults($searchString)
{
    $results = getSearchResults($searchString);
    require_once("./templates/search_form.php");
}

function getSearchResults($search)
{
    $url = "http://www.omdbapi.com/?apikey=178bb728&type=movie&r=json&s=" . urlencode($search);
    $json = file_get_contents($url);
    return json_decode($json, true)["Search"];
}

function processPageRequest()
{
    if (isset($_POST["search"]) && !empty($_POST["search"])) {
        displaySearchResults($_POST["search"]);
    } else {
        displaySearchForm();
    }
}