<?php

namespace App;
use App\Resume;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded = ["id"];

    public function resume() {
        return $this->belongsTo(Resume::class);
    }
}
