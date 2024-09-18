<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportCompany extends Model
{
    protected $table = 'transport_company';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'company_name',
        'city_id',
        'HQ_address',
        'company_type_id',
        'description',
        'active',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }
}
