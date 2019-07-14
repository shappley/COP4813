<?php
require_once("Template.php");
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

function createAccount($username, $password, $displayName, $emailAddress)
{
    //TODO
}

function displayCreateAccountForm()
{
    //TODO
}

function displayForgotPasswordForm()
{
    //TODO
}

function displayResetPasswordForm($userId)
{
    //TODO
}

function resetPassword($userId, $password)
{
    //TODO
}

function sendForgotPasswordEmail($username)
{
    //TODO
}

function sendValidationEmail($userId, $displayName, $emailAddress)
{
    //TODO
}

function validateAccount($userId)
{
    //TODO
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
    $data = array(
        "title" => "Log on",
        "page_content" => "./templates/logon/logon_form.php",
        "message" => $message
    );
    $template = new Template("./templates/template.php", $data);
    echo $template->render();
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