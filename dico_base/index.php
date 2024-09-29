<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
    <style>
        /* Styles decoratifs */
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
        <h1>Page d'accueil</h1>
    </header>
    
    <nav>
        <a href="index.php">ACCEUIL</a>
        <a href="affichecit.php">RESULTAT DES RECHERCRES</a>
        <a href="insertion.php">INSERTION</a>
    </nav>
    
    <main>
        <section>
            <h2>Citation du jour</h2>
            <?php
            // Récupérer une citation aléatoire depuis la base de données
            include('connexion.php');
            $random = random_int(0,34);
            $query = "SELECT siecle,nom,prenom,nationalite,citation.texte FROM auteurs,citation where auteur = idauteur and idcit = '$random'";
            $result = $conexion->query($query);    //etape 2 creation et execution de requete
            while($row = $result->fetch())    //etape 3 traitement de la requete
            {
                echo $row['siecle'].'  :  '.$row['nom'].'  :  '.$row['prenom'].'  :  '.$row['nationalite'].'  :  '.$row['texte'].'<br/>'."\n";
            }
            
            ?>
        </section><br><br>
        <hr></hr>
        <section>
            <h2>Rechercher une citation</h2>
            
            <form action="affichecit.php" method="get">
                <label for="mcl">Mot-clé :</label>
                <input type="text" id="mcl" name="mcl" placeholder="Saisissez un mot-clé"> <br><br>

               <label for="auteur">AUTEURS:</label>
                <select id="auteur" name="auteur" >
                    <option value="">selectionnez un auteur</option>
                    <option value="Sartre">Sartre</option>
                    <option value="Nietzsche">Nietzsche</option>
                    <option value="shopenhoher">shopenhoher</option>
                    <option value="Paster">Paster</option>
                    <option value="Copernic">Copernic</option>
                    <option value="Newton">Newton</option>
                    <option value="Machiavel">Machiavel</option>
                    <option value="hegel">hegel</option>
                    <option value="Valery">Valery</option> 
                    <option value="Kant">Kant</option>
                    <option value="Garaudy">Garaudy</option>
                    <option value="Churchil">Churchil</option>
                    <option value="Uchiha">Uchiha</option>
                    <option value="Ackerman">Ackerman</option>
                    <option value="Sankara">Sankara</option>
                    <option value="Mandela">Mandela</option>
                    <option value="Kyoraku">Kyoraku</option>
                    <option value="Einsten">Einsten</option>
                    <option value="kiyotaka">kiyotaka</option> 
                    <option value="Rousseau">Rousseau</option>
                    <option value="kafka">kafka</option>
                    <option value="pascal">pascal</option>
                    <option value="Descartes">Descartes</option>
                    <option value="Poincare">Poincare</option>
                </select> <br><br>
                
                    <label for="nationalite">nationalite:</label>
                <select id="nationalite" name="nationalite">
                        <option value="">selectionner une nationalite</option>
                        <option value="francais">francais</option>
                        <option value="allemand">allemand</option>
                        <option value="genevois">genevois</option>
                        <option value="autrichien">autrichien </option>
                        <option value="britanique">britanique</option>
                        <option value="japonais">japonais</option>
                        <option value="sud africain">sud africain</option>
                        <option value="burkinabe">burkinabe</option>
                        <option value="nigerien">nigerien</option>
                        <option value="prussien">prussien</option>
                        <option value="grec">grec</option>
                </select><br><br>
                            
                <label for="siecle">SIECLE:</label>
                <select id="siecle" name="siecle">
                <option value="">selectionnez un siecle</option>
                    <option value=15>XV</option>
                    <option value=16>XVI</option>
                    <option value=17>XVII</option>
                    <option value=18>XVIII</option>
                    <option value=19>XIX</option>
                    <option value=20>XX</option>
                    <option value=21>XXI</option>
                </select> <br><br>

                    <label for="categorie">categorie:</label>
                <select id="categorie" name="categorie">
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
                </select><br><br>
                
                <label>Trier par:   </label>
                <label for="trie_aut">Auteur</label>
                <input type="radio" id="trie_aut" name="trie" value="auteur" checked>
                <label for="trie_siecle">Siècle</label>
                <input type="radio" id="trie_siecle" name="trie" value="siecle">
                <p>NB: ne pas mettre d'apostrophe a l'interieur des champs</p> <br><br>


                <button type="submit">Rechercher</button>
            </form>
            
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 collection de citations.</p>
    </footer>
</body>
</html>