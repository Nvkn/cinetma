const Discord = require('discord.js');
const axios = require('axios');

module.exports = {
	name: 'mejores-peliculas',
	description: 'Devuelve las películas mejor valoradas de Cinetma',
	execute(message, args) {
		console.log(' ** Solicitando mejores películas. **');
		axios.post('https://cinetma.myftp.org/api/mejorValoradas')
		.then(function (response) {
			var peliculas = response.data;
			console.log();

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
				let texto = peliculas[i].descripcion + '\nNota: ' + peliculas[i].nota + '\nEnlace: https://cinetma.myftp.org/pelicula/' + peliculas[i].id + '\n\n';
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