</div> <!-- container -->

<!-- Footer -->
<footer class="bg-dark text-light mt-5 py-4">
    <div class="container">

        <div class="row align-items-center">

            <!-- Nombre de la app -->
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <h5 class="fw-bold mb-0">ProjectGest</h5>
                <small class="text-muted">Organiza. Planifica. Avanza.</small>
            </div>

            <!-- Enlaces -->
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <a href="<?= BASE_URL ?>" class="text-light text-decoration-none me-3">
                    <i class="bi bi-house-door-fill"></i> Inicio
                </a>
                <a href="<?= BASE_URL ?>auth/login" class="text-light text-decoration-none me-3">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="<?= BASE_URL ?>auth/register" class="text-light text-decoration-none">
                    <i class="bi bi-person-plus-fill"></i> Registro
                </a>
            </div>

            <!-- Redes o derechos -->
            <div class="col-md-4 text-center text-md-end">
                <small class="text-muted">
                    © <?= date('Y') ?> ProjectGest. Todos los derechos reservados.
                </small>
            </div>

        </div>

    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>