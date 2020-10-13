const Discord = require('discord.js');

module.exports = {
	name: 'help',
	description: 'Muestra un listado con los comandos disponibles',
	execute(message, args) {
		var embed = new Discord.MessageEmbed()
		.setColor('#800000')
		.setTitle('Comandos disponibles')
		.setURL('https://cinetma.myftp.org')
		.setAuthor('Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg', 'https://cinetma.myftp.org')
		.setDescription('¡Hola! Aquí puedes encontrar un listado con los comandos disponibles. Gracias por utilizar Cinetma.')
		.setTimestamp()
		.setFooter('Copyright © 2020 - Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg')
		.addFields(
			{ name:'!help !commands', value:'Muestra un listado de los comandos disponibles.' },
			{ name:'!ultimas-peliculas', value:'Muestra un listado de las últimas películas publicadas.' },
			{ name:'!mejores-peliculas', value:'Muestra un listado de las películas mejor valoradas en Cinetma.' },
			{ name:'!pelicula-aleatoria', value:'Muestra una película aleatoria.' },
			{ name:'!pelicula {titulo-pelicula}', value:'Busca una película en Cinetma y muestra sus datos.' },
			);

		message.channel.send(embed);
	}
}