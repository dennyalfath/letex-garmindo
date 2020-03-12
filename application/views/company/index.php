<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="company">
                <thead>
                    <th>#</th>
                    <th>Nama Perusahaan</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($company as $cp) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $cp->company_name ?></td>
                            <td><?php echo $cp->company_contact ?></td>
                            <td><?php echo $cp->company_address ?></td>
                            <td><?php if ($cp->company_status == 'Active') {
                                    echo '<span class="badge badge-success">Aktif</span>';
                                } else {
                                    echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                } ?></td>
                            <td>
                                <a href="<?php echo '#detailcompany' . $cp->company_id ?>" data-toggle="modal" class="btn btn-sm btn-primary">Detail</a>
                                <a href="<?php echo base_url('company/edit/' . $cp->company_id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?php echo base_url('company/destroy/' . $cp->company_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?');">Hapus</a>
                            </td>
                            <td></td>
                        </tr>
                        <!-- Detail Modal -->
                        <div class="modal fade" id="detailcompany<?php echo $cp->company_id ?>" tabindex="-1" role="dialog" aria-labelledby="detailcompanylabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailcompanylabel"><?php echo $cp->company_name ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Company Logo:</p>
                                        <?php if ($cp->company_logo == NULL) : ?>
                                            -
                                        <?php else : ?>
                                            <img src="<?php echo base_url('uploads/company-logo/' . $cp->company_logo) ?>" width="30%">
                                        <?php endif; ?>
                                        <p class="mt-2">Sales Order No:</p>
                                        <p class="mt-2">Invoice No:</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->