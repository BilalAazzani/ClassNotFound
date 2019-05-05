<section class="content">
    <!-- Material form register -->
    <div class="card-body">
        <!--Card content-->
        <div class="card-body">
            <!-- Form -->
            <form class="text-center border border-light p-5" action="index.php?action=register" method="post">
                <p class="h4 mb-4">Sign up</p>

                <div class="form-row">
                    <div class="col">
                        <!-- First name -->
                        <div class="md-form">
                            <input type="text" id="materialRegisterFormFirstName" class="form-control" required name="first_name">
                            <label for="materialRegisterFormFirstName">First name</label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Last name -->
                        <div class="md-form">
                            <input type="text" id="materialRegisterFormLastName" class="form-control" required name="last_name">
                            <label for="materialRegisterFormLastName">Last name</label>
                        </div>
                    </div>
                </div>

                <!-- E-mail -->
                <div class="md-form mt-0">
                    <input type="email" id="materialRegisterFormEmail" class="form-control" required name="email">
                    <label for="materialRegisterFormEmail">E-mail</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="materialRegisterFormPassword" class="form-control" required aria-describedby="materialRegisterFormPasswordHelpBlock" name="password">
                    <label for="materialRegisterFormPassword">Password</label>
                    <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">

                    </small>
                </div>

                <!-- Sign up button -->
                <a href="index.php?action=login">
                    <?php echo "$notification" ?>
                </a>

                <button class="btn btn-info btn-block my-4" type="submit" name="form_register">Sign up</button>

            </form>
            <!-- Form -->

        </div>
    </div>
    <!-- Material form register -->
</section>
