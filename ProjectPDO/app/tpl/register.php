	<form name='regis_form' method='post' action="<?= APP_W.'register/c_register'; ?>">
		EMAIL: <input type='text' name='email' placeholder='E-MAIL' /><br/>
		PASS: <input type='text' name='pass' placeholder='PASSWORD' /><br/>
		CONFIRM PASS: <input type='text' name='conf_pass' placeholder='REPEAT' /><br/>
		NAME: <input type='text' name='name' placeholder='NAME' /><br/>
		PHONE: <input type='text' name='phone' placeholder='PHONE' /><br/>
		<input type='submit' value='SUBMIT'/>
		<br/><br/>
	</form>