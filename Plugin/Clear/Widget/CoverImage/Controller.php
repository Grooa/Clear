<?php

namespace Plugin\Clear\Widget\CoverImage;
use Plugin\Clear\Widget\ContainerWidget;
use Plugin\Clear\Widget\ColorWidgetController;

class Controller extends ColorWidgetController implements ContainerWidget
{

	public function getTitle() {
		return "Cover Image";
	}


	public function update($widgetId, $postData, $currentData) {

		// Bind and unbind files
		$currentFileName = isset($currentData['fileName']) ? $currentData['fileName'] : null;
		$postFileName = isset($postData['fileName']) ? $postData['fileName'] : null;

		if ($postFileName != $currentFileName) {
			// Release old file (if any)
			if ($currentFileName) {
				ipUnbindFile($currentFileName, 'Clear', $widgetId);
			}

			// Bind new file
			if ($postFileName) {
				ipBindFile($postFileName, 'Clear', $widgetId);
			}
		}

		return $postData;
	}


	public function defaultData() {
		return array(
			'boxIds' => array(0),
			'nextBoxId' => 1
		);
	}


	public function generateHtml($revisionId, $widgetId, $data, $skin) {

		// Create reflection
		if (!empty($data['fileName'])) {

			$reflection = ipReflection(
				$data['fileName'],
				array(
					'type' => 'width',
					'width' => 1280
				)
			);

			$data['imageUrl'] = ipFileUrl($reflection);
		}

		$data['blockNames'] = $this->getBlockNames($widgetId, $data);
		$data['revisionId'] = $revisionId;

		return parent::generateHtml($revisionId, $widgetId, $data, $skin);
	}


	public function optionsMenu($revisionId, $widgetId, $data, $skin) {
		return array(

			array(
				'title' => 'Change background',
				'attributes' => array(
					'class' => 'changeBackground'
				)
			),

			array(
				'title' => 'Add box',
				'attributes' => array(
					'class' => 'addBox'
				)
			)

		);
	}


	public function duplicate($oldId, $newId, $data) {
		if (empty($data['blockPrefix'])) {
			$data['blockPrefix'] = 'box_' . $oldId;
		}

		return $data;
	}


	public function getBlockNames($widgetId, $data) {
		$blockPrefix = isset($data['blockPrefix']) ?
			$data['blockPrefix'] : "box_$widgetId";

		if (!isset($data['boxIds']) || !is_array($data['boxIds'])) {
			$data['boxIds'] = array();
		}

		return array_map(
			function ($boxId) use ($blockPrefix) {
				return $blockPrefix . '_' . $boxId;
			},
			$data['boxIds']
		);
	}

}
