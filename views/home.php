<section class="content">
    <h2>All the Questions </h2>
    </br>

    <div class="form">

        <div id="search">
            <form action="index.php" method="post">
                Search for a question: <input type="text" name="keyword" value="<?php echo $html_keyword ?>" placeholder="Search.."/>
                <input type="submit" name="form_search" value="Search">
            </form>
        </div>

    </div>

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
    <table class="table table-striped">

        <thead>
            <tr>
                <th width="840"> <scope="col"> Question</th>
                <th width="330"> <scope="col">Category</th>
                <?php
                if(isset($_SESSION['member']) and $_SESSION['member']){
                    if($_SESSION['member']->is_admin == 1 ) {?>
                        <th width="330"> <scope="col">Delete</th>
                    <?php } }?>
            </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabquestions); $i++) { ?>
            <tr>
                <td><a href="index.php?action=show-question&id=<?php echo $tabquestions[$i]->getId() ?>"><span class="html"><?php echo $tabquestions[$i]->getTitle() ?></span></a></td>
                <td><?php echo $tabquestions[$i]->getCatName() ?></td>
                <?php
                if(isset($_SESSION['member']) and $_SESSION['member']){
                    if($_SESSION['member']->is_admin == 1 ) {?>
                        <td>
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </td>
                    <?php } }?>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</section>
