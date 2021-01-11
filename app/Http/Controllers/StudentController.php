<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $record = Student::all();
        return response()->json($record);
    }


    /**public function login(Request $request)
    {
        $credentials = $request->only('idNumber' ,'password');
        if ($token = auth('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['status' => false, 'error' =>'Invalid idNmuber or password']);
    } */

    public function create(Request $request){

        $record = new Student;
        $record->idNumber = $request->idNumber;
        $record->fullName = $request->fullName;
        $record ->password = Hash::make($request->password);
        $record->course = $request->course;
        $record->phnNumber = $request->phnNumber;
        $record->save();

        return response()->json(['status' => true, 'message' => 'Record Created']);
    }

    public function update(Request $request, $id)
    {   
        try{
            $record = Student::findOrFail($id);
            $record->idNumber = $request->idNumber;
            $record->fullName = $request->fullName;
            $record ->password = Hash::make($request->password);
            $record->course = $request->course;
            $record->phnNumber = $request->phnNumber;
            $record->save();

            return response()->json(['status' => true, 'message' => 'succesfully updated']);
        } catch(\Exception $e) {
            return response()->json(['status' => false]);
        }

    }

    public function delete($id){
        try{
            $record = Student::findOrFail($id);
            $record->delete();

            return response()->json(['status' => true, 'message' => 'succesfully deleted']);


        }catch(\Exception $e){
            return response()->json(['status' => false]);
        }
    }
}
