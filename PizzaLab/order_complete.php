<?php
require_once("const.php");
require_once("page.php");

$page = new PizzaLab\Page("Order Complete");

print $page->getTopSection();
session_start();

// Navigation guard to check if order was confirmed
if (!isset($_SESSION['order_confirmed']) || empty($_SESSION['order_confirmed']) || $_SESSION['order_confirmed'] != true) {
    $_SESSION['error'] = "Please confirm your order.";
    die(header("Location: " . PAGE_ORDER_SUMMARY));
}

// Retrieve order details from the session
$toppings = $_SESSION['toppings'];
$crust = $_SESSION['crust'];
$size = $_SESSION['size'];

// Convert toppings array to string
$toppings_string = implode(", ", $toppings);
if (count($toppings) > 1) {
    $lastTopping = array_pop($toppings);
    $toppings_string = implode(", ", $toppings) . " and " . $lastTopping;
}

// Display order confirmation
print "<h1>Order Complete</h1>";
print "<p>You successfully ordered a $size-sized, $crust pizza with $toppings_string.</p>";

// Unset and destroy the session
session_unset();
session_destroy();

// Provide a link to go back and modify the order
print "<p>You may now safely close the web page.</p>";
print "<p>If you'd like to place another order, please click the 'New Order' button below.</p>";
print "<form action=" . PAGE_PIZZA_FORM . " method='post' style='display: inline-block;'><button type='submit'>New Order</button></form>";

print $page->getBottomSection();
?>