<?php
    class Carte
        {           
            private $valeur;
            private $etat;

            function __construct($i)
                {
                    $this->etat = 0;      
                    $this->valeur = $i;                              
                }
            //Initialise l'état de la carte  à 1 après avoir cliquer dessus
            public function setEtat()
                {
                    $this->etat = 1;
                    return ($this->etat);
                }
            //Reset l'état de la carte si la paire n'a pas été trouvée
            public function resetEtat()
                {
                    $this->etat = 0;
                    return ($this->etat);
                }
            //Set l'état de la carte à 2 quand la paire est trouvé
            public function winEtat()
                {
                    $this->etat = 2;
                    return ($this->etat);
                }
            //Initialise la valeur de la carte
            public function setValeur($i)
                {
                    $this->valeur = $i;      
                    return true;
                }
            public function getEtat()
                {
                    return($this->etat);
                }           
            public function getValeur()    
                {
                    return ($this->valeur);
                }
        }
?>