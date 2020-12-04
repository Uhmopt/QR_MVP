<?php

namespace App;

// use willvincent\Rateable\Rateable;
use App\MyModel;

class Branch extends MyModel
{
    // use Rateable;
    protected $fillable = ['name', 'user_id', 'restorant_id','description'];
    protected $appends = ['alias','logom','icon','coverm'];
    protected $imagePath='/uploads/restorants/';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function restorant()
    {
        return $this->belongsTo('App\Restorant');
    }

    public function getAliasAttribute()
    {
        return $this->subdomain;
    }

    public function getLogomAttribute()
    {
        return $this->getImge($this->restorant->logo,config('global.restorant_details_image'));
    }

    public function getIconAttribute()
    {
        return $this->getImge($this->restorant->logo,str_replace("_large.jpg","_thumbnail.jpg",config('global.restorant_details_image')),"_thumbnail.jpg");
    }
    
    public function getCovermAttribute()
    {
        return $this->getImge($this->cover,config('global.restorant_details_cover_image'),"_cover.jpg");
    }

    // public function hours()
    // {
    //     return $this->hasOne('App\Hours','restorant_id','id');
    // }
}