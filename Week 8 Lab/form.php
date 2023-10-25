<?php
require_once("const.php");
session_start();

print "<!doctype html>";
print "<html lang=\"en\"><head><title>Login</title></head>\n";
print "<body>\n";
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
  print "<p>" . $_SESSION['error'] . "</p>\n";
  unset($_SESSION['error']);
}
print "<form action=\"" . ACTION_LOGIN . "\" method=\"POST\">\n";
print "Username: <input type=\"text\" name=\"username\">\n";
print "Password: <input type=\"password\" name=\"password\">\n";
print "<input type=\"submit\" name=\"Submit\">\n";
print "</form>\n";
print "</body>\n";
print "</html>\n";