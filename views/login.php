<section class="content">
    <h2>Login here</h2>
    <p>Welcome to the login page.</p>
    <div id="notification"><?php echo $notification; ?></div>
    <div class="form">
        <form action="?action=login" method="post">
            <p>Login : <input type="text" name="username"/></p>
            <p>Password : <input type="password" name="password"/></p>
            <p><input type="submit" name="form_login" value="Log in"></p>
        </form>
    </div>
</section>