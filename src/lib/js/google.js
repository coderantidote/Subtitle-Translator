function googleTranslateElementInit() {
	new google.translate.TranslateElement({
		pageLanguage: 'en',
		autoDisplay: false,
		layout: google.translate.TranslateElement.InlineLayout.SIMPLE
	}, 'google_translate_element');
	$("#google_translate_element img").eq(0).remove();

	function changeGoogleStyles() {
		if ($('.goog-te-menu-frame').contents().find('.goog-te-menu2').length) {
			$('.goog-te-menu-frame').contents().find('.goog-te-menu2').css({
				'max-width': '100%',
				'overflow-x': 'auto',
				'box-sizing': 'border-box',
				'height': 'auto'
			});
		} else {
			setTimeout(changeGoogleStyles, 50);
		}
	}
	changeGoogleStyles();
}