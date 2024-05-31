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
              <option value="unAnswered">Unanswered questions</option>
              <option value="questionsAnsweredByUser">I answered</option>
            </select>
          </div> 
          <button class="btn btn-primary">`Apply</button>
      </form>
      
        <ul>
            <?php foreach ($questions as $question) : ?>
              <div class="flex w-full justify-between	items-center		flex border-1 border-indigo-600">
                <a href="/question?id=<?= $question['id'] ?>" class="">
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
                <?php if($question["user_id"]==$id):?>
                  <form class="justify-self-end	" action="/question" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="question_id" value="<?=$question["id"] ?>">
                    <input type="hidden" name="user_id" value="<?=$question["user_id"] ?>">
                    <button ><svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                </form>
                <?php endif;?>
              </div>

                    
            <?php endforeach; ?>
        </ul>

    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>