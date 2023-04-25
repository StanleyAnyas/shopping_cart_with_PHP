<?php
    $file  = 'product.txt';

    if (!file_exists($file)) die ('File not Found');
    $PRODUCTS = read_products($file);

    function read_products($file) {
        $products = array();
        // open file for reading 
        $fp = fopen($file, 'r');
        // fget return false at the end of the file
        while ($line = fgetcsv($fp, 1024)) {
            $line = trim($line[0]);
            if (empty($line)) continue;
            // split each line into array
            $product = explode(';', trim($line));
            // add product to products array
            $id = (int) $line[0];
            $name = $line[1];
            $price = (float) $line[2];
            // move the infomation to the produvt array
            $products[$id] = array(
                'name' => $name,
                'price' => $price
            );
        }
        return $products;
    }

    // handling the session
    session_start();
    // create a shopping cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // create a buyer info
    if (!isset($_SESSION['buyer'])) {
        $_SESSION['buyer'] = array();
    }

    // delete the earlier purchase's info from the session
    function initialize_session() {
        unset($_SESSION['bought']);
    }

    // navigation
    function menu() {
        $menu = array(
            "index.php" => "Products",
            "cart.php" => "Shopping Cart",
            "checkout.php" => "Checkout",
        );
        echo "<div class='menu'>";
        foreach ($menu as $file => $header) {
            $i = -1 - strlen($file);
            if(substr($_SERVER['PHP_SELF'], $i) == "/".$file) {
                echo "[<strong>$header</strong>] ";
            } else {
                echo "[<a href=\"$file\">$header</a>] ";
            }
        }
        echo "</div>";
    }

    // handling the shopping cart
    function totalsum() {
        global $PRODUCTS;
        $sum = 0;
        foreach ($_SESSION['cart'] as $prod_id => $count) {
          $product = $PRODUCTS[$prod_id];
          $price = $product['price'] * $count;
          $sum += $price;
        }
        return $sum;
      }
    function buy_product() {
        global $PRODUCTS;
        // has the purchase been done yet
        if (isset($_SESSION['bought'])) {
          return false;
        }
        // has the product being bought been defined
        if (isset($_POST['id']) and isset($_POST['count'])) {
          // is the id correct
          $prod_id = (int) $_POST['id'];
          $count = (int) $_POST['count'];
          if ($count > 0 and array_key_exists($prod_id, $PRODUCTS)) {
            // make the purchase
            $edcount = 0;
            if (isset($_SESSION['cart'][$prod_id])) {
              $edcount = $_SESSION['cart'][$prod_id];
            }
            $_SESSION['cart'][$prod_id] = $edcount + $count;
            // set the purchase as done in the session
            // so it won't be repeated upon refresh
            $_SESSION['bought'] = $prod_id;
            return true;
          }
        }
        return false;
      }

      // changing the amount of products in the cart
  function change_count() {
    $count = $_POST['count'];
    foreach ($count as $prod_id => $count) {
      if (isset($_SESSION['cart'][$prod_id])) {
        $count = (int) $count;
        // if count is zero, delete entirely
        if ($count <= 0) {
          unset($_SESSION['cart'][$prod_id]);
        } else {
          $_SESSION['cart'][$prod_id] = (int) $count;
        }
      }
    }
  }