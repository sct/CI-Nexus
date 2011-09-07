                
                	<div class="sidebar-box">
                    	<img src="<?=base_url()?>assets/images/sidebar-title-featured-video.png">
                      	<ul id="featured-video-list">
							<?php foreach ($featured_videos as $video): ?>
                            <li>
                                <?php if (file_exists($this->config->item('upload_path').'images/posts/article-'.$video->id.'-310x121.jpg')) { ?>
                                	<div class="image"><img src="<?=base_url()?>assets/upload/images/posts/article-<?=$video->id?>-310x121.jpg" /></div>
                                <?php } ?>
                                <div class="title"><?=anchor($video->category_name.'/'.$video->post_seo,$video->post_title);?></div>                         
                            	<div class="posted-date"><?=date('F jS, Y @ g:i a',$video->posted_on);?> - <?=anchor($video->category_name.'/'.$video->post_seo.'#comments',comment_count($video->comment_count));?></div>
                            </li>
                        	<?php endforeach; ?>
                    	</ul>
                	</div>
                
                	<div class="sidebar-box">
                    	<img src="<?=base_url()?>assets/images/sidebar-title-most-commented.png">
                      	<ul id="most-commented-list">
							<?php foreach ($most_commented as $comment): ?>
                            <li>
                                <div class="title"><?=anchor($comment->category_name.'/'.$comment->post_seo,$comment->post_title);?></div>
                            	<div class="image">
									<?php if (file_exists($this->config->item('upload_path').'images/posts/article-'.$comment->id.'-70x27.jpg')) { ?>
                                        <?=anchor($comment->category_name.'/'.$comment->post_seo,'<img src="'.base_url().'assets/upload/images/posts/article-'.$comment->id.'-70x27.jpg" />');?>
                                    <?php } ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                	</div>