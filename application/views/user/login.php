<div id="login">
    <?php if ($error != 0) { ?>
    <div id="validation-error">Invalid username/password. Please try again!</div>
    <?php } ?>
    <form method="post" action="<?=$_SERVER['REQUEST_URI'];?>">
        <label>Username</label> <input type="text" name="username" id="username" />
        <label>Password</label> <input type="password" name="password" id="password" />
        <input type="submit" name="submit" value="Login" />
    </form>
</div>