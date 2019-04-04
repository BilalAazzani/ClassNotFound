<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 18/03/2019
 * Time: 09:22
 */

class HomeController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run(){
        # Mot clé de recherche
        $html_motcle='';

        # Recherche si un mot clé est entré dans le formulaire form_recherche
        if (!empty($_POST['form_search'])
            && !empty($_POST['keyword'])) {
            $tabquestions=$this->_db->select_question($_POST['keyword']);
            $html_motcle=htmlspecialchars($_POST['keyword']); # Protection faille XSS pour l'affichage
        } else {
            # Sélection de tous les livres sous forme de tableau
            $tabquestions=$this->_db->select_question();
        }

        # Ecrire ici la vue livres.php
        # $tablivres contient un tableau de livres
        require_once(PATH_VIEWS . 'home.php');
    }


}
?>