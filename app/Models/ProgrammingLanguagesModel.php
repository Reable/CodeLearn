<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguagesModel extends Model
{
    use HasFactory;
    protected $table ='programming_languages';
    protected $primaryKey = 'language_id';
}
