<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('superadmin/updateuser/' . $user->user_id) ?>" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" value="<?php echo $user->username ?>" readonly>
            </div>
            <div class="form-group">
                <label for="username">Role</label>
                <select name="role" class="form-control">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" <?php if ($user->role == 'admin') {
                                                echo "selected";
                                            } ?>>Admin</option>
                    <option value="manager" <?php if ($user->role == 'manager') {
                                                echo "selected";
                                            } ?>>Manager</option>
                    <option value="drafter" <?php if ($user->role == 'drafter') {
                                                echo "selected";
                                            } ?>>Drafter</option>
                    <option value="tailor" <?php if ($user->role == 'tailor') {
                                                echo "selected";
                                            } ?>>Tailor</option>
                    <option value="packing" <?php if ($user->role == 'packing') {
                                                echo "selected";
                                            } ?>>Packing</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Status</label>
                <select name="block" class="form-control">
                    <option value="Y" <?php if ($user->block == 'Y') {
                                            echo "selected";
                                        } ?>>Tidak Aktif</option>
                    <option value="N" <?php if ($user->block == 'N') {
                                            echo "selected";
                                        } ?>>Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->