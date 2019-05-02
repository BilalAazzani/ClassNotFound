<section class="content">
    <h2 align="center">All the Questions </h2>
    </br>

    <!--- Search bar -->
    <div class="form">
        <div id="search">
            <form action="index.php" method="post">
                Search for a question: <input type="text" name="keyword" value="<?php echo $html_keyword ?>" placeholder="Search.."/>
                <input type="submit" name="form_search" value="Search">
            </form>
        </div>
    </div>

    <!-- Categories -->
    <div>
        Categories :
        <?php
        foreach ($categories as $category) {
            ?>
            <a href="index.php?action=category&catid=<?php echo "{$category->getCategoryId()}" ?>"><?php echo "{$category->getName()}"." "; ?></a>
            <?php
        }
        ?>
    </div>
    </br>

    <!--- Questions table -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="840"> <scope="col"> Question</th>
            <th width="200"> <scope="col">Category</th>
            <?php
            if(isset($_SESSION['member']) and $_SESSION['member']){
                if($_SESSION['member']->is_admin == 1 ) {?>
                    <th width="150"> <scope="col">Delete</th>
                <?php } }?>
            <?php
            if(isset($_SESSION['member']) and $_SESSION['member']){
                if($_SESSION['member']->is_admin == 1 ) {?>
                    <th width="150"> <scope="col">Duplicate/Open</th>
                <?php } }?>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabquestions); $i++) { ?>
            <tr>
                <td>
                    <a href="index.php?action=show-question&id=<?php echo $tabquestions[$i]->getId() ?>">
                        <span class="html"><?php echo $tabquestions[$i]->getTitle(); ?></span>
                    </a>
                    <?php  if($tabquestions[$i]->getState()=='S') {
                        echo '[solved]';
                    }elseif ($tabquestions[$i]->getState()=='D'){
                        echo '[duplicate]';
                    } ?>
                </td>
                <td><?php echo $tabquestions[$i]->getCatName() ?></td>

                <!--- Delete question -->
                <?php
                if(isset($_SESSION['member']) and $_SESSION['member']){
                    if($_SESSION['member']->is_admin == 1 ) {?>
                        <td>
                            <form action="index.php?action=delete-question" method="post">
                                <button type="submit" name="form_delete_question" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                <input type="hidden" name="question_id_delete" value="<?php echo $tabquestions[$i]->getId() ?>">
                            </form>
                        </td>
                    <?php } }?>

                <!--- Mark a question as open/duplicate -->
                <?php
                if(isset($_SESSION['member']) and $_SESSION['member']){
                    if($_SESSION['member']->is_admin == 1) {
                        if($tabquestions[$i]->getState()=='O'){?>
                            <td>
                                <form action="index.php?action=state-change" method="post">
                                    <button type="submit" name="form_duplicate_question" value="D" class="btn btn-secondary"><i class="fa fa-copy"></i></button>
                                    <input type="hidden" name="question_id_duplicate" value="<?php echo $tabquestions[$i]->getId() ?>">
                                </form>
                            </td>
                        <?php }elseif ($tabquestions[$i]->getState()=='D' or $tabquestions[$i]->getState()=='S'){ ?>
                            <td>
                                <form action="index.php?action=state-change" method="post">
                                    <button type="submit" name="form_open_question" value="O" class="btn btn-secondary"><i class="fab fa-opera"></i></button>
                                    <input type="hidden" name="question_id_open" value="<?php echo $tabquestions[$i]->getId() ?>">
                                </form>
                            </td>
                        <?php } } }?>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</section>
