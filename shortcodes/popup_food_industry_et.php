<?php $id = preg_replace('/_/i','-',$a['file_name']); ?>

<!--Zoho Campaigns Web-Optin Form Starts Here-->
<script type="text/javascript" src="https://jtpf.maillist-manage.com/js/optin.min.js" onload="setupSF('sfad6ce691a86cad6183ba5cfc34eadbb8c98e811ca5f0889b','ZCFORMVIEW',false,'light')"></script>
<script type="text/javascript">
	setTimeout(function() {
		jQuery('#popup-<?php echo $id; ?>').modal('show');
	}, <?php echo $a['time_delay']; ?>000);
	function runOnFormSubmit_sfad6ce691a86cad6183ba5cfc34eadbb8c98e811ca5f0889b(th){};
</script>
<div class="modal fade" id="popup-<?php echo $id; ?>">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center">
				<img src="http://leedemo.leadingedgeenergy.com.au/wp-content/uploads/2018/06/cross.png" width="50" height="50">
				<h5 class="mb-1">Keen on cutting energy costs in your food wholesale and distribution business?</h5>
				<?php gravity_form( 70, false, false, false, null, true ); ?>
				<a href="#" class="text-muted small" data-dismiss="modal">Remind me later</a>
			</div>
		</div>
	</div>
</div>