<?php 
include 'class_carte.php'; 
session_start();

if(isset($_GET["deco"]))
    {
        session_destroy();
    }
if(!isset($_SESSION["nb_cartes"]) && !isset( $_SESSION["carte_retourne"]) && !isset($_SESSION["carte_etat"]) && !isset($_SESSION["carte"]))
    {
        $_SESSION["nb_cartes"] = [];
        $_SESSION["carte_retourne"] = [];
        $_SESSION["carte_etat"] = [];        
        $_SESSION["carte"]= [];
    }


// var_dump($_SESSION["nb_cartes"]);
    if(isset($_GET["jeu"], $_GET["niveau"]) && empty($_SESSION["nb_cartes"]))
        {                                  
            $_SESSION["nb_paires"] = $_GET["niveau"]; 
           
           
            if(empty($_SESSION["nb_cartes"]) && empty($_SESSION["carte_etat"]))
                {                                        
                    for($i = 1; $i<=$_SESSION["nb_paires"]; $i++)     
                        {                                                                             
                            array_push($_SESSION["nb_cartes"], $i, $i);                               
                        }        
                    for($i = 0; $i<($_SESSION["nb_paires"]*2); $i++) 
                        {
                            array_push($_SESSION["carte"], new Carte);
                            array_push($_SESSION["carte_etat"], $_SESSION["carte"][$i]->getEtat());
                        }
                    
                    shuffle($_SESSION["nb_cartes"]);                                 
                }               
        }        
    
    if(isset($_SESSION["nb_paires"]))   
        {            
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
                                    echo $_SESSION["nb_cartes"][$i];
                                    array_push($_SESSION["carte_retourne"], $i);
                                }                            
                        }      
                }                           
        }            
        var_dump($_SESSION);                                                                                                          
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
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
            <input type="submit" name="deco" value="deco">
        </form>
    </main>
</body>
</html>