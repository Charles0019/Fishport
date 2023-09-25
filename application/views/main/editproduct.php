<?= $this->session->flashdata('add_user_submit'); ?>
<?= $this->session->flashdata('add_user_error'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
		<?php echo form_open_multipart('', array('onsubmit'=>'return confirm(\'Are you sure you want to update this product?\')')); ?>
		<div class="form-group">
			<label>Product Code</label>
			<input type="text"  name="product_code" class="form-control form-control-sm <?php echo form_error('product_code') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_code' , $product->product_code); ?>" readonly>
		</div>
		<div class="form-group">
			<label>Product Name</label>
			<input type="text"  name="product_name" class="form-control form-control-sm <?php echo form_error('product_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_name' , $product->product_name); ?>" >
			<?php echo form_error('product_name'); ?>
		</div>
		<div class="form-group">
			<label>Product Name</label>
			<input type="file"  name="product_image" class="form-control form-control-sm <?php echo form_error('product_image') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_image' , $product->product_image); ?>" >
			<?php echo form_error('product_image'); ?>
		</div>
		<input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
		<!-- Add the other form fields in a similar manner -->
		<div>
			<button type="submit"  name="submit" class="btn btn-primary btn-sm" class="form-submit"><i class="fas fa-save"></i> Submit</button>
			<a class="btn btn-secondary btn-sm" href="<?=base_url('main/product')?>"><i class="fas fa-reply"></i> back</a>
		</div>
	</div>
</div>
</form>