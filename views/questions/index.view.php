<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>


    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <form action="/questions" class="mb-5 flex justify-between">
          <div>
            sort by <select  name="sort" id="">
              <option  value=""></option>
              <option value="rating_ascending">rating ascending</option>
              <option value="rating_descending">rating descending</option>
            </select>
            filter by <select name="filter" id="">
               <option value=""></option>
              <?php foreach($db->query("SELECT * FROM `Categories`")->get() as $category) :?>
               
                <option value="<?= $category["name"] ?>"><?= $category["name"] ?></option>
              <?php endforeach;?>                      
              <option value="my_questions">my questions</option>
              
            </select>
          </div> 
          <button class="btn btn-primary">`Apply</button>
      </form>
      
        <ul>
            <?php foreach ($questions as $question) : ?>
                    <a href="/question?id=<?= $question['id'] ?>" class="flex-col	flex border-1 border-indigo-600">
                        <h2><?= htmlspecialchars($question['title']) ?></h2> 
                        <div>
                          <p>
                            questioned by 
                            <?= $db->query("SELECT * FROM `users` WHERE `id` = :user_id",[
                              "user_id"=>$question["user_id"]
                              ])->find()["name"]?>
                            </p>
                            <p>Rating:<?= $question["rating"] ?></p>
                            <p>Category:<?= $question["category"] ?></p>
                        </div>
                    </a>
            <?php endforeach; ?>
        </ul>

    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>