<?php
$title = 'Summer Swarm | Age Gate';
$body_class = 'age-gate';
if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header-nomenu.php');
}
?>

<div class="outer-wrapper blackbg">
	<div class="page-wrapper">
		<div class="bg"></div>
		<h1>WHEN WERE YOU BORN?</h1>
		<form id="agegate" method="post" action="/">
			<fieldset class="dob">
				<input type="text" name="mobiledate" id="mobiledate" />
				<select name="age[month]" id="month" class="month">
					<?php $months = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"); ?>
					<option value="" selected>MM</option>
					<?php foreach($months as $index=>$month): ?>
					<option data-days="<?php echo cal_days_in_month(CAL_GREGORIAN, $index+1, date('Y')); ?>" value="<?php echo $index+1; ?>"><?php echo $month; ?></option>
					<?php endforeach; ?>
				</select>
				<select name="age[day]" id="day" class="day">
					<option value="" selected>DD</option>
					<?php for($i=1; $i<=31; $i++): ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
				<select name="age[year]" id="year" class="year">
					<option value="" selected>YYYY</option>
					<?php for($i=date('Y'); $i>=1920; $i--): ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
			</fieldset>
			<fieldset>
				<input type="checkbox" name="remember" id="remember" value="1" />
				<label for="remember" class="checkbox" onclick="TAG.event('agegate_1');">REMEMBER ME</label>
				<div class="subcopy jdexb">Do not check this box if on a shared computer</div>
			</fieldset>
			<p class="jdexb">This site uses <a href="http://www.jackdaniels.com/cookies" target="_blank" class="jdexb">Cookies</a>. I agree to the <a href="http://www.jackdaniels.com/terms-use" target="_blank" class="jdexb nowrap">Terms of Use</a> and <a href="http://www.jackdaniels.com/privacy-policy" target="_blank" class="jdexb nowrap">Privacy Policy</a></p>
			<p class="jdexb">This site is for US residents only.</p>
			<div class="buttoncontainer overlaybutton middle">
				<button type="submit">Enter<span class="icon-arrowR4 ico-after"></span></button>
			</div>
		</form>
	</div>
</div>

<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
	/* additional Scripts go here */
	require('includes/bottom.php');
}
?>