const Discord = require('discord.js');
const axios = require('axios');

module.exports = {
	name: 'pelicula',
	description: 'Devuelve una película de Cinetma buscada mediante su título',
	execute(message, args) {
		var titulo = args.join(' ');
		console.log(titulo);
		console.log(' ** Solicitando película por título. **');
		axios.post('https://cinetma.myftp.org/api/peliculaTitulo', {
			titulo: titulo
		})
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
			message.channel.send('No encuentro una película con ese título.');
		}).finally(function () {
			console.log('** Petición finalizada. **')
		})
	}
}