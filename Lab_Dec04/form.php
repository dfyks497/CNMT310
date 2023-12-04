<?php
require_once("page.php");
require_once("WebServiceClient.php");

$page = new Lab\Page("Form");
print $page->getTopSection();

print "<form action=\"#\" method=\"POST\">\n";
print "Zip code: <input type=\"number\" name=\"zipcode\">\n";
print "<input type=\"submit\" name=\"Submit\">\n";
print "</form>\n";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zipcode']) && !empty($_POST["zipcode"]) && strlen($_POST["zipcode"]) == 5 && ctype_digit($_POST["zipcode"])) {
    $url = "https://cnmt310.classconvo.com/ziplookup/";
    $client = new WebServiceClient($url);

    $apihash = "emfhxkpth";
    $apikey = "api34";
    $data = array("zip"=>$_POST['zipcode']);
    $action = "zip2city";
    $fields = array("apikey" => $apikey,
                "apihash" => $apihash,
                "data" => $data,
                "action" => $action,
                );
    $client->setPostFields($fields);
    $obj = json_decode($client->send());
    if (!is_object($obj) || !property_exists($obj, "result") || $obj->result != "Success") {
        print "The zip code could not be located in the database";
        exit;
      }
    if (property_exists($obj, "data") && is_object($obj->data)) {
        print "City: " . $obj->data->city;
        print "<br>";
        print "State: " . $obj->data->state;
    }
} else if (($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zipcode'])) && (empty($_POST["zipcode"]) || strlen($_POST["zipcode"]) != 5 || !ctype_digit($_POST["zipcode"]))) {
    print '<div>Invalid ZIP code. Please enter a valid 5-digit ZIP code.</div>';
}

print $page->getBottomSection();