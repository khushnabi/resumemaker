<?php

namespace App;
use App\Experience;
use App\Education;
use App\Skill;
use App\Summary;
use App\Custom;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
  protected $guarded = ["id"];

  public function experiences() {
    return $this->hasMany(Experience::class);
  }

  public function educations() {
    return $this->hasMany(Education::class);
  }

  public function skills() {
    return $this->hasMany(Skill::class);
  }

  public function summaries() {
    return $this->hasMany(Summary::class);
  }

  public function customs() {
    return $this->hasMany(Custom::class);
  }

}
