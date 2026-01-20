<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderApplication extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_decisions';


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
        return $query->whereNotNull('approved_interview_place')->whereNotNull('approved_interview_time')->oldest('invitation_accept_time');
    }

    /**
     * Scope a query to only include secondInvitationApproved
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSecondInvitationApproved($query)
    {
        return $query->whereNotNull('approved_committee_time')->whereNotNull('invitation_accept_time')->oldest('approved_committee_time');
    }


}
