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
namespace Ves\Backend\Model\Cssgen;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Directory\Helper\Data;
use Magento\Framework\Locale\ResolverInterface;

class Generator {

	/**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
	protected $_storeManager;

	/**
     * @var \Magento\Framework\Message\ManagerInterface
     */
	private $messageManager;

	/**
     * @var \Magento\Framework\View\Element\BlockFactory
     */
	protected $_blockFactory;


	/**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
	protected $_scopeConfig;

	/**
     * @var \Ves\Backend\Helper\Data
     */
	protected $_vesBackendData;

	protected $_locale;

    /**
     * Generator constructor.
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\Element\BlockFactory $blockFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Ves\Backend\Helper\Data $vesBackendData
     * @param ResolverInterface $locale
     */
	public function __construct(
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\View\Element\BlockFactory $blockFactory,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\Framework\Message\ManagerInterface $messageManager,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Ves\Backend\Helper\Data $vesBackendData,
		ResolverInterface $locale
		)
	{
		$this->_storeManager = $storeManager;
		$this->_blockFactory = $blockFactory;
		$this->_filesystem = $filesystem;
		$this->messageManager = $messageManager;
		$this->_scopeConfig = $scopeConfig;
		$this->_vesBackendData = $vesBackendData;		
		$this->_locale = $locale;
	}

	public function generateCss(){
		$cssBlockHtml = $this->_blockFactory->createBlock('Ves\Backend\Block\Adminhtml\BackendDesign')->setTemplate("Ves_Backend::backend_styles.phtml")->toHtml();
		$cssBlockHtml = $this->_compressCssCode($cssBlockHtml);

		try{
			if (empty($cssBlockHtml)) {
				throw new Exception( __("The system has an issue when create css file") ); 
			}

			$default_locale = $this->_locale->getDefaultLocale();
			$enableCssMinify = $this->_scopeConfig->getValue(
				\Magento\Config\Model\Config\Backend\Admin\Custom::XML_PATH_DEV_CSS_MINIFY_FILES);
			
			// pub/static/adminhmtl
			$dir = $this->_filesystem->getDirectoryWrite(DirectoryList::STATIC_VIEW);

			$fileName = 'adminhtml' . DIRECTORY_SEPARATOR . 'Magento' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . $default_locale . DIRECTORY_SEPARATOR .'Ves_Backend/css/custom_style.css';

			$dir->writeFile($fileName, $cssBlockHtml);
			$this->messageManager->addSuccess(__('The %1 file updated successfully.', $dir->getAbsolutePath($fileName)));

		}catch (\Exception $e){
			$this->messageManager->addError(__('The system has an issue when create css file'). '<br/>Message: ' . $e->getMessage());
		}
	}

	private function _compressCssCode( $input_text = "") {
        $output = str_replace(array("\r\n", "\r"), "\n", $input_text);
        $lines = explode("\n", $input_text);
        $new_lines = array();

        foreach ($lines as $i => $line) {
            if(!empty($line))
                $new_lines[] = trim($line);
        }
        return implode($new_lines);
    }
}