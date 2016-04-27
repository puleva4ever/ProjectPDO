	<div class="container">
		<article>
			<form action="<?= APP_W.'post/c_post' ?>" method="post" name="post_form">
				Titulo: <input type="text" name="title" /><br />
				Descripción: <textarea name="description"></textarea><br />
				Imagen: <input type="text" name="image" placeholder="http://i.imgur.com/Im4g3n.jpg" /><br />
				<input type="hidden" id="form_latitude" name="latitude" value="" />
				<input type="hidden" id="form_longitude" name="longitude" value="" />
				<input type="button" id="geolocate" value="PROPORCIONAR LOCALIZACION" /><br /><br />
				<input type="submit" value="POSTEAR" /><br /><br />
				<p><i>Todos los campos son obligatorios.</i></p>
			</form>
		</article>
	</div>