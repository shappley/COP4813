<?php
require_once '/home/common/mail.php';
require_once("Template.php");

function keepSendingMailUntilItActuallyWorks($email_address, $display_name, $subject, $message)
{
    $result = -1;
    while ($result !== 0) {
        $result = sendMail(854505548, $email_address, $display_name, $subject, $message);
        if ($result > 0) {
            sleep($result);
        } else if ($result < -1) {
            break;
        }
    }
    return $result;
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

function getOmdbDataById($id)
{
    $url = "http://www.omdbapi.com/?apikey=178bb728&type=movie&r=json&i={$id}";
    $json = file_get_contents($url);
    return json_decode($json, true);
}

function getOmdbSearchResults($search)
{
    $url = "http://www.omdbapi.com/?apikey=178bb728&type=movie&r=json&s=" . urlencode($search);
    $json = file_get_contents($url);
    return json_decode($json, true)["Search"];
}