<?php
require_once '../pages/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "INSERT INTO items (username, email, password) VALUES (:nom, :prix, :description)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nom' => $nom,
            ':prix' => $prix,
            ':description' => $desc
        ]);

        echo "Le produit a été ajouté avec succès !";
        echo "<a href='main.php'>Voir la liste des produits</a>";

    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout : " . $e->getMessage();
    }
}
?>