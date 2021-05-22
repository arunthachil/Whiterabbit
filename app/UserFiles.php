<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFiles extends Model
{
    protected $fillable = [
        'fileid', 'userid'
    ];
    protected $table = 'userfiles';
}
