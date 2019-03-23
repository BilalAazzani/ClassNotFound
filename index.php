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