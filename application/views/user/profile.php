<div id="user-profile">
	<?php if ($this->session->flashdata('password_change') == TRUE) { ?>
		<div class="edit-success">
			Password successfully changed.
		</div>
	<?php } ?>
	<div class="profile-header">
		<?php if (user_avatar($user->id,true)) { ?>
			<div class="user-avatar" style="background: url(<?=base_url()?>assets/upload/images/avatars/avatar-<?=$user->id?>.jpg) no-repeat top left;"></div>
		<?php } ?>
		<div class="profile-userinfo">
    		<h1 class="display_name"><?=$user->display_name?></h1>
			<h2>Member Since <?=date('F jS, Y @ g:i a',$user->created);?></h2>
		</div>
	</div>
	<div class="profile-content">
        
        <div id="profile-sections">
             <ul class="tabs">
                <li><a href="#" rel="activity">Latest Activity</a></li>
                <li><a href="#" rel="stats">Stats</a></li>
				<?php if ($this->session->userdata('id') == $user->id) { ?>
                    <li><?=anchor('profile/avatar','Change Avatar')?></li>
					<li><?=anchor('profile/password','Change Password')?></li>
                <?php } ?>
             </ul>
        </div>

        <div>
         	<div id="activity" class="tabcontent">
                <ul id="activity-list">
                    <?php foreach ($comments as $comment): ?>
                	<li>
                        <div class="image">
                            <?php if(user_avatar($comment->user_id,true)):  ?>
                                <?=anchor('profile/'.$comment->display_name,'<img src="'.base_url().'assets/upload/images/avatars/avatar-'.$comment->user_id.'.jpg" alt="'.$comment->display_name.'">');?>
                            <?php else: ?>
                                <?=anchor('profile/'.$comment->display_name,'<img src="'.base_url().'assets/images/profile-pic-default.jpg" alt="'.$comment->display_name.'" />');?>
                            <?php endif; ?>
                        </div>
                        <div class="details">
                            <div class="title"><?=anchor('/profile/'.$user->username, $user->display_name)?> commented on <?=anchor($comment->category_name.'/'.$comment->post_seo, $comment->post_title)?></div>
                            <div class="text">"<?=nl2br($comment->content)?>"</div>
                            <div class="meta">Written on <?=date('F jS, Y @ g:i a',$comment->posted_on);?></div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>                    
            </div>
			<div id="comments" class="tabcontent">
                <div class="profile-comments">
                    <?php foreach ($comments as $comment): ?>
                        <div class="single-comment">
                            <div class="post-content">
                                <p class="post-title"><?=$comment->post_title?></p>
                                <p class="comment-content"><?=$comment->content?></p>
                                <p class="post-meta">View Comment - Posted on <?=date('F jS, Y @ g:i a',$comment->posted_on);?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>            
            </div>
			<div id="stats" class="tabcontent">
            	<ul>
                	<li>Total Comments: 0</li>
                    <li>Profile Viewed: 0</li>
                </ul>
            </div>

            <script type="text/javascript">

                var pages=new tabcontent("profile-sections")
                pages.setpersist(true)
                pages.setselectedClassTarget("link") //"link" or "linkparent"
                pages.init()

            </script>
         </div>

        
	</div>
</div>