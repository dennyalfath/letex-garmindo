<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table text-center" id="userlist">
                <thead>
                    <th>#</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($userlist as $us) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $us->username ?></td>
                            <td><?php echo ucfirst($us->role) ?></td>
                            <td><?php if ($us->block == 'Y') {
                                    echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                } else {
                                    echo '<span class="badge badge-success">Aktif</span>';
                                } ?></td>
                            <td>
                                <?php if ($us->role == 'superadmin') : ?>
                                    -
                                <?php else : ?>
                                    <a href="<?php echo base_url('superadmin/edituser/') . $us->user_id ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?php echo base_url('superadmin/deleteuser/') . $us->user_id ?>" class="btn btn-sm btn-danger">Delete</a>
                                <?php endif; ?>
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