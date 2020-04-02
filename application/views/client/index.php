<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Contact</th>
                        <th>Date of Registered</th>
                        <th>Company</th>
                        <th>SO No.</th>
                        <th>Invoice No.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($client as $cl) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $cl->client_name ?></td>
                            <td><?php echo $cl->client_code ?></td>
                            <td><?php echo $cl->client_contact ?></td>
                            <td><?php echo date('d-m-Y', strtotime($cl->client_date_register)) ?></td>
                            <td><?php echo $cl->company_name ?></td>
                            <td><?php echo $cl->so_number ?></td>
                            <td><?php echo $cl->invoice_number ?></td>
                            <td>
                                <a href="<?php echo base_url('client/edit/' . $cl->client_id) ?>" class="btn btn-sm btn-warning">Modify</a>
                                <a href="<?php echo base_url('client/destroy/' . $cl->client_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
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