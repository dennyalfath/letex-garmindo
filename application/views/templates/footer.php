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
                    url: '<?php echo base_url('salesorder/get_company_so') ?>',
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
                        $('#so_number').val(data['company_code'] + '-' + formatted_string('000', soNum, 'l'));
                        $('#int_so_number').val(soNum);
                        $('#company').val(data['company_id']);
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() { // Ketika halaman sudah diload dan siap    
        $("#add-items").click(function() { // Ketika tombol Tambah Data Form di klik      
            var total = parseInt($("#form-total").val()); // Ambil jumlah data form pada textbox jumlah-form      
            var nextform = total + 1; // Tambah 1 untuk jumlah form nya            
            // Kita akan menambahkan form dengan menggunakan append      
            // pada sebuah tag div yg kita beri id insert-form      
            $("#insert-form").append(
                '<div class="card">' + '<div class="card-header">' + '<h5 class="card-title font-weight-bold">' + 'Item ' + nextform + '</h5>' + '</div>' +

                '<div class="card-body">' +

                '<div class="row">' +

                '<div class="col-md-3">' + ' <div class="form-group">' + ' <label for="so_number">SO. Number</label>' + '<input type="text" class="form-control" name="sod_so_number[]" value="<?php echo $salesorder->so_number ?>" readonly required>' + '</div>' + '</div>' +

                '<div class="col-md-3">' + '<div class="form-group">' + '<label for="product">Product</label>' + '<select name="sod_product[]" class="form-control" required>' + '<option value="0">-- Select Product --</option>' + '<?php foreach ($product as $pr) : ?>' + ' <option value="<?php echo $pr->pr_id ?>"><?php echo $pr->pr_name ?></option>' + ' <?php endforeach; ?>' + '</select>' + ' </div>' + ' </div>' +

                '<div class="col-md-3">' + '<div class="form-group">' + '<label for="user">Responsible Staff</label>' + '<select name="sod_user[]" class="form-control" required>' + '<option value="0">-- Select Staf --</option>' + '<?php foreach ($users as $us) : ?>' + ' <option value="<?php echo $us->user_id ?>"><?php echo ucfirst($us->username) ?></option>' + ' <?php endforeach; ?>' + '</select>' + '</div>' + '</div>' +

                '<div class="col-md-3">' + '<div class="form-group">' + '<label for="qty">Quantity</label>' + '<input type="text" class="form-control" name="sod_qty[]" required>' + '</div>' + '</div>' +

                '<div class="col-md-3">' + '<div class="form-group">' + '<label for="remark_size">Remark Size</label>' + '<input type="text" class="form-control" name="sod_remark_size[]" required>' + '</div>' + '</div>' +

                '<div class="col-md-3">' + '<div class="form-group">' + '<label for="desc">Description</label>' + '<input type="text" class="form-control" name="sod_desc[]">' + '</div>' + '</div>' +

                '<div class="col-md-3">' + '<div class="form-group">' + '<label for="status">Status</label>' + '<select name="status[]" class="form-control" required>' + '<option value="0">-- Select status --</option>' + ' <option value="cut">On Cutting</option>' + '<option value="sew">On Sewing</option>' + '<option value="pack">On Packing</option>' + '<option value="sent">Sent Out</option>' + '<option value="cancelled">Cancelled</option>' + '</select>' + '</div>' + '</div>' +

                '<div class="col-md-3">' + '<div class="form-group">' + '<label for="sod_total_price">Total Price</label>' + '<input type="text" class="form-control" name="sod_total_price[]">' + '</div>' + '</div>' +

                '</div>' +

                '</div>' + '</div>'
            );
            $("#form-total").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform    
        });
        // Buat fungsi untuk mereset form ke semula    
        $("#reset-items").click(function() {
            $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form     
            $("#form-total").val("1"); // Ubah kembali value jumlah form menjadi 1   
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