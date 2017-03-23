<?php

namespace Plugin\Clear;

use \Ip\Internal\Content\Model as ContentModel;

class Event
{

	public static function ipBeforeController($data)
	{
		ipAddJs('assets/clear.js');
	}

	/**
	 * Update language and revision of  "sub-widgets" in containers when widget
	 * is moved.
	 */
	public static function ipBeforeWidgetMove($info)
	{

		// Get the related widget
		$widget = ContentModel::getWidgetRecord($info['widgetId']);
		$widgetObject = ContentModel::getWidgetObject($widget['name']);

		if (!($widgetObject instanceof Widget\ContainerWidget)) {
			return;
		}

		// Extract data
		$newRevisionId = $info['revisionId'];
		$newLanguageId = $info['languageId'];
		$oldRevisionId = $widget['revisionId'];
		$oldLanguageId = $widget['languageId'];

		// Update if necessary
		if (
			($oldRevisionId !== $newRevisionId ||
			$oldLanguageId !== $newLanguageId)
		) {

			$blockNames = $widgetObject->getBlockNames(
				$widget['id'],
				$widget['data']
			);

			foreach ($blockNames as $blockName) {

				$subwidgets = ContentModel::getBlockWidgetRecords(
					$blockName,
					$oldRevisionId,
					$oldLanguageId
				);

				// Move each sub-widget
				foreach ($subwidgets as $i => $subwidget) {
					ContentModel::moveWidget(
						$subwidget['id'],
						$i,
						$blockName,
						$newRevisionId,
						$newLanguageId
					);
				}
			}
		}

	}
}
