</div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <?php include('inc/footer.php')?>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>