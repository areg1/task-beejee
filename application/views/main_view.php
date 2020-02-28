<div class="table-container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Text</th>
                <th scope="col">Status</th>
                <th scope="col">Edited by Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $row => $value):  ?>
            <tr>
                <th scope="row"><?=$row+1?></th>
                <td><?=$value['name']?></td>
                <td><?=$value['email']?></td>
                <td><?=$value['text']?></td>
                <td>
                    <?php
                        if($value['status']) {
                            echo "Performed";
                        } else {
                            echo  "Not performed";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($value['admin_edited']) {
                            $icon = "check-mark.png";
                        } else {
                            $icon = "minus.png";
                        }
                    ?>
                    <img src="../../images/<?=$icon?>" alt="" srcset="">
                </td>
            </tr>
        <?php endforeach ?>    
        </tbody>
    </table>    
</div>