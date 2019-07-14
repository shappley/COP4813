<?php
require_once '/home/common/mail.php';
require_once '/home/common/dbInterface.php';
require_once("Template.php");
processPageRequest();

function authenticateUser($username, $password)
{
    $user = validateUser($username, $password);
    if ($user !== null) {
        session_start();
        $_SESSION["user_id"] = $user[0];
        $_SESSION["username"] = $user[1];
        $_SESSION["email"] = $user[2];
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