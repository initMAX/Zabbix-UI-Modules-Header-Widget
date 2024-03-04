//<script>
window.widget_configuration_form = new class {

	init(options) {
		this._form = document.getElementById(options.form_id);

		jQuery('[name="font_color"]', this._form).colorpicker({"use_default": true});
		jQuery('[name="background_color"]', this._form).colorpicker({"use_default": true});
	}

}();