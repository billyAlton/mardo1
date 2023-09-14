<!DOCTYPE html>
<html>
<head>
    <title>Modifier une Commande</title>
    <!-- Liens Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
        require_once('connexion.php');

        if(isset($_GET['id'])) {
            $idCommande = $_GET['id'];

            // Récupérer les informations de la commande à modifier
            $sql = "SELECT idCommande, idProduit, idClient, quantite, dateCommande FROM Commande WHERE idCommande = $idCommande";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                ?>
                <h1>Modifier la Commande</h1>
                <form action="traitement_modifier_commande.php" method="post">
                    <input type="hidden" name="idCommande" value="<?php echo $row['idCommande']; ?>">
                    <div class="mb-3">
                        <label for="idProduit" class="form-label">Produit:</label>
                        <select class="form-select" name="idProduit" required>
                            <option value="">Sélectionnez un produit</option>
                            <?php
                            $sql_produit = "SELECT idProduit, nom FROM Produit";
                            $result_produit = $conn->query($sql_produit);
                            while ($row_produit = $result_produit->fetch_assoc()) {
                                $selected = ($row_produit["idProduit"] == $row["idProduit"]) ? 'selected' : '';
                                echo '<option value="' . $row_produit["idProduit"] . '" ' . $selected . '>' . $row_produit["nom"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="idClient" class="form-label">Client:</label>
                        <select class="form-select" name="idClient" required>
                            <option value="">Sélectionnez un client</option>
                            <?php
                            $sql_client = "SELECT idClient, CONCAT(nom, ' ', prenom) AS nom_complet FROM Client";
                            $result_client = $conn->query($sql_client);
                            while ($row_client = $result_client->fetch_assoc()) {
                                $selected = ($row_client["idClient"] == $row["idClient"]) ? 'selected' : '';
                                echo '<option value="' . $row_client["idClient"] . '" ' . $selected . '>' . $row_client["nom_complet"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité:</label>
                        <input type="number" class="form-control" name="quantite" value="<?php echo $row['quantite']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dateCommande" class="form-label">Date de Commande:</label>
                        <input type="date" class="form-control" name="dateCommande" value="<?php echo $row['dateCommande']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
                <?php
            } else {
                echo "Commande non trouvée.";
            }
        } else {
            echo "ID de la commande non spécifié.";
        }

        $conn->close();
        ?>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
