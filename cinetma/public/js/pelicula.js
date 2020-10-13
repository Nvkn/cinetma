$(document).ready(function() {

    $('#añadirValoracion').on("click", function() {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-1',
                cancelButton: 'btn btn-danger mx-1'
            },
            buttonsStyling: false
        });

        // Comprueba si existe el usuario.
        if(user)
        {
            // Si existe, comprueba si ya ha valorado la película.
            data = {
                "_token" : token,
                "user_id" : user,
                "pelicula_id" : pelicula_id
            };
            $.ajax({
                url: 'https://cinetma.myftp.org/buscarValoracion',
                type: 'POST',
                dataType: 'json',
                data : data
            })
            // En caso de que haya sido valorada, muestra la nota y permite eliminar la valoración.
            .done(function(response) {
                swalWithBootstrapButtons.fire({
                    title: '<h3><i class="fas fa-star fa-xs text-warning"></i> ' + response.data[0].nota,
                    text: "Ya has valorado esta publicación.",
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar valoración',
                    cancelButtonText: 'Cancelar',
                    showCloseButton: true
                }).then((result) => {
                    // Si se desea eliminar la valoración
                    if (result.value) {
                        data = {
                            "_token" : token,
                            "user_id" : user,
                            "pelicula_id" : pelicula_id
                        };
                        $.ajax({
                            url: 'https://cinetma.myftp.org/eliminarValoracion',
                            type: 'POST',
                            dataType: 'json',
                            data : data
                        })
                        // Valoracion eliminada.
                        .done(function(response) {
                            swalWithBootstrapButtons.fire({
                                title: `Tu valoracion ha sido eliminada`,
                                icon: 'success'
                            }).then(function() {
                                location.replace("https://cinetma.myftp.org/pelicula/" + pelicula_id);
                            });
                        })
                        .fail(function(response) {
                            swalWithBootstrapButtons.fire({
                                title: `La valoracion no ha podido ser eliminada`,
                                icon: 'error'
                            })
                        });
                    }
                })
            })
            // En caso de que no se haya valorado, permite valorar una película.
            .fail(function(response) {
                swalWithBootstrapButtons.fire({
                    title: 'Añadir una valoración',
                    text: '0 - 10',
                    input: 'number',
                    inputAttributes: {
                        step : '0.1',
                        min : '0',
                        max : '10',
                        placeholder : 'Nota'
                    },
                    inputValue: '5',
                    showCancelButton: true,
                    confirmButtonText: 'Valorar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    // Comprueba que se introduce una nota
                    preConfirm: (nota) => {
                        if (!nota) {
                            swalWithBootstrapButtons.showValidationMessage(
                                `Debes introducir una nota.`
                                )
                        }
                    },
                    allowOutsideClick: () => !swalWithBootstrapButtons.isLoading()
                }).then((result) => {
                    if (result.value) {
                        data = {
                            "_token" : token,
                            "nota" : result.value,
                            "user_id" : user,
                            "pelicula_id" : pelicula_id
                        };
                        $.ajax({
                            url: 'https://cinetma.myftp.org/valoracion',
                            type: 'POST',
                            dataType: 'json',
                            data : data

                        })
                        .done(function() {
                            swalWithBootstrapButtons.fire({
                                title: `Tu nota ha sido añadida correctamente`,
                                icon: 'success'
                            }).then(function() {
                                location.replace("https://cinetma.myftp.org/pelicula/" + pelicula_id);
                            });
                        })
                        .fail(function(response) {
                            swalWithBootstrapButtons.fire({
                                title: `Tu nota no ha podido ser añadida`,
                                icon: 'success'
                            })
                        });
                    }
                });
            });
        }
        else
        {
            // Si el usuario no está loggeado, se lo notifica y le da la opción de hacerlo.
            swalWithBootstrapButtons.fire({
                title: 'Debes iniciar sesión para poder valorar una película.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iniciar sesión',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !swalWithBootstrapButtons.isLoading()
            }).then((result) => {
                if (result.value) {
                    location.replace("https://cinetma.myftp.org/login");
                }
            })
        }


    });
});