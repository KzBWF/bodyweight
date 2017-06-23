<?php echo validation_errors(); ?>

<?php echo form_open(''); ?>
	<br>Name</br>
	<input type="text" name="name" value="<?php echo $name; ?>" />
	<br>Age</br>
	<input type="text" name="age" value="<?php echo $age; ?>" />
	<br>Gender</br>
	<input type="radio" name="gender" value="0" <?php if($gender==0){ echo "checked"; } ?> />Man 
	<input type="radio" name="gender" value="1" <?php if($gender==1){ echo "checked"; } ?> />Woman 
	<br>Height</br>
	<input type="text" name="height" value="<?php echo $height; ?>" />
	<br>
	<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
	<br>
	<input type="submit" name="submit" value="<?php echo $btntext; ?>" />
</form>

<a href="/mytools/bodyweight/topmenu">Return TopMenu</a>

