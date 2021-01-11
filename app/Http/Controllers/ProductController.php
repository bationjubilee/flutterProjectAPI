<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {   
        $record = Product::all();


        return response()->json($record);
    }

    public function create(Request $request){

        $record = new Product;
        $record->idNumber = $request->idNumber;
        $record->fullName = $request->fullName;
        $record->password = $request->password;
        $record->course = $request->course;
        $record->save();

        return response()->json(['status' => true, 'message' => 'Record Created']);
    }

    public function update(Request $request, $id)
    {   
        try{
            $record = Product::findOrFail($id);
            $record->idNumber = $request->idNumber;
            $record->fullName = $request->fullName;
            $record->password = $request->password;
            $record->course = $request->course;
            $record->save();

            return response()->json(['status' => true, 'message' => 'succesfully updated']);
        } catch(\Exception $e) {
            return response()->json(['status' => false]);
        }

    }

    public function delete($id){
        try{
            $record = Product::findOrFail($id);
            $record->delete();

            return response()->json(['status' => true, 'message' => 'succesfully deleted']);


        }catch(\Exception $e){
            return response()->json(['status' => false]);
        }
    }
}
