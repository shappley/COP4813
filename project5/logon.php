<?php
//require_once '/home/common/mail.php';
//require_once '/home/common/dbInterface.php';
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
    $id = addUser($username, $password, $displayName, $emailAddress);
    if ($id === 0) {
        displayLoginForm("The provided username already exists");
    } else if ($id > 0) {
        sendValidationEmail($id, $displayName, $emailAddress);
    } else {
        displayLoginForm("An error occurred ({$id})");
    }
}

function displayCreateAccountForm()
{
    template("./templates/logon/create_form.php");
}

function displayForgotPasswordForm()
{
    template("./templates/logon/forgot_form.php");
}

function displayResetPasswordForm($userId)
{
    template("./templates/logon/reset_form.php", array("userId" => $userId));
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
        "message" => $message
    );
    template("./templates/logon/logon_form.php", $data);
}

function processPageRequest()
{
    session_unset();
    if (isset($_POST) && isset($_POST["action"])) {
        $action = $_POST["action"];
        if ($action === "create") {
            createAccount(
                $_POST["username"], $_POST["password"],
                $_POST["displayName"], $_POST["emailAddress"]
            );
        } else if ($action === "forgot") {
            sendForgotPasswordEmail($_POST["username"]);
        } else if ($action === "login") {
            authenticateUser($_POST["username"], $_POST["password"]);
        } else if ($action === "reset") {
            resetPassword($_POST["userId"], $_POST["password"]);
        } else {
            displayLoginForm();
        }
    } else if (isset($_GET) && isset($_GET["action"]) && $_GET["action"] === "validate") {
        validateAccount($_GET["userId"]);
    } else if (isset($_GET) && isset($_GET["form"])) {
        $form = $_GET["form"];
        if ($form === "create") {
            displayCreateAccountForm();
        } else if ($form === "forgot") {
            displayForgotPasswordForm();
        } else if ($form === "reset") {
            displayResetPasswordForm($_GET["userId"]);
        }
    } else {
        displayLoginForm();
    }
}

function template($template_file, $data = array())
{
    $template = new Template(
        "./templates/template.php",
        $template_file,
        $data
    );
    echo $template->render();
}