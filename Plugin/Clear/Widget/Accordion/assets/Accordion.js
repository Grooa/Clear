IpWidget_MyWidget = function () {

	this.init = function ($widgetObject, data) {
		$widgetObject.on('click', function (event) {
			event.preventDefault();
			$(event.target).parent().toggleClass('expanded');
		});

	};

};
