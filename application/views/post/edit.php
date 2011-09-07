<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-post-management.png') top left no-repeat;"></div>

<div id="admin-wrap">
<div id="create-post">
    <h1>Edit Post</h1>
    <?php if (validation_errors() != FALSE) { ?>
    <div id="validation-errors">
        <?=validation_errors();?>
    </div>
    <?php } ?>
    <?php if (isset($success)) { ?>
    <div id="edit-success">
        Post has been updated!
    </div>
    <?php } ?>
    <?=form_open_multipart('admin/post/edit/'.$post->id);?>
    <input type="hidden" name="post_id" value="<?=$post->id?>" />
    <div class="form-item input">
        <label>Post Title</label><input type="text" name="post_title" id="post_title" value="<?=$post_title = set_value('post_title') != NULL ? set_value('post_title') : $post->post_title; ?>" />
    </div>
    <div class="form-item select">
        <label>Select Category</label>
        <select name="category">
            <?php foreach ($categories as $category): ?>
            <option value="<?=$category->id?>" <?=$display_cat = $post->category_id == $category->id ? 'selected' : null;?>><?=$category->category_display?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-item textarea postcontent">
        <label>Post Content</label>
        <textarea name="post_content" id="post_content" cols="6" rows="6"><?=$post_content = set_value('post_content') != NULL ? set_value('post_content') : $post->post_content;?></textarea>
    </div>
    <div class="form-item input">
        <label>Post Excerpt</label>
        <input type="text" name="post_excerpt" id="post_excerpt" value="<?=$post_excerpt = set_value('post_excerpt') != NULL ? set_value('post_excerpt') : $post->post_excerpt; ?>" />
    </div>
    <div class="form-item input">
        <label>SEO Description</label>
        <input type="text" name="seo_description" id="seo_description" value="<?=$seo_description = set_value('seo_desription') != NULL ? set_value('seo_description') : $post->seo_description; ?>" />
    </div>
    <div class="form-item input">
        <label>Image (640x250)</label>
        <div id="image-upload">
        <?php if (post_image($post->id,"small",true)) { ?>
        <div class="image"><?=post_image($post->id)?></div>
        <?php } ?>
        <input type="file" name="post_image" id="post_image" />
        </div>
    </div>
    <div class="form-item input">
        <label>Featured Image (1000x253)</label>
		<div id="image-upload">
		<?php if (post_image($post->id,"very_large",true)) { ?>
			<?=anchor(base_url().'assets/upload/images/posts/article-'.$post->id.'-1000x253.jpg','View Image','target="_blank"')?>
		<?php } ?>
        <input type="file" name="large_image" id="large_image" />
		</div>
    </div>
    <div class="form-item input">
        <label>Tags (Comma Separated)</label>
        <input type="text" name="keywords" id="keywords" value="<?=$keywords = set_value('keywords') ? set_value('keywords') : $post->keywords; ?>" />
    </div>
    <div class="form-item select">
        <label>Featured</label>
        <select name="featured" id="featured">
            <option value="0" <?=$selected = $post->featured == 0 ? 'selected' : ''?>>No</option>
            <option value="1" <?=$selected = $post->featured == 1 ? 'selected' : ''?>>Yes</option>
        </select>
    </div>
    <div class="form-item select">
        <label>Published</label>
        <select name="published" id="published">
            <option value="0" <?=$selected = $post->published == 0 ? 'selected' : ''?>>No</option>
            <option value="1" <?=$selected = $post->published == 1 ? 'selected' : ''?>>Yes</option>
        </select>
    </div>
    <div class="form-submit">
        <input type="submit" name="submit" value="Edit Post" />
    </div>
    </form>
</div>
</div>