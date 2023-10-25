<?php
require_once("const.php");
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
  die(header("Location:" . PAGE_LOGIN));
}

print "<!doctype html>";
print "<html lang=\"en\"><head><title>My Account</title></head>\n";
print "<body>\n";
print "<div>\n";
print "<h1>Welcome to your account page</h1>\n";
print "<a href=\"" . PAGE_HOME . "\">Click here to go to the home page</a><br><br>\n";
print "<a href=\"" . PAGE_BOOKMARK . "\">Click here to go to bookmarks page</a><br><br>\n";
print "<a href=\"" . ACTION_LOGOUT . "\">Click here to logout</a>\n";
print "</div>\n";
print "</body>\n";
print "</html>\n";