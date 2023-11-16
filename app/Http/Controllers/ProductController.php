<?php

namespace App\Http\Controllers;
//تم ربطه بلمودل عن طريق --model
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

     public function index()
    {

       $product="";
        $product= Product::latest()->paginate(5);
       

       return view('products.index',compact('product'))->with('i',(request()->input('page',1)-1) * 5);

    }

   
    public function create()
    {
        
        return view('products.create');
    }

  
    public function store(Request $request)
    {
     
        $request->validate([

            'name'=> 'required', 
            'details'=> 'required',
            'image'=> 'required |image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         
           
        ]);
        
            $input =$request->all();
          
            if ($image=$request->File('image')){
               
                $destinationPath= 'images/';

                $profileImage= date('YmdHis').".".$image->getClientOriginalExtension();
      
                $image->move($destinationPath,$profileImage);
                $input['image']="$profileImage";
            }
     
            Product::create($input);
            return redirect()->route('products.index')->with('success','Products added successfully');
    }




    public function show(Product $product)
    {
        //
        return view('products.show',compact('product'));
        
    }


    public function edit(Product $product)
    {
        //
        return view('products.edit',compact('product'));
    }

   
    public function update(Request $request, Product $product)
    {
        
          $request->validate([

                        'name'=> 'required', 
                        'details'=> 'required',
                       
                    ]);
          
                        $input =$request->all();
                       
                        if ($image=$request->File('image')){
                          
                            $destinationPath= 'images/';
                            $profileImage= date('YmdHis').".".$image->getClientOriginalExtension();
                            $image->move($destinationPath,$profileImage);
                            $input['image']="$profileImage";
                        }else{
                            unset($input["image"]);
                        }
                        $product->update($input);
                        return redirect()->route('products.index')->with('success','Products added successfully');
                }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Products deleted successfully');
    }
}
