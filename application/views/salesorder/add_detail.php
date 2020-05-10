<div class="content">
    <div class="container-fluid">
        <form action="<?php echo base_url('salesorder/store_detail') ?>" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Item 1</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" class="form-control" name="so_id" value="<?php echo $salesorder->so_id ?>" readonly required>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="so_number">SO. Number</label>
                                <input type="text" class="form-control" name="sod_so_number[]" value="<?php echo $salesorder->so_number ?>" readonly required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="product">Product</label>
                                <select name="sod_product[]" class="form-control" required>
                                    <option value="0">-- Select Product --</option>
                                    <?php foreach ($product as $pr) : ?>
                                        <option value="<?php echo $pr->pr_id ?>"><?php echo $pr->pr_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="text" class="form-control" name="sod_qty[]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sod_price">Price</label>
                                <input type="text" class="form-control" name="sod_price[]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="remark_size">Remark Size</label>
                                <input type="text" class="form-control" name="sod_remark_size[]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <input type="text" class="form-control" name="sod_desc[]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="sod_status[]" class="form-control" required>
                                    <option value="0">-- Select status --</option>
                                    <option value="cut">On Cutting</option>
                                    <option value="sew">On Sewing</option>
                                    <option value="pack">On Packing</option>
                                    <option value="sent">Sent Out</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="insert-form">

            </div>
            <input type="hidden" class="form-control" id="form-total" value="1">
            <div class="form-group">
                <button type="button" id="add-items" class="btn btn-success"><i class="fas fa-plus"></i> Add More Items</button>
                <button type="reset" id="reset-items" class="btn btn-info"><i class="fas fa-times"></i> Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Save</button>
            </div>
        </form>
    </div>
</div>
</div>