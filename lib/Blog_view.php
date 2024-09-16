<?php
declare(strict_types=1);

class Blog_view extends Blog
{
    public function allBlogs(): array
    {
        $sql = "SELECT blogs.*, users.user_id, users.user_name, users.user_email, users.user_password 
                FROM blogs
                INNER JOIN users 
                ON users.user_id = blogs.blog_author_id 
                ORDER BY blogs.blog_created_at 
                ASC";
        $allBlogs = $this->getAllBlogs($sql);

        foreach($allBlogs as &$blog){
            $blog["blog_created_at"] = Date::format("M j, Y", $blog["blog_created_at"]);
            $blog["author_name"] = $blog["user_name"];
        }

        return $allBlogs;
    }

    public function aBlog(int $blog_id): array
    {
        $sql = "SELECT blogs.*, users.user_id, users.user_name, users.user_created_at 
                FROM blogs INNER JOIN users ON blogs.blog_author_id = users.user_id 
                WHERE blogs.blog_id = {$blog_id}";

        return $this->getAblog($sql);

    }

    public function countComment(string $blog_id): int | string
    {
        $sql = "SELECT COUNT(reply_blog_id) FROM replies WHERE reply_blog_id = {$blog_id}";
        $replyCount = $this->getBlogComments($sql)["COUNT(reply_blog_id)"];
        $sql = "SELECT COUNT(comment_blog_id) FROM comments WHERE comment_blog_id = {$blog_id}";
        $commentCount = $this->getBlogComments($sql)["COUNT(comment_blog_id)"];
        $totalComment = $replyCount + $commentCount;
                
        if($totalComment < 1){
            return "no comment";
        }else if($totalComment > 1){
            return $totalComment." comments";
        }else{
            return $totalComment." comment";
        }

    }

    public function firstReviewer(int $blog_id):array
    {
        $sql = "SELECT users.user_name, comments.comment_id, comments.comment_reviewer_id, comments.comment_text, comments.comment_date 
        FROM users 
        INNER JOIN comments 
        ON users.user_id = comments.comment_reviewer_id 
        WHERE comment_blog_id = {$blog_id} 
        LIMIT 1";

        $firstReviewerDetails = $this->getFirstReview($sql);

        return [
                "name" => $firstReviewerDetails["user_name"],
                "id" => $firstReviewerDetails["comment_reviewer_id"],
                "comment_id" => $firstReviewerDetails["comment_id"],
                "review" => $firstReviewerDetails["comment_text"],
                "comment_date" => Date::format("M j, Y", $firstReviewerDetails["comment_date"]),
               ];
    }

    public function blogAndAuthor(string $blog_id): array
    {
        $sql = "SELECT blogs.*, users.user_id, users.user_name, users.user_email, users.user_created_at 
                FROM blogs 
                INNER JOIN users 
                WHERE blog_id = {$blog_id} 
                AND users.user_id = blogs.blog_author_id";

        return $this->getBlogAndAuthor($sql);
    }

    public function blogComments(int $blog_id): array
    {
        $sql = "SELECT comments.*, users.user_id, users.user_name, users.user_email 
                FROM users 
                INNER JOIN comments 
                ON users.user_id = comments.comment_reviewer_id 
                WHERE comments.comment_blog_id = {$blog_id}";

        return $this->getAllComments($sql);
    }

    public function countReplies(int $blog_id, int $comment_blog_id): string
    {
        // var_dump($blog_id, $comment_blog_id);
        $sql = "SELECT COUNT(*) 
                FROM replies 
                WHERE {$blog_id} = replies.reply_blog_id 
                AND {$comment_blog_id} = replies.reply_on_comment_id";

        $countReplies = $this->getCountReplies($sql);

        if($countReplies < 1){
            return "Reply";
        }elseif($countReplies == 1){
            return $countReplies . " Reply";
        }else{
            return $countReplies . " Replies";
        }
    }

    public function repliesTotal(int $blog_id): string
    {
        // var_dump($blog_id, $comment_blog_id);
        $sql = "SELECT COUNT(*) 
                FROM replies 
                WHERE {$blog_id} = replies.reply_blog_id";

        $countReplies = $this->getCountReplies($sql);

        if($countReplies < 1){
            return "Reply";
        }elseif($countReplies == 1){
            return $countReplies . " Reply";
        }else{
            return $countReplies . " Replies";
        }
    }

    public function replies(array $urlparams)
    {
        $blog_id = (int) $urlparams["blog-id"];
        $comment_id = (int) $urlparams["comment-id"];

        if(empty($blog_id ) || empty($comment_id)){
            header("location:/");
            return;
        }

        $sql = "SELECT replies.* 
                FROM comments 
                INNER JOIN replies 
                ON comments.comment_id = replies.reply_on_comment_id 
                WHERE comments.comment_id ={$comment_id}";
    }

    public function aComment(int $blog_id, int $comment_id): array
    {
        $sql = "SELECT comments.comment_text, comments.comment_date, comments.comment_id, users.user_name 
                FROM comments
                INNER JOIN users ON comments.comment_reviewer_id = users.user_id 
                WHERE comment_blog_id = {$blog_id} 
                AND comment_id ={$comment_id}";
        return $this->getAcomment($sql);
    }

    public function commentReplies(int $blog_id, int $comment_id)
    {
        $sql = "SELECT replies.reply_text, replies.reply_date, users.user_name
                FROM replies INNER JOIN users
                ON replies.reply_reviewer_id = users.user_id
                WHERE replies.reply_blog_id = {$blog_id} 
                AND replies.reply_on_comment_id = {$comment_id}";
        return $this->getCommentReplies($sql);
    }
}