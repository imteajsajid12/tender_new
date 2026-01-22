<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Application extends Model
{
    use HasFactory, Encryptable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'applications';

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
    protected $fillable = [
        'status',
        'sender',
        'send_date',
        'form_id',
        'email',
        'type',
        'department',
        'tenderval',
        'encryption_key_slot'
    ];

    /**
     * The attributes that should be encrypted/decrypted automatically.
     *
     * @var array
     */
    protected $encryptable = [
        'email'
    ];

    /**
     * Get the files associated with this application.
     */
    public function files()
    {
        return $this->hasMany(ApplicationFiles::class, 'app_id', 'id');
    }

    /**
     * Get the decision associated with this application.
     */
    public function decision()
    {
        return $this->hasOne(AppDecisions::class, 'p5_id', 'id');
    }
}
