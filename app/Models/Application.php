<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'applications';
    protected $guarded = false;

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function feedback() {
        return $this->hasOne(Feedback::class, 'app_id', 'id');
    }
    
}
