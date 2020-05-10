<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>SO. Number</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($so_detail as $sod) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $sod->so_number ?></td>
                            <td><?php echo $sod->pr_name ?></td>
                            <td><?php echo $sod->total_qty ?></td>
                            <td>
                                <?php if ($sod->sod_status == 'cut') {
                                    echo '<span class="badge badge-warning">On Cutting</span>';
                                } else if ($sod->sod_status == 'sew') {
                                    echo '<span class="badge badge-warning">On Sewing</span>';
                                } else if ($sod->sod_status == 'pack') {
                                    echo '<span class="badge badge-warning">On Packing</span>';
                                } else if ($sod->sod_status == 'sent') {
                                    echo '<span class="badge badge-success">Sent Out</span>';
                                } else if ($sod->sod_status == 'cancelled') {
                                    echo '<span class="badge badge-danger">Cancelled</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#more-sod<?php echo $sod->sod_id ?>" class="btn btn-sm btn-primary" data-toggle="modal">More Detail</a>
                                <?php if ($sod->sod_status == 'cut') {
                                    echo "<a href=" . base_url('salesorder/update_detail_status/' . $sod->sod_id . '?status=sew&so_id=' . $so_id) . " class='btn btn-sm btn-success'>On Sewing</a>";
                                } else if ($sod->sod_status == 'sew') {
                                    echo "<a href=" . base_url('salesorder/update_detail_status/' . $sod->sod_id . '?status=pack&so_id=' . $so_id) . " class='btn btn-sm btn-success'>On Packing</a>";
                                } else if ($sod->sod_status == 'pack') {
                                    echo "<a href=" . base_url('salesorder/update_detail_status/' . $sod->sod_id . '?status=sent&so_id=' . $so_id) . " class='btn btn-sm btn-success'>Sent Out</a>";
                                } else if ($sod->sod_status == 'cancelled') {
                                    echo "<a href=" . base_url('salesorder/update_detail_status/' . $sod->sod_id . '?status=cut&so_id=' . $so_id) . " class='btn btn-sm btn-success'>On Cutting</a>";
                                }
                                if ($sod->sod_status != 'cancelled') {
                                    echo " <a href=" . base_url('salesorder/update_detail_status/' . $sod->sod_id . '?status=cancelled&so_id=' . $so_id) . " class='btn btn-sm btn-danger'>Cancel</a>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Detail Modal -->
        <?php foreach ($so_detail as $sod) : ?>
            <div class="modal fade" id="more-sod<?php echo $sod->sod_id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsodlabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fluid" role="document">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsodlabel">Item Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow-x: auto">
                            <div class="form-group">
                                <label for="remark_size">Remark Size:</label>
                                <input type="text" class="form-control" value="<?php echo $sod->remark_size ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total_price">Total Price:</label>
                                <input type="text" class="form-control" value="<?php echo $sod->total_price ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description:</label>
                                <input type="text" class="form-control" value="<?php echo $sod->sod_description ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="resp_staff">Responsible Staff:</label>
                                <input type="text" class="form-control" value="<?php echo ucfirst($sod->username) ?>" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->