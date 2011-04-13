jQuery(document).ready(function($) {
	$('.wpis-colorpicker').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	}).bind('keyup', function() {
		$(this).ColorPickerSetColor(this.value);
	});
	
	$('.wpis-slider').each(function() {
		$(this).slider({
			min: 0,
			max: 100,
			value: $('#' + $(this).attr('id').substr(0, $(this).attr('id').length - 7)).val(),
			slide: function(event, ui) {
				$('#' + $(this).attr('id').substr(0, $(this).attr('id').length - 7)).val($(this).slider('value'));
			}
		});
	});
});