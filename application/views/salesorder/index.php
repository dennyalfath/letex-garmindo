<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>SO. Number</th>
                        <th>Client Name</th>
                        <th>Description</th>
                        <th>Date Ordered</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($salesorder as $so) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo str_pad($so->so_number, 3, '0', STR_PAD_LEFT) ?></td>
                            <td><?php echo $so->client_name ?></td>
                            <td><?php echo $so->so_description ?></td>
                            <td><?php echo date('d-m-Y', strtotime($so->so_date_order)) ?></td>
                            <td><?php echo number_format($so->so_total_amount) ?></td>
                            <td>
                                <?php if ($so->so_status == 'cut') {
                                    echo '<span class="badge badge-warning">On Cutting</span>';
                                } else if ($so->so_status == 'sew') {
                                    echo '<span class="badge badge-warning">On Sewing</span>';
                                } else if ($so->so_status == 'pack') {
                                    echo '<span class="badge badge-warning">On Packing</span>';
                                } else if ($so->so_status == 'sent') {
                                    echo '<span class="badge badge-success">Sent Out</span>';
                                } else if ($so->so_status == 'cancelled') {
                                    echo '<span class="badge badge-danger">Cancelled</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('salesorder/show_detail/' . $so->so_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                                <?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'manager' || $this->session->userdata('role') == 'superadmin') : ?>
                                    <a href="<?php echo base_url('salesorder/add_detail/' . $so->so_id) ?>" class="btn btn-sm btn-success">Add Items</a>
                                    <a href="<?php echo base_url('salesorder/edit/' . $so->so_id) ?>" class="btn btn-sm btn-warning">Modify</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->