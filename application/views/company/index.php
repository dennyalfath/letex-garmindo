<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <th>#</th>
                    <th>Nama Perusahaan</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Logo</th>
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
                            <td><?php if ($cp->company_logo == NULL) : ?>
                                    -
                                <?php else : ?>
                                    <?php echo $cp->company_logo ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('company/edit/' . $cp->company_id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?php echo base_url('company/destroy/' . $cp->company_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?');">Hapus</a>
                            </td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->