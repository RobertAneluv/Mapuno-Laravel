<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentTreeCutting extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'admin_id',
        'app_letter',
        'app_letter_compliant',
        'app_letter_remarks',
        'endorsement_Certification',
        'endorsement_Certification_compliant',
        'endorsement_Certification_remarks',
        'siteDevtPlan',
        'siteDevtPlan_compliant',
        'siteDevtPlan_remarks',
        'ECC_CNC',
        'ECC_CNC_compliant',
        'ECC_CNC_remarks',
        'FPIC',
        'FPIC_compliant',
        'FPIC_remarks',
        'consent',
        'consent_compliant',
        'consent_remarks',
        'clearance',
        'clearance_compliant',
        'clearance_remarks',
        'status',
        'app_Date',
        'app_Agency',
        'app_Loc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
