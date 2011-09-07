<div class="forum-thread">
    <div class="thread-details">
		<div class="thread-title"><?=anchor('forum/thread/'.$thread->uri_title,$thread->title)?></div>
    	<div class="thread-creator">By <?=anchor('profile/'.$thread->display_name,$thread->display_name);?></div>
    </div>
    <div class="thread-latest-reply">
        <?=date('F jS, Y @ g:i a',$thread->lp_posted_on);?><br />
        by <?=anchor('profile/'.$thread->lu_display_name,$thread->lu_display_name);?>
    </div>
    <div class="thread-count-replies"><?=$thread->total_posts-1?></div>
</div>