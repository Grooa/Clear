<?php

namespace Plugin\Clear\Widget\Banner;
use Plugin\Clear\Widget\ContainerWidget;
use Plugin\Clear\Widget\ColorWidgetController;

class Controller extends ColorWidgetController implements ContainerWidget
{

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


	public function generateHtml($revisionId, $widgetId, $data, $skin) {

		// Generate file url
		if (!empty($data['fileName'])) {
			$data['imageUrl'] = ipFileUrl('file/repository/' . $data['fileName']);
		}

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
				$data['blockName'] : 'banner_' . $widgetId
		);
	}

}
