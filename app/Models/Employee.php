<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function bank_account_details(): HasMany
    {
        return $this->hasMany(EmployeeBankAccountDetail::class);
    }

    public function company_details(): HasMany
    {
        return $this->hasMany(EmployeeCompanyDetail::class);
    }

    public function financial_details(): HasMany
    {
        return $this->hasMany(EmployeeFinancialDetail::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function performances(): HasMany
    {
        return $this->hasMany(Performance::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'].' '.$attributes['middle_name'].' '.$attributes['last_name'],
        );
    }

    protected function EmployeeNumber(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (EmployeeCompanyDetail::where('employee_id', $attributes['id'])->orderBy('created_at','DESC')->first())?->employee_number ,
        );
    }

    protected function Department(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (EmployeeCompanyDetail::where('employee_id', $attributes['id'])->orderBy('created_at','DESC')->first())?->department->name ,
        );
    }

    protected function Status(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (EmployeeCompanyDetail::where('employee_id', $attributes['id'])->orderBy('created_at','DESC')->first())?->status ,
        );
    }
}
