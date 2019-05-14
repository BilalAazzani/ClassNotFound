<div class="content">
    <h2 align="center">All the related Questions</h2>

    <!--- Categories you can click on -->
    <div class="card-body">
        Categories :
        <?php
        foreach ($categories as $category) {
            ?>
            <a href="index.php?action=category&catid=<?php echo "{$category->getCategoryId()}" ?>">
                <?php echo "{$category->getName()}"." "; ?>
            </a>
            <?php
        }
        ?>
    </div>
    </br>

    <table class="table table-striped">
        <thead>
        <tr>
            <th width="840"> <scope="col">Question</th>
            <th width="330"> <scope="col">Category</th>
        </tr>
        </thead>
        <tbody>
        <!--- Loop displaying the questions -->
        <?php for ($i = 0; $i < count($tab_question_cat); $i++) { ?>
            <tr>
                <td>
                    <a href="index.php?action=show-question&id=<?php echo $tab_question_cat[$i]->getId() ?>">
                        <span class="html">
                            <?php echo $tab_question_cat[$i]->getTitle() ?>
                        </span>
                    </a>
                    <?php  if($tab_question_cat[$i]->getState()=='S') {
                        echo '[solved]';
                    }elseif ($tab_question_cat[$i]->getState()=='D'){
                        echo '[duplicate]';
                    } ?>
                </td>
                <td> <?php echo $tab_question_cat[$i]->getCatName() ?></td>
            </tr>
        <?php } ?>
        <!--- End of loop -->
        </tbody>
    </table>
</div>