<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-change-avatar.png') top left no-repeat;"></div>

<div id="upload-avatar">
	<h3>Step 1 of 2: Upload Your Avatar</h3>
    <p>To change your avatar, you will need to first upload an image from your computer. Once you have selected the image to use as your avatar, click the "Upload" button below.</p>
	<?=form_open_multipart('profile/avatar');?>
	<div class="form-item">
		<input type="file" name="avatar" id="avatar" />
	</div>
	<div class="form-submit">
		<input type="submit" name="submit" value="Upload">
	</div>
</div>