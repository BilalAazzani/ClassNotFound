<section class="content">
    <h2>Register here</h2>
    <p>Welcome to the register page.</p>
    <div id="notification"><?php echo $notification; ?></div>
    <div class="form">
        <form action="?action=register" method="post">
            <p>First name :<input type="text" name="firstname"></p>
            <p>Last name : <input type="text" name="lastname"></p>
            <p>E-mail : <input type="text" name="mail"></p>
            <p><input type="submit" name="form_register" value="Register"></p>
        </form>
    </div>
</section>