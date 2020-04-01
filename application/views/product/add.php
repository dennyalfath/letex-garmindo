<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <?php echo $this->session->flashdata('message') ?>
        <form action="<?php echo base_url('product/store') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pr_name">Product Name:</label>
                <input type="text" class="form-control" name="pr_name" required>
            </div>
            <div class="form-group">
                <label for="client">Client:</label>
                <select name="pr_client" class="form-control" required>
                    <option value="">-- Choose Client --</option>
                    <?php foreach ($client as $c) : ?>
                        <option value="<?php echo $c->client_id ?>"><?php echo $c->client_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="pr_category" class="form-control" required>
                    <option value="">-- Choose Category --</option>
                    <?php foreach ($category as $cat) : ?>
                        <option value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="style">Style:</label>
                <input type="text" class="form-control" name="style">
            </div>
            <div class="form-group">
                <label for="sell_price">Sell Price:</label><br>
                <input type="text" class="form-control" name="sell_price" required>
            </div>
            <div class="form-group">
                <label for="desc">Description:</label><br>
                <input type="text" class="form-control" name="desc">
            </div>
            <div class="form-group">
                <label for="pr_image">Image:</label><br>
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