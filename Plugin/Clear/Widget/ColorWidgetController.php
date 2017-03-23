<?php

namespace Plugin\Clear\Widget;

/**
 * Represents a widget that can contain blocks.
 */
class ColorWidgetController extends \Ip\WidgetController {


	/**
	 * Override html rendering to add a "skin" attribute to the data and always 
	 * load default skin.
	 */
	public function generateHtml($revisionId, $widgetId, $data, $skin) {
		if ($skin) {
			$data['skin'] = $skin;
		}

		return parent::generateHtml($revisionId, $widgetId, $data, 'default');
	}


	/**
	 * Provide names for the skins.
	 */
	public function getSkins() {
		return array(
			array(
				'title' => 'Default',
				'name' => 'default'
			),
			array(
				'title' => 'Alternative color',
				'name' => 'alternative'
			)
		);
	}

}
