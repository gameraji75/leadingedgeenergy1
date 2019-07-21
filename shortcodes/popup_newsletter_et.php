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
<div class="modal-dialog modal-dialog-centered" id="sfad6ce691a86cad6183ba5cfc34eadbb8c98e811ca5f0889b" data-type="signupform">
	<div class="modal-content" id="customForm">
		<div class="modal-body">
			<input type="hidden" id="signupFormType" value="QuickForm_Vertical">
			<table width="468" class="quick_form_18_css" border="0" cellspacing="0" cellpadding="0" align="center" name="SIGNUP_BODY" id="SIGNUP_BODY">
				<tbody>
					<tr>
						<td align="center" valign="top">
							<div id="SIGNUP_HEADING" name="SIGNUP_HEADING" changeid="SIGNUP_MSG" changetype="SIGNUP_HEADER">
								<img src="http://leedemo.leadingedgeenergy.com.au/wp-content/uploads/2018/06/cross.png" width="50" height="50">
								<h4 class="mb-1">Be the first to know</h4>
							</div>
							<div id="Zc_SignupSuccess" style="display:none;position:absolute;margin-left:4%;width:90%;background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154);  margin-top: 10px;margin-bottom:10px;word-break:break-all ">
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tbody>
										<tr>
											<td width="10%">
												<img class="successicon" src="https://jtpf.maillist-manage.com/images/challangeiconenable.jpg" align="absmiddle">
											</td>
											<td>
												<span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px;word-break:break-word">&nbsp;&nbsp;Thank you for Signing Up</span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<form method="POST" id="zcampaignOptinForm" action="https://jtpf.maillist-manage.com/weboptin.zc" target="_zcSignup">
								<p class="mb-2">Register below to receive our monthly newsletter.<br>
								We'll keep you informed about electricity price changes,<br>
								energy news, tips to save your business money and much more.</p>
								<div class="d-none text-danger" id="errorMsgDiv">&nbsp;&nbsp;Please correct the marked field(s) below.</div><!-- check to mark emailid field as type email, and other mandatory fields as type required -->
								<div  class="row justify-content-center">
									<div class="col-6">
										<div class="form-group mb-2">
											<input class="form-control" name="CONTACT_EMAIL" changetype="CONTACT_EMAIL" changeitem="SIGNUP_FORM_FIELD" type="email" required="true" id="CONTACT_EMAIL" placeholder="Email">
											<span style="display:none" id="dt_CONTACT_EMAIL">1,true,6,Contact Email,2</span>
										</div><!-- check to mark emailid field as type email, and other mandatory fields as type required --><!-- check to mark emailid field as type email, and other mandatory fields as type required -->
										<div class="form-group mb-2 d-none">
											<input class="form-control" name="LASTNAME" changetype="LASTNAME" changeitem="SIGNUP_FORM_FIELD" type="text" id="LASTNAME" placeholder="Name">
											<span style="display:none" id="dt_LASTNAME">1,false,1,Last Name,2</span>
										</div>
									</div>
									<div class="col-3">
										<button class="btn btn-primary mb-2" name="SIGNUP_SUBMIT_BUTTON" id="zcWebOptin">Submit</button>
									</div>
								</div>
								<!-- Do not edit the below Zoho Campaigns hidden tags -->
								<input type="hidden" id="fieldBorder" value="rgb(49, 188, 173)">
								<input type="hidden" id="submitType" name="submitType" value="optinCustomView">
								<input type="hidden" id="lD" name="lD" value="131d5d2c003b8e01">
								<input type="hidden" name="emailReportId" id="emailReportId" value="">
								<input type="hidden" id="formType" name="formType" value="QuickForm">
								<input type="hidden" name="zx" id="cmpZuid" value="1224768a">
								<input type="hidden" name="zcvers" value="3.0">
								<input type="hidden" name="oldListIds" id="allCheckedListIds" value="">
								<input type="hidden" id="mode" name="mode" value="OptinCreateView">
								<input type="hidden" id="zcld" name="zcld" value="131d5d2c003b8e01">
								<input type="hidden" id="document_domain" value="crmplus.zoho.com">
								<input type="hidden" id="zc_Url" value="jtpf.maillist-manage.com">
								<input type="hidden" id="new_optin_response_in" value="0">
								<input type="hidden" id="duplicate_optin_response_in" value="0">
								<input type="hidden" name="zc_trackCode" id="zc_trackCode" value="ZCFORMVIEW" onload="">
								<input type="hidden" id="zc_formIx" name="zc_formIx" value="ad6ce691a86cad6183ba5cfc34eadbb8c98e811ca5f0889b"><!-- End of the campaigns hidden tags -->
							</form>
							<a href="#" class="text-muted small" data-dismiss="modal">Remind me later</a>
						</td>
					</tr>
				</tbody>
			</table>
			<img src="https://jtpf.maillist-manage.com/images/spacer.gif" id="refImage" onload="referenceSetter(this)" style="display:none;">
		</div>
	</div>
</div>
</div>
<div id="zcOptinOverLay" oncontextmenu="return false" style="display:none;text-align: center; background-color: rgb(0, 0, 0); opacity: 0.5; z-index: 100; position: fixed; width: 100%; top: 0px; left: 0px; height: 988px;"></div>
<div id="zcOptinSuccessPopup" style="display:none;z-index: 9999;width: 800px; height: 40%;top: 84px;position: fixed; left: 26%;background-color: #FFFFFF;border-color: #E6E6E6; border-style: solid; border-width: 1px;  box-shadow: 0 1px 10px #424242;padding: 35px;">
	<span style="position: absolute;top: -16px;right:-14px;z-index:99999;cursor: pointer;" id="closeSuccess">
		<img src="https://jtpf.maillist-manage.com/images/videoclose.png">
	</span>
	<div id="zcOptinSuccessPanel"></div>
</div>
<!--Zoho Campaigns Web-Optin Form Ends Here-->