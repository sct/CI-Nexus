<div id="edit-profile">
	<h1>Change Password</h1>
	<div class="edit-password">
		<?=form_open('profile/password')?>
		<div class="form-validation">
			<?=validation_errors()?>
		</div>
		<div class="form-item">
			<label for="current_password">Current Password</label> <input type="password" name="current_password" id="current_password" />
		</div>
		<div class="form-item">
			<label for="new_password">New Password</label> <input type="password" name="new_password" id="new_password" />
		</div>
		<div class="form-item">
			<label for="conf_password">Re-Enter Password</label> <input type="password" name="conf_password" id="conf_password" />
		</div>
		<div class="form-submit">
			<input type="submit" name="submit" value="Change Password" />
		</div>
		</form>
	</div>
</div>