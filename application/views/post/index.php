                
                	<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-dcuo-<?=url_title($posts[0]->category_display, 'dash', TRUE)?>.png') top left no-repeat;">
                    	<h1>DC Universe Online <?=$posts[0]->category_display?></h1>
                    </div>

                    <div id="news-list-index">
                        <ul>
						<?php foreach ($posts as $post): ?>
                        	<li>
                                <div class="details">
                                    <div class="title"><?=anchor($post->category_name.'/'.$post->post_seo,$post->post_title);?></div>                         
                                    <div class="posted-date"><?=date('F jS, Y @ g:i a',$post->posted_on);?> - <?=anchor($post->category_name.'/'.$post->post_seo.'#comments',comment_count($post->comment_count));?></div>
                                    <div class="excerpt"><?=word_limiter($post->post_excerpt, 45)?></div>
                                </div>
                            	<div class="image">
									<?php if (file_exists($this->config->item('upload_path').'images/posts/article-'.$post->id.'-310x121.jpg')) { ?>
                                        <?=anchor($post->category_name.'/'.$post->post_seo,'<img src="'.base_url().'assets/upload/images/posts/article-'.$post->id.'-310x121.jpg" />');?>
                                    <?php } ?>
                                </div>
                        	</li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if ($this->session->userdata('admin') == 1) { ?>
                    <div class="admin-options">
                        <?=anchor('post/create','Create Post');?>
                    </div>
                    <?php } ?>
                    <div class="pagination">
                        <?=$pagination?>
                    </div>