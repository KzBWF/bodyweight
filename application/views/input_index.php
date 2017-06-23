<?php echo validation_errors(); ?>

<br>date</br>
<?php echo $nowtime; ?>
<br>
<?php echo form_open(''); ?>

	<h5>BodyWeight</h5>
	<input type="text" name="body_weight" value="" />
	<h5>BodyFatPercentage</h5>
	<input type="text" name="body_fat_per" value="" />
	</br>
	</br>
	<input type="submit" name="submit" value="Input" />

</form>

<a href="/mytools/bodyweight/topmenu">Return TopMenu</a>


