<?php
/**
 * Above Nav setup.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php if ( is_active_sidebar( 'abovenav' ) ) : ?>
	<?php /*
 * echo preg_replace( '/<div[\s\S]*?widget[\s\S]*?>([\s\S]*?)<\/div>+$/' , '$1' , get_dynamic_sidebar( 'abovenav' ));
 */ ?>
	<?php dynamic_sidebar( 'abovenav' ); ?>

<?php endif; ?>