<div id="login">
    <form method="post" action="<?=$_SERVER['REQUEST_URI'];?>">
        <label>Username</label> <input type="text" name="username" id="username" />
        <label>Password</label> <input type="password" name="password" id="password" />
        <input type="submit" name="submit" value="Login" />
    </form>
</div>