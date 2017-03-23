
IpWidget_Banner = function () {
	'use strict';

	/**
	 * Runs when this widget is initialized.
	 * Sets up event listeners and js data.
	 */
	this.init = function ($widgetObject, data) {
		if (Array.isArray(data) || typeof data !== 'object') {
			data = {};
		}

		this.$widgetObject = $widgetObject;
		this.data = data;

		$widgetObject
			.children()
			.children('img, div.no-image')
			.click(changeImage.bind(this));
	};


	/**
	 * Promt the user for a new image.
	 */
	function changeImage() {
		ipBrowseFile(function (files) {
			if (files.length) {
				setImage.call(this, files[0]);
			}
		}.bind(this), {preview: 'list', filter: null});
	}


	function setImage(file) {
		var $widgetObject = this.$widgetObject,
			data = this.data;

		data.fileName = file.fileName;
		console.log(data);
		$widgetObject.save(data, true);
	}

};
