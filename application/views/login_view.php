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
    <form action="/auth/login" method="post">
        <div class="form-group">
            <label for="name-field">Name</label>
            <input type="text" name="name" id="name-field" class="form-control"  value="<?php echo $_SESSION['name'] ?? ''?>" />
        </div>
        <div class="form-group">
            <label for="password-field">Password</label>
            <input type="password" name="password" id="password-field" class="form-control"  value="<?php echo $_SESSION['password'] ?? ''?>" />
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>