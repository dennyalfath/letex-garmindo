<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('company/store') ?>" method="POST">
            <div class="form-group">
                <label for="pr_name">Nama Produk:</label>
                <input type="text" class="form-control" name="pr_name">
            </div>
            <div class="form-group">
                <label for="client">Client:</label>
                <input type="text" class="form-control" name="client">
            </div>
            <div class="form-group">
                <label for="category">Kategori:</label>
                <input type="text" class="form-control" name="category">
            </div>
            <div class="form-group">
                <label for="style">Style:</label>
                <input type="text" class="form-control" name="style">
            </div>
            <div class="form-group">
                <label for="sellprice">Harga Jual:</label><br>
                <input type="text" class="form-control" name="sellprice">
            </div>
            <div class="form-group">
                <label for="desc">Deskripsi:</label><br>
                <input type="text" class="form-control" name="desc">
            </div>
            <div class="form-group">
                <label for="pr_image">Gambar:</label><br>
                <input type="file" name="pr_image" size="20">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Save</button>
            </div>
        </form>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->