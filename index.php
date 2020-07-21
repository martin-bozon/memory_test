<?php 
include 'class_carte.php'; 
session_start();

    if(isset($_GET["deco"]))
        {
            session_destroy();
            header('Location:index.php');
        }

    if(!isset($_SESSION["carte"]))
        {
            $_SESSION["carte"]= [];
        }

    if(isset($_GET["jeu"], $_GET["niveau"]) && empty($_SESSION["carte"]))
        {
            $_SESSION["nb_paires"] = $_GET["niveau"]; 

            for($i = 1; $i<=$_SESSION["nb_paires"]; $i++)
                {
                    array_push($_SESSION["carte"], new Carte($i), new Carte($i));
                    // $doublon = $i + $_SESSION["nb_paires"];
                    // array_push($_SESSION["carte"], new Carte ($doublon));
                }
                var_dump($_SESSION["carte"]);
        }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" href="style.css"/>
    <title>Document</title>
</head>
<body>
    <main>      
        <form action="" method="GET">
            <select name="niveau" id="niveau">    
                <option value="4">4 paires</option>
                <option value="6">6 paires</option>
                <option value="8">8 paires</option>
                <option value="10">10 paires</option>            
            </select>
            <input type="submit" name="jeu" id="jeu">                        
        </form>                          
        <form action="" method="GET">
            <input type="submit" name="deco" value="reset">
        </form>
    </main>
</body>
</html>