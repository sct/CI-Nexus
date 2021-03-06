<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-login.png') top left no-repeat;"></div>

<div class="content-bg-login">
    <div id="login">
        <?php if ($error != 0) { ?>
        <div id="validation-errors">Invalid username/password. Please try again!</div>
        <?php } ?>
        <form method="post" action="<?=$_SERVER['REQUEST_URI'];?>">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <div class="form-submit">
                <input type="submit" name="submit" value="Login">
            </div>
            <div class="login-links">
            	<?=anchor('reset-password','Forgot your password? Reset it.')?><br>
            	<?=anchor('register','Don\'t have an Account? Register Free!')?>
            </div>
        </form>
    </div>
</div>