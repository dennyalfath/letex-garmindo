<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        CV. Letex Garmindo
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y') ?> CV. Letex Garmindo.</strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLable">Akhiri sesi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Klik "Logout" untuk mengakhiri sesi ini.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url('auth/logout') ?>" type="button" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/dist/js/jquery-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- Datatables -->
<script src="<?php echo base_url() ?>assets/dist/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/dist/datatables/dataTables.bootstrap4.js"></script>

<!-- Additional Javascripts -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#client').change(function() {
            var client = $(this).val();

            function formatted_string(pad, user_str, pad_pos) {
                if (typeof user_str === 'undefined')
                    return pad;
                if (pad_pos == 'l') {
                    return (pad + user_str).slice(-pad.length);
                } else {
                    return (user_str + pad).substring(0, pad.length);
                }
            }

            //AJAX REQUEST
            if (client) {
                $.ajax({
                    url: '<?php echo base_url('salesorder/getClient') ?>',
                    method: 'post',
                    data: {
                        client: client
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        //Add SO Number
                        var soNum = parseInt(data['so_number']);
                        soNum = soNum + 1;
                        $('#so_number').val(formatted_string('000', soNum, 'l'));
                    }
                });
            }
        });
    });
</script>

<script>
    $(function() {
        $("#data-table").DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 20,
        });
    });
</script>

</body>

</html>