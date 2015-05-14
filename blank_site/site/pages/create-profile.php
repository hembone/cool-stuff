<div class="overlay_content create-profile_ create-profile">
	<form action="" method="post" enctype="multipart/form-data" style="display: none;">
	    Select image to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload Image" name="submit">
	</form>
	
	<div id="overlay_content">
		<div class="head">
			<h1>Create new profile</h1>
			<p class="jdexb centered">Enter your info so we can get in touch if you’re a winner.</p>
		</div>
		
		<div id="create-profile" class="wider">
			<form id="create_form" method="post" action="/">
				<div class="col col-1-2">
					<input name="fname" type="text" placeholder="First Name*"/>
					<input name="lname" type="text" placeholder="Last Name*"/>
					<input name="email" type="text" placeholder="Email*"/>
					<input name="phone" type="text" placeholder="Phone*"/>
					<input name="zip" type="text" placeholder="ZIP*"/>
					<input name="country" type="text" placeholder="Country*" value="USA"/>
					
					<div id="birthday" class="jdexb section-title">Birthday*
						<p class="jdexb">Forgive us for creeping so hard. We’re legally required to check your birthdate a second time.</p>
						<div id="dob">
							<input type="text" name="mobiledate" id="mobiledate" />
							<fieldset class="dob">
								<select name="age[month]" id="month" class="month birthday-group">
									<?php $months = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"); ?>
									<option value="" selected>MM</option>

									<?php foreach($months as $index=>$month): ?>
									<option data-days="<?php echo cal_days_in_month(CAL_GREGORIAN, $index+1, date('Y')); ?>" value="<?php echo $index+1; ?>"><?php echo $month; ?></option>

									<?php endforeach; ?>
								</select>
								<select name="age[day]" id="day" class="day birthday-group">
									<option value="" selected>DD</option>

									<?php for($i=1; $i<=31; $i++): ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>

									<?php endfor; ?>
								</select>
								<select name="age[year]" id="year" class="year birthday-group">
									<option value="" selected>YYYY</option>

									<?php for($i=date('Y'); $i>=1920; $i--): ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>

									<?php endfor; ?>
								</select>
							</fieldset>
						</div>
					</div>
					
					<input name="password" type="password" placeholder="Password"/>
					<input name="password2" type="password" placeholder="Re-type Password"/><br/>
					<!--<button type="submit">Enter</button>-->
				</div>

				<div class="col col-1-2-2">
					<div class="jdexb section-title">I want to hear from Jack Daniel's Brands</div>
					<div id="sendemailupdate" class="checkcontainer">
						<input id="sendemail" name="emailOptin" type="checkbox" value="1"/>
						<label for="sendemail">
							<span class="icon-check"></span>
						</label>
						<div class="rmtext">
							<h6>Send me email updates</h6>
						</div>
					</div>
					
					<div id="sendtextupdate" class="checkcontainer">
						<input id="sendtext" name="smsOptin" type="checkbox" value="1"/>
						<label for="sendtext">
							<span class="icon-check"></span>
						</label>
						<div class="rmtext">
							<h6>Send me text updates</h6>
							<p class="jdexb">By opting in, you will receive up to 5 messages per month from Jack Daniel’s brand. We’ll send you a message to confirm your opt-in. Message and data rates may apply. Check your carrier for availability. Text STOP to quit or HELP for info to 68405. <a href="http://www.jackdaniels.com/terms-use" target="_blank">Terms&nbsp;and&nbsp;Conditions.</a></p>
						</div>
						
						<p class="jdexb">By clicking continue you are agreeing to the <a href="/official-rules">Official&nbsp;Rules</a>. You also expressly give your consent to the processing of your personal data for promotional activities by the Brown-Forman Corporation, other companies of the Brown-Forman group and data processors for Brown-Forman as detailed in the <a href="http://www.jackdaniels.com/privacy-policy" target="_blank">Privacy&nbsp;Policy.</a></p>
					</div>
					
					<div class="buttoncontainer overlaybutton">
						<button id="create_btn" type="submit">Continue <span class="icon-arrowR4 ico-after"></span></button>
					</div>
				  	<div id="form-errors"></div>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
//$(function() {
//	$('#create_form').on('submit', function(e) {
//		e.preventDefault();
//		$.ajax({
//			method: "POST"
//			,url: "/api"
//			,data: { action: "add-user", data: $(this).serializeArray() }
//		})
//		.done(function(res) {
//			//console.log(res);
//		});
//	});
//});
</script>
