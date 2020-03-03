<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <th>#</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Tanggal Daftar</th>
                    <th>Perusahaan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($client as $cl) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $cl->client_name ?></td>
                            <td><?php echo $cl->client_contact ?></td>
                            <td><?php echo $cl->client_date_register ?></td>
                            <td><?php echo $cl->company_name ?></td>
                            <td>
                                <a href="<?php echo base_url('client/edit/' . $cl->client_id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?php echo base_url('client/destroy/' . $cl->client_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?');">Hapus</a>
                            </td>
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