<?php

/**
 *
 * Please see single-event.php in this directory for detailed instructions on how to use and modify these templates.
 *
 */

?>

<script type="text/html" id="tribe_tmpl_tooltip">
	<div id="tribe-events-tooltip-[[=eventId]]" class="tribe-events-tooltip">
		<a href="[[=permalink]]" title="[[=title]]">
			<h4 class="entry-title summary">[[=title]]</h4>
		</a>

		<div class="tribe-events-event-body">
			<div class="duration">
				<abbr class="tribe-events-abbr updated published dtstart">[[=startTime]] </abbr>
				<!--[[ if(endTime.length) { ]]
				<abbr class="tribe-events-abbr dtend"> [[=endTime]]</abbr>
				[[ } ]]-->
			</div>

			[[ if(imageSrc && imageSrc.length) { ]]
			<div class="tribe-events-event-thumb">
				<a href="[[=permalink]]" title="[[=title]]">
					<img src="[[=imageSrc]]" alt="[[=title]]" />
				</a>
			</div>
			[[ } else if(imageTooltipSrc && imageTooltipSrc.length) { ]]
			<div class="tribe-events-event-thumb">
				<a href="[[=permalink]]" title="[[=title]]">
					<img src="[[=imageTooltipSrc]]" alt="[[=title]]" />
				</a>
			</div>
			[[ } ]]

			[[ if(excerpt.length) { ]]
			<p class="entry-summary description">[[=raw excerpt]]</p>
			[[ } ]]
			<span class="tribe-events-arrow"></span>

			<br />

			[[ if( typeof( rhpCtaHref ) !== 'undefined' && rhpCtaHref.length ) { ]]
			<div class="rhino-event-single-cta">
				<span class="[[=rhpCtaClass]]">
					<a class="button primary large" title="[[=rhpCtaLabel]]" href="[[=rhpCtaHref]]">[[=rhpCtaLabel]]</a>
				</span>
			</div>
			[[ } else if( typeof( rhpCtaClass ) !== 'undefined' && rhpCtaClass.length ) { ]]
			<div class="rhino-event-single-cta">
				<span class="[[=rhpCtaClass]]">
					[[=rhpCtaLabel]]
				</span>
			</div>
			[[ } ]]

		</div>
	</div>
</script>
