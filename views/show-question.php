<section class="content">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center"><?php echo $question->title ?></h1>
            <i class="fa fa-user"></i> <?php echo $question->first_name . ' ' . $question->last_name; ?>

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
</section>
<div class="foot"><a href="index.php">Retour &agrave; l'accueil</a>


