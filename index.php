<?php
#Session start
session_start();

#Global variables
define('PATH_VIEWS','views/');
define('PATH_MODELS','models/');
define('PATH_CONTROLLERS','controllers/');
define('SESSION_ID',session_id());


#Class inclusion
function loadClass($class) {
    require_once('models/' . $class . '.class.php');
}
spl_autoload_register('loadClass');

# Data base connection
require_once(PATH_MODELS . 'Db.class.php');
$db=Db::getInstance();

# Pour le header : admin ou login selon que la variable de session 'authentifie' existe ou pas
if (empty($_SESSION['authentifie'])){
    $actionloginadmin='login';
    $libelleloginadmin='Login';
} else {
    $actionloginadmin='admin';
    $libelleloginadmin='Zone Admin';
}
#header
require_once(PATH_VIEWS.'header.php');

#Default action home
if(empty($_GET['action'])){
    $_GET['action']='home';
}
switch ($_GET['action']) {
    case 'login': # action=login
        require_once(PATH_CONTROLLERS.'LoginController.php');
        $controller = new LoginController();
        break;
    case 'admin': # action = admin
        require_once(PATH_CONTROLLERS.'AdminController.php');
        $controller = new AdminController();
        break;
    case 'archive': # action = archive
        require_once(PATH_CONTROLLERS.'ArchiveController.php');
        $controller = new ArchiveController();
        break;
    case 'category': # action= category
        require_once(PATH_CONTROLLERS.'CategoryController.php');
        $controller = new CategoryController();
        break;

    case 'logout': # action= logout
        require_once(PATH_CONTROLLERS.'LogoutController.php');
        $controller = new LogoutController();
        break;
    case 'member': # action = member
        require_once(PATH_CONTROLLERS.'MemberController.php');
        $controller = new MemberController();
        break;
    case 'question': # action = question
        require_once(PATH_CONTROLLERS.'QuestionController.php');
        $controller = new QuestionController('create');
        break;
    case 'register': # action=register
        require_once(PATH_CONTROLLERS.'RegisterController.php');
        $controller = new RegisterController();
        break;
    case 'show-question': # action=register
        require_once(PATH_CONTROLLERS.'RegisterController.php');
        $controller = new QuestionController('show');
        break;
    default: # default controller home
        require_once(PATH_CONTROLLERS.'HomeController.php');
        $controller = new HomeController($db);
        break;
}

$controller->run();

#footer
require_once(PATH_VIEWS.'footer.php');
?>