const Discord = require('discord.js');
const axios = require('axios');

module.exports = {
	name: 'ultimas-peliculas',
	description: 'Devuelve las últimas películas subidas a Cinetma',
	execute(message, args) {
		console.log(' ** Solicitando últimas películas. **');
		axios.post('https://cinetma.myftp.org/api/ultimasPeliculas')
		.then(function (response) {
			var peliculas = response.data;

			var embed = new Discord.MessageEmbed()
			.setColor('#800000')
			.setTitle('Últimas películas')
			.setURL('https://cinetma.myftp.org')
			.setAuthor('Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg', 'https://cinetma.myftp.org')
			.setDescription('Últimas películas publicadas en Cinetma. Todas estas películas se encuentran finalizadas.')
			.setTimestamp()
			.setThumbnail('https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg')
			.setFooter('Copyright © 2020 - Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg');

			for(var i=0; i < response.data.length; i++)
			{
				let texto = peliculas[i].descripcion + '\nEnlace: https://cinetma.myftp.org/pelicula/' + peliculas[i].id;
				embed.addField(peliculas[i].titulo, texto);
			}
			message.channel.send(embed);


		}).catch(function (error) {
			console.log(error);
		}).finally(function () {
			console.log('** Petición finalizada. **')
		})
	}
}