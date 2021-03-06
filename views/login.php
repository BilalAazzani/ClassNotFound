<section class="content">
    <!-- Default form login -->
    <div class="card-body">
        <form class="text-center border border-light p-5" action="index.php?action=login" method="post">
            <p class="h4 mb-4">Sign in</p>
            <!-- Email -->
            <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" required name="email">
            <!-- Password -->
            <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" required name="password">

            <div class="d-flex justify-content-around">
                <div>
                </div>
            </div>

            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4" type="submit" name="form_login">Sign in</button>

            <div class="notification">
                <p><?php echo "$notification" ?></p>
            </div>

            <!-- Register -->
            <p>Not a member?
                <a href="index.php?action=register">Register</a>
            </p>

        </form>
        <!-- Default form login -->
    </div>
</section>