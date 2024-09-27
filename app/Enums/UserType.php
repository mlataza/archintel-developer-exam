<?php 

namespace App\Enums;

enum UserType: string 
{
    case WRITER = "Writer";
    case EDITOR = "Editor";
};