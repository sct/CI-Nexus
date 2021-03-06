                
                	<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-dcuo-<?=url_title($post->category_display, 'dash', TRUE)?>.png') top left no-repeat;"></div>
                    
                    <div id="single-post">
                    
                        <div class="post-header">                    
                            <h1><?=$post->post_title?></h1>                    
                            <div class="details">Posted by <?=anchor('profile/'.$post->display_name,$post->display_name);?> in <?=anchor($post->category_name,$post->category_display)?> | Posted on <?=date('F jS, Y @ g:i a',$post->posted_on);?> <?php if ($this->session->userdata('admin') != FALSE) { ?><span class="inline-post">[<?=anchor('admin/post/edit/'.$post->id,'edit')?>]</span><?php } ?></div>
                        </div>
                    
                        <div class="post-content">                    
                            <?=$post->post_content?>                    
                        </div>
                    
                    </div>
                    
                    <?php if (!empty($related)): ?>
                    
                    <div class="content-heading content-heading-replacer" style="background: url('/assets/images/title-left-related-stories.png') top left no-repeat;"></div>
                    
                    <div id="related-posts">
                        <ul>                                      
						<?php foreach ($related as $related_post): ?>
                            <li><?=anchor($related_post->category_name.'/'.$related_post->post_seo,$related_post->post_title);?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($post->allow_comments == 1) { ?>
                    
                    <div class="content-heading content-heading-replacer" style="background: url('/assets/images/title-left-the-comments.png') top left no-repeat;"></div>
                    
                    <div id="comments">                    
                        
                        <?php if ($this->session->userdata('username') != FALSE) { ?>
                        <div id="comment-form">
                            <?php if (validation_errors() != "") { ?>
                            <div id="validation-errors">                    
                                <?=validation_errors();?>                    
                            </div>
                            <?php } ?>
                            <form method="post" action="<?=$_SERVER['REQUEST_URI']?>">                    
                                <input type="hidden" name="post_id" value="<?=$post->id?>" />
                                <input type="hidden" name="parent_id" id="parent-id" value="0" />
                                <div class="replying-to" style="display: none">.</div>            
                            	<div class="form-item">
                                	<textarea name="comment-text" id="comment-text" cols="6" rows="6"></textarea>
                                </div>                   
                            	<div class="form-submit">                    
                                	<input type="submit" name="submit" id="submit" value="Post Comment" />
                                </div>                    
                            </form>
                    
                        </div>
                        <?php } else { ?>
                        <div id="sign-up-notice">
                            <span class="sign-up-message"><?=anchor('/register', 'Register')?> or <?=anchor('/login', 'Login')?> to leave a comment.</span>
                        </div>
                        <?php } ?>
                    
                        <div id="comment-container">
                    
                            <?=$comments?>
                    
                        </div>                    
                    </div>
                    
                    <?php } ?>
                    
                    	
                    <div id="tools-share">
                        <ul>
                            <li style="padding: 0 5px;"><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like layout="box_count" show_faces="true" width="450"></fb:like></li>
                            <li><iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?count=vertical&via=DCUONexus&text=<?=$post->post_title?>&url=<?=urlencode(base_url().$post->category_name.'/'.$post->post_seo);?>" style="width:55px; height:65px;"></iframe></li>                
                            <!-- <li><script src="http://www.stumbleupon.com/hostedbadge.php?s=5&r=<? //urlencode(base_url().$post->category_name.'/'.$post->post_seo);?>"></script></li> -->
                            <li><a onclick="window.open('http://feedburner.google.com/fb/a/emailFlare?itemTitle=<?=urlencode($post->post_title)?>&uri=<?=urlencode(base_url().$post->category_name.'/'.$post->post_seo);?>', 'emailThis', 'status=1,height=700,width=600,resizable=1'); return false;" class="button-email-it">Email It</a></li>
                            <li><a onclick="share('<?=base_url().$post->category_name.'/'.$post->post_seo;?>','<?=$post->post_title?>');" class="button-share-it">Share It</a></li>
                        </ul>
                    </div>
                    
<script type="text/javascript">

$('.reply-to').click(function() {
    var parent_id = $(this).attr('rel');
    $('#parent-id').val(parent_id);
    var username = $('.c-username[rel="' + parent_id + '"]').html();
    $('.replying-to').html('Replying to ' + username + ' [<a href="javascript:null" id="cancel-reply" onClick="javascript:cancel_reply()">Cancel Reply</a>]');
    $('.replying-to').show();
    $('#comment-text').focus();
})

function cancel_reply() {
    $('#parent-id').val('0');
    $('.replying-to').hide();
}

</script>
