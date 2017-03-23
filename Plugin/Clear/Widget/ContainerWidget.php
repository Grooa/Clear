<?php

namespace Plugin\Clear\Widget;

/**
 * Represents a widget that can contain blocks.
 */
interface ContainerWidget {

	/**
	 * Get the blocks associated with a container.
	 *
	 * @param int $widgetId Id of container widget
	 * @return string[] Block names
	 */
	public function getBlockNames($widgetId, $data);

}
