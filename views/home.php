<section class="content">
    <h2>All the Questions </h2>
    </br>

    <div class="form">

        <div id="search">
            <form action="">
                <input type="text" name="search" placeholder="Search..">
                <input class="bouton" type="button" value="Search " />
            </form>
        </div>

    </div>
    </br>

    <table class="table table-striped">

        <thead>
            <tr>
                <th width="840"> <scope="col"> Question</th>
                <th width="330"> <scope="col">Category</th>
            </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabquestions); $i++) { ?>
            <tr>
                <td><a href="index.php?action=show-question&id=<?php echo $tabquestions[$i]->getId() ?>"><span class="html"><?php echo $tabquestions[$i]->getTitle() ?></span></a></td>
                <td><?php echo $tabquestions[$i]->getCatName() ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</section>
