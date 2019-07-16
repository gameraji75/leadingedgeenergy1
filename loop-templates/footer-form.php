<?php
/**
 * Footer form template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div class="row bg-secondary py-2 py-md-4 text-white">
<div class="col">
		<div class="container">
			<div class="row">
				<div class="col">
					<h1 class="mb-0">-</h1>
					<h4><a class="text-white" href="tel:1300852770" target="_blank" rel="noopener noreferrer">Give us a call on: 1300 852 770.</a></h4>
					<h4><a class="text-primary" href="mailto:info@leadingedgeenergy.com.au" target="_blank" rel="noopener noreferrer">Or send us an email at info@leadingedgeenergy.com.au</a></h4>
				</div>
				<div class="w-100"></div>
				<div class="col">
					<div style="margin-bottom: 20px; height: 400px; overflow: hidden;"><!--<iframe style=" margin-top: -50px;" src="https://www.google.com/maps/d/embed?mid=1Uq5nPHShof3JeixtM8A3L1AtT5pYBwHH" width="620" height="450"></iframe>--></div>
				</div>
				<div class="col">
					<?php echo do_shortcode('[gravityform id=21 title=false description=false ajax=false]'); ?>
				</div>
			</div>
		</div>
	</div>
</div>