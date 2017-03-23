
IpWidget_CoverImage = function () {
	'use strict';

	/**
	 * Prompt the user for a new background image.
	 */
	this.changeBackground = function () {
		ipBrowseFile(function (files) {
			if (files.length) {
				setBackground.call(this, files[0]);
			}
		}.bind(this), {preview: 'thumbnails', filter: 'images'});
	};

	/**
	 * Add a new box to this image cover.
	 */
	this.addBox = function () {
		var data = this.data;

		data.boxIds.push(data.nextBoxId++);
		
		// Save and refresh
		this.$widgetObject.save(data, true);
	}

	/**
	 * Remove a box from this image cover.
	 *
	 * @param number boxIndex Index of box to remove
	 */
	this.removeBox = function (boxIndex) {
		var data = this.data;

		data.boxIds.splice(boxIndex, 1);

		this.$widgetObject.save(data, true);
	};


	/**
	 * Runs when this widget is initialized.
	 * Sets up event listeners and js data.
	 */
	this.init = function ($widgetObject, data) {
		this.$widgetObject = $widgetObject;
		this.data = data;

		data.boxIds = data.boxIds || [];
		data.nextBoxId = data.nextBoxId || data.boxIds.length + 1;

		// Register listeners for the menu
		addMenuListener.call(this, 'changeBackground');
		addMenuListener.call(this, 'addBox');

		// Add remove buttons on each box
		addRemoveListener.call(this);

	};


	/**
	 * Runs when this widget is added.
	 * Immediately asks the user to select a background image.
	 */
	this.onAdd = function () {
		this.changeBackground();
	};



	function setBackground(file) {
		var $widgetObject = this.$widgetObject,
			data = this.data;

		$widgetObject
			.children('.cover')
			.css('background-image', 'url(' + file.originalUrl + ')');

		data.fileName = file.fileName;
		$widgetObject.save(this.data);
	}

	function addMenuListener(item) {
		var coverImage = this;

		this.$widgetObject
			.find('.' + item)
			.on('click.CoverImage', function (e) {
				e.preventDefault();
				coverImage[item].call(coverImage);
			});
	}

	function addRemoveListener() {
		var coverImage = this;

		this.$widgetObject
			.find('.box > .ipWidgetCoverImageRemove')
			.click(function (e) {
				e.preventDefault();
				coverImage.removeBox(
					$(e.target).parent().index()
				);
			});

	}


};
