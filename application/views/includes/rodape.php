

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<script src="<?= base_url("js/jquery-1.11.3.min.js") ?>"></script>
<script src="<?= base_url("js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("js/js_base.js") ?>"></script>

<!-- Se for passado a fução especifica para carregamnto do JS de forma dinamica a função careega aqui -->
<!-- tem que passar no carregamento da tela o caminho do JS especifico para ela para carrera as função JS do arquivo-->
<script src="<?php echo (isset($funcao_especifica['js_tela']) ? base_url($funcao_especifica['js_tela']) : '') ?>"></script>

</body>
</html>