<?php
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$cart = $_SESSION["cart"] ?? [];
$total = 0;
?>

<h2>Keranjang Saya</h2>

<?php if (empty($cart)): ?>
    Keranjang Anda kosong.
<?php else: ?>
    <?php foreach ($cart as $id => $item):
        $subtotal = $item["price"] * $item["quantity"];
        $total += $subtotal; 
    ?>
        <div>
            <?= $item["name"] ?>
            (<?= $item["quantity"] ?> x Rp<?= $item["price"] ?>)
            = Rp<?= $subtotal ?>
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