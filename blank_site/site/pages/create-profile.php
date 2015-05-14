<?php
$title = 'Create Profile';
$body_class = 'create-profile';

if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
	require('includes/navigation.php');
}
?>

<form id="create_form" method="post" action="/">

	<input name="fname" type="text" placeholder="First Name*"/>
	<input name="lname" type="text" placeholder="Last Name*"/>
	<input name="email" type="text" placeholder="Email*"/>
	<input name="phone" type="text" placeholder="Phone*"/>
	<input name="zip" type="text" placeholder="ZIP*"/>
	
	<div>
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
	</div>
	
	<input name="password" type="password" placeholder="Password"/>
	<input name="password2" type="password" placeholder="Re-type Password"/><br/>

	<button type="submit">Create Profile</button>

</form>

<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
?>
<script type="text/javascript">
$(function() {
	$('#create_form').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			method: "POST"
			,url: "/api"
			,data: { action: "add-user", data: $(this).serializeArray() }
		})
		.done(function(res) {
			console.log(res);
			if(res.success) {
				
			} else {
				
			}
		});
	});
});
</script>
<?php
	require('includes/bottom.php');
}
?>