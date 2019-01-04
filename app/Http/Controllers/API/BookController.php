<?php

namespace App\Http\Controllers\API;

use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\Base as Base;
use App\Book;
class BookController extends Base
{

    public function index(){
        $books=Book::all();
        return $this->sendResponse($books->toArray(),'Books read successfully');
    }



    public function store(Request $request){
        $input=$request->all();
        $validator=\Validator::make($input,[
           'name'=>'required',
            'details'=>'required'
        ]);
        if ($validator->fails()){
            return $this->errorResponse('error validation',$validator->errors());
        }else{
           $book= Book::create([
                'name'=>$request->get('name'),
                'details'=>$request->get('details'),
            ]);
            return $this->sendResponse($book->toArray(),'Book added');
        }
    }



    public function show($id){
        $book= Book::find($id);

        if (is_null($book)){
            return $this->errorResponse('Book not found');
        }else{

            return $this->sendResponse($book->toArray(),'Book found');
        }
    }



    public function update(Request $request ,Book $book){
        $input=$request->all();
        $validator=\Validator::make($input,[
            'name'=>'required',
            'details'=>'required'
        ]);
        if ($validator->fails()){
            return $this->errorResponse('error validation',$validator->errors());
        }else{
            $book->name=$input['name'];
            $book->details=$input['details'];
            $book->save();
            return $this->sendResponse($book->toArray(),'Book updated');
        }
    }



    public function destroy(Book $book)
    {
        $book->delete();
        return $this->sendResponse($book->toArray(), 'Book deleted');
    }
}



