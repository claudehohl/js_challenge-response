<?php
/**
 * Class and Function List:
 * Function list:
 * Classes list:
 */
session_start();
$password = 'test';

if (!isset($_SESSION['challenge'])) 
{
	$_SESSION['challenge'] = sha1(mt_rand(0, 1000000) . mktime());
}

if (isset($_POST['password'])) 
{
	
	if ($_POST['password'] == sha1($password . $_SESSION['challenge'])) 
	{
		echo 'Logged in. <a href="">Reload</a>';
		session_destroy();
	}
}
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
input {
	width: 300px;
}

.jslogin_challenge { display: none; }

</style>
</head>
<body>

<p><strong>Server challenge: </strong><?php echo $_SESSION['challenge']; ?></p>

<form action="" method="post">
<span class="jslogin_challenge"><?php echo $_SESSION['challenge']; ?></span>
<p>Password: <span class="jslogin_pass" data-name="password">For security reasons, Javascript must be enabled.</span> (PW: <?php echo $password; ?>)</p>
<p><input type="submit" /></p>
</form>

<script src="jquery-1.4.2.min.js"></script>
<script src="sha1.js"></script>
<script>

$(document).ready(function(){

	var pass_name = $('.jslogin_pass').attr('data-name');
	$('.jslogin_pass').replaceWith('<input class="jslogin_pass" type="password" name="' + pass_name + '" />');
	$('.jslogin_pass').focus()

	$('form').submit(function(){
		var passval = $('.jslogin_pass').val();
		var challenge = $('.jslogin_challenge').text();
		var sha1 = hex_sha1(passval + challenge);
		$('.jslogin_pass').attr('value', sha1);
	});

});

</script>

<br />
<pre>
<p>$_POST:</p>
<?php
print_r($_POST);
?>
</pre>

</body>
</html>
