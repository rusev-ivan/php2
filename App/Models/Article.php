<?php


namespace App\Models;


use App\Model;

class Article extends Model
{

    public const TABLE = 'news';

    public $title;
    public $content;
    public $author_id;

    public function author()
    {
        if (isset ($this->author_id)) {
            return 42;
        }
    }







}