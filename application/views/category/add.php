<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('category/store') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cat_name">Category Name:</label>
                <input type="text" class="form-control" name="cat_name" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Save</button>
            </div>
        </form>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->