<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    public function index() {
        $groups = Groupe::with(['columns.column_default', 'columns.value'])
        ->orderBy('id', 'asc')
        ->get();
        return response()->json($groups);
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required|string',
        ]);

        $group = Groupe::create(['title' => $request->title]);
        return response()->json(['message' => 'Group created!', 'group' => $group], 201);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string',
        ]);
        $group = Groupe::find($id);
        $group->update(['title' => $request->title]);
        return response()->json(['message' => 'Group updated!', 'group' => $group], 200);
    }

    public function delete($id) {
        $group = Groupe::find($id);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        $group->delete();
        return response()->json(['message' => 'Group deleted!', 'group' => $group], 200);
    }
}
