<section class="content">
    <h2>All the Questions </h2>
    <div class="form">

        <div id="search">

            <form action="">
                <input class="champ" type="text" placeholder="Search"/>
                <input class="bouton" type="button" value=" " />
            </form>
        </div>
    </div>
    </div>
    <table>
        <thead>
            <tr>
                <th width="840">Question</th>
                <th width="330">Category</th>
            </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabquestions); $i++) { ?>
            <tr>
                <td><a href="/projetphp/controllers/QuestionController.php?action=show&id=<?php echo $tabquestions[$i]->getId() ?>"><span class="html"><?php echo $tabquestions[$i]->getTitle() ?></span></a></td>
                <td><?php echo $tabquestions[$i]->getCatName() ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</section>
