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
 * @package    Ves_Backend
 * @copyright  Copyright (c) 2014 Venustheme (http://www.venustheme.com/)
 * @license    http://www.venustheme.com/LICENSE-1.0.html
 */
namespace Ves\Backend\Block\Adminhtml;

class BackendDesign extends \Magento\Backend\Block\Template
{
	/**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
	// protected $_storeManager;

	/**
	 * @param \Magento\Framework\View\Element\Template\Context $context 
	 * @param array                                            $data    
	 */
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		array $data = []
		){
		parent::__construct($context, $data);
	}

	// public function getMediaUrl(){
	// 	$url = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	// 	return $url;
	// }
}