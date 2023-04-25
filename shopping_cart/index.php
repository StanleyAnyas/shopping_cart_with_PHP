<?php
require('functions.php');
initialize_session();
?><!DOCTYPE HTML>

<html>
    <head>
        <title>Store</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>

    <body>
        <?php menu() ?>

        <h1>Products</h1>
        <table border="1">
            <thead><tr><th>Product ID</th><th>Name</th><th>Price</th></tr></thead>

            <tbody>
                <?php
                // print the products one by one
                foreach($PRODUCTS as $id => $product) {
                    $price = number_format($product['price'], 2, ',', ' ');
                    echo <<<FORM
                <tr><td>$id</td>
                    <td>$product[name]</td>
                    <td>$price &euro;</td>

                    <td>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="action" value="purchase">
                            <input type="hidden" name="id" value="$id">
                            <input type="text" name="count" size="2" value="1">
                            <input type="submit" name="purchase" value="Buy">
                        </form>
                    </td>
                </tr>

                FORM;
                }
                ?>
            </tbody>
        </table>

    <p>Shopping cart total: <?= number_format(totalsum(), 2, ',', ' ') ?> &euro; </p>
    </body>
</html>