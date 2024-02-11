<footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © JOME <?php echo date("Y"); ?></span></div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../../assets/js/Animated-Text-Background.js"></script>
    <script src="../../assets/js/responsive-blog-card-slider-1.js"></script>
    <script src="../../assets/js/responsive-blog-card-slider.js"></script>
    <script src="../../assets/js/theme.js"></script>

    <!-- jquery (js) -->
<script src = "../../librerias/jquery/jquery-3.7.1.min.js"></script>
<!-- DataTable (js) -->
<script src = "../../librerias/jquery/jquery.dataTables.js"></script>
<!-- popper (js) -->
<script src = "../../librerias/popper/js/popper.min.js"></script>
<!-- sweetalert2 (js) -->
<script src = "../../librerias/sweetalert2/sweetalert2.all.min.js"></script>

<!-- personalizamos la tabla  -->
<script>
$(document).ready( function(){
$("#tabla_id").DataTable({
pageLength: 3,
lengthMenu:[ [3,10,25,50], [3,10,25,50] ],
destroy: true,
language:{
    lengthMenu: "Mostrar _MENU_ registros por página",
    zeroRecords: "Ningún elemento encontrado",
    info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
    infoEmpty: "Ningún elemento encontrado",
    infoFiltered: "(filtrados desde _MAX_ registros totales)",
    search: "Buscar:",
    loadingRecords: "Cargando...",
    paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior"
    }
  }

 });

});
</script>

<!-- incluimos el scripts de las alertas personalizadas-->
<script src = "../../librerias/codigo_alertas.js"></script>

</body>

</html>