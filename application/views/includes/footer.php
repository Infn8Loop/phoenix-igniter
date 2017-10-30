<!--CONTEND ENDS -->
</body>
<!--MVVM MODEL-->
<script type="text/javascript">
    mvvm     = <?php echo json_encode($mvvm['record']); ?>;
    token    = <?php echo json_encode($mvvm['token']); ?>;
    mvvm_url = '<?php echo MVVM_URL; ?>';
</script>
<script src="<?php echo site_url('assets/jquery/jquery-3.2.1.min.js');?>"></script>
<script src="<?php echo site_url('assets/bootstrap-3.3.7-dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo site_url('assets/wow/dist/wow.min.js');?>"></script>
<script>
    new WOW().init();
</script>
<script src="<?php echo site_url('assets/js/mvvm.js')?>"></script>
<script src="<?php echo site_url('assets/js/script.js')?>"></script>
</html>