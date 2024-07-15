<?php

namespace App\Http\Controllers;

use App\Models\GovernmentTreeCutting;
use Illuminate\Http\Request;

class GovernmentTreeCuttingController extends Controller
{
    public function pendingGovernment()
    {
        $pendingGovernment = GovernmentTreeCutting::with(['user:id,name', 'admin:id,name'])
            ->select(
                'id',
                'user_id',
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
                'admin_id',
                'app_Date',
                'app_Agency',
                'app_Loc',
            )
            ->where('status', 'Pending')
            ->get();

        return response()->json([
            'PendingGovernment' => $pendingGovernment
        ], 200);
    }

    public function approvedGovernment(Request $request, $id)
    {
        $status = 'Approved';
        try {
            $pendingGovernment = GovernmentTreeCutting::findOrFail($id);
            $pendingGovernment->update([
                'app_letter_compliant' => $request->input('app_letter_compliant'),
                'app_letter_remarks' => $request->input('app_letter_remarks'),
                'endorsement_Certification_compliant' => $request->input('endorsement_Certification_compliant'),
                'endorsement_Certification_remarks' => $request->input('endorsement_Certification_remarks'),
                'siteDevtPlan_compliant' => $request->input('siteDevtPlan_compliant'),
                'siteDevtPlan_remarks' => $request->input('siteDevtPlan_remarks'),
                'ECC_CNC_compliant' => $request->input('ECC_CNC_compliant'),
                'ECC_CNC_remarks' => $request->input('ECC_CNC_remarks'),
                'FPIC_compliant' => $request->input('FPIC_compliant'),
                'FPIC_remarks' => $request->input('FPIC_remarks'),
                'consent_compliant' => $request->input('consent_compliant'),
                'consent_remarks' => $request->input('consent_remarks'),
                'clearance_compliant' => $request->input('clearance_compliant'),
                'clearance_remarks' => $request->input('clearance_remarks'),
                'status' => $status,
                'app_Date' => $request->input('app_Date'),
            ]);

            return response()->json(['message' => 'Government tree cutting request approved successfully', 'pendingGovernment' => $pendingGovernment], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to approved government tree cutting request', 'message' => $e->getMessage()], 500);
        }
    }

    public function declinedGovernment(Request $request, $id){
        $status = 'Declined';
    
        try {
            $pendingGovernment = GovernmentTreeCutting::findOrFail($id);
            $pendingGovernment->update([
                'status' => $status,
            ]);
    
            return response()->json(['message' => 'Government tree cutting request declined successfully', 'pendingGovernment' => $pendingGovernment], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to decline government tree cutting request', 'message' => $e->getMessage()], 500);
        }
    }
}
