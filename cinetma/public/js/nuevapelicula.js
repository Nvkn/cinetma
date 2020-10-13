$(document).ready( function() {

	// Limita el número máximo de imágenes que se pueden subir.
	$("input[type='submit']").on("click", function(event) {
		// Si se pretenden subir más de 4 imágenes...
		var $fileUpload = $("input[type='file']");
		if (parseInt($fileUpload.get(1).files.length) > 4){
			event.preventDefault();
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'No puedes subir mas de 4 imágenes'
			})
		}

		// Si la película está finalizada y no existe fecha de lanzamiento...
		if ( $('#finalizada').val() == 1 && $('#fechaLanzamiento').val() == "" ) {
			event.preventDefault();
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Si la película está finalizada, debes incluír su fecha de lanzamiento'
			})
		}

		// Si la película está finalizada y no existe fecha de lanzamiento...
		if ( $('#finalizada').val() == 1 && $('#duracion').val() == 0 ) {
			event.preventDefault();
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Si la película está finalizada, debes incluír su duración'
			})
		}
	});


	// Añadir Reparto
	$('#añadirReparto').on("click", function(event) {
		event.preventDefault();
		nombre = escapeHtml($("#naReparto").val());
		papel = escapeHtml($("#papel").val());
		if(nombre != ''){
			$('#reparto').append('<tr><th scope="row"><input type="hidden" name="reparto[nombre][]" value="'+nombre+'">'+nombre+'</th><td><input type="hidden" name="reparto[papel][]" value="'+papel+'">'+papel+'</td><td style="width:35px"><button class="btn btn-outline-primary rounded-0 eliminarFila" type="button">x</button></td></tr>');

			$('#naReparto').val('');
			$('#papel').val('');

			$('.eliminarFila').on("click", function(event) {
				event.preventDefault();
				$(this).parent().parent().remove();
			});
		}
	});

	// Añadir Staff
	$('#añadirStaff').on("click", function(event) {
		event.preventDefault();
		nombre = escapeHtml($("#naStaff").val());
		rol = escapeHtml($("#rol").val());
		if(nombre != '' && rol != ''){
			$('#staff').append('<tr><th scope="row"><input type="hidden" name="staff[nombre][]" value="'+nombre+'">'+nombre+'</th><td><input type="hidden" name="staff[rol][]" value="'+rol+'">'+rol+'</td><td style="width:35px"><button class="btn btn-outline-primary rounded-0 eliminarFila" type="button">x</button></td></tr>');

			$('#naStaff').val('');
			$('#rol').val('');


			$('.eliminarFila').on("click", function(event) {
				event.preventDefault();
				$(this).parent().parent().remove();
			});
		}
	});

	$('.eliminarFila').on("click", function(event) {
		event.preventDefault();
		$(this).parent().parent().remove();
	});
});

function escapeHtml(text) {
	return $.trim(text
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;"));
}