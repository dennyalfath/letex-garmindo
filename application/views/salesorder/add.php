<div class="content">
    <div class="container-fluid">
        <form action="<?php echo base_url('salesorder/store') ?>" method="POST">
            <div class="form-group">
                <label for="so_number">SO. Number</label>
                <input type="text" class="form-control" name="so_number" id="so_number" placeholder="Automatically filled when client is selected" readonly>
            </div>
            <div class="form-group">
                <label for="client">Client</label>
                <select name="client" class="form-control" id="client">
                    <option value="0">-- Choose Client --</option>
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
                <label for="total_amount">Total Amount</label>
                <input type="text" class="form-control" name="total_amount">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1">On Cutting</option>
                    <option value="1">On Sewing</option>
                    <option value="1">On Packing</option>
                    <option value="1">Sent Out</option>
                    <option value="1">Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Save</button>
            </div>
        </form>
    </div>
</div>
</div>