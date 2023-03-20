<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Illuminate\Database\QueryException as QE;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos=Product::all(); //all select * from

        if($productos->isEmpty()){
            return response()->json([
                "status"=>"No elements in DB"
            ],400);
        }else{
            return response()->json($productos,Response::HTTP_OK);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        try{
            $jsonProduct = $request->json()->all();

            $product = new Product($jsonProduct);

            $product->save();

            return response()->json([
                'status'=>'accepted',
                'product'=>$product
            ],200);
        }catch(QE $exception){
            return response()->json([
                'status'=>'rejected',
                'message'=>$exception->errorInfo,
            ],400);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $nombre)  //show por tipo
    {
        $productos = Product::where('tipo',$nombre)->get();

        if($productos->isEmpty()){
            return response()->json([
                "status"=>"Not Found"
            ],400);
        }else{
            return response()->json($productos,Response::HTTP_OK);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        try {

            $jsonProduct = $request->json()->all();

            if(!empty($jsonProduct)){

                $productos = Product::where('id',$id)->update($request->only('nombre','tipo','cantidad'));

                if ($productos == 1){
                    return response()->json([
                        'status'=>'accepted',
                        'id'=>$id,
                        'product'=>$productos
                    ],200);
                }else{
                    return response()->json([
                        'status'=>'rejected',
                        'message'=> 'ID don´t exist, not all body in, or same info in',
                    ],400);
                }
            }

        } catch (QE $exception) {
            return response()->json([
                'status'=>'rejected',
                'message'=>$exception->errorInfo,
            ],400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try{
            $productos = Product::where('id',$id)->delete();

            return response()->json([
                "status"=>"Deleted"
            ],200);
        }catch(QE $exception){
            return response()->json([
                'status'=>'Not Found',
                'message'=>$exception->errorInfo,
            ],400);
        }

    }
}
