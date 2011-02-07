<div id="single-post">
    <div class="post-header">
        <h1><?=$post->post_title?></h1>
        <h2>Posted by <?=anchor('profile/'.$post->display_name,$post->display_name);?> in <?=anchor($post->category_name,$post->category_display)?> | Posted on <?=date('F jS, Y @ g:i a',$post->posted_on);?></h2>
    </div>
    <div class="post-content">
        <?=$post->post_content?>
    </div>
</div>
<?php if ($post->allow_comments == 1) { ?>
<div id="comments">
    <div id="comment-form">
        <div id="validation-errors">
            <?=validation_errors();?>
        </div>
        <form method="post" action="<?=$_SERVER['REQUEST_URI']?>">
            <input type="hidden" name="post_id" value="<?=$post->id?>" />
        <div class="form-item">
            <textarea name="comment-text" id="comment-text" cols="6" rows="6"></textarea>
        </div>
        <div class="form-submit">
            <input type="submit" name="submit" id="submit" value="Post Comment" />
        </div>
        </form>
    </div>
    <div id="comment-container">
        <?php foreach ($comments as $comment): ?>
        <div id="comment-<?=$comment->id?>" class="comment">
            <div class="comment-author">
                <?=anchor('profile/'.$comment->display_name,$comment->display_name);?>
            </div>
            <div class="comment-content">
                <?=$comment->content?>
            </div>
            <div class="comment-meta">
                Posted on <?=date('F jS, Y @ g:i a',$comment->posted_on);?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php } ?>