Vue.component('pelicula', {
	template: '#template-pelicula',
	props: ['pelicula'],
});

var vm = new Vue({
	el: '#listadoPeliculas',
	data: {
		orden: "0",
		categoria: "",
		peliculas: [],
		pagination: {}
	},
	mounted: function () {
		this.listarPeliculas()
	},
	methods: {
		listarPeliculas: function (page_url) {
			page_url = page_url || 'api/listarpeliculas/finalizada';
			axios
			.post(page_url, {
				orden: this.orden,
				categoria: this.categoria
			})
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