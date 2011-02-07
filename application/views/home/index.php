        <div id="content">
        	<div class="content-top"></div>
            <div id="splash">   
                
                <div id="featured-story" class="featured-slidecontent featured">
 					<div class="featured-main-outer">
  						<ul class="featured-main-wapper">
  							<li>
        						<img src="/assets/images/featured-story.jpg" title="title" height="250" width="640">          
                 				<div class="featured-main-item-desc">
                        			<h3><a href="/news/id-title.html" target="_parent" title="title">Preview the New February Raid Content!</a></h3>
                        			<p>Your first sneak peak at the second Batcave Raid zone, a new cinematic and much more.</p>
                					<p><span>18 hours ago &nbsp; &nbsp; <a href="/news/id-title.html#comments">3 Comments</a></span></p>
             					</div>
        					</li> 
  							<li>
        						<img src="/assets/images/featured-story-2.jpg" title="title" height="250" width="640">          
                 				<div class="featured-main-item-desc">
                        			<h3><a href="/news/id-title.html" target="_parent" title="title">Green Lantern Content Coming Soon</a></h3>
                        			<p>Sony Online Entertainment are planning on releasing a new light power set and much more next year.</p>
                					<p><span>21 hours ago &nbsp; &nbsp; <a href="/news/id-title.html#comments">1 Comment</a></span></p>
             					</div>
        					</li> 
  							<li>
        						<img src="/assets/images/featured-story-3.jpg" title="title" height="250" width="640">          
                 				<div class="featured-main-item-desc">
                        			<h3><a href="/news/id-title.html" target="_parent" title="title">Movement Guides: Super Speed</a></h3>
                        			<p>Learn how to master super speed to dominate PVE and PVP content.</p>
                					<p><span>1 day ago &nbsp; &nbsp; <a href="/news/id-title.html#comments">No Comments Yet</a></span></p>
             					</div>
        					</li> 
      					</ul>  	
                    </div>
                    <div class="featured-navigator-wapper">
                        <div onclick="return false" href="" class="featured-previous">Previous</div>
                        <div class="featured-navigator-outer">
                            <ul class="featured-navigator">
                               <li><img src="/assets/images/featured-story-thumb-1.jpg" /></li>
                               <li><img src="/assets/images/featured-story-thumb-2.jpg" /></li>
                               <li><img src="/assets/images/featured-story-thumb-3.jpg" /></li>    		
                            </ul>
                        </div>
                        <div onclick="return false" href="" class="featured-next">Next</div>
                    </div>
 				</div>
                
                <div class="splash-right">
                	<p>I'll figure this out sometime soon</p>
                </div>              
                
            </div>
            <div class="content-inner">
            	
                <div id="news-list">
                	<ul>
   						<?php foreach ($posts as $post): ?>
                        <li>
                            <?php if (file_exists($this->config->item('upload_path').'images/posts/article-'.$post->id.'-310x121.jpg')) { ?>
                            	<div class="image"><img src="<?=base_url()?>assets/upload/images/posts/article-<?=$post->id?>-310x121.jpg" /></div>
                            <?php } ?>
                            <div class="category-name"><?=$post->category_display?></div>
                            <div class="title"><?=anchor($post->category_name.'/'.$post->post_seo,$post->post_title);?></div>                         
                            <div class="posted-date"><?=date('F jS, Y @ g:i a',$post->posted_on);?> - <?=anchor($post->category_name.'/'.$post->post_seo.'#comments','No Comments Yet');?></div>
                            <div class="excerpt"><?=$post->post_excerpt;?></div>
                        </li>
    					<?php endforeach; ?>
                    </ul>
                </div>
            
                <ul>
                <?php foreach ($categories as $category): ?>
                <li><?=anchor($category->category_name,$category->category_display);?></li>
                <?php endforeach; ?>
                </ul>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            
            </div>        
        </div>