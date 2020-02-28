<div class='form-container'>
    <?php if(isset($_SESSION['errors'])): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="text-danger">
                <?php foreach($_SESSION['errors'] as $error): ?>
                    <li>
                        <?=$error?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="/task/update/<?=$data['task']['id']?>" method="post">
        <input type="hidden" name="_method" value="put" />
        <div class="form-group">
            <label for="text-field">Text</label>
            <input type="text" name="text" id="text-field" class="form-control" 
            value="<?php echo $data['task']['text'] ?? ''?>" />
        </div>
        <div class="form-check mb-4">
            <input type="checkbox" class="form-check-input" id="status-checkbox" name='status'
            <?php if($data['task']['status']) echo 'checked'; ?> >
            <label class="form-check-label" for="status-checkbox">Performed</label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>