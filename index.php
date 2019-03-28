<?php
#Session start
session_start();

#Global variables
define('PATH_VIEWS','views/');
define('PATH_MODELS','models/');
define('PATH_CONTROLLERS','controllers/');
define('SESSION_ID',session_id());


#Class inclusion
function loadClasse($class) {
    require_once('models/' . $class . '.class.php');
}
spl_autoload_register('loadClasse');

# Data base connection
require_once(CHEMIN_MODELS . 'db.php');
$db=Db::getInstance();

#header
require_once(CHEMIN_VUES.'header.php');

#Default action home
if(empty($_GET['action'])){
    $_GET['action']='home';
}
switch ($_GET['action']) {
    case 'login': # action=genese
        require_once(CHEMIN_CONTROLEURS.'LoginController.php');
        $controller = new AccueilController();
        break;
    case 'admin':
        require_once(CHEMIN_CONTROLEURS.'AdminController.php');
        $controller = new AdminController($db);
        break;
    case 'archive':
        require_once(CHEMIN_CONTROLEURS.'ArchiveController.php');
        $controller = new ArchiveController();
        break;
    case 'categorie': # action=contact
        require_once(CHEMIN_CONTROLEURS.'CategorieController.php');
        $controller = new CategorieController();
        break;
    case 'logout': # action=genese
        require_once(CHEMIN_CONTROLEURS.'LogoutController.php');
        $controller = new LogoutController();
        break;
    case 'membre':
        require_once(CHEMIN_CONTROLEURS.'MembreController.php');
        $controller = new MembreController($db);
        break;
    case 'question':
        require_once(CHEMIN_CONTROLEURS.'QuestionController.php');
        $controller = new QuestionController();
        break;
    case 'register': # action=contact
        require_once(CHEMIN_CONTROLEURS.'RegisterController.php');
        $controller = new RegisterController();
        break;
    case 'utilisateur': # action=contact
        require_once(CHEMIN_CONTROLEURS.'UtilisateurController.php');
        $controller = new UtilisateurController();
        break;
    default: # Par défaut, le contrôleur de l'accueil est sélectionné
        require_once(CHEMIN_CONTROLEURS.'AccueilController.php');
        $controller = new AccueilController();
        break;
}

#switch action
switch ($_GET['action']){
    default:
        require_once('controllers/HomeController.php');
        $controller=new HomeController();
        break;
}

$controller->run();

#footer
require_once(PATH_VIEWS.'footer.php');
?>