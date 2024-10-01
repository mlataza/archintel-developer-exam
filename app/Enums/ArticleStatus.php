<?php 

namespace App\Enums;

enum ArticleStatus: string 
{
    case FOR_EDIT = "For Edit";
    case PUBLISHED = "Published";
};