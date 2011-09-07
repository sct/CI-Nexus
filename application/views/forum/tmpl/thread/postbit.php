<div id="post-<?=$post->id?>" class="forum-post">
    <div class="user-postbit">
        <div class="username">
            <?=anchor("profile/".$post->display_name,$post->display_name)?>
        </div>
        <?php if (user_avatar($post->user_id,TRUE)): ?>
        <div class="user-avatar">
            <?=user_avatar($post->user_id);?>
        </div>
        <?php endif; ?>
        <div class="user-meta">
        	<ul>
            	<li><span class="field">Total Posts: </span><span class="value"><?=$post->post_count?></span></li>
            </ul>
        </div>
    </div>
    <div class="user-post">
        <div class="user-post-meta">
            <span style="float: right">&nbsp;<?php if ($this->session->userdata('admin') == 1 || $this->session->userdata('id') == $post->user_id) { ?> [<?=anchor('forum/edit/'.$post->id,'edit')?>]<?php } if ($this->session->userdata('admin') == 1) { ?> [<?=anchor('forum/delete/'.$post->id,'delete')?>] <?php } ?></span>Posted on <?=date('F jS, Y @ g:i a',$post->posted_on);?>
        </div>
        <div class="user-content">
            <?=$post->content?>
        </div>
        <div class="user-signature">
            <?=$post->signature?>
        </div>
    </div>
</div>