<div id="post-list">
    <?php foreach ($posts as $post): ?>
    <div class="post">
        <?php if (file_exists($this->config->item('upload_path').'images/posts/article-'.$post->id.'-310x121.jpg')) { ?>
        <div class="image"><img src="<?=base_url()?>assets/upload/images/posts/article-<?=$post->id?>-310x121.jpg" /></div>
        <?php } ?>
        <span class="author"><?=anchor('profile/'.$post->display_name,$post->display_name)?></span>
        <span class="category-name"><?=anchor($post->category_name,$post->category_display)?></span>
        <span class="title"><?=anchor($post->category_name.'/'.$post->post_seo,$post->post_title);?></span>
        <span class="posted-date">Posted on <?=date('F jS, Y @ g:i a',$post->posted_on);?></span>
    </div>
    <?php endforeach; ?>
</div>
<?php if ($this->session->userdata('admin') == 1) { ?>
<div class="admin-options">
    <?=anchor('post/create','Create Post');?>
</div>
<?php } ?>