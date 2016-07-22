<?
switch ($_GET['accion']) {
	case 'acordarse':
	$usuario='juan';
	session_register("usuario");
	#$_SESSION['usuario']='hola';
	break;
	case 'olvidarse':
	unset($_SESSION['usuario']);
	break;
	default:
	echo 'No seleccionó accion<br>';
	break;
}
echo 'Nuestra variable vale '.$_SESSION['usuario'].'.';
echo "<br>Si register globals estuviera en on estaria en $usuario.";

