/**
 * Inintiate jQuery and zurb Foundation javascript
 */

var app = (function(document, $) {

	'use strict';
	var docElem = document.documentElement,

		_userAgentInit = function() {
			docElem.setAttribute('data-useragent', navigator.userAgent);
		},
		_init = function() {
			$(document).foundation();
			_userAgentInit();
		};

	return {
		init: _init
	};

})(document, jQuery);

(function() {

	'use strict';
	app.init();

	// Sticky Footer 
	// $(window).bind('load', function () {
	// 	var footer = $('#footer');
	// 	var pos = footer.position();
	// 	var height = $(window).height();
	// 	height = height - pos.top;
	// 	height = height - footer.height();
	// 	if (height > 0) {
	// 		footer.css({
	// 			'margin-top': height + 'px'
	// 		});
	// 	}
	// });

	//Basic fancy box
	$('.WmdbLightbox').fancybox({
		openEffect	: 'none',
		closeEffect	: 'none',
		titlePosition	:	'inside',
		helpers : {
			overlay : {
				showEarly  : false
			},
			media : {

			},
			title : {
				type : 'inside' // 'float', 'inside', 'outside' or 'over'
			}
		}
	});

})();