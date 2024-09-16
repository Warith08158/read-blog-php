<?php
declare(strict_types=1);

abstract class Blog extends Database_handler
{
    protected function getAllBlogs( string $sql): array
    {
        return $this->fetchAll($sql);
    }

    protected function getComments( string $sql): int
    {
        return $this->fetch($sql)["COUNT(comment_blog_id)"];
    }

    protected function getFirstReview( string $sql): array
    {
        return $this->fetch($sql);
    }

    protected function getBlogAndAuthor( string $sql): array
    {
        return $this->fetch($sql);
    }

    protected function getAllComments( string $sql): array
    {
        return $this->fetchAll($sql);
    }

    protected function getCountReplies( string $sql): int
    {
        return $this->fetch($sql)["COUNT(*)"];
    }

    protected function getReplies( string $sql):array
    {
        return $this->fetchAll($sql);
    }

    protected function getAblog(string $sql)
    {
        return $this->fetch($sql);
    }

    protected function getBlogComments(string $sql){
        return $this->fetch($sql);
    }

    protected function getAcomment(string $sql){
        return $this->fetch($sql);
    }

    protected function getCommentReplies(string $sql)
    {
        return $this->fetchAll($sql);
    }

}