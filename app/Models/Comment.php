<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
    // 关联商品
    public function goods()
    {
        return $this->belongsTo('App\Models\goods', 'gid');
    }
}
