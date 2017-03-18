<?php
/**
 * @category Fishpig
 * @package Fishpig_Wordpress_Addon_EventsCalendar
 * @license http://fishpig.co.uk/license.txt
 * @author Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_EventsCalendar_Block_Sidebar_Widget_Event_List extends Fishpig_Wordpress_Block_Sidebar_Widget_Abstract
{
	protected function _beforeToHtml()
	{
		if (!Mage::helper('wp_addon_eventscalendar')->isEnabled()) {
			return false;
		}

		parent::_beforeToHtml();

		$this->setPosts(
			Mage::getResourceModel('wordpress/post_collection')
				->addPostTypeFilter('tribe_events')
				->load()
			);
		
		if (!$this->getTemplate()) {
			$this->setTemplate('wordpress-addons/eventscalendar/widget.phtml');
		}

		return $this;
	}

	/**
	 * Retrieve the default title
	 *
	 * @return string
	 */
	public function getDefaultTitle()
	{
		return $this->__('Upcoming Events');
	}
}
