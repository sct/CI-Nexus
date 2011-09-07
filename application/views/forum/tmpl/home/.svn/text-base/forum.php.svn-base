<div class="forum-item">
    <div class="forum-details">
		<div class="forum-title"><?=anchor('forum/'.$forum->uri_name,$forum->name);?></div>
    	<div class="forum-description"><?=$description = $forum->description != "" ? $forum->description : null; ?></div>
    </div>
    <div class="forum-latest-post">
    	<? if (isset($latest_post->posted_on)) { ?>
            <strong><?=anchor('forum/thread/'.$latest_post->uri_title,$latest_post->title);?></strong><br />
            by <?=anchor('profile/'.$latest_post->display_name,$latest_post->display_name)?> on <?=date('F jS, Y @ g:i a',$latest_post->posted_on);?>
        <? }else{ ?>
        	No posts have been made.
        <? } ?>
    </div>
    <div class="forum-count-threads"><?=$forum->thread_count?></div>
    <div class="forum-count-posts"><?=$forum->post_count?></div>
</div>