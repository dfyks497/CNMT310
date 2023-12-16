<?php
require_once("const.php");
require_once("page.php");

$page = new PizzaLab\Page("Pizza Form");

print $page->getTopSection();
session_start();

if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    print "<p>" . $_SESSION['error'] . "</p>\n";
    unset($_SESSION['error']);
}

print "<h1>Create Your Pizza</h1>";
print "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\">\n";
print " <fieldset>\n";
print " <legend>Pizza Toppings</legend>\n";
print " <input type=\"checkbox\" id=\"mushrooms\" name=\"toppings[]\" value=\"mushrooms\" " . (in_array('mushrooms', $_SESSION['toppings'] ?? []) ? 'checked' : '') . ">\n";
print " <label for=\"mushrooms\">Mushrooms</label><br>\n";
print " <input type=\"checkbox\" id=\"olives\" name=\"toppings[]\" value=\"olives\" " . (in_array('olives', $_SESSION['toppings'] ?? []) ? 'checked' : '') . ">\n";
print " <label for=\"olives\">Olives</label><br>\n";
print " <input type=\"checkbox\" id=\"pepperoni\" name=\"toppings[]\" value=\"pepperoni\" " . (in_array('pepperoni', $_SESSION['toppings'] ?? []) ? 'checked' : '') . ">\n";
print " <label for=\"pepperoni\">Pepperoni</label><br>\n";
print " <input type=\"checkbox\" id=\"peppers\" name=\"toppings[]\" value=\"peppers\" " . (in_array('peppers', $_SESSION['toppings'] ?? []) ? 'checked' : '') . ">\n";
print " <label for=\"peppers\">Peppers</label><br>\n";
print " <input type=\"checkbox\" id=\"sausage\" name=\"toppings[]\" value=\"sausage\" " . (in_array('sausage', $_SESSION['toppings'] ?? []) ? 'checked' : '') . ">\n";
print " <label for=\"sausage\">Sausage</label><br>\n";
print " </fieldset>\n";
print " <fieldset>\n";
print " <legend>Crust Type</legend>\n";
print " <input type=\"radio\" id=\"thin\" name=\"crust\" value=\"thin\" " . (isset($_SESSION['crust']) && $_SESSION['crust'] == 'thin' ? 'checked' : '') . ">\n";
print " <label for=\"thin\">Thin</label><br>\n";
print " <input type=\"radio\" id=\"regular\" name=\"crust\" value=\"regular\" " . (isset($_SESSION['crust']) && $_SESSION['crust'] == 'regular' ? 'checked' : '') . ">\n";
print " <label for=\"regular\">Regular</label><br>\n";
print " <input type=\"radio\" id=\"deepdish\" name=\"crust\" value=\"deep dish\" " . (isset($_SESSION['crust']) && $_SESSION['crust'] == 'deep dish' ? 'checked' : '') . ">\n";
print " <label for=\"deepdish\">Deep Dish</label>\n";
print " </fieldset>\n";
print " <fieldset>\n";
print " <legend>Size</legend>\n";
print " <input type=\"radio\" id=\"small\" name=\"size\" value=\"small\" " . (isset($_SESSION['size']) && $_SESSION['size'] == 'small' ? 'checked' : '') . ">\n";
print " <label for=\"small\">Small (8&quot;)</label><br>\n";
print " <input type=\"radio\" id=\"medium\" name=\"size\" value=\"medium\" " . (isset($_SESSION['size']) && $_SESSION['size'] == 'medium' ? 'checked' : '') . ">\n";
print " <label for=\"medium\">Medium (12&quot;)</label><br>\n";
print " <input type=\"radio\" id=\"large\" name=\"size\" value=\"large\" " . (isset($_SESSION['size']) && $_SESSION['size'] == 'large' ? 'checked' : '') . ">\n";
print " <label for=\"large\">Large (16&quot;)</label>\n";
print " </fieldset><br>\n";
print " <input type=\"submit\" value=\"Submit\">\n";
print "</form>\n";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $errors = [];
   $toppings = $_POST['toppings'];
   $crust = isset($_POST['crust']) ? $_POST['crust'] : null;
   $size = isset($_POST['size']) ? $_POST['size'] : null;
   
   // Update session variables every time the form is submitted
   $_SESSION['toppings'] = $toppings;
   $_SESSION['crust'] = $crust;
   $_SESSION['size'] = $size;
   
   if (empty($toppings)) {
      $errors[] = "You must select at least one topping.";
   } elseif (count($toppings) > 3 && $crust == 'deep dish') {
      $errors[] = "You may only select up to three toppings for a deep dish pizza.";
   }
   
   if (!isset($crust) || empty($crust)) {
      $errors[] = "You must select a crust.";
   }
   
   if (!isset($size) || empty($size)) {
      $errors[] = "You must select a size.";
   }
   
   if ($crust == 'deep dish' && $size != 'medium') {
      $errors[] = "You may only select medium size for a deep dish pizza.";
   }
   
   if (empty($errors)) {
      die(header("Location: " . PAGE_ORDER_SUMMARY));
   } else {
      $_SESSION['error'] = implode("<br>", $errors);
      // Redirect back to the this pizza form page if there are validation errors
      die(header("Location: " . $_SERVER["PHP_SELF"]));
   }
}
print $page->getBottomSection();
?>