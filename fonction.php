<?php
    function connexion()
        {
            try 
                {
                    $bd = new PDO('mysql:host=localhost;dbname=memory;charset=utf8','root','', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                }
            catch(PDOException $e)
                {
                    echo 'Échec de la connexion : ' . $e->getMessage();
                    exit;
                }
            return $bd;
        }
    function issetUser($login, $bd)
        {
            $query_issset_user = $bd->query("SELECT * FROM utilisateurs WHERE login='$login'");
            $isset_user = $query_issset_user->fetch();

            return $isset_user;
        }
    function register($login, $password, $email, $bd)
        {                    
            $insert_user = $bd->prepare("INSERT INTO utilisateurs (login, password, email) VALUES ('?', '?', '?')");
            $insert_user->execute([
                $login,
                $password,
                $email
            ]);                                                   
        }    

?>