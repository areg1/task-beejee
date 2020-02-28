<div class="table-container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Text</th>
                <th scope="col">Status</th>
                <th scope="col">Edited by Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['tasks'] as $row => $value):  ?>
            <tr>
                <th scope="row">&middot;</th>
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
    <?php if ($data['pages_count'] > 1): ?>        

        <nav aria-label="Tasks Navigation" class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($data['active_page'] == 1) echo 'disabled'; ?>" >
                    <a class="page-link" href="#" tabindex="-1"  value="<?=$data['active_page'] - 1?>">Previous</a>
                </li>

                <?php for ($i = 1; $i <= $data['pages_count']; $i++): ?>
                    <li class="page-item <?php if($data['active_page'] == $i) echo 'active'; ?>">
                        <a class="page-link" value="<?=$i?>" href="#"><?=$i?></a>
                    </li>
                <?php endfor ?>  

                <li class="page-item <?php if($data['active_page'] == $data['pages_count']) echo 'disabled'; ?>" >
                    <a class="page-link" href="#" value="<?=$data['active_page'] + 1?>">Next</a>
                </li>
            </ul>
        </nav>

    <?php endif ?>
</div>