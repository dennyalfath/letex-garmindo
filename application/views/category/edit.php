<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('category/update/' . $category->cat_id) ?>" method="POST">
            <div class="form-group">
                <label for="cat_name">Category Name:</label>
                <input type="text" class="form-control" name="cat_name" value="<?php echo $category->cat_name ?>">
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