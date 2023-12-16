<?php
require_once("const.php");
require_once("page.php");

$page = new PizzaLab\Page("Order Summary");

print $page->getTopSection();
session_start();

if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    print "<p>" . $_SESSION['error'] . "</p>\n";
    unset($_SESSION['error']);
}

// Navigation guard to check if pizza was set
if (!isset($_SESSION['toppings']) || empty($_SESSION['toppings'])
    || !isset($_SESSION['crust']) || empty($_SESSION['crust'])
    || !isset($_SESSION['size']) || empty($_SESSION['size'])) {
    $_SESSION['error'] = "Please create a pizza.";
    die(header("Location: " . PAGE_PIZZA_FORM));
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

// Display order summary
print "<h1>Order Summary</h1>";
print "<p>Your pizza will be a $size-sized, $crust pizza with $toppings_string.</p>";
print "<p>If this is correct, click the 'Place Order' button to confirm, or click the 'Modify Pizza' button to go back and modify your pizza.</p>";

// Set order_confirmed field in session upon clicking "Place Order"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $_SESSION['order_confirmed'] = true;
    die(header("Location: " . PAGE_ORDER_COMPLETE));
}

print "<form action=" . PAGE_PIZZA_FORM . " method='get' style='display: inline-block;'><button type='submit'>Modify Pizza</button></form>";
print "<form action=" . $_SERVER['PHP_SELF'] . " method='post' style='display: inline-block;'><button type='submit' name='place_order'>Place Order</button></form>";

print $page->getBottomSection();
?>