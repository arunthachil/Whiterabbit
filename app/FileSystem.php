<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileSystem extends Model
{
    protected $fillable = [
        'sha_value', 'filename'
    ];

    protected $table = 'filesystem';
}
