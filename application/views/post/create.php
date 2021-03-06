<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-create-post.png') top left no-repeat;"></div>

<div id="admin-wrap">
<div id="create-post">
    <?php if (validation_errors() != FALSE) { ?>
    <div id="validation-errors">
        <?=validation_errors();?>
    </div>
    <?php } ?>
    <?=form_open_multipart('post/create');?>
    <div class="form-item input">
        <label>Post Title</label><input type="text" name="post_title" id="post_title" value="<?php echo set_value('post_title'); ?>" />
    </div>
    <div class="form-item select">
        <label>Select Category</label>
        <select name="category">
            <?php foreach ($categories as $category): ?>
            <option value="<?=$category->id?>"><?=$category->category_display?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-item textarea postcontent">
        <label>Post Content</label>
        <textarea name="post_content" id="post_content" cols="6" rows="6"><?php echo set_value('post_content'); ?></textarea>
    </div>
    <div class="form-item input">
        <label>Post Excerpt</label>
        <input type="text" name="post_excerpt" id="post_excerpt" value="<?php echo set_value('post_excerpt'); ?>" />
    </div>
    <div class="form-item input">
        <label>SEO Description</label>
        <input type="text" name="seo_description" id="seo_description" value="<?php echo set_value('seo_description'); ?>" />
    </div>
    <div class="form-item input">
        <label>Image (640x250)</label>
        <input type="file" name="post_image" id="post_image" />
    </div>
    <div class="form-item input">
        <label>Featured Image (1000x253)</label>
        <input type="file" name="large_image" id="large_image" />
    </div>
    <div class="form-item input">
        <label>Tags (Comma Separated)</label>
        <input type="text" name="keywords" id="keywords" value="<?php echo set_value('keywords'); ?>" />
    </div>
    <div class="form-item select">
        <label>Featured</label>
        <select name="featured" id="featured">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <div class="form-item select">
        <label>Published</label>
        <select name="published" id="published">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <div class="form-submit">
        <input type="submit" name="submit" value="Create Post" />
    </div>
    </form>
</div>
</div>