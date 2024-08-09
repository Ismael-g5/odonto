<?php
/**
 *  Contact Template, Contact Map Section
 * 
 *  @package Medicall
 */

$contact_map_iframe = get_theme_mod( 'contact_map_iframe' );

if( $contact_map_iframe ) { ?>
    <div class="map-wrap">
        <?php echo htmlspecialchars_decode( $contact_map_iframe ); ?>
    </div>
<?php 
}