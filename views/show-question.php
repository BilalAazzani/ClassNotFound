<section class="content">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center"><?php echo $question->title ?></h1>
            <i class="fa fa-user"></i> <?php echo $question->first_name . ' ' . $question->last_name; ?>
            <p><small> <i class="fa fa-calendar"></i> <?php echo date_format(date_create($question->creation_date), 'd/m/Y H:i:s') ?></small></p>

            <div>
                <?php echo $question->subject  ?>
                <hr>
            </div>
        </div>
    </div>

    <div class="row">
        <?php

        foreach ($answers as $answer) {
            ?>
            <div class="col-4">
                <i class="fa fa-user"></i> <?php echo $answer->first_name . ' ' . $answer->last_name; ?>
                <p><small> <i class="fa fa-calendar"></i> <?php echo date_format(date_create($answer->creation_date), 'd/m/Y H:i:s') ?></small></p>
            </div>

            <div class="col-8 alert alert-info ">
                <?php echo $answer->subject; ?>
            </div>

            <?php
        }
        ?>
    </div>

    <?php if(empty($_SESSION['authenticated'])){ ?>
        <p align="center">You must be logged in to answer</p>
        <p align="center">
            <a href="index.php?action=login">Log in</a>
            or
            <a href="index.php?action=register">Register</a>
        </p>

    <?php }else { ?>
        <div>
            <form action="index.php?action=insert-answer" method="post">
                <div class="form-group">
                    <textarea name="subject" class="form-control" id="subject" rows="2" placeholder="Write your answer"></textarea>
                </div>
                <input type="hidden" name="question_id" value="<?php echo $question->question_id ?>">
                <p class="text-center">
                    <button type="submit" name="form_insert_answer" class="btn btn-success"><i class="fa fa-plus"></i>Answer</button>
                </p>
            </form>
        </div>
    <?php } ?>



</section>