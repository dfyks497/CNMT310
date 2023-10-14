<?php
// $validPass = password_hash("boo",PASSWORD_DEFAULT);

$userAccount = array('username' => 'dennis', 'password' => '$2y$10$Uyw7d9NFRkypDDnMb1/TXeVbOJZHeShu9.3tH0UswVdeg3e/rYOvG');

// https://stackoverflow.com/questions/28777299/how-to-use-ob-start-on-a-string
ob_start();
include 'form.php';
$form = ob_get_clean();
$start = strpos($form, '<!DOCTYPE html>');
$end = strpos($form, '</form>', $start);
$formContent = substr($form, $start, $end - $start + 7);
ob_end_clean();

function echo_form($errorMessage, $formContent) {
    echo $formContent . "\n" . "<h4>$errorMessage</h4>" . "</body></html>";
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    echo_form("Your username or password was not entered! Enter both and try again.", $formContent);
}

else {
    if($_POST['username'] === $userAccount['username'] && password_verify($_POST['password'], $userAccount['password'])) {
        echo 
        '<!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Password Validated</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <h1>
                Authentication complete!
            </h1>
            <h3>
                You have successfully entered your username and password.
            </h3>
            </body>
        </html>';
    }
    else {
        echo_form("Your username or password was invalid! Check your spelling and try again.", $formContent);
    }
}