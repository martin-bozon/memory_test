<?php 
include 'class_carte.php'; 
session_start();
// session_destroy();

    if(isset($_GET["deco"]))
        {
            session_destroy();
            header('Location:index.php');
        }
    if(!isset($_SESSION["valeur_carte"]) && !isset( $_SESSION["carte_retourne"]) && !isset($_SESSION["carte_etat"]) && !isset($_SESSION["carte"]))
        {
            $_SESSION["valeur_carte"] = [];
            $_SESSION["carte_retourne"] = [];
            $_SESSION["carte_etat"] = [];        
            $_SESSION["carte"]= [];
        }

    if(isset($_GET["jeu"], $_GET["niveau"]) && empty($_SESSION["valeur_carte"]))
        {                                  
            $_SESSION["nb_paires"] = $_GET["niveau"];             
                      
            if(empty($_SESSION["valeur_carte"]) && empty($_SESSION["carte_etat"]))
                {                                        
                    for($i = 1; $i<=$_SESSION["nb_paires"]; $i++)     
                        {                               
                            array_push($_SESSION["valeur_carte"], $i, $i);                               
                        }        
                    for($i = 0; $i<($_SESSION["nb_paires"]*2); $i++) 
                        {
                            array_push($_SESSION["carte"], new Carte);
                            array_push($_SESSION["carte_etat"], $_SESSION["carte"][$i]->getEtat());
                            // $_SESSION["carte"][$i]->setValeur($_SESSION["valeur"]);
                        }
                  
                    shuffle($_SESSION["valeur_carte"]);                                 
                }               
        }        
    
    if(isset($_SESSION["nb_paires"]))   
        {            
            ?>
            <section id="plateau">
            <?php
            for($i = 0; $i<($_SESSION["nb_paires"]*2); $i++) 
                {                   
                    if($_SESSION["carte_etat"][$i] == 0 && !isset($_POST[$i]))
                        {
                            ?>
                            <form action="index.php" method="POST">
                                <input type="submit" name="<?= $i?>" id="">
                            </form>
                            <?php    
                        }   
                    if(isset($_POST[$i]))
                        {                            
                            $_SESSION["carte_etat"][$i] = $_SESSION["carte"][$i]->setEtat();   
                            
                            if($_SESSION["carte_etat"][$i] == 1)
                                {                                    
                                    echo $_SESSION["valeur_carte"][$i];
                                    array_push($_SESSION["carte_retourne"], $_SESSION["carte"][$i]->getValeur());
                                }                            
                        }    
                }     
                var_dump($_SESSION["carte_etat"])  ;             
                var_dump($_SESSION["carte_retourne"]);
                var_dump($_SESSION["valeur_carte"]);
            ?>
            </section>
            <?php                         
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