<section class="content">
    <div class="card-body">
        <div class="col-12">
            <h1 class="text-center"><?php echo $question->title ?></h1>

            <!--- Update question area (for the member who asked)-->
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

                    <!--- Mark as solved -->
                    <?php if ($question->state=='O' and $question->goodanswer_id!=null){ ?>
                        <form action="index.php?action=state-change" method="post">
                            <div class="form_solved">
                                <button type="submit" name ="form_mark_as_solved" value="S" class="btn btn-success"> <i class="fas fa-check"></i>Mark as solved</button>
                                <input type="hidden" name="question_id_solved" value="<?php echo $question->question_id ?>">
                            </div>
                        </form>
                    <?php }elseif ($question->state=='S'){?>
                        <div class="form_solved">
                            <form action="index.php?action=state-change" method="post">
                                <button type="submit" name="form_open_question" value="O" class="btn btn-success"> <i class="fas fa-lock-open"></i>Mark as open</button>
                                <input type="hidden" name="question_id_open" value="<?php echo $question->question_id ?>">
                            </form>
                        </div>
                    <?php } ?>
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
    <div class="card-body">
        <div class="row">
            <!--- Loop displaying answers -->
            <?php
            foreach ($answers as $answer) {
                ?>
                <!--- The answer itself -->
                <div class="col-4">
                    <i class="fa fa-user"></i> <?php echo $answer->first_name . ' ' . $answer->last_name; ?>
                    <p><small> <i class="fa fa-calendar"></i> <?php echo date_format(date_create($answer->creation_date), 'd/m/Y H:i:s') ?></small></p>
                </div>

                <div class="col-8 alert alert-info ">
                    <!--- Displays good answer new to an answer -->
                    <?php echo $answer->subject;
                    if($question->goodanswer_id == $answer->answer_id){
                        echo " [good answer]";
                    }
                    ?>

                    <!--- Good answer form button-->
                    <?php
                    if(isset($_SESSION['member']) and $_SESSION['member']){
                        if($_SESSION['member']->member_id == $question->member_id ) {?>
                            <form action="index.php?action=goodanswer" method="post">
                                <button type="submit" name="form_goodanswer" class="btn-dark"><i class="fab fa-google"></i></button>
                                <input type="hidden" value="<?php echo $answer->answer_id ?>" name="answer_id">
                                <input type="hidden" name="question_id_goodanswer" value="<?php echo $question->question_id ?>">
                            </form>
                        <?php }} ?>

                    <!--- Votes -->
                    <div class="vote">

                        <form action="index.php?action=vote" method="post">
                            <button type="submit" name="form_vote" value="p" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            <span>
                                <?php echo $answer->totalVote ?>
                            </span>
                            <button type="submit" name="form_vote" value="n" class="btn btn-danger"><i class="fa fa-minus"></i></button>
                            <input type="hidden" value="<?php echo $answer->answer_id ?>" name="answer_id">
                            <input type="hidden" name="question_id_vote" value="<?php echo $question->question_id ?>">

                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
            <!--- End of loop to displays answer -->
        </div>


        <!--- Add an answer form -->
        <div class="notification">
            <p align="center"><?php echo $notification ?></p>
        </div>

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
    </div>
</section>