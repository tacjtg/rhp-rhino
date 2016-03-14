jQuery(document).ready(function($) {
	// General function to hide all Woo Settings deemed unnecessary
	// CURRENTLY NOT USED as of v1.0.2
	window.rhino_toggle_settings = function() {
		var togglers = [
			'#general-settings #display-options table.form-table tr:eq(3)',
			'#general-styling table.form-table tr:eq(0)',
			'#general-styling table.form-table tr:eq(1)',
			'#general-styling table.form-table tr:eq(10)',
			'#general-styling table.form-table tr:eq(11)',
			'span.logo.alignright' // Logo test
		];
		$( togglers.join(',') ).toggle();
	};
	window.rhino_toggle_settings();

	// Alt + R to toggle settings
	$(window).keydown(function (e){
		if( e.altKey && e.keyCode == 82 ) {
			window.rhino_toggle_settings();
		}
	});

	// Apply Ace Syntax Highlighter
	if( $('#woo_custom_css').length && typeof('ace') !== 'undefined' ) {
		$('#woo_custom_css').before('<div id="ace_custom_css" />').hide();

		var editor = ace.edit('ace_custom_css');
		editor.setTheme('ace/theme/monokai');
		editor.getSession().setMode('ace/mode/css');
		editor.setOption('minLines',200);

		editor.setValue( $('#woo_custom_css').val() );
		editor.getSession().on('change', function(e) {
			$('#woo_custom_css').val( editor.getSession().getValue() );
		});

		// Alt + S to Save Ace Editor
		$(window).keydown(function (e){
			if( e.altKey && e.keyCode == 83 ) {
				$('.ace_content').css('opacity','0.1').css('background-color','black');
				editor.setOptions({
					    readOnly: true,
					    highlightActiveLine: false,
					    highlightGutterLine: false
				});

				$('#submit').trigger('click');
				return false;
			}
		});
	}
});
