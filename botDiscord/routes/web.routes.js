const express = require('express');
const router = express.Router();
const { prefix, token } = require('../config.json');
const dotenv = require('dotenv').config();
const Discord = require('discord.js');
const client = new Discord.Client();

// Al recibir una película finalizada
router.post('/nuevaPelicula', function(req, res) {

	var pelicula = req.body.pelicula;
	var categoria = req.body.categoria;
	const webhookClient = new Discord.WebhookClient(process.env.WEBHOOK_ID, process.env.WEBHOOK_TOKEN);

	var embed = new Discord.MessageEmbed()
	.setColor('#800000')
	.setTitle(pelicula.titulo)
	.setURL('https://cinetma.myftp.org/pelicula/' + pelicula.id)
	.setAuthor('Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg', 'https://cinetma.myftp.org')
	.setDescription(pelicula.descripcion)
	.setThumbnail('https://cinetma.myftp.org/storage/portadas/' + pelicula.portada)
	.addField('Categoría:', categoria)
	.setImage('https://cinetma.myftp.org/storage/portadas/' + pelicula.portada)
	.setTimestamp()
	.setFooter('Copyright © 2020 - Cinetma', 'https://cinetma.myftp.org/assets/img/destacadas/lebowski.jpg');

	webhookClient.send(embed);
	console.log(client.channels);
	res.send('Birds home page');
});

module.exports = router;