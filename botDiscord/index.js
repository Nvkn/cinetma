// index.js


//////////////// MÓDULOS ///////////////////

// Módulos necesarios para el servidor
const fs = require('fs');
const { prefix, token } = require('./config.json');
const https = require('https');
const express = require('express');
const router = express.Router();
const web = require('./routes/web.routes');
const bodyParser = require('body-parser');
const Discord = require('discord.js');
client = new Discord.Client();

// Variables de entorno
const dotenv = require('dotenv').config();

// Certificados
const privateKey = fs.readFileSync('/etc/letsencrypt/live/cinetma.myftp.org/privkey.pem', 'utf8');
const certificate = fs.readFileSync('/etc/letsencrypt/live/cinetma.myftp.org/cert.pem', 'utf8');
const ca = fs.readFileSync('/etc/letsencrypt/live/cinetma.myftp.org/chain.pem', 'utf8');

const credentials = {
    key: privateKey,
    cert: certificate,
    ca: ca
}
// Express
const app = express();
app.use(bodyParser.urlencoded({
    extended: true
}));


// Comandos
const commandFiles = fs.readdirSync('./commands').filter(file => file.endsWith('.js'));
client.commands = new Discord.Collection();
for (const file of commandFiles) {
    const command = require(`./commands/${file}`);
    client.commands.set(command.name, command);
}



/////////////////// RUTAS //////////////////////

app.use('/', web);


const httpsServer = https.createServer(credentials, app);
var server = httpsServer.listen(process.env.PUERTO_WEB_HTTPS, () => {
    console.log(`Servidor https funcionando en puerto ${process.env.PUERTO_WEB_HTTPS}`);
})

//////////////// BOT DISCORD ///////////////////

client.once('ready', async () => {
    // const channel = client.channels.cache.get('720023012283383839');
    console.log('¡Bot en funcionamiento!');
    // console.log(client.channels);
});


client.on('message', msg => {

    if (!msg.content.startsWith(prefix) || msg.author.bot) return;

    const args = msg.content.slice(prefix.length).split(/ +/);
    const command = args.shift().toLowerCase();

    if (command === 'pelicula-aleatoria') {
        client.commands.get('pelicula-aleatoria').execute(msg, args);
    } else if (command === 'pelicula') {
        client.commands.get('pelicula').execute(msg, args);
    } else if (command === 'ultimas-peliculas') {
        client.commands.get('ultimas-peliculas').execute(msg, args);
    } else if (command === 'mejores-peliculas') {
        client.commands.get('mejores-peliculas').execute(msg, args);
    } else if (command === 'help') {
        client.commands.get('help').execute(msg, args);
    } else if (command === 'commands') {
        client.commands.get('help').execute(msg, args);
    }

});




client.login(token);