<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;

    protected $fillable = [
        'tree_id',
        'com_Name',
        'sci_Name',
        'fam_Name',
        'barangay',
        'municipality',
        'province',
        'Lat',
        'Lng',
        'origin',
        'conserve_Status',
        'uses',
        'tagging_Stat'
    ];
}
