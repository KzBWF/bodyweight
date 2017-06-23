<?php echo validation_errors(); ?>

<br>

<?php
foreach($body_data as $data) {
	echo form_open('');
	echo "date:".$data->entry_date."</br>";
	echo "<input type=\"text\" name=\"body_weight\" value=\"".$data->body_weight."\" /></br>";
	echo "<input type=\"text\" name=\"body_fat_per\" value=\"".$data->body_fat_per."\" /></br>";
	echo "<input type=\"hidden\" name=\"entry_date\" value=\"".$data->entry_date."\" />";
	echo "<input type=\"submit\" name=\"submit\" value=\"Modify\" />";
	echo "   delete:";
	echo "<input type=\"radio\" name=\"delete\" value=\"1\" />";
	echo "</br>";
	echo "<HR size=\"5\">";
	echo "</form>";
}
?>


<a href="/mytools/bodyweight/topmenu">Return TopMenu</a>


