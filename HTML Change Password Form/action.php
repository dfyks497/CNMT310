<?php

$required = array("username","password");
foreach ($required as $key => $value) {
    if (!isset($_POST[$key])) {
        die(header("Location: /"));
    }
}

print "Success";