<body>
	<header>
		<a href="<?= APP_W.'home' ?>"><h1 id="main-title"><?= $title; ?></h1></a><br />
		<div id="sub-title">Donde se vende lo que nadie quiere.</div>
	</header>
<br/>

<div id="login">
<?php
	if(isset($_SESSION['user'])){
		echo $_SESSION['user']." | <a href='".APP_W.'home/logout'."'>Logout</a><br/><br/>";
	}else{
		echo "<form id='login_form' method='post' action='".APP_W.'home/login'."'>
				<input type='text' name='email' placeholder='EMAIL' id='login-email' />
				<input type='text' name='pass' placeholder='PASSWORD' id='login-' /><br/>
				<input type='submit' value='SUBMIT'/>    <a href='".APP_W.'register'."'>REGISTER</a>
			  </form>			  
			  <br/><br/>";
	}
?>
</div>