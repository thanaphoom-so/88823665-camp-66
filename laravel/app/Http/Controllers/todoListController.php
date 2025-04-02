<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;

class todoListController extends Controller
{
    function index(){
        return view('final');
    }

    function store(Request $req){
        $todoList = new TodoList();
        $todoList->name = $req->input('tasks');
        $todoList->description = $req->input('dest');
        $todoList->save();
        return redirect('/final-camp');
    }

    public function delete($id) {
        TodoList::destroy($id);
        return redirect('/final-camp');
    }
}
