<?php
  echo 
  '<!DOCTYPE html>
  <!-- http://cnmtsrv2.uwsp.edu/home/dfyks497 -->
  <html lang="en">
    <head>
        <title>CNMT 310: PHP Password Validation Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
      <h1>
        PHP Password Validation Form
      </h1>
      <h3>
        Please enter your username and password:
      </h3>
      <form action="action.php" method="POST">
        <label for="username">
          Username:
        </label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">
          Password:
        </label>
        <input type="password" id="password" name="password"><br><br>
        <button type="submit">
          Submit
        </button>
      </form>
    </body>
  </html>';
?>