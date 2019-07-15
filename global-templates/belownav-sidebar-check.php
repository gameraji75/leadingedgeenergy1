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

<?php if ( is_active_sidebar( 'belownav' ) ) : ?>

	<?php dynamic_sidebar( 'belownav' ); ?>

<?php endif; ?>
