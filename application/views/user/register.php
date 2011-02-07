<div id="register-form">
    <div id="validation-errors">
        <?=validation_errors();?>
        <?php if (isset($username_exists)) { ?><p>Username already exists.</p><?php } ?>
        <?php if (isset($email_exists)) { ?><p>Email already exists.</p><?php } ?>
    </div>
    <?=form_open('register');?>
    <div class="form-item">
        <label for="username">Username</label> <input type="text" name="username" id="username" value="<?=set_value('username')?>" />
    </div>
    <div class="form-item">
        <label for="password">Password</label> <input type="password" name="password" id="password" />
    </div>
    <div class="form-item">
        <label for="pass_conf">Password Confirmation</label> <input type="text" name="pass_conf" id="pass_conf" />
    </div>
    <div class="form-item">
        <label for="email">Email</label> <input type="text" name="email" id="email" value="<?=set_value('email');?>" />
    </div>
    <div class="form-submit">
        <input type="submit" name="submit" id="submit" value="Register" />
    </div>
</div>