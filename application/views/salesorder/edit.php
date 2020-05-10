<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('salesorder/update/' . $salesorder->so_id) ?>" method="POST">
            <div class="form-group">
                <label for="so_number">SO. Number</label>
                <input type="text" class="form-control" name="so_number" value="<?php echo str_pad($salesorder->so_number, 3, '0', STR_PAD_LEFT) ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="client">Client</label>
                <input type="text" name="client" class="form-control" value="<?php echo $salesorder->client_name ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" value="<?php echo $salesorder->so_description ?>">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="0">-- Select one --</option>
                    <option value="cut" <?php if ($salesorder->so_status == 'cut') {
                                            echo "selected";
                                        } ?>>On Cutting</option>
                    <option value="sew" <?php if ($salesorder->so_status == 'sew') {
                                            echo "selected";
                                        } ?>>On Sewing</option>
                    <option value="pack" <?php if ($salesorder->so_status == 'pack') {
                                                echo "selected";
                                            } ?>>On Packing</option>
                    <option value="sent" <?php if ($salesorder->so_status == 'sent') {
                                                echo "selected";
                                            } ?>>Sent Out</option>
                    <option value="cancelled" <?php if ($salesorder->so_status == 'cancelled') {
                                                    echo "selected";
                                                } ?>>Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Save</button>
            </div>
        </form>
    </div>
</div>
</div>