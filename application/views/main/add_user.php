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
				<h1 class="m-0 text-dark">Add User</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url('inventory/dashboard')?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Users</li>
					</ol>
					</div><!-- /.col -->
					</div><!-- /.row -->
					<?php echo form_open_multipart('', array('onsubmit'=>'return confirm(\'Are you sure you want to add this user?\')')); ?>
					<div class="form-group">
						<label>Username</label>
						<input type="text" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>" class="form-control <?php echo form_error('username') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?php echo form_error('username'); ?></span>
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" placeholder="First Name" name="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control <?php echo form_error('first_name') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?php echo form_error('first_name'); ?></span>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" placeholder="Last Name" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control <?php echo form_error('last_name') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?php echo form_error('last_name'); ?></span>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="text" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?php echo form_error('password'); ?></span>
					</div>
					<div class="form-group">
						<label>Roles</label>
						<select class="form-select" name="role" id="role" aria-label="Default select example">
							<option selected hidden>Select Role</option>
							<option value="encoder">Encoder</option>
							<option value="cashier">Cashier</option>
							<option value="auditor">Auditor</option>
						</select>
						<span style="color: red;"><?php echo form_error('role'); ?></span>
					</div>
					<!-- Add the other form fields in a similar manner -->
					<div>
						<button type="submit"  name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
						<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Clear</button>
						<a class="btn btn-secondary btn-sm" href="<?=base_url('main/user')?>"><i class="fas fa-reply"></i> Back</a>
					</div>
				</div>
			</div>
		</form>