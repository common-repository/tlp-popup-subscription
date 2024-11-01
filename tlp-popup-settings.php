<?php
$msg = null;
if(@$_REQUEST['submit']){
	$value = array(
			'tlp_popup_code' => htmlspecialchars(@$_REQUEST['tlp_popup_code'], ENT_QUOTES),
			'tlp_popup_enable' => esc_attr( @$_REQUEST['tlp_popup_enable'] ),
			'tlp_popup_load_time' => esc_attr( (int)@$_REQUEST['tlp_popup_load_time'] ),
			'tlp_popup_session_time' => esc_attr( (int)@$_REQUEST['tlp_popup_session_time'] ),
			'tlp_popup_height' => esc_attr( (int)@$_REQUEST['tlp_popup_height'] ),
			'tlp_popup_width' => esc_attr( (int)@$_REQUEST['tlp_popup_width'] ),
			'tlp_popup_location' => esc_attr( @$_REQUEST['tlp_popup_location'] ),
		);
	update_option( 'tlp_popup_subscription', $value);
}
$data = get_option('tlp_popup_subscription');
$e = (@$data['tlp_popup_enable'] ? @$data['tlp_popup_enable'] : null);
$c = (@$data['tlp_popup_code'] ? @$data['tlp_popup_code'] : null);
$ltime = (@$data['tlp_popup_load_time'] ? (int)@$data['tlp_popup_load_time'] : 5);
$stime = (@$data['tlp_popup_session_time'] ? (int)@$data['tlp_popup_session_time'] : 24);
$ph = (@$data['tlp_popup_height'] ? (int)@$data['tlp_popup_height'] : 50);
$pw = (@$data['tlp_popup_width'] ? (int)@$data['tlp_popup_width'] : 70);
$location = (@$data['tlp_popup_location'] ? @$data['tlp_popup_location'] : 'front');
$tlp_popup_code = stripslashes($c);
?>
<div class="wrap">

	<div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
	<h2>TLP Popup Settings</h2>
	<?php if($msg): ?>
	<div class='update'><?php $msg; ?></div>
	<?php endif; ?>

	<form id="tlp-popup-settings" method="POST" accept="">

		<h3>General settings</h3>

		<table class="form-table">

			<tr>
				<th scope="row"><label for="tlp_popup_enable">Enable pop up</label></th>
				<td>
					<input type="checkbox" <?php echo ($e ? "checked" : null); ?> name="tlp_popup_enable" id="tlp_popup_enable" value="1">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="tlp_popup_all">All page and post</label></th>
				<td>
					<label for="front_page">
					    <input <?php echo ($location == 'front' ? "checked" : null); ?>  type="radio" id="front_page" name="tlp_popup_location" value="front">Only front page
					</label><br />
					<label for="page_post">
						<input  <?php echo ($location == 'all' ? "checked" : null); ?> type="radio" id="page_post" name="tlp_popup_location" value="all">All Page and Post
					</label>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="tlp_popup_load_time">Popup load time(Seconds)</label></th>
				<td>
					<input type="number" size="2" value="<?php echo $ltime; ?>" name="tlp_popup_load_time" id="tlp_popup_load_time"> Sec.
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="tlp_popup_session_time">Session Time (Hours)</label></th>
				<td>
					<input size="4" type="number" value="<?php echo $stime; ?>" name="tlp_popup_session_time" id="tlp_popup_session_time"> Hours
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="tlp_popup_width">Popup With</label></th>
				<td>
					<select name="tlp_popup_width">
					<option value="">Select one</option>
						<?php
							for ($i=1; $i <= 100 ; $i++) {
								$slt = ($pw == $i ? "selected" : null);
								echo "<option value='$i' $slt>$i</option>";
							}
						?>
					</select> %
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="tlp_popup_height">Popup Height</label></th>
				<td>
					<select name="tlp_popup_height">
						<option value="">Select one</option>
						<?php
							for ($i=1; $i <= 100 ; $i++) {
								$slt = ($ph == $i ? "selected" : null);
								echo "<option value='$i' $slt>$i</option>";							}
						?>
					</select> %
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="tlp_popup_code">HTML code for pop up</label></th>
				<td>
					<textarea rows="15" cols="80" name="tlp_popup_code" id="tlp_popup_code"><?php echo (@$tlp_popup_code ? @$tlp_popup_code : null); ?></textarea>
				</td>
			</tr>

		</table>
		<p class="submit"><input type="submit" name="submit" class="button button-primary" value="Save Changes"></p>

		<?php wp_nonce_field( 'tlp_popup_sub_nonce', 'tlp_nonce' ); ?>
	</form>

</div>
