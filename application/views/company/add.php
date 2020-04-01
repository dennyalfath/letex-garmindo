<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('company/store') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" class="form-control" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="company_address">Company Contact:</label>
                <input type="text" class="form-control" name="company_contact" required>
            </div>
            <div class="form-group">
                <label for="company_contact">Company Address:</label>
                <input type="text" class="form-control" name="company_address" required>
            </div>
            <div class="form-group">
                <label for="company_status">Status:</label>
                <select name="company_status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="company_logo">Logo:</label><br>
                <input type="file" name="company_logo" size="20">
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