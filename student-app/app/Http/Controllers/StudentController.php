<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;



class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();   
        return response()->json($students);
    }  
    public function store(Request $request)
    {
        $students = new Student([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'image' => $request->input('image'),
            'status' => $request->input('status'),



        ]);
        $students->save();
        return response()->json('Students created!');
    }
    public function show($id)
    {
        $contact = Student::find($id);
        return response()->json($contact);
    }
    public function update(Request $request, $id)
    {
       $students = Student::find($id);
       $students->update($request->all());
       return response()->json('Student updated');
    }
    public function destroy($id)
    {
        $students = Student::find($id);
        $students->delete();
        return response()->json(' deleted!');
    }
}
