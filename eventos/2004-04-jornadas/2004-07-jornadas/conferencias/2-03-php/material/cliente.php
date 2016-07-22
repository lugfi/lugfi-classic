
<?php
error_reporting(E_ALL);
ob_implicit_flush();

//ejemplo de pagina en php que se conecta a un servidor mediante TCP
//------------------------------------------------------------------

echo "<html>";

echo "<br><b>Conexión TCP/IP</b><br><br><br>";

$port=80;
$address = gethostbyname('127.0.0.1');

//PASO 1: crear el socket
echo "1) Creando el socket... ";
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
   echo "No se pudo crear el socket: " . socket_strerror($socket) . "\n";
} else {
   echo "OK<br><br>";
}

//PASO 2: conectarse al servidor
echo "2) Conectandose a '$address' por el puerto '$port'... ";
$result = socket_connect($socket, $address, $port);
if ($result < 0) {
   echo "No se pudo conectar: ($result) " . socket_strerror($result) . "\n";
} else {
   echo "OK<br><br>";
}

//PASO 3: a partir de ahora, se puede enviar y recibir mensajes


//preparo un mensaje para enviar
$mensaje = "GET /charlassoc/ejemplo.html HTTP/1.1\r\n";
$mensaje .= "Host: php.lug.fi.uba.ar\r\n";
$mensaje .= "Connection: Close\r\n\r\n";

//envio el mensaje
echo "3a) Enviando mensaje... ";
socket_write($socket, $mensaje, strlen($mensaje));
echo "OK<br><br>";

//leo una respuesta
echo "3b) Leyendo respuesta...<br><br>";
while ($out = socket_read($socket, 2048)) {

   echo "------------------------------------------------------------------<br>";
   echo "la respuesta fue:<br>";
   echo "------------------------------------------------------------------<br>";
   echo "$out<br>";
   echo "------------------------------------------------------------------<br><br>";
}

//PASO 4: cerrar el socket
echo "4) Cerrando el socket... ";
socket_close($socket);
echo "OK";
?>
