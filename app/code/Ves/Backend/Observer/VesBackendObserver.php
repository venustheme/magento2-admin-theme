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
namespace Ves\Backend\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class VesBackendObserver implements ObserverInterface
{
	protected $_generator;

	public function __construct(
		\Ves\Backend\Model\Cssgen\Generator $generator
	){
		$this->_generator = $generator;
	}
	/**
     * Add coupon's rule name to order data
     *
     * @param EventObserver $observer
     * @return $this
     */
	public function execute(EventObserver $observer)
	{
		// $website = $observer->getEvent()->getWebsite();
		// $store = $observer->getEvent()->getStore();
		$this->_generator->generateCss();
	}
}