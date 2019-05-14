<section class="content">
    <h2>Here's the list of all members</h2>
    <br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th> <scope="col">First name</th>
            <th> <scope="col">Last name</th>
            <th> <scope="col">Email</th>
            <th> <scope="col">Admin</th>
            <th> <scope="col">Make admin</th>
            <th> <scope="col">Active</th>
            <th> <scope="col">Suspend</th>
        </tr>
        </thead>

        <tbody>
        <!--- Loop displaying members -->
        <?php for ($i = 0; $i < count($tabmembers); $i++) { ?>
            <tr>
                <td><?php echo $tabmembers[$i]->first_name ?></td>
                <td><?php echo $tabmembers[$i]->last_name ?></td>
                <td><?php echo $tabmembers[$i]->email ?></td>

                <!--- Displays if the member is admin or not  -->
                <td>
                    <?php
                    if($tabmembers[$i]->is_admin == 1){echo "yes";}
                    else{
                        echo "no";
                    }
                    ?>
                </td>

                <!--- Button that either changes the state of an user to admin or member -->
                <td>
                    <?php if ($tabmembers[$i]->is_admin == 0) {?>
                        <form action="index.php?action=member" method="post">
                            <button type="submit" name="form_make_admin" value="<?php echo $tabmembers[$i]->member_id ?>">Make admin</button>
                        </form>
                    <?php }else { ?>
                        <form action="index.php?action=member" method="post">
                            <button type="submit" name="form_make_member" value="<?php echo $tabmembers[$i]->member_id ?>">Make member</button>
                        </form>
                    <?php }?>
                </td>

                <!--- Display if the member is suspended or not -->
                <td>
                    <?php
                    if($tabmembers[$i]->is_active == 1){echo "yes";}
                    else{
                        echo "no";
                    }
                    ?>
                </td>

                <!--- Button that suspends/unsuspend the user  -->
                <td>
                    <?php if ($tabmembers[$i]->is_active == 1 ) {?>
                        <form action="index.php?action=member" method="post">
                            <button type="submit" name="form_suspend" value="<?php echo $tabmembers[$i]->member_id ?>">Suspend</button>
                        </form>
                    <?php }else{ ?>
                        <form action="index.php?action=member" method="post">
                            <button type="submit" name="form_unsuspend" value="<?php echo $tabmembers[$i]->member_id ?>">Unsuspend</button>
                        </form>
                    <?php }?>
                </td>
            </tr>
        <?php } ?>
        <!--- End of loop displaying the members -->
        </tbody>
    </table>
</section>