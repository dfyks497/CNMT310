<?php
require_once("const.php");
session_start();

$_SESSION['loggedIn'] = false;
unset($_SESSION['loggedIn']);

foreach ($_SESSION as $key => $value) {
    unset($_SESSION[$key]);
}
session_destroy();
session_unset();
session_write_close();
die(header("Location: " . PAGE_LOGIN));