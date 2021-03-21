<?php

namespace App\Http\Model\employees;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\companies\Company;
use Illuminate\Database\Eloquent\softDeletes;

class Employee extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

}
