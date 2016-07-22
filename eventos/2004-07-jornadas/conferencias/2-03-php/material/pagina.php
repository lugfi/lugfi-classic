
<?php
error_reporting(E_ALL);
ob_implicit_flush();

//ejemplo de pagina en php que se conecta a un servidor mediante TCP para obtener alguna informacion
//--------------------------------------------------------------------------------------------------

echo "<html>";
echo "<br><b>Informe del estado del reactor</b><br><br>";

$port=1982;
$address = gethostbyname('127.0.0.1');
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$result = socket_connect($socket, $address, $port);

$mensaje = "estado\n";
socket_write($socket, $mensaje, strlen($mensaje));
$respuesta = socket_read($socket, 2048);
echo "$respuesta";
$mensaje = "quit\n";
socket_write($socket, $mensaje, strlen($mensaje));
socket_close($socket);

echo "</html>";
?>
