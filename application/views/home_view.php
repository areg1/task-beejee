<?php 
    if(isset($_SESSION['created_notification'])):
        unset($_SESSION['created_notification']);
?>
<script>
    toastr.success('Created succesfully');
</script>
<?php
    endif;
?>

<div class='main-container'>
<div class="d-flex justify-content-between align-items-end">
    <form class="filter-form" action="/home/filter" method="POST">
        <div class="form-group mr-4">
            <label for="sortBySelect">Sort By</label>
            <select class="form-control" id="sortBySelect" name='sort_by_filter'>
                <?php foreach ($data['sort_by_filter'] as $item): ?>
                    <option value="<?=$item['value']?>" <?php if($item['value'] == $data['sort_by_selected']) echo "selected"?> >
                        <?=$item['text']?> 
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mr-4">
            <label for="status_select">Status</label>
            <select class="form-control" id="statusSelect" name='status_filter'>
                <?php foreach ($data['status_filter'] as $item): ?>
                    <option value="<?=$item['value']?>" <?php if($item['value'] == $data['status_selected']) echo "selected"?> >
                        <?=$item['text']?> 
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="text" value="<?=$data['active_page']?>" name='page_number' hidden />
        <div class="form-group">
            <button type="submit" class="btn btn-secondary">Filter</button>
        </div>
    </form>

    <div class="form-group">
        <?php if (isset($_SESSION['login'])): ?>
            <a href="/auth/logout" class="btn btn-outline-secondary">Sign out</a>
        <?php else: ?>
            <a href="/auth" class="btn btn-secondary">Sign in</a>
        <?php endif; ?>

    </div>

</div>    
<?php if(count($data['tasks']) > 0): ?>

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
                <?php foreach($data['tasks'] as $value):  ?>
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

    </div>

    <?php if ($data['pages_count'] > 1): ?>

    <nav aria-label="Tasks Navigation" class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if($data['active_page'] == 1) echo 'disabled'; ?>">
                <a
                    class="page-link"
                    href="#"
                    tabindex="-1"
                    value="<?=$data['active_page'] - 1?>">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $data['pages_count']; $i++): ?>
            <li class="page-item <?php if($data['active_page'] == $i) echo 'active'; ?>">
                <a class="page-link" value="<?=$i?>" href="#"><?=$i?></a>
            </li>
            <?php endfor ?>

            <li
                class="page-item <?php if($data['active_page'] == $data['pages_count']) echo 'disabled'; ?>">
                <a class="page-link" href="#" value="<?=$data['active_page'] + 1?>">Next</a>
            </li>
        </ul>
    </nav>

    <?php endif ?>
<?php else: ?>
    <h2 class="mb-5">Nothing to show</h2>
<?php endif ?>
    
    <div class="mt-5">
        <a href="/task/create" class="btn btn-dark" role="button">Add new task</a>
    </div>

</div>