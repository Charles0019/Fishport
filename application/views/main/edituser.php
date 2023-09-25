<?= $this->session->flashdata('add_user_submit'); ?>
<?= $this->session->flashdata('add_user_error'); ?>
<div class="row justify-content-center">
	<div class="col-md-8">
					<?php echo form_open_multipart('', array('onsubmit'=>'return confirm(\'Are you sure you want to update this user?\')')); ?>
					<div class="form-group">
						<label>Username</label>
						<input type="text"  name="username" class="form-control form-control-sm <?php echo form_error('username') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('username' , $user->username); ?>" >
						<?php echo form_error('username'); ?>
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text"  name="first_name" class="form-control form-control-sm <?php echo form_error('first_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('first_name' , $user->first_name); ?>" >
						<?php echo form_error('first_name'); ?>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text"  name="last_name" class="form-control form-control-sm <?php echo form_error('last_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('last_name' , $user->last_name); ?>" >
						<?php echo form_error('last_name'); ?>
					</div>
					<div class="form-group">
						<label>Password</label>
						<div class="input-group">
							<input type="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" class="form-control form-control-sm <?php echo form_error('password') ? 'is-invalid' : ''; ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<div class="input-group">
							<input type="password" placeholder="Confirm Password" name="password1" class="form-control form-control-sm <?php echo form_error('password1') ? 'is-invalid' : ''; ?>">
						</div>
						<span style="color: red;"><?php echo form_error('password1'); ?></span>
					</div>
					<div class="form-group">
						<label>Roles</label>
						<select name="role" class="form-control form-control-sm <?php echo form_error('role') ? 'is-invalid' : ''; ?>" id="role-select">
							<option class="text-info invisible" value="<?= $user->role ?>"><?= ucfirst($user->role) ?></option>
							<option value="encoder">Encoder</option>
							<option value="cashier">Cashier</option>
							<option value="auditor">Auditor</option>
						</select>
						<?php echo form_error('role'); ?>
					</div>
					<input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
					<!-- Add the other form fields in a similar manner -->
					<div>
						<button type="submit"  name="submit" class="btn btn-primary btn-sm" class="form-submit"><i class="fas fa-save"></i> Submit</button>
						<a class="btn btn-secondary btn-sm" href="<?=base_url('main/user')?>"><i class="fas fa-reply"></i> back</a>
					</div>
				</div>
			</div>
		</form>