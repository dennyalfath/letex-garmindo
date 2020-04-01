<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('client/update/' . $client->client_id) ?>" method="POST">
            <div class="form-group">
                <label for="client_name">Client Name:</label>
                <input type="text" class="form-control" name="client_name" value="<?php echo $client->client_name ?>" required>
            </div>
            <div class="form-group">
                <label for="client_code">Client Code:</label>
                <input type="text" class="form-control" name="client_code" value="<?php echo $client->client_code ?>" required>
            </div>
            <div class="form-group">
                <label for="client_contact">Client Contact:</label>
                <input type="text" class="form-control" name="client_contact" value="<?php echo $client->client_contact ?>" required>
            </div>
            <div class="form-group">
                <label for="company">Perusahaan:</label>
                <select name="company" class="form-control">
                    <?php foreach ($company as $cp) :  ?>
                        <option value="<?php echo $cp->company_id ?>" <?php if ($client->company_id == $cp->company_id) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $cp->company_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="client_sonum">Client SO Number:</label>
                <input type="text" class="form-control" name="client_sonum" value="<?php echo $client->so_number ?>">
            </div>
            <div class="form-group">
                <label for="client_invnum">Client Invoice Number:</label>
                <input type="text" class="form-control" name="client_invnum" value="<?php echo $client->invoice_number ?>">
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