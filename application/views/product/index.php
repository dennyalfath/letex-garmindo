<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Client</th>
                    <th>Kategori</th>
                    <th>Style</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($product as $pr) : ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $pr->pr_name ?></td>
                            <td><?php echo $pr->client_name ?></td>
                            <td><?php echo $pr->cat_name ?></td>
                            <td><?php echo $pr->style ?></td>
                            <td><?php echo $pr->sell_price ?></td>
                            <td>
                                <a href="<?php echo base_url('company/edit/' . $pr->company_id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?php echo base_url('company/destroy/' . $pr->company_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?');">Hapus</a>
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