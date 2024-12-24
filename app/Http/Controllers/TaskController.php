<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::with('values')
        ->orderBy('id', 'desc')
        ->get();
        return response()->json($tasks);
    }

    // public function update(Request $request, $id) {
    //     $request->validate([
    //         'title' => 'required|string',
    //     ]);
    //     $group = Groupe::find($id);
    //     $group->update(['title' => $request->title]);
    //     return response()->json(['message' => 'Group updated!', 'group' => $group], 200);
    // }

    // public function delete($id) {
    //     $group = Groupe::find($id);
    //     if (!$group) {
    //         return response()->json(['message' => 'Group not found'], 404);
    //     }
    //     $group->delete();
    //     return response()->json(['message' => 'Group deleted!', 'group' => $group], 200);
    // }
}
