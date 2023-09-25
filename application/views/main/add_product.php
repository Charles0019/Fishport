<?= $this->session->flashdata('add_user_submit'); ?>
<?= $this->session->flashdata('add_user_error'); ?>
<style>
    .card {
        width: 95%; /* Adjust the width as needed */
        margin: 0 auto; /* Center the card on the page horizontally */
    }

    .row {
        margin-top: 3px;
        margin-left: 20px;
    }

    body {
        overflow-x: hidden; /* Hide horizontal scrollbar */
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('inventory/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <?php echo form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this product?\')')); ?>
        <div class="form-group">
            <label>Product Code</label>
          			<input type="text" name="product_code" value="<?=$product_code?>" class="form-control form-control-sm text" readonly>
        </div>
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" placeholder="Product Name" name="product_name"
                value="<?php echo set_value('product_name'); ?>"
                class="form-control <?php echo form_error('product_name') ? 'is-invalid' : ''; ?>">
            <span style="color: red;"><?php echo form_error('product_name'); ?></span>
        </div>
        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="product_image" value="<?php echo set_value('product_image'); ?>"
                class="form-control <?php echo form_error('product_image') ? 'is-invalid' : ''; ?>">
            <span style="color: red;"><?php echo form_error('product_image'); ?></span>
        </div>
        <!-- Add the other form fields in a similar manner -->
        <div>
            <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Clear</button>
            <a class="btn btn-secondary btn-sm" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>
        </div>
        </form>
    </div>
</div>
