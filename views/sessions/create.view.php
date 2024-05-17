<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" >
    <form method="POST" action="/login">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
        <p class="text-danger"><?=$errors["login"]?></p>
        <?php if($errors["password"]!=NULL):?>
            <p class="text-danger"><?=$errors["password"]?></p>
            <img src="https://content.imageresizer.com/images/memes/SMELLING-YODA-meme-2.jpg" alt="">
        <?php endif;?>

    </form>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
