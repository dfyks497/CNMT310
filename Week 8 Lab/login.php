<?php
require_once("const.php");
session_start();

$_SESSION['loggedIn'] = false;
$_SESSION['error'] = "";
unset($_SESSION['loggedIn']);
unset($_SESSION['error']);

/*
  If either of these are not set, then it's more 
  than just the user leaving the form blank.
  Therefore, redirect right away rather than
  doing more work, even though this means a second
  exit path
*/
if (!isset($_POST['username']) || !isset($_POST['password'])) {
  $_SESSION['error'] = "Username or password are missing";
  die(header("Location: " . PAGE_LOGIN));
}

$_SESSION['loggedIn'] = validateUser($_POST['username'],$_POST['password']);

if ($_SESSION['loggedIn'] === true) {
  die(header("Location: " . PAGE_HOME));
} else {
  $_SESSION['error'] = "Username or password incorrect";
  die(header("Location: " . PAGE_LOGIN));
}

// Note this function uses a single return/exit path
function validateUser($user,$pass) {
  $result = false;
  $validUser = "steve";
  $validPass = '$2y$10$PmTVZ7692mUFzpLwKxD0BezY2VJvR5zBYJCiCt//wfatu6mfs4QfW';
  if ($user == $validUser && password_verify($pass,$validPass)) {
    $result = true;
  }
  return $result;
}