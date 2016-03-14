var rhptribe_ev = window.rhptribe_ev || {};

jQuery(document).ready(function($) {

	if( typeof( tribe_ev ) !== 'undefined' ) {
		/**
		 * @namespace rhptribe_ev.fn
		 * @desc rhptribe_ev.fn namespace stores custom functions
		 */
		rhptribe_ev.fn = {
			/**
			 * @function desktop_month_sidebar Creates a sidebar for the desktop month view re-using the mobile tooltip
			 */
			desktop_month_sidebar: function() {
				// Rework the Calendar View Tooltips to be ... useful, with a side container
				$('<div id="rhp-calendar-sidebar">').insertAfter('table.tribe-events-calendar');
				// Artificially trigger the rendering of the tooltop HTML
				$('div[id*="tribe-events-event-"], div.event-is-recurring').trigger( 'mouseenter' ).trigger( 'mouseleave' );

				// Go through each tooltip and move to the sidebar, attach the click event to display
				$('#tribe-events-content div.tribe-events-tooltip').each( function(i) {
					var me = $(this).clone(true);
					me.appendTo('#rhp-calendar-sidebar').hide();
					$(this).html('').css('height',0).css('width',0).css('padding',0);

					var p = $(this).closest('div.vevent');
					$(p).click( function(e) {
						$('#rhp-calendar-sidebar .tribe-events-tooltip:visible').hide();
						me.show();
						e.stopPropagation();
						return false;
					});
				});

				// Show the first event tooltip we have on the present day or close thereafter
				var next = 0;
				var cur_date = false;
				var found_one = false;
				$('table.tribe-events-calendar td.tribe-events-thismonth').each( function(i,el) {
					if( $(el).hasClass( 'tribe-events-present' ) ) {
						cur_date = true;
					}
					var evts = $(el).children('.tribe_events');
					if( evts.length ) {
						for(var i=0; i<evts.length; i++ ) {
							if( cur_date && !found_one ) {
								found_one = true;
							}
							if( !found_one ) {
								next++;
							}
						}
					}
				});
				$('#rhp-calendar-sidebar .tribe-events-tooltip').eq(next).show();
			}
		}

		// Remove our custom url_params on an ajax view switch
		$( tribe_ev.events ).on('collect-params.tribe tribe_ev_collectParams',function() {
			if( tribe_ev.state.url_params.length && tribe_ev.state.url_params.slice(0,21) == 'tribe_bar_rhino_venue' ) {
				tribe_ev.state.url_params = '';
			}
			return false;
		});

		// Force scroll on mobile for events
		if( $(window).width() < 500 && $('body.single-tribe_events #tribe-events-content').length ) {
			$( $.browser.webkit ? 'body': 'html').animate(
				{scrollTop: $('#tribe-events-content').offset().top}, 600);
		}
		if( $(window).width() < 500 && $('body.events-list #tribe-events-bar').length ) {
			$( $.browser.webkit ? 'body': 'html').animate(
				{scrollTop: $('#tribe-events-bar').offset().top}, 600);
		}

		// Enhance calendar view on first load
		if( $('body').hasClass( 'events-gridview' ) && !$('body').hasClass( 'tribe-mobile' ) ) {
			rhptribe_ev.fn.desktop_month_sidebar();

			// And also on ajax refreshes
			$( tribe_ev.events ).on( 'month-view-ajax-success.tribe tribe_ev_monthView_ajaxSuccess', function() {
				rhptribe_ev.fn.desktop_month_sidebar();
			});

			// Also hide our sidebar when the AJAX spinner is shown
			$( tribe_ev.events ).on( 'ajax-start.tribe tribe_ev_monthView_AjaxStart', function() {
				$('#rhp-calendar-sidebar .tribe-events-tooltip:visible').hide();
			});
		}

	}

	// Employ the accordion class on our static wrapper
	$('.st-accordion').accordion({
		active: false,
		collapsible: true,
		heightStyle: "content"
	});

	// Tabbify Homepage if present
	if( $( '#home-widget-container-main' ).length && $( '#home-widget-container-main' ).hasClass( 'responsive-tabs' ) ) {
		// This should be loaded already
		RESPONSIVEUI.responsiveTabs();
	}

});
