$(document).ready(function() {

	$('#editarPerfil').on("click", function(event) {
		event.preventDefault();
		$('.dato').each(function(index, el) {
			if($(el).prop('disabled'))
			{
				$(el).removeAttr('disabled');
				$(el).css('backgroundColor', '#fff');
			}
			$('#divGuardar').css('display', 'block');
		});
	})

	$('#eliminarPerfil').on("click", function(event) {

		event.preventDefault();

		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success mx-1',
				cancelButton: 'btn btn-danger mx-1'
			},
			buttonsStyling: false
		});

		swalWithBootstrapButtons.fire({
			title: '¿Deseas eliminar tu perfil?',
			text: "Tus valoraciones también serán eliminadas.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, eliminar',
			cancelButtonText: 'No, cancelar',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'usuario/' + user,
					type: 'delete',
					data: {_token : _token}
				})
				.done(function() {
					swalWithBootstrapButtons.fire(
						'¡Eliminado!',
						'Tu usuario ha sido eliminado.',
						'success'
						)
					.then(function() {
						location.replace("https://cinetma.myftp.org");
					});
				})
				.fail(function() {
					swalWithBootstrapButtons.fire(
						'¡Cancelado!',
						'Tu usuario no ha sido eliminado',
						'error'
						)
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
				) {
				swalWithBootstrapButtons.fire(
					'Cancelled',
					'Tu usuario no ha sido eliminado',
					'error'
					)
			}
		});

	})


});