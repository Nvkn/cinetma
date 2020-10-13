const Discord = require('discord.js');
const axios = require('axios');

module.exports = {
	name: 'pelicula-aleatoria',
	description: 'Devuelve una película aleatoria de Cinetma',
	execute(message, args) {
		console.log(' ** Solicitando película aleatoria. **');
		axios.post('https://cinetma.myftp.org/api/peliculaAleatoria')
		.then(function (response) {
			var pelicula = response.data.pelicula;
			var categoria = response.data.categoria;
			var nota = response.data.nota;

			var embed = new Discord.MessageEmbed()
			.setColor('#800000')
			.setTitle(pelicula.titulo)
			.setURL('https://cinetma.myftp.org/pelicula/' + pelicula.id)
			.setAuthor('Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg', 'https://cinetma.myftp.org')
			.setDescription(pelicula.descripcion)
			.setThumbnail('https://cinetma.myftp.org/storage/portadas/' + pelicula.portada)
			.addFields(
				{ name: 'Categoría:', value: categoria},
				{ name: 'Valoración media:', value: nota},
			)
			.setImage('https://cinetma.myftp.org/storage/portadas/' + pelicula.portada)
			.setTimestamp()
			.setFooter('Copyright © 2020 - Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg');

			message.channel.send(embed);


		}).catch(function (error) {
			console.log(error);
		}).finally(function () {
			console.log('** Petición finalizada. **')
		})
	}
}