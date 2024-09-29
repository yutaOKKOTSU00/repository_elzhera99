<?php
include('connexion.php');

// Récupérer les paramètres de recherche
$motcle = isset($_GET['mcl']) ? $_GET['mcl'] : '';
$auteur = isset($_GET['auteur']) ? $_GET['auteur'] : '';
$siecle = isset($_GET['siecle']) ? $_GET['siecle'] : '';
$nationalite = isset($_GET['nationalite']) ? $_GET['nationalite'] : '';
$categorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';
$trie = isset($_GET['trie']) ? $_GET['trie'] : '';

// Construire la requête SQL
$sql = "SELECT nom,prenom,siecle,texte FROM auteurs,citation WHERE idauteur = auteur";

if (!empty($auteur)) {
    $sql.= " AND prenom = '$auteur'";
}

if (!empty($motcle)) {
    $sql.= " AND texte LIKE '%$motcle%'";
}

if (!empty($nationalite)) {
    $sql.= " AND nationalite = '$nationalite'";
}

if (!empty($categorie)) {
    $sql.= " AND categorie = '$categorie'";
}

if (!empty($siecle)) {
    $sql.= " AND siecle = '$siecle'";
}

if ($trie == 'auteur') {
    $sql.= " ORDER BY auteur";
} elseif ($trie == 'siecle') {
    $sql .= " ORDER BY siecle";
}

$result = $conexion->prepare($sql);
$result->execute();
$result_clone = $conexion->prepare($sql);
$result_clone->execute();
$number_of_row = $result_clone->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>AFFICHAGE</title>
    <style>
        /* Styles décoratifs */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        
        nav {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }
        
        nav a {
            color: #333;
            text-decoration: none;
            margin: 0 10px;
        }
        
        main {
            padding: 20px;
        }
        
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        
        label {
            display: block;
            margin-top: 10px;
        }
        
        input[type="text"], textarea {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        textarea {
            height: 100px;
        }
        
        button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        a:hover 
        {
            background: rgb(150,150,150);
        }
    </style>
</head>
<body>
    <header>
    <h1>AFFICHAGE</h1>
    </header>
    
    <nav>
        <a href="index.php">ACCEUIL</a>
        <a href="insertion.php">INSERTION</a>
    </nav>

    <table>
        <tr>
            <th>CITATION</th>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>SIECLE</th>
        </tr>

        <?php
        if (count($number_of_row) > 0) {
            while($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row["texte"] . "</td>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["prenom"] . "</td>";
                echo "<td>" . $row["siecle"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Aucun résultat trouvé.</td></tr>";
        }
        ?>
    </table>

    <br>
    
    <footer>
        <p>&copy; 2024 collection de citations.</p>
    </footer>
</body>
</html>