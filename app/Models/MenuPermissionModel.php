<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPermissionModel extends BaseModel
{
    use HasFactory;

    protected $table = 'menu_permission';

    protected $guarded = [];
}
