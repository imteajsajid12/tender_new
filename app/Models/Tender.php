<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'job_details' => 'array',
        // 'functional_level' => 'array',
    ];

    function user(){
        return $this->belongsToMany(User::class,'tender_user');
    }


    function files(){
        return $this->hasMany(TenderFiles::class,'tender_id');
    }

    function applications(){
        return $this->hasMany(AppDecisions::class,'tenderval','generated_id');
    }

    function decisionMaker(){
        return $this->hasMany(DecisionMaker::class, 'tender_id','generated_id');
    }

    function decision(){
        return $this->hasOne(TenderDecision::class, 'tender_id','generated_id');
    }


    function getFunctionalLevelAttribute($functional_level){
        return json_decode($functional_level,JSON_UNESCAPED_UNICODE);
    }


    function template(){
        return $this->belongsTo(Template::class,'template_id');
    }

    
}
