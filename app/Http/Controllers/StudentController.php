<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\City;
use App\Models\Group;

class StudentController extends Controller
{   

    



    // Rodyti visus studentus su miestais (index)
    public function index()
    {
        $students = Student::with('city')->paginate(20);
        return view('students.index', compact('students'));
    }

    // Formos rodymas naujam studentui sukurti
    public function create()
   {
    $cities = City::all();
    $groups = Group::all(); // <- pridėta
    return view('students.create', compact('cities', 'groups'));
}

    // Naujo studento įrašymas
    public function store(Request $request)
   {
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'address' => 'required|string',
        'phone' => 'required|string|max:20',
        'city_id' => 'required|exists:cities,id',
        'grupe_id' => 'nullable|exists:groups,id', // <- pridėta
        'gim_data' => 'nullable|date',             // <- pridėta
    ]);

    Student::create($request->only(['name','surname','address','phone','city_id','grupe_id','gim_data']));

    return redirect()->route('students.index')->with('success', 'Studentas pridėtas!');
}

    // Redagavimo forma
    public function edit(Student $student)
    {
    $cities = City::all();
    $groups = Group::all(); // <-- pridėta
    return view('students.edit', compact('student', 'cities', 'groups'));
}

   // Atnaujinti studento duomenis
    public function update(Request $request, Student $student)

    {
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'address' => 'required|string',
        'phone' => 'required|string|max:20',
        'city_id' => 'required|exists:cities,id',
        'grupe_id' => 'nullable|exists:groups,id', // <- pridėta
        'gim_data' => 'nullable|date',             // <- pridėta
    ]);

    $student->update($request->only(['name','surname','address','phone','city_id','grupe_id','gim_data']));

    return redirect()->route('students.index')->with('success', 'Studentas atnaujintas!');
}


    // Ištrinti studentą
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Studentas ištrintas!');
    }




// Rodyti ir ištrintus studentus (withTrashed())
public function trashed()
{
     $students = Student::onlyTrashed()->with('city')->paginate(20);
    return view('students.trashed', compact('students'));
}

// Atkurti ištrintą studentą (restore())
public function restore($id)
{
    Student::withTrashed()->findOrFail($id)->restore();
    return redirect()->route('students.trashed')->with('success', 'Studentas atkurtas!');
}

// Visiškai ištrinti (forceDelete())
public function forceDelete($id)
{
    Student::withTrashed()->findOrFail($id)->forceDelete();
    return redirect()->route('students.trashed')->with('success', 'Studentas visam laikui pašalintas.');
}
}
  


