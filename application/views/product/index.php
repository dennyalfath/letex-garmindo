<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Client</th>
                        <th>Category</th>
                        <th>Style</th>
                        <th>Sell Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($product as $pr) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $pr->pr_name ?></td>
                            <td><?php echo $pr->client_name ?></td>
                            <td><?php echo $pr->cat_name ?></td>
                            <td><?php echo $pr->style ?></td>
                            <td><?php echo $pr->sell_price ?></td>
                            <td width="10%"><img src="<?php echo base_url('uploads/product-image/' . $pr->pr_picture) ?>" width="60%"></td>
                            <td>
                                <a href="<?php echo base_url('product/edit/' . $pr->pr_id) ?>" class="btn btn-sm btn-warning">Modify</a>
                                <a href="<?php echo base_url('product/destroy/' . $pr->pr_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
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