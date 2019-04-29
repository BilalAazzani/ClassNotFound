<section class="content">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center"><?php echo $question->title ?></h1>

            <!--- Update question area -->
            <?php
            if(isset($_SESSION['member']) and $_SESSION['member']){
                if($_SESSION['member']->member_id == $question->member_id ) {?>
                    <form action="index.php?action=update-question" method="post">
                        <div class="form-group">
                            <textarea name="subject_update" class="form-control" id="subject" rows="2" placeholder="Update your question"></textarea>
                        </div>
                        <input type="hidden" name="question_id_update" value="<?php echo $question->question_id ?>">

                        <button type="submit" name="form_update_question" class="btn btn-primary"><i class="fa fa-plus"></i>Update</button>
                    </form>

                <?php } } ?>

            <!--- Question subject area -->
            <i class="fa fa-user"></i> <?php echo $question->first_name . ' ' . $question->last_name; ?>
            <p><small> <i class="fa fa-calendar"></i> <?php echo date_format(date_create($question->creation_date), 'd/m/Y H:i:s') ?></small></p>

            <div>
                <?php echo $question->subject  ?>
                <hr>
            </div>
        </div>
    </div>

    <!--- Answers area -->
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

                <!--- Votes -->
                <div class="vote">
                    <form action="index.php?action=vote" method="post">
                        <button type="submit" name="form_vote" value="p" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        <button type="submit" name="form_vote" value="n" class="btn btn-danger"><i class="fa fa-minus"></i></button>
                        <input type="hidden" value="<?php echo $answer->answer_id ?>" name="answer_id">
                        <input type="hidden" name="question_id_vote" value="<?php echo $question->question_id ?>">
                    </form>
                </div>

            </div>

            <?php
        }
        ?>
    </div>

    <!--- Add an answer area -->
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
                    <button type="submit" name="form_insert_answer" class="btn btn-primary"><i class="fa fa-plus"></i>Answer</button>
                </p>
            </form>
        </div>
    <?php } ?>



</section>