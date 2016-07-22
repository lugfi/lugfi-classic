#!/usr/bin/php -q
<?php

error_reporting(E_ALL);

//Ejemplo de servidor implementado en un script PHP
//-------------------------------------------------

//quitar el límite de tiempo para que el script se pueda quedar indefinidamente esperando conexiones
set_time_limit(0);

$address = '127.0.0.1';
$port = 1982;

//PASO 1: crear el socket
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
   echo "No se pudo crear el socket: " . socket_strerror($sock) . "\n";
}

//PASO 2: setear las direcciones
if (($ret = socket_bind($sock, $address, $port)) < 0) {
   echo "No se pudo bindear el socket: " . socket_strerror($ret) . "\n";
}

//PASO 3: escuchar el puerto
if (($ret = socket_listen($sock, 5)) < 0) {
   echo "No se pudo poner a escuchar el socket: " . socket_strerror($ret) . "\n";
}

//en este punto, el script se queda colgado hasta que entre alguna conexión


do {
   //PASO 4: aceptar la conexión
   if (($msgsock = socket_accept($sock)) < 0) {
       echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
       break;
   }

   //enviar un mensaje de bienvenida
   $msg = "\nBienvenido al server.\nPara desconectarse, escriba 'quit'. Para matar al servidor, escriba 'shutdown'.\n";
   //socket_write($msgsock, $msg, strlen($msg));

   //PASO 5: entrar en el loop
   do {
       //leer un bloque del socket
       if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
           echo "socket_read() failed: reason: " . socket_strerror($ret) . "\n";
           break 2;
       }
       //sacar espacios, tabs, retornos de carro, etc., del comienzo y fin del buffer
       if (!$buf = trim($buf)) {
           continue;
       }
       //si vino un quit, se cierra la conexion, y se vuelve a quedar escuchando
       if ($buf == 'quit') {
           break;
       }
       //si vino un shutdown, se cierra la conexion y se mata el servidor
       if ($buf == 'shutdown') {
           socket_close($msgsock);
           break 2;
       }
       //si vino un mensaje comun y corriente, mi respuesta es el mensaje dado vuelta
       $respuesta = "Esta todo bien\n";
       socket_write($msgsock, $respuesta, strlen($respuesta));
       echo "$buf\n";
   } while (true);
   socket_close($msgsock);
} while (true);

socket_close($sock);
?>  
 
