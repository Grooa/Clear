<?php

namespace Plugin\Clear\Widget\Accordion;
use Plugin\Clear\Widget\ContainerWidget;
use Plugin\Clear\Widget\ColorWidgetController;

class Controller extends ColorWidgetController implements ContainerWidget
{

	public function generateHtml($revisionId, $widgetId, $data, $skin) {

		$data['revisionId'] = $revisionId;
		$data['blockName'] = $this->getBlockNames($widgetId, $data)[0];

		return parent::generateHtml($revisionId, $widgetId, $data, $skin);
	}


	public function duplicate($oldId, $newId, $data) {
		if (!isset($data['blockName'])) {
			$data['blockName'] = $this->getBlockNames($oldId, $data)[0];
		}

		return $data;
	}

	public function getBlockNames($widgetId, $data) {
		return array(
			isset($data['blockName']) ?
				$data['blockName'] : 'accordion_' . $widgetId
		);
	}

}
