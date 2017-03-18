<?php
/**
 * @category Fishpig
 * @package Fishpig_Wordpress_Addon_EventsCalendar
 * @license http://fishpig.co.uk/license.txt
 * @author Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_EventsCalendar_Block_Sidebar_Widget extends Fishpig_Wordpress_Block_Sidebar_Widget_Abstract
{
	protected function _beforeToHtml()
	{
		if (!Mage::helper('wp_addon_eventscalendar')->isEnabled()) {
			return false;
		}

		$widgetId = $this->getWidgetType() . '-' . $this->getWidgetIndex();
echo $widgetId;exit;
		global $wp_widget_factory;
		
		foreach($wp_widget_factory->widgets as $key => $value) {
			if ($value->id === $widgetId) {
				$this->setWidgetObject($value);
				break;
			}	
		}
		
		if (!$this->getWidgetObject()) {
			return $this;
		}

		ob_start();

		the_widget(get_class($this->getWidgetObject()), $this->getWidgetObject(), array(
			'widget_id' => $widgetId,
#			'before_widget' => '<div class="block">',
#			'after_widget' => '</div>',
#			'before_title' => '<div class="block-title"><strong><span>',
#			'after_title' => '</span></strong></div><div class="block-content">'
		));

		$this->setText(ob_get_clean());

		parent::_beforeToHtml();

		Mage::getSingleton('wp_addon_eventscalendar/observer')->enableHeadFooterIncludes();

		return $this;
	}
	
    protected function _toHtml()
    {
        if (!$this->_beforeToHtml()) {
            return '';
        }

        return $this->getText();
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
