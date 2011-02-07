<div id="create-post">
    <div id="validation-errors">
        <?=validation_errors();?>
    </div>
    <?=form_open_multipart('post/create');?>
    <div class="form-item">
        <label>Post Title</label><input type="text" name="post_title" id="post_title" value="<?php echo set_value('post_title'); ?>" />
    </div>
    <div class="form-item">
        <label>Select Category</label>
        <select name="category">
            <?php foreach ($categories as $category): ?>
            <option value="<?=$category->id?>"><?=$category->category_display?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-item">
        <label>Post Content</label>
        <textarea name="post_content" id="post_content" cols="6" rows="6"><?php echo set_value('post_content'); ?></textarea>
    </div>
    <div class="form-item">
        <label>Post Excerpt</label>
        <input type="text" name="post_excerpt" id="post_excerpt" value="<?php echo set_value('post_excerpt'); ?>" />
    </div>
    <div class="form-item">
        <label>SEO Description</label>
        <input type="text" name="seo_description" id="seo_description" value="<?php echo set_value('seo_description'); ?>" />
    </div>
    <div class="form-item">
        <label>Image (Dimensions: 640x250)</label>
        <input type="file" name="post_image" id="post_image" />
    </div>
    <div class="form-item">
        <label>Tags (Comma Separated)</label>
        <input type="text" name="keywords" id="keywords" value="<?php echo set_value('keywords'); ?>" />
    </div>
    <div class="form-item">
        <label>Featured</label>
        <select name="featured">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <div class="form-item">
        <label>Published</label>
        <select name="published">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <div class="form-submit">
        <input type="submit" name="submit" value="Submit" />
    </div>
    </form>
</div>