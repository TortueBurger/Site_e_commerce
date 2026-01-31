<?php 
ob_start();
?>
<!DOCTYPE html>
<html lang="fr">

<link rel="stylesheet" href="../css/accueil.css">

    <section class="hero">
        <div class="hero-content">
            <h1>KICKSTEP</h1>
            <p>L'alliance parfaite entre le confort urbain et le design exclusif.</p>
            <a href="#concept" class="btn-cta">Découvrir l'univers</a>
        </div>
    </section>

    <section id="concept" class="concept-section">
        <div class="concept-container">
            <h2 class="concept-title">Bienvenue dans la Culture</h2>
            <p class="concept-text">
                Chez <strong>Kickstep</strong>, nous ne vendons pas seulement des chaussures. 
                Nous célébrons l'art de la rue, le mouvement et l'expression de soi. 
                Chaque paire est sélectionnée pour raconter une histoire, votre histoire.
            </p>
            <p class="concept-text">
                Fondé par des passionnés pour des passionnés, notre objectif est de vous offrir 
                les pièces les plus rares et les classiques intemporels. Que vous soyez un collectionneur 
                averti ou à la recherche de votre style quotidien, vous êtes au bon endroit.
            </p>
            <div style="margin-top: 30px; font-family: 'Brush Script MT', cursive; font-size: 2rem; color: #555;">
                L'équipe Kickstep
            </div>
        </div>
    </section>

    <section class="final-cta">
        <h2>Prêt à trouver votre paire ?</h2>
        <p style="margin-bottom: 30px; color: #666;">Parcourez notre catalogue complet et faites votre choix.</p>
        <a href="produits.php" class="btn-black">Accéder à la boutique</a>
    </section>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>