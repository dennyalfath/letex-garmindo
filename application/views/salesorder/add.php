<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('salesorder/store') ?>" method="POST">
            <input type="hidden" class="form-control" name="company" id="company" readonly>
            <input type="hidden" class="form-control" name="int_so_number" id="int_so_number" readonly>
            <div class="form-group">
                <label for="so_number">SO. Number</label>
                <input type="text" class="form-control" name="so_number" id="so_number" placeholder="Automatically filled when client is selected" readonly required>
            </div>
            <div class="form-group">
                <label for="client">Client</label>
                <select name="client" class="form-control" id="client" required>
                    <option value="0">-- Select client --</option>
                    <?php foreach ($client as $cl) : ?>
                        <option value="<?php echo $cl->client_id ?>"><?php echo $cl->client_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Proceed</button>
            </div>
        </form>
    </div>
</div>
</div>