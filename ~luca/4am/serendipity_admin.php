<html>
    <head>
        <title>Suite de Administración de Serendipity</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
        <link rel="stylesheet" type="text/css" href="http://www.lug.fi.uba.ar/~luca/4am/serendipity_admin.css" />
        <script type="text/javascript">
        function spawn() {
            if (self.Spawnextended) {
                Spawnextended();
            }

            if (self.Spawnbody) {
                Spawnbody();
            }

            if (self.Spawnnugget) {
                Spawnnugget();
            }
        }
        
        function SetCookie(name, value) {
            var today  = new Date();
            var expire = new Date();
            expire.setTime(today.getTime() + (60*60*24*30));
            document.cookie = 'serendipity[' + name + ']='+escape(value) + ';expires=' + expire.toGMTString();
        }
        </script>
    </head>
    <body id="serendipity_admin_page" onload="spawn()">
        <table cellspacing="0" cellpadding="0" border="0" id="serendipityAdminFrame">
            <tr>
                <td colspan="2" id="serendipityAdminBanner">
                                    <h1>Suite de Administración de Serendipity</h1>
                    <h2>4am</h2>
                                </td>
            </tr>
            <tr>
                <td colspan="2" id="serendipityAdminInfopane">
                                    </td>
            </tr>
            <tr valign="top">
                <td colspan="2" class="serendipityAdminContent">
                    <div align="center">Bienvenido a la Suite de Administración de Serendipity.<br />Por favor introduce tus credenciales abajo.</div>
                    <br />
                                        <form action="serendipity_admin.php" method="post">
                        <input type="hidden" name="serendipity[action]" value="admin" />
                        <table cellspacing="10" cellpadding="0" border="0" align="center">
                            <tr>
                                <td>Nombre de usuario</td>
                                <td><input type="text" name="serendipity[user]" /></td>
                            </tr>
                            <tr>
                                <td>Contraseña</td>
                                <td><input type="password" name="serendipity[pass]" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input id="autologin" type="checkbox" name="serendipity[auto]" /><label for="autologin"> Guardar información</label></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right"><input type="submit" name="submit" value="Conectar &gt;" class="serendipityPrettyButton" /></td>
                            </tr>
                        </table>
                    </form>
                    <a href="/~luca/4am/">Volver al weblog</a>
                </td>
            </tr>
        </table>
        <br />
        <div id="serendipityAdminFooter">Basado en Serendipity 0.8.2 y PHP 4.4.4-8+etch4</div>
    </body>
</html>
