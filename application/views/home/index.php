        <div id="content">
            <div id="splash">   
                
                <div id="featured-story" class="featured-slidecontent featured">
 					<div class="featured-main-outer">
  						<ul class="featured-main-wapper">
                            <?php foreach ($featured_news as $featured_post): ?>
  							<li>
                                <?php if (post_image($featured_post->id, 'very_large', true)) { ?>
                                	<span class="rounded-img-splash" style="background: url('/assets/upload/images/posts/article-<?=$featured_post->id?>-1000x253.jpg') no-repeat center center; width: 1000px; height: 253px;"><?=post_image($featured_post->id, 'very_large', false, "alt=\"".$featured_post->post_title."\"")?></span>
                              	<?php } ?>
                 				<div class="featured-main-item-desc">
                                	<a href="<?=$featured_post->category_name.'/'.$featured_post->post_seo?>" class="shadow"><?=$featured_post->post_title?></a>
                                	<div class="inner">
                                        <h3><?=anchor($featured_post->category_name.'/'.$featured_post->post_seo, word_limiter($featured_post->post_title, 7));?></h3>
                                        <p><?=word_limiter($featured_post->post_excerpt, 12);?></p>
                                    </div>
             					</div>
        					</li>
                            <?php endforeach; ?>
      					</ul>  	
                    </div>
                    <div class="featured-navigator-wapper">
                        <div onclick="return false" href="" class="featured-previous">Previous</div>
                        <div class="featured-navigator-outer">
                            <ul class="featured-navigator">
                               	<?php foreach ($featured_news as $featured_post): ?>
									<?php if (post_image($featured_post->id, 'small', true)) { ?>
                                    	<li><?php echo post_image($featured_post->id, 'small'); ?></li>
                                	<?php } ?>
                                <?php endforeach; ?> 		
                            </ul>
                        </div>
                        <div onclick="return false" href="" class="featured-next">Next</div>
                    </div>
 				</div>           
                
            </div>
            <div class="content-inner content-with-sidebar">
                        
            	<div class="left">
                
                	<div class="content-heading">
                    	<img src="/assets/images/title-left-latest-news.png" alt="latest dc universe online news" />
                    </div>
            	
                    <div id="news-list">
                        <ul>
                            <?php foreach ($posts as $post): ?>
                            <li>
                            	<div class="left">
                                    <div class="title"><?=anchor($post->category_name.'/'.$post->post_seo,$post->post_title);?></div>                         
                                    <div class="posted-date"><?=date('F jS, Y @ g:i a',$post->posted_on);?> - <?=anchor($post->category_name.'/'.$post->post_seo.'#comments',comment_count($post->comment_count));?></div>
                                    <div class="excerpt"><?=word_limiter($post->post_excerpt, 45)?></div>
                                </div>
                                <div class="right">
									<?php if (file_exists($this->config->item('upload_path').'images/posts/article-'.$post->id.'-310x121.jpg')) { ?>
                                        <div class="image"><?=anchor($post->category_name.'/'.$post->post_seo, '<img src="'.base_url().'assets/upload/images/posts/article-'.$post->id.'-310x121.jpg" />');?></div>
                                    <div class="category-name"><?=$post->category_display?></div>                                 
                                	<?php } ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
            	</div>
                <div class="right">
                
                	<div class="sidebar-home-top"></div>
                
                	<div class="sidebar-box">
                    	<img src="<?=base_url()?>assets/images/sidebar-title-featured-videos.png">
                      	<ul id="most-commented-list">
							<?php foreach ($featured_videos as $video): ?>
                            <li>
                                <div class="title"><?=anchor($video->category_name.'/'.$video->post_seo,$video->post_title);?></div>
                            	<div class="image">
									<?php if (file_exists($this->config->item('upload_path').'images/posts/article-'.$video->id.'-70x27.jpg')) { ?>
                                        <?=anchor($video->category_name.'/'.$video->post_seo,'<img src="'.base_url().'assets/upload/images/posts/article-'.$video->id.'-70x27.jpg" />');?>
                                    <?php } ?>
                                </div>
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
                
                </div>
            
            </div>        
        </div>