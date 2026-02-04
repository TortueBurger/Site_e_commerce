<?php 
ob_start(); 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$drops = [
    1 => [
        'modele' => 'KICKSTEP ONE - MIDNIGHT',
        'prix' => '???', 
        'date' => '20/02',
        'img' => '../images/drop1.jpg' 
    ],
    2 => [
        'modele' => 'KICKSTEP AIR - INFRARED',
        'prix' => '???',
        'date' => '20/02',
        'img' => '../images/drop2.jpg'
    ]
];
?>

<!DOCTYPE html>
<link rel="stylesheet" href="../css/nouveautes.css">

<div class="drop-container">
    
    <div class="drop-header">
        <h4>EXCLUSIVITÉ KICKSTEP</h4>
        <h1>PROCHAIN DROP</h1>
        
        <div class="drop-date-badge">
            <span class="day">20</span>
            <div class="month-year">
                <span>FÉVRIER</span>
                <span>2026</span>
            </div>
        </div>
        
        <p>Préparez-vous. 2 modèles uniques. Stock ultra limité.</p>

        <div class="countdown">
    <div><span id="days">00</span> <span>Jours</span></div>
    <div><span id="hours">00</span> <span>Heures</span></div>
    <div><span id="minutes">00</span> <span>Min</span></div>
    <div><span id="seconds">00</span> <span>Sec</span></div>
</div>

<script src="../js/countdown.js"></script>
    </div>

    <section class="exclusive-grid">
        <?php foreach($drops as $drop): ?>
            
            <div class="drop-card blurred-reveal">
                <div class="badge-date">DROP <?= $drop['date'] ?></div>
                
                <img src="<?= $drop['img'] ?>" alt="<?= $drop['modele'] ?>">
                
                <div class="drop-info">
                    <h3><?= $drop['modele'] ?></h3>
                    <p class="price"><?= $drop['prix'] ?> €</p>
                </div>
            </div>

        <?php endforeach; ?>
    </section>

</div>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>