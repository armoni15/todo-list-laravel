<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;

class TodoListController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'todolists' => TodoList::where('user_id', auth()->user()->id)->latest()->paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'checklist' => 'required',
            'user_id' => 'required'
        ]);

        TodoList::create($validatedData);

        return redirect('/dashboard')->with('succes', 'Success, to do list has been added!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'checklist' => 'required',
            'user_id' => 'required'
        ]);

        TodoList::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'checklist' => $request->checklist,
                'user_id' => $request->user_id
            ]);

        return redirect('/dashboard')->with('succes', 'Success, to do list has been updated!');
    }

    public function destroy(Request $request)
    {
        TodoList::destroy($request->id);

        return redirect('/dashboard')->with('succes', 'Success, to do list has been deleted!');
    }

    public function completed(Request $request)
    {
        $todolist = TodoList::find($request->id);

        if ($todolist->checklist == 1) {
            TodoList::where('id', $request->id)
                ->update([
                    'checklist' => '0'
                ]);
            return redirect('/dashboard');
        } else {
            TodoList::where('id', $request->id)
                ->update([
                    'checklist' => '1'
                ]);
            return redirect('/dashboard');
        }
    }
}
