<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Clients</title>
    <!-- Liens Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des Clients</h1>
        <a href="gestion_client.php" class="btn btn-success mb-3">Ajouter un Client</a>

        <form action="" method="post" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher un client" name="search">
                <button type="submit" class="btn btn-outline-secondary">Rechercher</button>
            </div>
        </form>

        <?php
        require_once 'connexion.php';

        // Recherche de clients
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $search = $_POST['search'];
            $sql = "SELECT * FROM Client WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR email LIKE '%$search%'";
        } else {
            $sql = 'SELECT * FROM Client';
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Actions</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['idClient'].'</td>';
                echo '<td>'.$row['nom'].'</td>';
                echo '<td>'.$row['prenom'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td><a href="modifier_client.php?id='.$row['idClient'].'" class="btn btn-primary btn-sm">Modifier</a> ';
                echo '<a href="supprimer_client.php?id='.$row['idClient'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce client ?\')">Supprimer</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'Aucun client trouvé.';
        }

        $conn->close();
        ?>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
