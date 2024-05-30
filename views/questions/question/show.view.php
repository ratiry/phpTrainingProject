<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?php use Core\App;$db=App::resolve("Core\Database") ?>
<main >


    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 ">
      <div class="bg-neutral-200	p-4 flex justify-between	items-center" >
        <p class="text-wrap	"><?=$question["title"] ?></p>
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
        <p class="text-wrap	"><?= $question["body"]?></p>
      </div>
      <p>Answers</p>
      <?php if( sizeof($answers)==0):?>
        <p>No answers here</p>
      <?php endif;?>
      <?php foreach($answers as $answer) : ?>
        <div class="bg-red-50 w-full p-4 flex justify-between">
          <div>
            <p>Answered by
              <?=$db->query("SELECT * from users WHERE id=:user_id",[
                "user_id"=>$answer["user_id"]
              ])->find()["name"]?>
            </p>
            <p class="text-wrap">
              <?=$answer["body"] ?>
            </p>
          </div>
          <form class="m-[10px] flex flex-col items-center	" method="POST" action="/answer/rating">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="answer_id" value="<?= $answer["id"]?>">
            <input type="hidden" name="question_id" value="<?= $question["id"]?>">
            <button class="<?=$opinion=="plus" ? 'border-2 border-indigo-600': 'bug'?> block" name="opinion" value="plus">
              <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            </button>
            <span class="text-center"><?= $answer["rating"] ?></span>
            <button class="<?=$opinion=="minus" ? 'border-2 border-indigo-600': 'bug'?> block" name="opinion" value="minus">
              <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
            </button>
          </form>
          <?php if($user_id==$answer["user_id"]):?>
            <div class="flex flex-col  justify-around">
              <form method="POST" class="flex" action="/answer">
                  <input type="hidden" name="_method" value="DELETE">
                  <button >
                    <svg class="w-[15px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                  </button>
                </form>
                <form method="POST" class="flex" action="/answer">
                  <button >
                    <input type="hidden" name="_method" value="PATCH">
                    <svg class="w-[15px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
                  </button>
              </form>            
            </div>
          <?php endif;?>
        </div>
      <?php endforeach;?>

      <?php if($user_id !=NULL && !$userAlreadyAnswered ):?>
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