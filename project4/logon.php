<?php
processPageRequest();

function authenticateUser($username, $password)
{
    $user = getUser($username, $password);
    if ($user !== null) {
        session_start();
        $_SESSION["username"] = $user[0];
        $_SESSION["email"] = $user[3];
        header("Location: ./index.php");
        exit;
    } else {
        displayLoginForm("Incorrect username or password.");
    }
}

function getUser($username, $password)
{
    $credentials = array_map("str_getcsv", file("data/credentials.db"));
    foreach ($credentials as $user) {
        if ($user[0] === $username && $user[1] === $password) {
            return $user;
        }
    }
    return null;
}

function displayLoginForm($message = "")
{
    require_once("./templates/logon_form.php");
}

function processPageRequest()
{
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);
    if (posted()) {
        authenticateUser($_POST["username"], $_POST["password"]);
    } else {
        displayLoginForm();
    }
}

function posted()
{
    return isset($_POST["username"]) && !empty($_POST["username"])
        && isset($_POST["password"]) && !empty($_POST["password"]);
}