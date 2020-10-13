const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-success mx-1',
		cancelButton: 'btn btn-danger mx-1'
	},
	buttonsStyling: false
});

Vue.component('pelicula', {
	template: '#template-pelicula',
	props: ['pelicula'],
	methods: {
		eliminarPelicula: function(id) {
			swalWithBootstrapButtons.fire({
				title: 'Deseas eliminar esta película?',
				text: "Los cambios no podrán ser revertidos",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Si, eliminar',
				cancelButtonText: 'No, cancelar',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					url = 'https://cinetma.myftp.org/eliminarpelicula/' + id;
					console.log(url);
					$.ajax({
						url: url,
						type: 'POST',
						data: {
							_token: token
						},
						success: function(result) {
							swalWithBootstrapButtons.fire(
								'¡Eliminada!',
								'La película ha sido eliminada.',
								'success'
								)
							.then((result) => {
								location.reload();
							});
						},
						error: function(result) {
							swalWithBootstrapButtons.fire(
								'¡Error!',
								'Ha sucedido un error durante la eliminación de la película.',
								'error'
								).then((result) => {
									location.reload();
								});
							}
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
			})
		}
	}
});

var vm = new Vue({
	el: '#listadoPeliculas',
	data: {
		peliculas: [],
		pagination: {}
	},
	mounted: function () {
		this.listarPeliculas()
	},
	methods: {
		listarPeliculas: function (page_url) {
			page_url = page_url || 'https://cinetma.myftp.org/mispeliculas';
			axios
			.post(page_url)
			.then(function (response) {
				console.log(response);
				// Paginación
				vm.makePagination(response.data);
				vm.$set(vm, 'peliculas', response.data.data);
			});
		},
		makePagination: function(data){
			let pagination = {
				current_page: data.current_page,
				last_page: data.last_page,
				next_page_url: data.next_page_url,
				prev_page_url: data.prev_page_url
			}
			vm.$set(vm, 'pagination', pagination)
		}
	}
});