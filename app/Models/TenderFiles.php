<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderFiles extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenders_files';

    use HasFactory;

    function tender(){
        return $this->belongsTo(Tender::class,'tender_id');
    }
}
