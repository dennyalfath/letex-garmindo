<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('client/store') ?>" method="POST">
            <div class="form-group">
                <label for="client_name">Client Name:</label>
                <input type="text" class="form-control" name="client_name" required>
            </div>
            <div class="form-group">
                <label for="client_contact">Client Contact:</label>
                <input type="text" class="form-control" name="client_contact" required>
            </div>
            <div class="form-group">
                <label for="company">Company:</label>
                <select name="company" class="form-control" required>
                    <option value="0">-- Select Company --</option>
                    <?php foreach ($company as $cp) : ?>
                        <option value="<?php echo $cp->company_id ?>"><?php echo $cp->company_name ?></option>
                    <?php endforeach; ?>
                </select>
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