<?php
#Session start
session_start();
// session_destroy();
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

#header
require_once(PATH_VIEWS.'header.php');

#Default action home
if(empty($_GET['action'])){
    $_GET['action']='home';
}
switch ($_GET['action']) {
    case 'login': # action=login
        require_once(PATH_CONTROLLERS.'LoginController.php');
        $controller = new LoginController($db);
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
    case 'question': # simplement afficher le formulaire
    case 'insert-question': # on insere la question, une fois le form rempli
        require_once(PATH_CONTROLLERS.'QuestionController.php');
        $controller = new QuestionController($db, 'create');
        break;
    case 'register': # action=register
        require_once(PATH_CONTROLLERS.'RegisterController.php');
        $controller = new RegisterController($db);
        break;
    case 'show-question': # action=register
        require_once(PATH_CONTROLLERS.'QuestionController.php');
        $controller = new QuestionController($db, 'show');
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