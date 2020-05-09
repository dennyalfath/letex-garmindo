<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($company as $cp) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $cp->company_name ?></td>
                            <td><?php if ($cp->company_status == 'Active') {
                                    echo '<span class="badge badge-success">Active</span>';
                                } else {
                                    echo '<span class="badge badge-danger">Inactive</span>';
                                } ?></td>
                            <td>
                                <a href="<?php echo '#detailcompany' . $cp->company_id ?>" data-toggle="modal" class="btn btn-sm btn-primary">Detail</a>
                                <a href="<?php echo base_url('company/edit/' . $cp->company_id) ?>" class="btn btn-sm btn-warning">Modify</a>
                                <?php if ($this->session->userdata('role') == 'superadmin') : ?>
                                    <a href="<?php echo base_url('company/destroy/' . $cp->company_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php foreach ($company as $cp) : ?>
            <!-- Detail Modal -->
            <div class="modal fade" id="detailcompany<?php echo $cp->company_id ?>" tabindex="-1" role="dialog" aria-labelledby="detailcompanylabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fluid" role="document">
                    <div class="modal-content text-center width-auto">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailcompanylabel">Company Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow-x: auto">
                            <div class="form-group">
                                <?php if ($cp->company_logo == NULL) : ?>
                                    No image
                                <?php else : ?>
                                    <img src="<?php echo base_url('uploads/company-logo/' . $cp->company_logo) ?>" width="30%">
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="cpname">Company Name:</label>
                                <input type="text" class="form-control" value="<?php echo $cp->company_name ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cpcode">Company Code:</label>
                                <input type="text" class="form-control" value="<?php echo $cp->company_code ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cpcontact">Company Contact:</label>
                                <input type="text" class="form-control" value="<?php echo $cp->company_contact ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cpaddress">Company Address:</label>
                                <input type="text" class="form-control" value="<?php echo $cp->company_address ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cpso_number">SO Number:</label>
                                <input type="text" class="form-control" value="<?php echo $cp->company_code . '-' . str_pad($cp->so_number, 3, '0', STR_PAD_LEFT) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cpstatus">Company Status:</label>
                                <input type="text" class="form-control" value="<?php echo $cp->company_status ?>" readonly>
                            </div>

                            <div class="table-responsive" style="height: 175px;">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Client Name</th>
                                            <th>Contact</th>
                                            <th>Date of Registered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($client[$cp->company_id] as $cl) : ?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $cl->client_name ?></td>
                                                <td><?php echo $cl->client_contact ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($cl->client_date_register)) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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