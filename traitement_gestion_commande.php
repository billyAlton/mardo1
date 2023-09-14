<?php

require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProduit = $_POST['idProduit'];
    $idClient = $_POST['idClient'];
    $quantite = $_POST['quantite'];
    $dateCommande = $_POST['dateCommande'];

    // Insérer la nouvelle commande dans la base de données
    $sql = "INSERT INTO Commande (idProduit, idClient, quantite, dateCommande) VALUES ('$idProduit', '$idClient', '$quantite', '$dateCommande')";

    if ($conn->query($sql) === true) {
        echo 'Commande ajoutée avec succès.';
        echo "<a href='gestion_commande.php'>Allez consulter la liste </a>";
    } else {
        echo "Erreur lors de l'ajout de la commande : ".$conn->error;
    }
} else {
    echo 'Mauvaise méthode de requête.';
}

$conn->close();
