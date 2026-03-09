<?php
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$cart = $_SESSION["cart"] ?? [];
$total = 0;
?>

<h2>Keranjang Saya</h2>

<?php
if (!empty($_SESSION["error"])) {
    echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION["error"]);
}
?>

<?php if (empty($cart)): ?>
    Keranjang Anda kosong.
<?php else: ?>
    <?php foreach ($cart as $id => $item):
        $subtotal = $item["price"] * $item["quantity"];
        $total += $subtotal; 
    ?>
        <div>
            <strong><?= $item["name"] ?></strong><br>
            Harga: Rp<?= $item["price"] ?><br>
            Quantity: <?= $item["quantity"] ?>

            <br><br>

            <form action="update_cart.php" method="POST" style="display: inline;">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <input type="hidden" name="action" value="decrease">

                <button type="submit">-</button>
            </form>

            <form action="update_cart.php" method="POST" style="display: inline;">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <input type="hidden" name="action" value="increase">

                <button type="submit" onclick="return confirm('Hapus produk dari keranjang anda?')">+</button>
            </form>

            <br><br>

            Subtotal: Rp<?= $subtotal ?>

            <hr>

        </div>
    <?php endforeach; ?>

    <hr>
    Total: <strong>Rp<?= $total ?></strong>

    <form action="checkout.php" method="POST">
        Metode Pembayaran:
        <select name="payment_method" required>
            <option value="qris">QRIS</option>
            <option value="transfer">Transfer Bank</option>
        </select>

        <br><br>

        <button type="submit">Checkout</button>
    </form>
<?php endif; ?>