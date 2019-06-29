<?php
processPageRequest();

function authenticateUser($username, $password)
{

}

function displayLoginForm($message = "")
{
    require_once("./templates/logon_form.php");
}

function processPageRequest()
{
    displayLoginForm();
}