<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
    'equipment_code',
    'equipment_name',
    'problem_detail',
    'urgency',
    'reporter_name',
    'image_path',
    'status',
    'repair_details',
    'price',
    'slip_path',
    'payment_status'
];
}