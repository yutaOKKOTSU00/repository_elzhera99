<?php   // connesxion a la base
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $base = 'dico';
    try{$conexion = new PDO("mysql:host=$servername;dbname=$base",$username,$password);
            //definition du mode d'erreur de PDO sur exection
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } 
        /*on capture les exception si une exception est lancee et on affiche les iformations relatives a celles ci*/
        catch(PDOException $e)
        {
            echo "Erreur :".$e->getMessage();
        } 
?>