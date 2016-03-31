	<div class="container">
		<article>
			<h2>BIENVENIDO ADMINISTRADOR</h2>
		</article>
	</div>

	<br />
	<br />
	<br />

	<section>
		<div id="admin-menu">
			<select id="list_users">
				<option value="0">Selecciona usuario...</option>
			</select>
			<input type="button" value="EDITAR PERFIL" id="edit_profile" />
			<input type="button" value="EDITAR ANUNCIOS" id="edit_ad" />
			<input type="button" value="ELIMINAR" id="delete" />
		</div>

		<div id="edit-pro">
		<br/>
			<form>
				EMAIL*: <input type='text' name='email' placeholder='E-MAIL' /><br/>
				PASS*: <input type='text' name='pass' placeholder='PASSWORD' /><br/>
				CONFIRM PASS*: <input type='text' name='conf_pass' placeholder='REPEAT' /><br/>
				NAME*: <input type='text' name='name' placeholder='NAME' /><br/>
				PHONE: <input type='text' name='phone' placeholder='PHONE' /><br/>
				ROL: <select id="roles">
					<option value="2">Usuario</option>
					<option value="3">Moderador</option>
				</select>
				<br/>
				<br/>
				<input type='submit' value='APLICAR CAMBIOS'/>
				<br/><br/>
				<p><i>Los campos marcados con un * son obligatorios.</i></p>
				<br/>
			</form>
		</div>


		<div id="out-msg"></div>

	</section>