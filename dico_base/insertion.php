<!DOCTYPE html>
<html>
<head>
    <title>Insérer une citation</title>
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
        <h1>Insertion</h1>
    </header>
    
    <nav>
    <a href="index.php">ACCEUIL</a>
    <a href="affichecit.php">RESULTAT DES RECHERCRES</a>
    </nav>

    <main>
        <form  method="POST" action="traitement_saisie_auteur.php" >
        <h3>inserer un auteur</h3>
            <label for="nom">Nom de l'auteur :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom de l'auteur :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="nationalite">nationalite de l'auteur :</label>
            <input type="text" id="nationalite" name="nationalite" required>
            
            <label for="siecle">Siècle :</label>
            <select id="siecle" name="siecle" required>
                <label for="siecle">SIECLE:</label>
                <option value="">selectionner un siecle</option>
                <option value="15">XV</option>
                <option value='XV'>XV</option>
                <option value=15>XV</option>
                    <option value=16>XVI</option>
                    <option value=17>XVII</option>
                    <option value=18>XVIII</option>
                    <option value=19>XIX</option>
                    <option value=20>XX</option>
                    <option value=21>XXI</option>
            </select>
            <br>
            <button type="reset">Effacer</button>
            <button type="submit">Envoyer</button>
        </form><br>
        <hr></hr>
        <form  method="POST" action="traitement_saisie_citation.php" >
            <h3>inserer une citation</h3>
            <label for="nom">Nom de l'auteur :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom de l'auteur :</label>
            <input type="text" id="prenom" name="prenom" required><br>

            <label for="categorie">categorie:</label>
            <select id="categorie" name="categorie" required>
                <label for="categorie">CATEGORIE:</label>
                    <option value="">selectionner une categorie</option>
                    <option value="vie">vie</option>
                    <option value="liberte">liberte</option>
                    <option value="force et faiblesse">force et faiblesse</option>
                    <option value="destin">destin </option>
                    <option value="amitie et amour">amitie et amour</option>
                    <option value="guerre">guerre</option>
                    <option value="mensonge et verite">mensonge et verite</option>
                    <option value="justice">justice</option>
                    <option value="religion">religion</option>
                    <option value="succes">succes</option>
                    <option value="temps">temps</option>
                    <option value="etat">etat</option>
            </select>
           
            <label for="citation">Citation :</label>
            <textarea id="citation" name="citation" required></textarea>
            <p>NB: ne pas mettre d'apostrophe a l'interieur des champs</p>
            
            <button type="reset">Effacer</button>
            <button type="submit">Envoyer</button>
        </form>
        
        
    </main>
    
    <footer>
        <p>&copy; 2024 collection de citations.</p>
    </footer>
</body>
</html>