<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Commande</title>
    <!-- Liens Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter une Commande</h1>
        <form action="traitement_gestion_commande.php" method="post">
            <div class="mb-3">
                <label for="idProduit" class="form-label">Produit:</label>
                <select class="form-select" name="idProduit" required>
                    <option value="">Sélectionnez un produit</option>
                    <?php
                    require_once('connexion.php');
                    $sql = "SELECT idProduit, nom FROM Produit";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["idProduit"] . '">' . $row["nom"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="idClient" class="form-label">Client:</label>
                <select class="form-select" name="idClient" required>
                    <option value="">Sélectionnez un client</option>
                    <?php
                    $sql = "SELECT idClient, CONCAT(nom, ' ', prenom) AS nom_complet FROM Client";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["idClient"] . '">' . $row["nom_complet"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité:</label>
                <input type="text" class="form-control" name="quantite" required>
            </div>
            <div class="mb-3">
                <label for="dateCommande" class="form-label">Date de Commande:</label>
                <input type="date" class="form-control" name="dateCommande" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
