<footer class="main-footer">
  <strong>
     &copy;<?php echo date('Y'); ?>
     <a href="#" style="color: forestgreen;">clarity bank </a>.</strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- <script src="../plugins/jquery-3.6.3.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- Ekko Lightbox -->
<script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/select2/js/select2.full.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<script>
  $(document).on('click', '.see', function(event) {
    event.preventDefault();
    var hide = document.getElementsByClassName("acct").innerText;
    var show = document.getElementsByClassName("accts").innerText;
    if (show == null) {
      var show = document.getElementById("accts").innerText;
      if (show == "") {
        var id = $(this).data('id');
        $.ajax({
          url: "../home/acct.php",
          data: {
            id: id,
            show: show
          },
          type: "GET",
          success: function(data) {
            var json = JSON.parse(data);
            $(".acct").html('');
            $(".accts").html(json);
            $(".act").html("Account balance <i class='btn btn-tone bg-transparent see fas fa-eye button ' style='color:white;' data-id='<?php echo $_SESSION["User_id"]; ?>'></i>");
          }
        })
      } else {
        $(".acct").html('****');
        $(".accts").html('');
        $(".act").html("Account balance <i class='btn btn-tone bg-transparent see fas fa-eye-slash button ' style='color:white;' data-id='<?php echo $_SESSION["User_id"]; ?>'></i>");
         
      }

    }
  });

  function transfer() {
    window.location = "../transfer/index.php";
  }
  function add_money(){
    window.location = "../fund/index.php";    
  }
</script>
</body>

</html>