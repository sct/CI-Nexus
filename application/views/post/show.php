<div id="single-post">
    <div class="post-header">
        <h1><?=$post->post_title?></h1>
        <h2>Posted by <?=anchor('profile/'.$post->display_name,$post->display_name);?> in <?=anchor($post->category_name,$post->category_display)?> | Posted on <?=date('F jS, Y @ g:i a',$post->posted_on);?></h2>
    </div>
    <div class="post-content">
        <?=$post->post_content?>
    </div>
</div>