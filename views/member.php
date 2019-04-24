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
            <th> <scope="col">Active</th>
            <th> <scope="col">Suspend</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabmembers); $i++) { ?>
            <tr>
                <td><?php echo $tabmembers[$i]->first_name ?></td>
                <td><?php echo $tabmembers[$i]->last_name ?></td>
                <td><?php echo $tabmembers[$i]->email ?></td>
                <td>
                    <?php
                    if($tabmembers[$i]->is_admin == 1){echo "yes";}
                    else{
                        echo "no";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if($tabmembers[$i]->is_active == 1){echo "yes";}
                    else{
                        echo "no";
                    }
                    ?>
                </td>
                <td>
                    <?php if ($tabmembers[$i]->is_active == 1) {?>
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
        </tbody>
    </table>
</section>