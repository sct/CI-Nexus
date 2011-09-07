<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-forum.png') top left no-repeat;">DCUO Nexus Forum</div>

<div id="forum-container">
    <div class="forum-info">
    	<div class="forum-info-left"><?=$breadcrumb?></div>
        <div class="forum-info-right">
			<?=anchor('forum/thread/'.$thread->uri_title.'/reply','Reply',array('class' => 'reply-btn-half'))?>
        	<?=anchor('forum/'.$thread->forum_uri.'/new-thread','New Thread',array('class' => 'new-thread-btn-half'))?>
        </div>
    </div>
    <div class="forum-category">
        <div class="category-title"><h1><?=$thread->title?></h1></div>
        <div class="category-description"><?=$description = $category->description != "" ? $category->description : null; ?></div>
	</div>
    <div id="thread-container">
        <?=$posts?>
    </div>
    <div class="forum-info">
    	<div class="forum-info-left"> </div>
        <div class="forum-info-right">
			<?=anchor('forum/thread/'.$thread->uri_title.'/reply','Reply',array('class' => 'reply-btn-half'))?>
        	<?=anchor('forum/'.$thread->forum_uri.'/new-thread','New Thread',array('class' => 'new-thread-btn-half'))?>
        </div>
    </div>
    <?php if ($this->session->userdata('username') != FALSE): ?>
    <div class="forum-category">
        <div class="category-title">Quick Reply <a name="reply"></a></div>
	</div>
    <div id="quick-reply-container">
        <?=form_open('forum/thread/'.$thread->uri_title.'/reply')?>
        <input type="hidden" name="thread_id" value="<?=$thread->id?>" />
        <div class="form-item">
            <textarea name="content" id="content" cols="8" rows="10"></textarea>
        </div>
        <div class="form-submit">
            <input type="submit" name="submit" id="submit" value="Post Reply" />
        </div>
    </div>
    <?php endif; ?>
</div>