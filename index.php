
<?php 

    include "components/header.html.php";
    require "config/init.php";
    $_blog = new Blog_view();
    $allBlogs = $_blog->allBlogs();

?>

<section class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">We invest in the world’s potential</h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="/" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Get started
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            <a href="/" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                Learn more
            </a>  
        </div>
    </div>
</section>

<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
    <div class="max-w-2xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Trending today (<?= count($allBlogs) ?>)</h2>
    </div>

    <?php foreach($allBlogs as $blog):?>
    <div class="border-t rounded-lg mb-10">
        <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 border-b">
            <footer class="flex justify-between items-center mb-2 border-b pb-6">
                <div class="flex items-center">
                    <a href="view-user-profile?id=<?= $blog["user_id"] ?>" class="inline-flex items-center mr-3">
                        <div class="mr-2 w-8 h-8 rounded-full shadow-md bg-gray-200 flex items-center justify-center"><h1 class="leading-none font-medium text-gray-900 text-lg"><?=firstLetter($blog["author_name"])?></h1></div>
                        <span class="text-sm text-gray-900 dark:text-white font-semibold"><?= $blog["author_name"] ?></span>
                    </a>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                            title="February 8th, 2022"><?= $blog["blog_created_at"] ?></time></p>
                </div>
                <p class="text-xs bg-green-200 py-1 px-2 text-gray-600 rounded-md"><?= $blog["blog_tag"] ?></p>
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
            <a href="view-blog.php?id=<?= $blog["blog_id"] ?>" class="cursor-pointer text-lg mt-4 underline text-gray-600 font-medium pb-1"><?= $blog["blog_title"] ?></a>
            <p class="text-gray-500 dark:text-gray-400 mt-4"><?= $blog["blog_description"] ?></p>
            <div class="flex items-center mt-4 space-x-4">
                <a href="blog-comments?id=<?= $blog["blog_id"]?>"
                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                    </svg>
                    <?= $_blog->countComment($blog["blog_id"])?>
                </a>
            </div>
        </article>

    <?php if($_blog->countComment($blog["blog_id"]) !== "no comment"): ?>
    <article class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900 border-b border-t">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">

             <?php $firstReviewer = $_blog->firstReviewer($blog["blog_id"]) ?>
             
                <a href="view-user-profile.php?=<?= $firstReviewer["id"] ?>" class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                <div class="mr-2 w-6 h-6 rounded-full shadow-md bg-gray-200 flex items-center justify-center"><h1 class="leading-none font-medium text-gray-900 text-base"><?=firstLetter($firstReviewer["name"])?></h1></div>
                        <?= $firstReviewer["name"] ?></a>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-12"
                        title="February 12th, 2022"><?= $firstReviewer["comment_date"] ?></time></p>
            </div>

            <div id="dropdownComment2"
                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="/"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <a href="/"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                    </li>
                    <li>
                        <a href="/"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                    </li>
                </ul>
            </div>
        </footer>
        <p class="text-gray-500 dark:text-gray-400"><?= $firstReviewer["review"] ?></p>
        <div class="flex items-center mt-4 space-x-4">
            <?php
                $comment_id = $firstReviewer["comment_id"];
                $id_blog = $blog["blog_id"];

                $repliesTotal = $_blog->repliesTotal($id_blog);
             ?>
            <a href="view-replies.php?blog-id=<?= $id_blog ?>&comment-id=<?= $comment_id ?>"
                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                </svg>                
                <?= $repliesTotal ?>
            </a>
        </div>
    </article>
    <?php endif ?>
    </div>
    <?php endforeach?>
  </div>
</section>

<?php include "components/footer.html.php" ?>