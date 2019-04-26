<div class="content">
    <h2><?php echo "" ?></h2>

    <table class="table table-striped">

        <thead>
        <tr>
            <th width="840"> <scope="col">Question</th>
           <!-- <th width="330"> <scope="col">Category</th> -->
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tab_question_cat); $i++) { ?>
            <tr>
                <td>
                    <a href="index.php?action=show-question&id=<?php echo $tab_question_cat[$i]->question_id ?>">
                        <span class="html">
                            <?php echo $tab_question_cat[$i]->title ?>
                        </span>
                    </a>
                </td>
                <!-- <td><?php echo $tab_question_cat[$i]->category_id ?></td> -->
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>