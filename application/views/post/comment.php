<div id="comment-<?=$comment->id?>" class="comment comment-level-<?=$lvl?>">
    <div class="right">
        <?php if ($this->session->userdata('admin') != FALSE || $this->session->userdata('id') == $comment->user_id) { ?>
        <div class="inline-comment" style="float: right">[<?=anchor('post/delete-comment/'.$comment->id,'delete');?>]</div>
        <?php } ?>
        <div class="comment-author">                    
            <?=anchor('profile/'.$comment->display_name,'<span class="c-username" rel="'.$comment->id.'">'.$comment->display_name.'</span>');?>                    
        </div>                    
        <div class="comment-content">                    
            <?=nl2br($comment->content)?>                    
        </div>                    
        <div class="comment-meta">                    
            <?php if ($this->session->userdata('username') != FALSE && $lvl < 3) { ?><div style="float: right;"><a href="#comments" rel="<?=$comment->id?>" class="reply-to">Reply</a></div><?php } ?>Posted on <?=date('F jS, Y @ g:i a',$comment->posted_on);?>                    
        </div>  
	</div>   
	<div class="left">
		<?php if ($comment_arrow != "") { ?>
            <div class="comment-arrow"></div>
        <?php } ?>
    	<?php if(user_avatar($comment->user_id,true)):  ?>
       		<?=anchor('profile/'.$comment->display_name,'<img src="'.base_url().'assets/upload/images/avatars/avatar-'.$comment->user_id.'.jpg" alt="'.$comment->display_name.'">');?>
        <?php else: ?>
       		<?=anchor('profile/'.$comment->display_name,'<img src="'.base_url().'assets/images/profile-pic-default.jpg" alt="'.$comment->display_name.'" />');?>
        <?php endif; ?>
    </div>              
</div>