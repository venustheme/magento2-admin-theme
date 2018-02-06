<?php
/**
 * Venustheme
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Venustheme.com license that is
 * available through the world-wide-web at this URL:
 * http://www.venustheme.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Venustheme
 * @package    Ves_Themesettings
 * @copyright  Copyright (c) 2014 Venustheme (http://www.venustheme.com/)
 * @license    http://www.venustheme.com/LICENSE-1.0.html
 */
namespace Ves\Backend\Helper;
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;

class Theme extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /** @var \Magento\Store\Model\StoreManagerInterface */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var Theme
     */
    private $currentTheme;

    /**
     * @var CookieManagerInterface
     */
    protected $cookieManager;
    /**
     * @var \Ves\Themesettings\Helper\Data
     */
    protected $helperData;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\DesignInterface $design
     * @param PhpCookieManager $cookieManager
     * @param \Ves\Backend\Helper\Data $helperData
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\DesignInterface $design,
        PhpCookieManager $cookieManager,
        \Ves\Backend\Helper\Data $helperData,
        array $data = []
        ) {
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->currentTheme = $design->getDesignTheme();
        $this->_coreRegistry = $registry;
        $this->_scopeConfig = $context->getScopeConfig();
        $this->cookieManager = $cookieManager;
        $this->helperData = $helperData;
    }

    public function getCurrentTheme()
    {
        return $this->currentTheme;
    }

    public function getConfig($key, $package, $storeId = NULL, $default = NULL)
    {
        $store = $this->_storeManager->getStore($storeId);
        if($this->_coreRegistry->registry('ves_store')){
            $store = $this->_coreRegistry->registry('ves_store');
        }

        $result = $this->scopeConfig->getValue(
            $package.'/'.$key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);

        if($result == '' && $default){
            return $default;
        }
        return $result;
    }

    public function getGeneralCfg($group, $storeId = NULL, $default = NULL )
    {
        return $this->getConfig($group, "ves_backend_general", $storeId, $default);
    }

    public function getCustomizationCfg($group, $storeId = NULL, $default = NULL )
    {
        return $this->getConfig($group, "custom_code", $storeId, $default);
    }
}
