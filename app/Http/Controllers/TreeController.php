<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function Trees()
    {
        $trees = Tree::with('tagger:id,firstname') // Adjust the fields as necessary
            ->select(
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
                'tagging_Stat'
            )
            ->where('Tree_Status', '1')
            ->get();
    
        return response()->json([
            'trees' => $trees
        ], 200);
    }

    public function SearchQuery(Request $request)
{
    $query = $request->input('query');
    $Target = 100;
    $Status1 = "Deforestation";
    $Status2 = "Ado Puno toy";
    $Reco1 = "Tree Planting, Tree Tagging";
    $Reco2 = "Maintain It";
    
    $trees = Tree::where(function($q) use ($query) {
                $q->where('address', 'LIKE', "%$query%");
            })
            ->where('Tree_Status', '1')
            ->get();

    $aliveCount = $trees->where('tagging_Stat', 'Alive')
                        ->where('Tree_Status', '1')
                        ->count();

    $deadCount = $trees->where('tagging_Stat', 'Dead')
                       ->where('Tree_Status', '1')
                       ->count();

    $status = $aliveCount < $Target ? $Status1 : $Status2;
    $recommendation = $aliveCount < $Target ? $Reco1 : $Reco2;

    $responseData = [
        'trees' => $trees,
        'aliveCount' => $aliveCount,
        'deadCount' => $deadCount,
        'status' => $status,
        'recommendation' => $recommendation,
        'target' => $Target,
        'search' => $query,
    ];

    // Return JSON response
    return response()->json($responseData);
}

    public function deleteTree(Request $request, $id){
        $SoftDelete = '2';
    
        try {
            $tree = Tree::findOrFail($id);
            $tree->update([ 
                'Tree_Status' => $SoftDelete,
            ]);
    
            return response()->json(['message' => 'Tree updated successfully', 'tree' => $tree], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 

    public function treeUpdate(Request $request, $id)
    {
        try {
            $tree = Tree::findOrFail($id);
            $tree->update([ 
                'com_Name' => $request->input('com_Name'),
                'sci_Name' => $request->input('sci_Name'),
                'fam_Name' => $request->input('fam_Name'),
                'origin' => $request->input('origin'),
                'conserve_Status' => $request->input('conserve_Status'),
                'uses' => $request->input('uses'),
                'tagging_Stat' => $request->input('tagging_Stat'),
            ]);

            return response()->json(['message' => 'Tree updated successfully', 'tree' => $tree], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
              
}

