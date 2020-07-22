<?php 
include 'class_carte.php'; 
session_start();

    if(isset($_GET["deco"]))
        {
            session_destroy();
            header('Location:index.php');
        }

    if(!isset($_SESSION["carte"] ,$_SESSION["carte_retourne"]))//Crée des tableau vides
        {
            $_SESSION["carte"]= [];
            $_SESSION["carte_retourne"] = [];
        }
//Si on a choisi le nombre de paires à affcher, génère le bon nombre de carte avec un id unique et des valeurs en double
    if(isset($_GET["jeu"], $_GET["niveau"]) && empty($_SESSION["carte"]))    
        {
            $_SESSION["nb_paires"] = $_GET["niveau"]; 

            for($i = 1; $i<=$_SESSION["nb_paires"]; $i++)
                {
                    array_push($_SESSION["carte"], new Carte($i), new Carte($i));//Insertion des doublons dans le tableau carte              
                }    
           
            shuffle($_SESSION["carte"]);//Melange le tableau qui contient toutes les cartes           
        }


        // AFFICHAGE DU PLATEAU DE JEU

    if(isset($_SESSION["nb_paires"]))   
        {            
            ?>
            <section id="plateau">
            <?php

            if(isset($_POST[0]))
                {                            
                    $_SESSION["carte"][$_POST[0]]->setEtat();//Set l'état de la carte à 1
                    // echo $_SESSION["carte"][$i]->getValeur();
                    if($_SESSION["carte"][$_POST[0]]->getEtat() == 1)//Affiche la "valeur" de la carte
                        {                
                            //Reset l'état des cartes à 0 si elles n'ont pas la même valeur
                            if(count($_SESSION["carte_retourne"]) == 2 && $_SESSION["carte"][$_SESSION["carte_retourne"][0]]->getValeur() != $_SESSION["carte"][$_SESSION["carte_retourne"][1]]->getValeur())
                                {
                                    $_SESSION["carte"][$_SESSION["carte_retourne"][0]]->resetEtat();
                                    $_SESSION["carte"][$_SESSION["carte_retourne"][1]]->resetEtat();
                                    // $_SESSION["carte_retourne"][0] = $i;    
                                    // $_SESSION["carte_retourne"][1] = -1; 
                                    //var_dump($_SESSION["carte_retourne"]);
                                    $_SESSION["carte_retourne"] = [];
                                }                                        
                            //Set l'état des cartes à 2 si elles ont les mêmes valeurs
                            if(count($_SESSION["carte_retourne"]) == 2 && $_SESSION["carte"][$_SESSION["carte_retourne"][0]]->getValeur() == $_SESSION["carte"][$_SESSION["carte_retourne"][1]]->getValeur())
                                {                     
                                    //echo 'GAGNE';                      
                                    $_SESSION["carte"][$_SESSION["carte_retourne"][0]]->winEtat();
                                    $_SESSION["carte"][$_SESSION["carte_retourne"][1]]->winEtat();                                                                           
                                    //var_dump($_SESSION["carte_retourne"]);
                                    $_SESSION["carte_retourne"] = [];

                                }
                            //Push dans le tableau maximum 2 cartes pour checker leur valeur par la suite
                            if(empty($_SESSION["carte_retourne"]) || (count($_SESSION["carte_retourne"]) == 1))//Rempli le tableau si il est vide ou si il y'a déjà une ligne                            
                                {
                                    array_push($_SESSION["carte_retourne"], $_POST[0]);//Insére la valeur de la carte dans le tableau des cartes retournées
                                    // var_dump($_SESSION["carte_retourne"]);

                                }
                            
                        }                            
                }

            for($i = 0; $i<($_SESSION["nb_paires"]*2); $i++)//Affiche le bon nombre de cartes sur le plateau                  
                {   
                    if($_SESSION["carte"][$i]->getEtat() == 0 )//Affiche la carte "face cachée"
                        {
                            ?>
                            <form action="index.php" method="POST">
                                <input type="submit" name="<?= 0?>" id="" value="<?= $i ?>">
                            </form>
                            <?php    
                        }   
                    else if($_SESSION["carte"][$i]->getEtat() == 2)//Supprime les cartes si la paires est trouvée
                        {
                            echo '';
                        }
                    else//Affiche la valeur de la carte si son état est à 1
                        {                           
                            echo $_SESSION["carte"][$i]->getValeur();                                                      
                        }
                        
                }                      
                // var_dump($_SESSION["carte_retourne"]);
                // var_dump($_SESSION);
                // var_dump($_POST);
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