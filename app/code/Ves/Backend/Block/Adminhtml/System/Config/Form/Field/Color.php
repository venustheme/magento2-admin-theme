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
namespace Ves\Backend\Block\Adminhtml\System\Config\Form\Field;

class Color extends \Magento\Config\Block\System\Config\Form\Field
{
	/**
     * Add color picker
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return String
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
    	$elementId = $element->getHtmlId();
    	$html = $element->getElementHtml();
    	$moduleName = $this->getModuleName();
    	$mcPath = $this->getViewFileUrl($moduleName.'/js/mcolorpicker');
    	$html .= '<script>
    	require([
        "jquery",
        "Ves_Backend/js/mcolorpicker/mcolorpicker.min"
        ], function (jQuery) {
                jQuery(document).ready(function(){
    				var folderImageUrl = "'.$mcPath.'/images";
            		jQuery.noConflict();
    				jQuery.fn.mColorPicker.init.replace = false;
    				jQuery.fn.mColorPicker.defaults.imageFolder = "'. $mcPath .'/images/";
    				jQuery.fn.mColorPicker.init.allowTransparency = true;
    				jQuery.fn.mColorPicker.init.showLogo = false;
    				jQuery("#'. $elementId .'").attr("data-hex", true).width("250px").mColorPicker().change(function(){ console.log("def") });
    				
    				jQuery("#mColorPickerImg").css("background-image","url('.$mcPath.'/images/picker.png)");
    				jQuery("#mColorPickerFooter").css("background-image","url('.$mcPath.'/images/grid.gif)");
    				jQuery("#mColorPickerFooter img").attr({"src":"'.$mcPath.'/images/meta100.png"});

    				jQuery("#'. $elementId .'").click(function(){
    					jQuery("#icp_'. $elementId .' img").trigger("click");
    				});
                })
			});</script>';
    	return $html;
    }

}