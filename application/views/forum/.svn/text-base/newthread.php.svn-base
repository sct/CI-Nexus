<h1>Forums</h1>
<?=$breadcrumb?>
<div id="forum-newthread">
    <h1>Start a new thread in <?=$forum->name?></h1>
    <div class="thread-form">
        <?php if (validation_errors() != "") { ?>
        <div id="validation-errors">
            <?=validation_errors()?>
        </div>
        <?php } ?>
        <?=form_open('forum/'.$forum->uri_name.'/new-thread')?>
        <input type="hidden" name="forum_id" value="<?=$forum->id?>" />
            <div class="form-item">
                <label for="title">Thread Title</label> <input type="text" name="title" id="title" value="<?=set_value('title')?>" />
            </div>
            <div class="form-item">
                <label for="content">Message</label><br />
                <textarea name="content" id="content" cols="8" rows="30"><?=set_value('content')?></textarea>
            </div>
            <div class="form-submit">
                <input type="submit" name="submit" id="submit" value="Create Thread" />
            </div>
        </form>
    </div>
</div>