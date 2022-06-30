<footer class="main-footer">
  <div class="float-right hidden-xs">
    
  </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- Moment -->
<script src="<?= base_url('assets/adminlte/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/moment/locale/id.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.js') ?>"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<!-- Sweetalert2 -->
<script src="<?= base_url('assets/adminlte/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/adminlte/dist/js/demo.js') ?>"></script>

<!-- ChartJS -->
<script src="<?= base_url('assets/plugins/Chart.js/Chart.min.js') ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<!-- Fileinput -->
<script src="<?= base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/fileinput/themes/fas/theme.min.js') ?>"></script>

<script type="text/javascript">
  $(document).ready(function() {
    function update() {
      $('#clock').html(moment().format('D MMMM YYYY H:mm:ss'));
    }
    setInterval(update, 1000);
  });
</script>

<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 4000);
</script>

</body>

</html>