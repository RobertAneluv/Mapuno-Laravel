<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'com_Name',
        'sci_Name',
        'fam_Name',
        'address',
        'Lat',
        'Lng',
        'origin',
        'conserve_Status',
        'uses',
        'tagger',
        'tree_pic',
        'tagging_Stat',
        'Tree_Status',
    ];

    public function tagger()
    {
        return $this->belongsTo(User::class, 'tagger');
    }
}
