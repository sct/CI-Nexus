<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-crop-avatar.png') top left no-repeat;"></div>

<div id="edit-profile">
	<div class="crop-description">
		<h3>Step 2 of 2: Crop Your Avatar</h3>
        <p>There's just one last step before you are done. Using your mouse, click and drag a square on the large image below to crop the selection of the image you'd like to use as your avatar. When you are satisfied with the results, click the "Continue" button to save your changes.</p>
	</div>
	<?=form_open('profile/avatar/save')?>
    <div class="form-item" style="padding-bottom: 10px; float: left;">
        <div class="avatar-container">
            <img src="<?=base_url()?><?=$uploaded_image?>" id="photoselect" style="float: left; margin-right 20px;"/>
            <div style="float: left; position:relative; overflow:hidden; width:100px; height:100px;margin-left: 10px">
                <img src="<?=base_url()?><?=$uploaded_image?>" style="position: relative;" alt="Thumbnail Preview" />
            </div>
    	</div>
	</div>
	<input type="hidden" name="user_id" value="<?=$user_id?>">
	<input type="hidden" name="source_image" value="<?=$uploaded_image?>" />
	<input type="hidden" name="extension" value="<?=$extension?>">
	<input type="hidden" name="x1" value="" id="x1" />
	<input type="hidden" name="y1" value="" id="y1" />
	<input type="hidden" name="x2" value="" id="x2" />
	<input type="hidden" name="y2" value="" id="y2" />
	<input type="hidden" name="w" value="" id="w" />
	<input type="hidden" name="h" value="" id="h" />
	<div class="form-submit">
		<input type="submit" class="button" name="upload_avatar" value="Crop Avatar" id="save_avatar">
	</div>
</div>