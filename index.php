<?php 
session_start();
include 'class_carte.php'; 

var_dump($nb_cartes);
    if(isset($_GET["choix"], $_GET["selecteur"]) && !isset($nb_cartes))
        {
            echo 'toto';
            $_SESSION["nb_paires"] = $_GET["selecteur"]; 
            $_SESSION["nb_cartes"] = [];
            $_SESSION["carte_retourne"] = [];
            $_SESSION["carte_etat"] = [];           

            if(empty($_SESSION["nb_cartes"]))
                {        
                    echo 'OZFAE';
                    for($i = 0; $i<$_SESSION["nb_paires"]; $i++)     
                        {                    
                            $carte = new Carte;                    
                            array_push($_SESSION["nb_cartes"], $carte->getId());
                            array_push($_SESSION["carte_etat"], $carte->getEtat());   
                        }         
                    shuffle($_SESSION["nb_cartes"]);                 
                }                                                       
        }        
    
    if(isset($_SESSION["nb_paires"]))   
        {            
            for($i = 0; $i<$_SESSION["nb_paires"]; $i++) 
                {
                    if($_SESSION["carte_etat"][$i] == 0 && !isset($_POST[$i]))
                        {
                            ?>
                            <form action="" method="POST">
                                <input type="submit" name="<?= $i?>" id="">
                            </form>
                            <?php    
                        }   
                    if(isset($_POST[$i]))
                        {                            
                            $_SESSION["carte_etat"][$i] = $carte->setEtat();    
                            if($_SESSION["carte_etat"][$i] == 1)
                                {                                    
                                    echo $_SESSION["nb_cartes"][$i];
                                    array_push($_SESSION["carte_retourne"], $i);
                                }
                        }      
                }
                var_dump($_SESSION["nb_cartes"]);   
        }                                                                                                                      
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
            <select name="selecteur" id="selecteur">    
                <option value="8">4 paires</option>
                <option value="12">6 paires</option>
                <option value="16">8 paires</option>
                <option value="20">10 paires</option>            
            </select>
            <input type="submit" name="choix" id="choix">
        </form>
    </main>
</body>
</html>