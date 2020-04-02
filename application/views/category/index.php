<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($category as $cat) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $cat->cat_name ?></td>
                            <td>
                                <a href="<?php echo base_url('category/edit/' . $cat->cat_id) ?>" class="btn btn-sm btn-warning">Modify</a>
                                <a href="<?php echo base_url('category/destroy/' . $cat->cat_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
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