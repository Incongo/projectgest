    </div> <!-- cierre ui container -->

    <!-- FOOTER Semantic UI -->
    <div class="ui inverted vertical segment" style="padding: 3rem 0; margin-top: 4rem;">
        <div class="ui container">

            <div class="ui stackable grid">

                <div class="six wide column">
                    <h4 class="ui inverted header">ProjectGest</h4>
                    <p>Organiza. Planifica. Avanza.</p>
                </div>

                <div class="five wide column">
                    <h4 class="ui inverted header">Navegación</h4>
                    <div class="ui inverted link list">
                        <a href="<?= BASE_URL ?>" class="item">Inicio</a>
                        <a href="<?= BASE_URL ?>auth/login" class="item">Login</a>
                        <a href="<?= BASE_URL ?>auth/register" class="item">Registro</a>
                    </div>
                </div>

                <div class="five wide column">
                    <h4 class="ui inverted header">© <?= date('Y') ?></h4>
                    <p>Todos los derechos reservados.</p>
                </div>

            </div>

        </div>
    </div>

    </body>

    </html>