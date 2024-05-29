<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?php use Core\App;$db=App::resolve("Core\Database") ?>
<main>


    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <div class="bg-neutral-200	p-4 flex justify-between	items-center" >
        <p><?=$question["title"] ?></p>
        <div class="flex flex-nowrap items-center	">
          <span>asked by <?=$user_name ?></span>
          <form class="m-[10px] flex flex-col" method="POST" action="/question/rating">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="question_id" value="<?= $question["id"]?>">
            <button class="<?=$opinion=="plus" ? 'border-2 border-indigo-600': 'bug'?> block" name="opinion" value="plus">
              <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            </button>
            <span class="text-center"><?= $question["rating"] ?></span>
            <button class="<?=$opinion=="minus" ? 'border-2 border-indigo-600': 'bug'?> block" name="opinion" value="minus">
              <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
            </button>
          </form>
        </div>
      </div>
      <div class="bg-stone-100	mt-[20px] p-4 w-full">
        <p ><?= $question["body"]?></p>
      </div>
      <p>Answers</p>
      <?php foreach($answers as $answer) : ?>
        <div class="bg-red-50 w-full p-4 flex justify-between">
          <div>
            <p>Answered by
              <?=$db->query("SELECT * from users WHERE id=:user_id",[
                "user_id"=>$answer["user_id"]
              ])->find()["name"]?>
            </p>
            <?=$answer["body"] ?>
          </div>
          <form class="m-[10px] flex flex-col" method="POST" action="/answer/rating">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="answer_id" value="<?= $answer["id"]?>">
            <button class="<?=$opinion=="plus" ? 'border-2 border-indigo-600': 'bug'?> block" name="opinion" value="plus">
              <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            </button>
            <span class="text-center"><?= $answer["rating"] ?></span>
            <button class="<?=$opinion=="minus" ? 'border-2 border-indigo-600': 'bug'?> block" name="opinion" value="minus">
              <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
            </button>
          </form>
        </div>
      <?php endforeach;?>

      <?php if($user_id !=NULL):?>
        <form class="mt-[20px]" action="/answer" method="POST">
          <input type="hidden" name="question_id" value="<?= $question["id"]?>">
          <textarea id="about" name="body" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
          <p class="text-danger"><?=$errors["body"]?></p>
          <button class="btn btn-primary">answer</button>
        </form>
      <?php endif; ?>

    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>