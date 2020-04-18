<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <form action="<?php echo base_url('company/update/' . $company->company_id) ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" class="form-control" name="company_name" value="<?php echo $company->company_name ?>">
            </div>
            <div class="form-group">
                <label for="company_code">Company Code:</label>
                <input type="text" class="form-control" name="company_code" value="<?php echo $company->company_code ?>">
            </div>
            <div class="form-group">
                <label for="company_address">Contact:</label>
                <input type="text" class="form-control" name="company_contact" value="<?php echo $company->company_contact ?>">
            </div>
            <div class="form-group">
                <label for="company_contact">Address:</label>
                <input type="text" class="form-control" name="company_address" value="<?php echo $company->company_address ?>">
            </div>
            <div class="form-group">
                <label for="so_number">SO Number:</label>
                <input type="number" class="form-control" name="so_number" value="<?php echo $company->so_number ?>">
            </div>
            <div class="form-group">
                <label for="company_status">Status:</label>
                <select name="company_status" class="form-control">
                    <option value="Active" <?php if ($company->company_status == 'Active') {
                                                echo  "selected";
                                            } ?>>Aktif</option>
                    <option value="Inactive" <?php if ($company->company_status == 'Inactive') {
                                                    echo  "selected";
                                                } ?>>Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="company_logo">Logo:</label>
                <input type="text" class="form-control" value="<?php echo $company->company_logo ?>" readonly><br>
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