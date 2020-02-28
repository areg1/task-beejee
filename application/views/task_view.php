<div class="form-container">
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
    <form action="/task/store" method="post">
        <div class="form-group">
            <label for="email-field">Email</label>
            <input type="text" name="email" id="email-field" class="form-control" value="<?php echo $_SESSION['email'] ?? ''?>"/>
        </div>
        <div class="form-group">
            <label for="name-field">Name</label>
            <input type="text" name="name" id="name-field" class="form-control"  value="<?php echo $_SESSION['name'] ?? ''?>" />
        </div>
        <div class="form-group">
            <label for="text-field">Text</label>
            <textarea name="text" id="text-field" class="form-control"> <?php echo $_SESSION['text'] ?? ''?> </textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>