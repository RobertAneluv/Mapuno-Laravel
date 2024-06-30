<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function aliveTree()
    {
        $status = 'Alive';
        
        $trees = Tree::select('tree_id', 'Lat', 'Lng')
                     ->where('tagging_Stat', '=', $status)
                     ->get();
                     
        return response()->json([
            'trees' => $trees,
            'message' => 'Successfully retrieved alive trees.',
        ], 200);
    }
}
