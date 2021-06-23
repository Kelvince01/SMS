<div style="margin-left:400px;">
<?php
//$email_address=$_SESSION['emailaddress'];
//$email_address=$_GET['email'];
	if(isset($_GET['info']) && $_GET['info']=='success')
	{
	echo "<div class='success' align='center'>Details successfully saved</div>";
	}
	if(isset($_GET['info']) && $_GET['info']=='edited')
	{
	echo "<div class='success' align='center'>Changes successfully saved</div>";
	}
	if(isset($_GET['info']) && $_GET['info']=='duplicate')
	{
	echo "<div class='alert' align='center'>A similar record already exists</div>";
	}
	if(isset($_GET['info']) && $_GET['info']=='deleted')
	{
	echo "<div class='success' align='center'>Record successfully deleted</div>";
	}
	if(isset($_GET['info']) && $_GET['info']=='msgs')
	{
	echo "<div class='success' align='center'>Message sent succesfully</div>";
	}
	if(isset($_GET['info']) && $_GET['info']=='msgf')
	{
	echo "<div class='alert' align='center'>Message failed.Please check your internet connection.</div>";
	}
	if(isset($_GET['info']) && $_GET['info']=='no_record')
	{
	echo "<div class='alert' align='center'>No Records were found!</div>";
	}
	?>
</div>