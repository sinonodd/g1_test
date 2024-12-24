<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'groupe_id' => 'required|integer',
            'type' => 'required'
        ]);

        $column = Column::create(['title' => $request->title, 'groupe_id' => $request->groupe_id, 'type' => $request->type]);
        return response()->json(['message' => 'Column created!', 'column' => $column], 201);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string',
        ]);
        $column = Column::find($id);
        $column->update(['title' => $request->title]);
        return response()->json(['message' => 'Column updated!', 'column' => $column], 200);
    }

    public function delete($id) {
        $column = Column::find($id);
        if (!$column) {
            return response()->json(['message' => 'Column not found'], 404);
        }
        $column->delete();
        return response()->json(['message' => 'Column deleted!', 'column' => $column], 200);
    }
}
