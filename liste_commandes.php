<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Commandes</title>
    <!-- Liens Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Gestion des Commandes</h1>
        <a href="gestion_commandes.php" class="btn btn-success mb-3">Ajouter une Commande</a>
        <?php
        require_once 'connexion.php';

        // Récupérer la liste des commandes depuis la base de données
        $sql = 'SELECT c.idCommande, p.nom AS nom_produit, cl.nom AS nom_client, c.quantite, c.dateCommande 
                FROM Commande c
                JOIN Produit p ON c.idProduit = p.idProduit
                JOIN Client cl ON c.idClient = cl.idClient';

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>ID Commande</th><th>Produit</th><th>Client</th><th>Quantité</th><th>Date de Commande</th><th>Actions</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['idCommande'].'</td>';
                echo '<td>'.$row['nom_produit'].'</td>';
                echo '<td>'.$row['nom_client'].'</td>';
                echo '<td>'.$row['quantite'].'</td>';
                echo '<td>'.$row['dateCommande'].'</td>';
                echo '<td><a href="modifier_commande.php?id='.$row['idCommande'].'" class="btn btn-primary btn-sm">Modifier</a> ';
                echo '<a href="supprimer_commande.php?id='.$row['idCommande'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette commande ?\')">Supprimer</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'Aucune commande trouvée.';
        }

        $conn->close();
        ?>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
