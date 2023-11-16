<?php

namespace App\Http\Controllers;
//تم ربطه بلمودل عن طريق --model
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * تم انشاء جميع العمليات بناء على --resource
     * Display a listing of the resource.
     */
    //جلب البيانات من قاعده البيانات 
     public function index()
    {
        //عند جلب البيانات من قاعده البيانات اجلب لي أخر البيانات /أجددها 
       //paginations =paginate 1 ,2 ,3 ,4 ,....عد البيانات أكتي تطهر في الصفحه 
       //هنا (MODEL)جلب البيانات من قاعده البيانات لل-(CONTROLLER)
       $product="";
        $product= Product::latest()->paginate(5);
       
       // Controller يقوم بارسال المعلومات لل View
       //compact= indexهنا ياخذ  ويرسله لل-var products
       return view('products.index',compact('product'))->with('i',(request()->input('page',1)-1) * 5);
       // *5 هنا  )(رقم الصفحه التي يقف عليها المستخدم ثم يستدعي الصفحات اذا كان رقم الصفحه -1 لرسوي 0 أذن أكمل 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //ينتقل لصفحه  create عن طريق مجلد products
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
        // request يقوم  حفظ  المعلومات عن طريق 
    public function store(Request $request)
    {
        //هذه الداله للتاكد من أن جميع المعلومات التي يرسلها المستخدم تصل 
       // dd($request->all());
        //لتئاكد أنه قام ب حفظ  المعلومات بشكل صحيح 
        $request->validate([
//array fun نحتاج المعلومات التي اضيفت لل-table
            'name'=> 'required', //تحميل اجباري required
            'details'=> 'required',
            'image'=> 'required |image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //تحميل اجباري أو مشروط بلحجم أو صوره أو الامتداد 
           
        ]);
        //كل all المعلومات التي تأتي من المستخدم عن طريق ال-request احفظها في المتغير input  
            $input =$request->all();
            //بلنسبه لصوره سيتم حفظ مسارها لذلك نعطي متغير ياخذ الصوره من المستخدم على شكل ملف 
            if ($image=$request->File('image')){
                //أحدد المسار --قم بحفظه في images
                $destinationPath= 'images/';
                //الصوره المرفوعه مكن تتشابه اسمائها يمكن نستخدم نمته معين مثل (السنه،الشهر،اليوم،الساعه،الدقيقه،الثانيه)
                //وراح نربطها مع الصوره +الامتداد ويكون بشكل داله
                $profileImage= date('YmdHis').".".$image->getClientOriginalExtension();
                //قم بتحريك الصوره للمسار الذي تم أنشأئه
                $image->move($destinationPath,$profileImage);
                $input['image']="$profileImage";//المدخل عباره عن array أريد فقط أن يتم حفظ هذا الصوره مع هذا المسار بدلا من المتغير image
            }
            //يتم حفظ المتغير في اDB 
            Product::create($input);
            return redirect()->route('products.index')->with('success','Products added successfully');
    }

    /**
     * Display the specified resource.
     */


 //hier jezt 1 product view 
    public function show(Product $product)
    {
        //
        return view('products.show',compact('product'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
          //لتئاكد أنه قام ب حفظ  المعلومات بشكل صحيح 
          $request->validate([
            //array fun نحتاج المعلومات التي اضيفت لل-table
                        'name'=> 'required', //تحميل اجباري required
                        'details'=> 'required',
                       
                    ]);
                    //كل all المعلومات التي تأتي من المستخدم عن طريق ال-request احفظها في المتغير input  
                        $input =$request->all();
                        //بلنسبه لصوره سيتم حفظ مسارها لذلك نعطي متغير ياخذ الصوره من المستخدم على شكل ملف 
                        if ($image=$request->File('image')){
                            //أحدد المسار --قم بحفظه في images
                            $destinationPath= 'images/';
                            //الصوره المرفوعه مكن تتشابه اسمائها يمكن نستخدم نمته معين مثل (السنه،الشهر،اليوم،الساعه،الدقيقه،الثانيه)
                            //وراح نربطها مع الصوره +الامتداد ويكون بشكل داله
                            $profileImage= date('YmdHis').".".$image->getClientOriginalExtension();
                            //قم بتحريك الصوره للمسار الذي تم أنشأئه
                            $image->move($destinationPath,$profileImage);
                            $input['image']="$profileImage";//المدخل عباره عن array أريد فقط أن يتم حفظ هذا الصوره مع هذا المسار بدلا من المتغير image
                        }else{
                            unset($input["image"]);
                        }
                        $product->update($input);
                        return redirect()->route('products.index')->with('success','Products added successfully');
                }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Products deleted successfully');
    }
}
