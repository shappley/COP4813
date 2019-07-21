<?php
require_once '/home/common/mail.php';

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