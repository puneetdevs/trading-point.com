<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'company_symbol',
        'email',
        'start_date',
        'end_date',
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

    protected $dates = [
        'start_date',
        'end_date',
    ];

    // Date Modifications
    public static function viewDate($value)
    {
        $timestamp = strtotime($value);
        if ($timestamp < strtotime('1990-01-01') || $timestamp == strtotime('1970-01-01')) {
            return null;
        } else {
            return date($timestamp);
        }
    }
}
