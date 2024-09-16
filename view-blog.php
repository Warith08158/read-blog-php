<?php 
    include "components/header.html.php";
    require "config/init.php";

    //get blog id
    $blog_id = (int) $_GET["id"];

    $_blog = new Blog_view();


    //get blog detail including author detail
    $blogAndAuthorDetails = $_blog->blogAndAuthor($blog_id);

    // blog and author details refined
    $avatar= firstLetter($blogAndAuthorDetails["user_name"]);
    $authorName= $blogAndAuthorDetails["user_name"];
    $authorJoinedDate = Date::format('M j, Y', $blogAndAuthorDetails["user_created_at"]);
    $blogCreatedDate = Date::format('M j, Y', $blogAndAuthorDetails["blog_created_at"]);
    $blogTitle = $blogAndAuthorDetails["blog_title"];
    $blogDescription = $blogAndAuthorDetails["blog_description"];
    $countBlogComment = $_blog->countComment($blog_id);

    //get blog comments
    $blogComments = $_blog->blogComments( $blog_id);
?>

<div class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
  <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
      <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
          <header class="mb-4 lg:mb-6 not-format">
              <address class="flex items-center mb-6 not-italic">
                  <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                      <div class="mr-2 w-16 h-16 rounded-full shadow-md bg-gray-200 flex items-center justify-center"><h1 class="leading-none font-medium text-gray-900 text-3xl"><?= $avatar ?></h1></div>
                      <div class="ml-2">
                          <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white"><?= $authorName ?></a>
                          <p class="text-base text-gray-500 dark:text-gray-400">Joined <?= $authorJoinedDate ?></p>
                          <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022"><?= $blogCreatedDate ?></time></p>
                      </div>
                  </div>
              </address>
              <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white"><?= $blogTitle ?></h1>
          </header>
          <p class="lead"><?= $blogDescription ?></p>
          <section class="not-format mt-8">
              <div class="flex justify-between items-center mb-6">
                  <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion (<?= $countBlogComment ?>)</h2>
              </div>
              <form class="my-6">
        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea id="comment" rows="6"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="Write a comment..."></textarea>
        </div>
        <button type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Post a comment</button>
        </form>
        <?php if($countBlogComment !== "no comment"):?>
                <?php foreach($blogComments as $blogComment):?>
                    <?php $reviewerName = $blogComment["user_name"]?>
                    <section class="bg-white dark:bg-gray-900 border-t border-b border-gray-200">
                        <div class="max-w-2xl mx-auto px-4">
    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><div
                        class="mr-2 w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-medium"><h1><?= firstLetter($reviewerName) ?></h1></div><?= $reviewerName ?></div>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                        title="February 8th, 2022"><?= Date::format("M j, Y", $blogComment["comment_date"]) ?></time></p>
            </div>
            <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
                <span class="sr-only">Comment settings</span>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownComment1"
                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                    </li>
                </ul>
            </div>
        </footer>
        <p class="text-gray-500 dark:text-gray-400"><?= $blogComment["comment_text"] ?></p>
        <div class="flex items-center mt-4 space-x-4">
            <a href="view-replies.php?blog-id=<?= $blog_id ?>&comment-id=<?= $blogComment["comment_id"] ?>" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium cursor-pointer">
                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                </svg>
                <?php $countReplies = $_blog->countReplies($blog_id, $blogComment["comment_id"]);  echo $countReplies ?>
            </a>
           
        </div>
    </article>
  </div>
</section>
<?php endforeach?>
<?php else:?>
    <h1 class="text-3xl">no comment yet</h1>
<?php endif?>
</section>
</article>
</div>
</div>

<aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
  <div class="px-4 mx-auto max-w-screen-xl">
      <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
      <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
          <article class="max-w-xs">
              <a href="#">
                  <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png" class="mb-5 rounded-lg" alt="Image 1">
              </a>
              <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                  <a href="#">Our first office</a>
              </h2>
              <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
              <a href="#" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                  Read in 2 minutes
              </a>
          </article>
          <article class="max-w-xs">
              <a href="#">
                  <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-2.png" class="mb-5 rounded-lg" alt="Image 2">
              </a>
              <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                  <a href="#">Enterprise design tips</a>
              </h2>
              <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
              <a href="#" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                  Read in 12 minutes
              </a>
          </article>
          <article class="max-w-xs">
              <a href="#">
                  <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-3.png" class="mb-5 rounded-lg" alt="Image 3">
              </a>
              <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                  <a href="#">We partnered with Google</a>
              </h2>
              <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
              <a href="#" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                  Read in 8 minutes
              </a>
          </article>
          <article class="max-w-xs">
              <a href="#">
                  <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-4.png" class="mb-5 rounded-lg" alt="Image 4">
              </a>
              <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                  <a href="#">Our first project with React</a>
              </h2>
              <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
              <a href="#" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                  Read in 4 minutes
              </a>
          </article>
      </div>
  </div>
</aside>

<?php include "components/footer.html.php"?>