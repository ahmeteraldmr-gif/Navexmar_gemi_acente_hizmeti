<?php
/**
 * Home Controller
 * Ana sayfa ve diğer genel sayfalar için controller
 */

require_once SRC_PATH . '/Controllers/BaseController.php';
require_once SRC_PATH . '/Models/Page.php';
require_once SRC_PATH . '/Models/Service.php';
require_once SRC_PATH . '/Models/HeaderImage.php';
require_once SRC_PATH . '/Models/Setting.php';

class HomeController extends BaseController {
    private $pageModel;
    private $serviceModel;
    private $headerImageModel;
    private $settingModel;
    
    public function __construct() {
        parent::__construct();
        $this->pageModel = new Page();
        $this->serviceModel = new Service();
        $this->headerImageModel = new HeaderImage();
        $this->settingModel = new Setting();
    }
    
    /**
     * Ana Sayfa
     */
    public function index() {
        // Sayfa bilgilerini getir
        $page = $this->pageModel->getByKey('home');
        $sections = $this->pageModel->getSections('home');
        
        // Header görseli getir
        $headerImage = $this->headerImageModel->getPageHeaderImage('home');
        
        // Hizmetleri getir (ana sayfada gösterilecek)
        $services = $this->serviceModel->getAllOrdered($this->lang);
        
        // Site ayarlarını getir
        $settings = $this->settingModel->getAllSettings();
        
        // View'e veri gönder
        $this->render('pages/home', [
            'page' => $page,
            'sections' => $sections,
            'headerImage' => $headerImage,
            'services' => $services,
            'settings' => $settings,
            'lang' => $this->lang
        ]);
    }
    
    /**
     * Yaklaşımımız Sayfası
     */
    public function approach() {
        $page = $this->pageModel->getByKey('approach');
        $sections = $this->pageModel->getSections('approach');
        $headerImage = $this->headerImageModel->getPageHeaderImage('approach');
        $settings = $this->settingModel->getAllSettings();
        
        $this->render('pages/approach', [
            'page' => $page,
            'sections' => $sections,
            'headerImage' => $headerImage,
            'settings' => $settings,
            'lang' => $this->lang
        ]);
    }
    
    /**
     * Politikalar Sayfası
     */
    public function policies() {
        $page = $this->pageModel->getByKey('policies');
        $sections = $this->pageModel->getSections('policies');
        $headerImage = $this->headerImageModel->getPageHeaderImage('policies');
        $settings = $this->settingModel->getAllSettings();
        
        $this->render('pages/policies', [
            'page' => $page,
            'sections' => $sections,
            'headerImage' => $headerImage,
            'settings' => $settings,
            'lang' => $this->lang
        ]);
    }
    
    /**
     * Dil değiştir
     * 
     * @param string $code Dil kodu (tr, en)
     */
    public function changeLanguage($code) {
        if (setLang($code)) {
            // Referrer'a dön veya ana sayfaya yönlendir
            $referrer = $_SERVER['HTTP_REFERER'] ?? url('/');
            $this->redirect($referrer);
        } else {
            $this->redirect(url('/'));
        }
    }
}
