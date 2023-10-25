<?php
require_once("const.php");
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
  die(header("Location:" . PAGE_LOGIN));
}

print "<!doctype html>";
print "<html lang=\"en\"><head><title>Home</title></head>\n";
print "<body>\n";
print "<div>\n";
print "<h1>Welcome to the home page</h1>\n";
print "<a href=\"" . PAGE_ACCOUNT . "\">Click here to go to your account page</a><br><br>\n";
print "<a href=\"" . PAGE_BOOKMARK . "\">Click here to go to bookmarks page</a>\n";
print "</div>\n";
print "</body>\n";
print "</html>\n";