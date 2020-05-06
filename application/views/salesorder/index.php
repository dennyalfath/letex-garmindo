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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="<?php echo base_url('salesorder/edit/' . $so->so_id) ?>" class="btn btn-sm btn-warning">Modify</a>
                                <a href="<?php echo base_url('salesorder/destroy/' . $so->so_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
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