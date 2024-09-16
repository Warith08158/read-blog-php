<?php 
    include "components/header.html.php";
    require "config/init.php";

    $blog_id = (int) $_GET["blog-id"];
    $comment_id = (int) $_GET["comment-id"];


    $blog = new Blog_view();
    $blog->replies($_GET);
    $aBlog = $blog->aBlog($blog_id);
    $author_name = $aBlog["user_name"];
    $avatar = firstLetter($author_name);
    $blog_date = $aBlog["blog_created_at"];
    $blog_text = $aBlog["blog_description"];
    $blog_title = $aBlog["blog_title"];
    $aComment = $blog->aComment($blog_id, $comment_id);
    $commentReplies = $blog->commentReplies($blog_id, $comment_id);
?>
<section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
  <div class="max-w-xl mx-auto px-4 bg-gray-50 p-4 rounded-md">
  <h1 class="mb-4 text-xl font-medium text-gray-600">Reply to a comment</h1>
  <article class="p-6 rounded text-base bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center text-sm text-gray-900 dark:text-white font-semibold"><div class="mr-2 w-8 h-8 rounded-full shadow-md bg-gray-200 flex items-center justify-center"><h1 class="leading-none font-medium text-gray-900 text-lg"><?= $avatar ?></h1></div><?= $author_name ?> <span class="text-sm ml-2 bg-blue-500 text-blue-100 rounded-lg px-2 py-1">Author</span></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-4"><time pubdate datetime="<?= $blog_date ?>"
                        title="June 23rd, 2022"><?= Date::format('M j, Y' , $blog_date) ?></time></p>
            </div>
            <!-- Dropdown menu -->
            <div id="dropdownComment4"
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
        <h1 class="text-xl mt-6 mb-2 text-gray-800 font-normal"><?= $blog_title ?></h1>
        <p class="text-gray-500 dark:text-gray-400"><?= $blog_text ?></p>
        
        <div class="flex items-center mt-4 space-x-4">
            <button type="button"
                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                </svg>
                20 comments
            </button>
            <button type="button"
                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                </svg>
                10 reactions
            </button>
        </div>
    </article>

    <article class="p-6 rounded text-base mt-6 bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900 ml-5">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><div class="mr-2 w-6 h-6 rounded-full shadow-md bg-gray-200 flex items-center justify-center font-normal"><?= firstLetter($aComment["user_name"]) ?></div><?= $aComment["user_name"] ?></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-4"><time pubdate datetime="2022-06-23"
                        title="<?= Date::format("M j, Y", $aComment["comment_date"]) ?>"><?= Date::format("M j, Y", $aComment["comment_date"]) ?></time></p>
            </div>
            <!-- Dropdown menu -->
            <div id="dropdownComment4"
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
        <p class="text-gray-500 dark:text-gray-400"><span class="font-medium text-blue-700">@on-post</span> <?= $aComment["comment_text"] ?></p>
        <div class="flex items-center mt-4 space-x-4">
            <button type="button"
                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                </svg>
                Reply
            </button>
        </div>
    </article>

    <?php foreach($commentReplies as $reply): ?>
        <article class="p-4 rounded text-base bg-white/80 border-t border-b border-gray-300 dark:border-gray-700 dark:bg-gray-900 mt-6 ml-10">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><div
                        class="mr-2 w-6 h-6 rounded-full shadow-md bg-gray-200 flex items-center justify-center font-normal"><?= firstLetter($reply["user_name"]) ?></div><?= $reply["user_name"] ?></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-4"><time pubdate datetime="<?= DATE::format("M j, Y", $reply["reply_date"]) ?>"
                        title="<?= DATE::format("M j, Y", $reply["reply_date"]) ?>"><?= DATE::format("M j, Y", $reply["reply_date"]) ?></time></p>
            </div>
            <!-- Dropdown menu -->
            <div id="dropdownComment4"
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
        <p class="text-gray-500 dark:text-gray-400 text-sm"><span class="font-medium text-blue-700 mr-2">@Helen Engels</span><?= $reply["reply_text"] ?></p>
        <div class="flex items-center mt-4 space-x-4">
        </div>
    </article>
    <?php endforeach ?>

    <form>
        <div class="py-2 px-4 mb-4 mt-6 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <label for="comment" class="sr-only">Reply</label>
            <input id="comment" rows="6"
                class="px-0 text-sm w-full text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="@solaudeenwarith"></input>
        </div>
        <button type="submit"
            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
            Post a reply
        </button>
    </form>
  </div>
</section>
<?php 
    include "components/footer.html.php";
?>