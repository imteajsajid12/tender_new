<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppDecisions extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_decisions';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['selected_interview_time','approved_interview_time','approved_interview_place','selected_interview_place'
    ,'last_interview_invitation_send',
    
    'approved_committee_time','committee_selected_place','last_committee_invitation_send','committee_invitation_approved_time'
    
    ,'is_appeared', '2nd_invitation_rejected'];

    function tender(){
        return $this->belongsTo(Tender::class,'tenderval');
    }


    function files(){
        return $this->hasMany(ApplicationFiles::class, 'app_dec_id' );
    }

    /**
     * Scope a query to only include accepted
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAccepted($query)
    {
        return $query->whereNotNull('approved_interview_place')->whereNotNull('committee_invitation_approved_time')->oldest('committee_invitation_approved_time');
    }

    /**
     * Scope a query to only include secondInvitationApproved
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSecondInvitationApproved($query)
    {
        return $query->whereNotNull('approved_committee_time')->whereNotNull('committee_invitation_approved_time')->oldest('approved_committee_time');
    }


}
