<?php
// On active la mise en mémoire tampon pour éviter les erreurs de redirection
ob_start();

// Import des scripts avec le chemin absolu grâce à __DIR__
require_once __DIR__ . '/database/create_database.php';
require_once __DIR__ . '/database/create_tables.php';

// Redirection vers la page d'accueil
header('Location: ./pages/homepage.php');

// On termine le script pour s'assurer que rien d'autre ne s'exécute après la redirection
exit();
?>