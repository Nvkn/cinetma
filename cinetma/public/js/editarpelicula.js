$(document).ready(function() {

	// Limita el número máximo de imágenes que se pueden subir.
	$("input[type='submit']").on("click", function(event) {

		// Si se pretenden subir más de 4 imágenes...
		imagenesGuardadas = 0;
		imagenesGuardadas = $('.imagenGuardada').length
		maxImagenes = 4 - imagenesGuardadas;
		var $fileUpload = $("input[type='file']");
		if (parseInt($fileUpload.get(1).files.length) > maxImagenes){
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


	$('.eliminarImagen').on("click", function(event) {

		event.preventDefault();
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success ml-1',
				cancelButton: 'btn btn-danger mr-1'
			},
			buttonsStyling: false
		})
		card = $(this).parent().parent().parent().parent();
		idImagen = $(this).attr('id');
		id = $('#id_pelicula').val();

		swalWithBootstrapButtons.fire({
			title: 'Deseas eliminar esta imagen?',
			text: "Los cambios no podrán ser revertidos",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, eliminar',
			cancelButtonText: 'No, cancelar',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				url = 'https://cinetma.myftp.org/eliminarimagen/' + id;
				data ={"_token": token,	idImagen: idImagen};
				console.log(data);
				$.post(url, data)
				.done(function(data) {
					console.log('Imagen eliminada');
					card.remove();
					swalWithBootstrapButtons.fire(
						'¡Eliminada!',
						'La imagen ha sido eliminada.',
						'success'
						);
				})
				.fail(function(data, textStatus, xhr) {
					console.log('Error');
					swalWithBootstrapButtons.fire(
						'¡Error!',
						'Ha sucedido un error durante la eliminación de la película.',
						'error'
						);
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
				) {
				swalWithBootstrapButtons.fire(
					'¡Cancelado!',
					'La película no ha sido eliminada.',
					'error'
					);
			}
		});
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


	// En lugar de eliminar directamente la fila, se guardan los datos para que pueda ser corregido en caso de error.
	// De este modo, no se eliminan los datos si no se envía el formulario.
	$('.eliminarRepartoGuardado').on("click", function(event) {
		event.preventDefault();
		id = $(this).parent().find('input').val();
		$('#tablaReparto').append('<input type="hidden" name="repartoEliminado[]" value="' + id + '">');
		$(this).parent().parent().remove();
	});

	$('.eliminarStaffGuardado').on("click", function(event) {
		event.preventDefault();
		id = $(this).parent().find('input').val();
		$('#tablaStaff').append('<input type="hidden" name="staffEliminado[]" value="' + id + '">');
		$(this).parent().parent().remove();
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