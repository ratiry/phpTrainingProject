<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <ul>
            <?php foreach ($questions as $question) : ?>
                    <a href="/question?id=<?= $question['id'] ?>" class="flex-col	flex border-1 border-indigo-600">
                        <h2><?= htmlspecialchars($question['title']) ?></h2> 
                        <p><?= htmlspecialchars($question['body']) ?></p>
                        <div>
                          <p>
                            questioned by 
                            <?= $db->query("SELECT * FROM `users` WHERE `id` = :user_id",[
                              "user_id"=>$question["user_id"]
                              ])->find()["name"]?>
                            </p>
                        </div>
                    </a>
            <?php endforeach; ?>
        </ul>

    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>