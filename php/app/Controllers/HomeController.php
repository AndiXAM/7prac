<?php



require_once ROOT_PATH . '/app/models/SessionModel.php';


class HomeController {
    private $sessionModel;

    public function __construct() {
        $this->sessionModel = new SessionModel();
        $this->sessionModel->startSession();
        $this->sessionModel->setCookies();
    }

    public function index() {
        $username = $this->sessionModel->getUsername();
        $theme = $this->sessionModel->getTheme();
        $language = $this->sessionModel->getLanguage();
    
        $cookieData = $this->sessionModel->getCookieData();
    
        
        require_once ROOT_PATH . '/app/views/home.php';
    }
}