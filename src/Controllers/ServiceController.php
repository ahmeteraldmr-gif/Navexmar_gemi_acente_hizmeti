<?php
/**
 * Service Controller
 * Hizmetler sayfası için controller
 */

require_once SRC_PATH . '/Controllers/BaseController.php';
require_once SRC_PATH . '/Models/Service.php';
require_once SRC_PATH . '/Models/Page.php';
require_once SRC_PATH . '/Models/HeaderImage.php';
require_once SRC_PATH . '/Models/Setting.php';

class ServiceController extends BaseController {
    private $serviceModel;
    private $pageModel;
    private $headerImageModel;
    private $settingModel;
    
    public function __construct() {
        parent::__construct();
        $this->serviceModel = new Service();
        $this->pageModel = new Page();
        $this->headerImageModel = new HeaderImage();
        $this->settingModel = new Setting();
    }
    
    /**
     * Hizmetler Listesi
     */
    public function index() {
        // Sayfa bilgilerini getir
        $page = $this->pageModel->getByKey('services');
        $headerImage = $this->headerImageModel->getPageHeaderImage('services');
        
        // Tüm hizmetleri getir
        $services = $this->serviceModel->getAllOrdered($this->lang);
        
        // Site ayarlarını getir
        $settings = $this->settingModel->getAllSettings();
        
        // View'e veri gönder
        $this->render('pages/services', [
            'page' => $page,
            'headerImage' => $headerImage,
            'services' => $services,
            'settings' => $settings,
            'lang' => $this->lang
        ]);
    }
    
    /**
     * Hizmet Detay Sayfası - Hizmetlerimiz sayfasındaki ilgili bölüme yönlendirir
     * 
     * @param string $slug Hizmet slug'ı
     */
    public function detail($slug) {
        $this->redirect(url('/hizmetlerimiz#' . $slug));
    }
}
