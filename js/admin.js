acf.add_filter('color_picker_args', function(args, $field) {

	// custom color picker colors
	args.palettes = ['#4D545E', '#aeccd3', '#617E82', '#ffffff', '#F2F0E8', '#E0BA5C']


	// return
	return args;

});

jQuery(document).ready(function($) {
	// Code that uses jQuery's $ can follow here.

	function loadSlider(id) {
		console.log('load slider')
		var isInit = 'slick-initialized';



		$('.center-mode-carousel').each(function() {
			if (!$(this).hasClass(isInit)) {
				$(this).slick({
					centerMode: true,
					slidesToShow: 1,

				});
			}
		});


	}

	var initializeBlock = function($block) {

		var x = $($block[0])
		var hasSlider = $(x).find('.slick-slider-selector');
		var id = $(hasSlider).attr('id');

		if (hasSlider.length) {

			if ($(hasSlider).hasClass('slick-initialized')) {

				$(hasSlider).slick('unslick');

			}

			loadSlider(id)
			return
		}
		// console.log('Block Init')
		loadSlider()

	}

	// Initialize each block on page load (front end).

	// Initialize dynamic block preview (editor).
	function resetAllSliders(selector) {
		console.log(selector)
		if (selector) {
			// console.log('selector')
			if ($(selector).find('.slick-slider-selector').hasClass('slick-initialized')) {
				$(selector).find('.slick-slider-selector').slick('unslick');
			}
		} else {
			// console.log('NO selector')
			$(".slick-slider-selector").each(function() {
				if ($(this).hasClass('slick-initialized')) {
					$(this).slick('unslick');
				}
			});
		}

	}



	if (window.acf) {




		//  console.log('window.acf')
		window.acf.addAction('render_block_preview', initializeBlock);



		window.acf.addAction('append', function($el) {


			var result;
			if ($($el[0]).hasClass('acf-fields')) {
				var label = $($el[0]).find('.acf-label label').attr('for');
				var splitString = label.split('-field_');
				var result = splitString[0];
				var result = result.replace("acf-", "block-");
				var result = '#' + result;
				// console.log(result)
				console.log('fired')
				resetAllSliders(result);
				return
			}


			$('.acf-icon').each(function() {
				// console.log('icon')
				$(this).click(function(e) {

					resetAllSliders(result);
					return
				});
			});
			console.log('fired 2')
			resetAllSliders(result);
			return
		});

		window.acf.addAction('remove', function($el) {
			// console.log('Remove')
			resetAllSliders();

		});
	}

	window.addEventListener('DOMContentLoaded', () => {
		// console.log('addEventListener')
		// loadSlider()
	});

});