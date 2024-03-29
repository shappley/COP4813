<?php
require_once '/home/common/mail.php';
require_once '/home/common/dbInterface.php';
require_once("Template.php");
require_once("Util.php");
processPageRequest();

function authenticateUser($username, $password)
{
    $user = validateUser($username, $password);
    if ($user !== null) {
        session_start();
        $_SESSION["userId"] = $user[0];
        $_SESSION["displayName"] = $user[1];
        $_SESSION["emailAddress"] = $user[2];
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
    template("./templates/logon/create_form.php", array("title" => "Create Account"));
}

function displayForgotPasswordForm()
{
    template("./templates/logon/forgot_form.php", array("title" => "Forgot Password"));
}

function displayResetPasswordForm($userId)
{
    template("./templates/logon/reset_form.php", array("userId" => $userId, "title" => "Reset Password"));
}

function resetPassword($userId, $password)
{
    $status = resetUserPassword($userId, $password);
    if ($status) {
        displayLoginForm("Password reset successfully");
    } else {
        displayLoginForm("An error occurred. Try again later.");
    }
}

function sendForgotPasswordEmail($username)
{
    $user = getUserData($username);
    if ($user !== null) {
        $url = "http://139.62.210.181/~ss412345/project5/logon.php?form=reset&userId={$user[0]}";
        $message = "
            <h2>myMovies Express!</h2>
            <p>Dear {$username},</p>
            <p>it looks like you forgot your password.</p>
            <p>
            We have terrible security so I could just email you your password in plain text,
            but, instead, you should click 
            <a href='{$url}'>this link</a> to reset it.
            </p>
        ";
        $status = keepSendingMailUntilItActuallyWorks(
            $user[2], $user[1],
            "Forgot Password", $message
        );
        displayLoginForm("Sent forgot password email with status {$status}");
    }
}

function sendValidationEmail($userId, $displayName, $emailAddress)
{
    $url = "http://139.62.210.181/~ss412345/project5/logon.php?action=validate&userId={$userId}";
    $message = "
        <h2>myMovies Express!</h2>
        <p>Dear ${displayName},</p>
        <p>Click <a href='{$url}'>this link</a> to validate your account.</p>
    ";
    keepSendingMailUntilItActuallyWorks($emailAddress, $displayName, "Account Validation", $message);
    displayLoginForm("Check your email to validate your account");
}

function validateAccount($userId)
{
    $result = activateAccount($userId);
    $str = $result ? "true" : "false";
    displayLoginForm(
        "Account activated: {$str}. "
        . ($result ? "Your account was successfully activated" : "The function says you don't exist")
    );
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
    unset($_SESSION["userId"]);
    unset($_SESSION["displayName"]);
    unset($_SESSION["emailAddress"]);
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