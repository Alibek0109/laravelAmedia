<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $guarded = false;

    public function app() {
        return $this->belongsTo(Application::class, 'app_id', 'id');
    }
}
