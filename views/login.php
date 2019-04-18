<!-- Default form login -->
<form class="text-center border border-light p-5" action="?action=login" method="post">
    <p class="h4 mb-4">Sign in</p>
    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" name="email">
    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" name="password">

    <div class="d-flex justify-content-around">
        <div>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit" name="form_login">Sign in</button>

    <!-- Register -->
    <p>Not a member?
        <a href="index.php?action=register">Register</a>
    </p>

</form>
<!-- Default form login -->