<section class="content">
    <div class="container">


        <h2>Ask your question</h2>
        <div class="form">

            <form action="index.php?action=insert-question" method="post">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Write your question title...">
                </div>

                <div class="form-group">
                    <label for="categories">Category</label>
                    <select class="form-control" id="categories" name="category">
                        <?php
                        foreach ($categories as $category) {
                            echo "<option value='{$category->getCategoryId()}'>{$category->getName()}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Example textarea</label>
                    <textarea class="form-control" name="subject" id="subject" rows="3" placeholder="Explain your question"></textarea>
                </div>

                <?php if(empty($_SESSION['authenticated'])){ ?>
                    <p align="center">You must be logged in to create your question</p>
                    <p align="center">
                        <a href="index.php?action=login">Log in</a>
                        or
                        <a href="index.php?action=register">Register</a>
                    </p>

                <?php }else { ?>

                    <p class="text-center">
                        <button type="submit" name='form_create_question' class="btn btn-primary"><i class="fa fa-plus"></i> Create question</button>
                    </p>
                <?php }?>
            </form>
        </div>
    </div>
</section>