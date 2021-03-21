<?php

namespace App\Http\Model\companies;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\employees\Employee;
use Illuminate\Database\Eloquent\softDeletes;

class Company extends Model
{

    use SoftDeletes;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';

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
        'name', 'email', 'photo', 'website'
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

}
