<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

        protected $guarded =[];
//    protected $fillable=['title'];

        protected $dates=['published_at'];

        //formatted_published_at
    public function getFormattedPublishedAtAttribute()
    {
//        Carbon::setLocale('cat_es');
//        dd($this->published_at->format('j \d\e F \d\e Y'));
        if(!$this->published_at) return '';
        $locale_date = $this->published_at->locale(config('app.locale'));
        return $locale_date->day . ' de ' . $locale_date->monthName . ' de ' . $locale_date->year;
    }
    public function getFormattedForHumansPublishedAtAttribute()
    {
        return optional($this->published_at)->diffForHumans(Carbon::now());
    }

    public function getPublishedAtTimestampAttribute()
    {
        return optional($this->published_at)->timestamp;
    }
}
