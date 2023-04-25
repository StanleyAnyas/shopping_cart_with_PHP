<?php
  require('functions.php');
/* Create functions */
  if ($_POST['action'] == 'purchase') {
    buy_product();
  } elseif ($_POST['action'] == 'change_count') {
    change_count();
  }
?><!DOCTYPE HTML>
<html>
    <head>
        <title>Store: Shopping cart</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>

    <body>
        <?php menu() ?>

            <h1>Shopping cart</h1>

        <?php if (count($_SESSION['cart']) == 0) { ?>

            <p>Shopping cart is empty!</p>

        <?php } else { ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="action" value="change_count">
            <table border="1">
                <thead>
                    <tr><th>Name</th><th>Unit Price</th><th>Count</th><th>Price</th></tr>
                </thead>

        <tbody>
                <?php
                // calculate the total sum for purchases
                $sum = 0;
                foreach ($_SESSION['cart'] as $prod_id => $count) {
                    $product = $PRODUCTS[$prod_id];
                    echo "<tr><td>$product[name]</td>";
                    echo "<td>" . number_format($product['price'], 2, ',', ' ') . " &euro;</td>";
                    echo "<td><input type=\"text\" name=\"count[$prod_id]\" size=\"2\" value=\"$count\"></td>\n";
                    $price = $product['price'] * $count;
                    echo "<td>" . number_format($price, 2, ',', ' ') . " &euro;</td></tr>\n";
                    $sum += $price;
                }
                ?>

        <tr>
            <td></td><td></td>
            <td><input type="submit" value="Change"></td>
            <td></td>
        </tr>
        </tbody>

        </table>
        </form>
        <p>Total: <?= number_format($sum, 2, ',', ' ') ?> &euro;</p>
        <?php } ?>
    </body>
</html>