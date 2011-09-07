<h1>Forums</h1>
<?=$breadcrumb?>
<div id="forum-newthread">
    <h1>Replying to <?=$thread->title?></h1>
    <div class="thread-form">
        <?php if (validation_errors() != "") { ?>
        <div id="validation-errors">
            <?=validation_errors()?>
        </div>
        <?php } ?>
        <?=form_open('forum/thread/'.$thread->uri_title.'/reply')?>
        <input type="hidden" name="thread_id" value="<?=$thread->id?>" />
            <div class="form-item">
                <label for="content">Your Reply</label><br />
                <textarea name="content" id="content" cols="8" rows="30"><?=set_value('content')?></textarea>
            </div>
            <div class="form-submit">
                <input type="submit" name="submit" id="submit" value="Reply" />
            </div>
        </form>
    </div>
</div>