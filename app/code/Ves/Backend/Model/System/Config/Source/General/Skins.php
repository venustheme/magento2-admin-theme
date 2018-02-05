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
namespace Ves\Backend\Model\System\Config\Source\General;

class Skins implements \Magento\Framework\Option\ArrayInterface
{

    protected $_vesBackendData;

    /**
     * Skins constructor.
     * @param \Ves\Backend\Helper\Data $vesBackendData
     */
    public function __construct(
        \Ves\Backend\Helper\Data $vesBackendData
        ) {
        $this->_vesBackendData = $vesBackendData;
    }

    public function toOptionArray()
    {
        $output = [];
        $moduleViewPath = $this->_vesBackendData->getModuleDirectory();
        $skinDir = $moduleViewPath.'/adminhtml/web/css/skins/';

        $skins = glob($skinDir . '*.css');
        $output[] = [
            'label' => __('Default'),
            'value' => ''
        ];
        $replaceLabelPattern = [$skinDir => '','.css'=>''];
        $replaceValuePattern = [$skinDir => ''];
        foreach ($skins as $k => $v) {
             $output[] = [
                'label' => ucfirst(str_replace(array_keys($replaceLabelPattern),array_values($replaceLabelPattern),$v)),
                'value' => str_replace(array_keys($replaceValuePattern),array_values($replaceValuePattern),$v)
                ];
        }
        return $output;
    }

}