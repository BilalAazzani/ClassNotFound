<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo PATH_VIEWS?>css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<section class="container">
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


</body>
</html>



