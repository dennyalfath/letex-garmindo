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
                            <td>
                                <?php if (empty($so->total_amount)) {
                                    echo '-';
                                } else {
                                    echo $so->so_total_amount;
                                } ?>
                            </td>
                            <td>
                                <?php if ($so->so_status == 'progress') {
                                    echo '<span class="badge badge-warning">On Progress</span>';
                                } else if ($so->so_status == 'sew') {
                                    echo '<span class="badge badge-success">Finished</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('salesorder/show_detail/' . $so->so_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                                <a href="<?php echo base_url('salesorder/add_detail/' . $so->so_id) ?>" class="btn btn-sm btn-success">Add Items</a>
                                <a href="<?php echo base_url('salesorder/edit/' . $so->so_id) ?>" class="btn btn-sm btn-warning">Modify</a>
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