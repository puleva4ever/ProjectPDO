$(document).ready(function(){

	/* ------------- LOGIN ------------- */
	$("#login_form").on('submit',function(){
		var postData = $(this).serialize();
		var formURL = $(this).attr("action");
		$.ajax({
			url: formURL,
			data: postData,
			method: 'post',
			dataType: 'json',
			success:
				function(output){
					console.log(output),
					window.location.href=output.redir;
				}
		});
		return false;
	});

	/* GET USER COOKIE */
	function getCookie(){
		$.ajax({
			url: "home/getCookie",
			dataType: 'json',
			success: function(resp){
				if(resp.response != '-1'){
					return resp.response;
				}
			}
		});
	}

	function showRating(this_id_ad, this_ad, this_ad_sel, user){
		$(this_ad).append("<br><br><div><strong>Valoracion</strong></div>");
		$.ajax({
			type: 'POST',
			url: "home/c_checkIfRated",
			dataType: 'json',
			data: {user : user, ad : this_id_ad},
			success: function(canShow){
				if(canShow.response){
					$.ajax({
						url: "home/c_get_total_score",
						dataType: 'json',
						data: {ad : this_id_ad},
						success: function(resp_score){
							$(this_ad).append("<div>"+resp_score.score+", resultado de "+resp_score.outOf+" valoraciones</div>");
						}
					});
				}else{
					//alert(this_ad_sel);
					$(this_ad).append("<div id='"+this_ad_sel+"' class='sel'><select><option value='5'>5</option><option value='4'>4</option><option value='3'>3</option><option value='2'>2</option><option value='1'>1</option></select></div>");
					$(this_ad).append("<input type='button' value='VALORAR' class='btn-rate' name='"+this_id_ad+"' />");
				}
			}
		});			
	}



	/* ------------- SHOW POST ------------- */
	$.ajax({
		url: "home/show_post",
		dataType: 'json',
		success: function(resp){
			for(i=0;i<resp.length;i++){
				if(resp[i].ad == resp[i].id_ad){
					$("#ads").append("<br /><div class='ad' id='ad"+resp[i].id_ad+"'><img src='"+resp[i].image_path+"' height='200' /><div><h3>"+resp[i].title+"</h3><div class='ad-content'>"+resp[i].description+"</div></div><br></div>");
					this_id_ad = resp[i].id_ad;
					this_ad = "#ad"+this_id_ad;
					this_ad_sel = "#sel"+this_id_ad;

					/* SHOW MAP */
					if(resp[i].latitude != 0 && resp[i].longitude != 0){
						$(this_ad).append("<div>Localizacion</div><div class='ad-map' id='map"+this_id_ad+"'></div>");
						new GMaps({
							div: '#map'+this_id_ad,
							lat: resp[i].latitude,
							lng: resp[i].longitude
						});
					}else{
						$(this_ad).append("<div><i>Localizacion no disponible</i></div> ");
					}
					//alert(this_ad);
					showRating(this_id_ad, this_ad, this_ad_sel, getCookie());
				}				
			}
		}
	});
	


	// ------------- RATING ------------- 
	$("#ads").on("click", ".btn-rate", function(){
				$(this).remove();
				alert("Gracias por votar!");
		/*$.ajax({
			url: "home/c_get_total_score",
			dataType: 'json',
			success: function(resp_score){
			}
		});*/
	});
	







	/* ------------- FILL USERS ------------- */
	function fill_users(){
		$.ajax({
			url: "admin/fill_users",
			dataType: 'json',
			success: function(resp){
				//console.log(resp);
				$("#list_users").html("<option value='0'>Seleccionar usuario...</option>");
				for(i=0;i<resp.length;i++){
					$("#list_users").append("<option value='"+resp[i].id_user+"'>"+resp[i].email+"</option>");		
				}
			}
		});
	}fill_users();


	/* ------------- HIDE USER LIST & CLEAR MESSAGE BOX ------------- */
	$("#list_users").on("click",function(){
		$("#edit-pro").slideUp(300);
		$("#out-msg").html("<br /><br /><br />");
	});


	/* ------------- *ADMIN* DELETE USER ------------- */
	$("#delete").on("click",function(){
		user = $("#list_users option:selected").attr("value");
		$.ajax({
			method: 'POST',
			url: "admin/delete_user",
			data: {user : user},
			dataType: 'json',
			success: function(resp){
				//console.log(resp);
				if(resp > 0){
					$("#out-msg").html("<br />El usuario se ha borrado correctamente.<br /><br />");
				}else{
					$("#out-msg").html("<br />No se ha podido borrar el usuario.<br />");
				}
				setTimeout(function(){$("#out-msg").html("<br /><br /><br />");},3000);
				fill_users();
			}
		});
	});	


	/* ------------- *ADMIN* LOAD EDIT USERS ------------- */
	$("#edit_profile").on("click",function(){
		$("#edit-pro").slideToggle(300);
		user = $("#list_users option:selected").attr("value");
		$.ajax({
			method: 'POST',
			url: "admin/get_user_data",
			data: {user : user},
			dataType: 'json',
			success: function(resp){
				//console.log(resp);
				//alert(resp);
				$("#edit-pro input:eq(0)").attr("placeholder",resp[0].email);
				$("#edit-pro input:eq(0)").val(resp[0].email);
				$("#edit-pro input:eq(1)").attr("placeholder",resp[0].password);
				$("#edit-pro input:eq(1)").val(resp[0].password);
				$("#edit-pro input:eq(2)").attr("placeholder",resp[0].password);
				$("#edit-pro input:eq(2)").val(resp[0].password);
				$("#edit-pro input:eq(3)").attr("placeholder",resp[0].name);
				$("#edit-pro input:eq(3)").val(resp[0].name);
				$("#edit-pro input:eq(4)").attr("placeholder",resp[0].phone);
				$("#edit-pro input:eq(4)").val(resp[0].phone);
			}
		});
	});

	/* ------------- *ADMIN* EDIT USERS ------------- */
	$("#edit-pro form").on("submit",function(event){
		user = $("#list_users option:selected").attr("value");
		email = $("#edit-pro input:eq(0)").val();
		pass = $("#edit-pro input:eq(1)").val();
		conf_pass = $("#edit-pro input:eq(2)").val();
		name = $("#edit-pro input:eq(3)").val();
		phone = $("#edit-pro input:eq(4)").val();
		rol = $("#roles option:selected").val();

		$.ajax({
			method: 'POST',
			url: "admin/edit_user",
			data: {user : user, email : email, pass : pass, conf_pass : conf_pass, name : name, phone : phone, rol : rol},
			dataType: 'json',
			success: function(resp){
				//console.log(resp);
				if(resp == '0'){
					$("#out-msg").html("El usuario se ha modificado correctamente.<br /><br />");
				}else if(resp == '-1'){
					$("#out-msg").html("Rellene los campos obligatorios (*)<br /><br />");
				}else if(resp == '-2'){
					$("#out-msg").html("Las contraseñas no coinciden.<br /><br />");
				}else if(resp == '-3'){
					$("#out-msg").html("Error al modificar el usuario.<br /><br />");
				}
				fill_users();
			}
		});
		event.preventDefault();
	});


	/* ------------- GET GEOLOCATION ------------- */
	$("#geolocate").on("click",function(){
		GMaps.geolocate({
			success: function(position) {
				$("#form_latitude").val(position.coords.latitude);
				$("#form_longitude").val(position.coords.longitude);
				alert("Geolocalizacion guardada. Gracias.");
			},error: function(error) {
				alert('No se ha podido guardar la localizacion.');
			},not_supported: function() {
				alert("Su navegador no soporta geolocalizacion.");
			}
		});
	});

});