<div class="contenedor login">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>

        <form class="formulario" method="POST" action="/" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input 
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email"
                />
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input 
                    type="password"
                    id="password"
                    placeholder="Tu Password"
                    name="password"
                />
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? obtener una</a>
            <a href="/olvide">¿Olvidaste tu Password?</a>
        </div>
    </div> <!--.contenedor-sm -->
</div>

<!-- Botón Flotante del Chatbot -->
<a href="/chatbot" class="btn-chatbot-flotante" title="Hablar con TalkTrack Bot">
    <span class="icono">💬</span>
    <span class="texto">TalkTrack Bot</span>
</a>