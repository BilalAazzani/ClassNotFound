<section class="content">
    <h2>All the Questions </h2>
    <div class="form">
        <form action="../index.php" method="post">
            <p>
                <input class="search" type="text" name="keyword" value="<?php echo $html_keyword ?>"/>
                <input type="submit" name="form_search" value="Search">
            </p>
        </form>
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
                <td><a href="index.html"><span class="html"><?php echo $tabquestions[$i]->getTitle() ?></span></a></td>
                <td><?php echo $tabquestions[$i]->getCatName() ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</section>
