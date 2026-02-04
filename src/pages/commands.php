<?php 
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../management/order_gestion.php');

$address = $zipcode = $city = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $address = process_input($_POST["address"]); 
    $zipcode = process_input($_POST["zipcode"]); 
    $city = process_input($_POST["city"]);
}

// Remove all special characters from the inputs for security
function process_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$user = get_user($_SESSION["id"]);
$order_id = get_order_id($user["id"]);
$order_items = get_order_items($user["id"]);
$amount = get_total_amount($user["id"]);
$deliver_fee = 10.00;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Confirmée - KICKSTEP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/commands.css">
</head>
<body>
<div id="content">
    <div class="receipt-container">
        
        <div class="success-header">
            <i class="fas fa-check-circle icon-check"></i>
            <h1>Merci, <?= $user["name"] ?> !</h1>
            <p class="subtitle">Votre commande <span class="order-id">#ORD-<?= $order_id ?></span> a bien été reçue.</p>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h3>Adresse de livraison</h3>
                <?= $user["name"] ?><br>
                <?= $address ?><br>
                <?= $zipcode ?> <?= $city ?></p>
            </div>
            <div class="info-box">
                <h3>Mode de paiement</h3>
                <p><i class="fab fa-cc-visa"></i> Visa terminant par **4242</p>
            </div>
        </div>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th style="text-align:center;">Qté</th>
                    <th style="text-align:right;">Prix</th>
                </tr>
            </thead>
            <?php 
                $total = 0;
            
                foreach ($order_items as $item):
                    $item_info = get_item($item['item_id']);
                    $quantity = $item['quantity'];
                    $total += $item_info["price"]*$quantity;
                ?>
                <tbody>
                    <tr>
                        <td>
                            <div class="product-col">
                                <img src="<?= $item_info['image_url'] ?>" alt="<?= $item_info['name'] ?>" class="thumb">
                                <div>
                                    <span class="prod-name"><?= $item_info['name'] ?></span>
                                    <span class="prod-size">Taille : <?= $item['size'] ?></span>
                                </div>
                            </div>
                        </td>
                        <td style="text-align:center;"><?= $quantity ?></td>
                        <td style="text-align:right;"><?= number_format($item_info['price'], 2) ?> €</td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>

        <div class="totals-section">
            <div class="total-row">
                <span>Sous-total</span>
                <span><?= number_format($total, 2) ?> €</span>
            </div>
            <div class="total-row">
                <span>Livraison</span>
                <?php if ($total >= 200): $deliver_fee = 0;?>
                    <span>Gratuite</span>
                <?php else: $deliver_fee = 10.00; ?>
                    <span><?= number_format($deliver_fee, 2) ?> €</span>
            <?php endif; ?>
            </div>
            <div class="total-row final">
                <span>Total</span>
                <span><?= number_format($amount + $deliver_fee, 2) ?> €</span>
            </div>
        </div>

        <a href="products.php" class="btn-home">Continuer mes achats</a>
    </div>
</div>
</body>
</html>
<?php 
$amount += $deliver_fee;
proceed_order($user["id"],$amount, $address, $zipcode, $city);
?>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>