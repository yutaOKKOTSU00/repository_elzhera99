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
        <a href="affichecit.php">RESULTAT DES RECHERCRES</a>
        <a href="insertion.php">INSERTION</a>
    </nav>
    <?php
        include('connexion.php');
        // Traitement du formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $citation = $_POST["citation"];
                $categorie = $_POST["categorie"];
            }
            // Vérifier si l'auteur existe déjà
            $sql = "SELECT * FROM auteurs where  nom ='$nom' and prenom ='$prenom'";
            $result = $conexion->prepare($sql);
            $result->execute();
            $result_clone = $conexion->prepare($sql);
            $result_clone->execute();
            $number_of_row = $result_clone->fetchAll();
            if (count($number_of_row) > 0) {
                //capture de l'identifiant de l'auteur
                while($row = $result->fetch())   
                {   
                    $identifiant = $row['idauteur'];
                }
            } else {
                // Insérer d'un nouvel auteur
                echo "<p>L'auteur n'existe pas dans la base de données veuillez l'inserer d'abord a la page insertion auteur.</p>";    
            }
            // Vérifier si l'auteur existe déjà
            $sql = "SELECT * FROM citation WHERE texte LIKE '%$citation%' ";
            $result_clone = $conexion->query($sql);
            $number_of_row = $result_clone->fetchAll();
            if (count($number_of_row) > 0) {
                echo "la citation existe deja";
            }else {
            //insertion de la citation
            $sql = "INSERT INTO citation (auteur,categorie,texte) VALUES ('$identifiant','$categorie','$citation')";
            $result = $conexion->query($sql);
            if ($result == TRUE) {
                echo "<p>La citation a été ajoutée avec succès.</p>";
            } else {
                echo "<p>Erreur lors de l'insertion de la citation</p>";
            }
            }
        ?>
        <footer>
        <p>&copy; 2024 collection de citations.</p>
    </footer>
</body>
</html>