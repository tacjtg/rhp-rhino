<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Display "Powered by Rockhouse" credit.
 *
 * @since  	1.0.0
 * @package Rhino
 * @author 	Rockhouse
 */

add_action( 'woo_foot' , 'rhino_rockhouse_powered', 100 );

if ( !function_exists( 'rhino_rockhouse_powered' ) ) {

	function rhino_rockhouse_powered() {

		echo <<<HTML

		<div id="rockhouse-powered" class="col-full">
			<a href="http://rockhousepartners.com#utm_source=clientsite&utm_medium=web&utm_campaign=RHP_Rhino_Powered_By" target="_blank" title="Rockhouse Partners">
				Powered by Rockhouse Partners, an Etix company.
			</a>
		</div>

HTML;

	} // End rhino_rockhouse_powered()

} // End if
