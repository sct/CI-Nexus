<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-post-management.png') top left no-repeat;"></div>

<div id="admin-wrap">
<div id="admin-post-list">
    <?php if (isset($created)) { ?>
    <div id="edit-success">Post Created!</div>
    <?php } ?>
    <?php if (isset($deleted)) { ?>
    <div id="validation-errors"><p>Post Deleted!</p></div>
    <?php } ?>
    <ul>
        <li class="post-list-header">
            <div class="list-date">Date</div>
            <div class="list-title">Title</div>
            <div class="list-category">Category</div>
            <div class="list-comments">Com.</div>
            <div class="list-icons"></div>
        </li>
    <?php foreach ($posts as $post): ?>
        <li>
            <div class="list-date"><?=date('m/d/y',$post->posted_on)?></div>
            <div class="list-title"><?=anchor('admin/post/edit/'.$post->id, $post->post_title);?></div>
            <div class="list-category"><?=$post->category_display?></div>
            <div class="list-comments"><?=$post->comment_count?></div>
            <div class="list-icons">
                <!-- TODO: Change these to icons! -->
                <?=anchor('admin/post/delete/'.$post->id,'D');?>
                <?=anchor($post->category_name.'/'.$post->post_seo,'V');?>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
</div>