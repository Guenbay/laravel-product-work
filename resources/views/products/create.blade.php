@extends('products.layout')

@section('content')


<br>
<div class="row">
    <div class="col align-self-start">
     <a   class="btn btn-primary" href="{{route('products.index')}}" >All products</a>
    </div>
     
  </div>
  <br>

<!--لو كان هناك خطأ أظهر لي -->
  @if ($errors->any())
  <div class="alert alert-danger" role="alert">
    <ul><!--لو كان هناك خطأ أظهر لي جميع الأخطاء في حل عدم تعبئه الحقول الأجباريه-->
        @foreach ($errors->all() as $item)
        <li>{{$item}}</li>
        @endforeach
       
    </ul>
  </div>
      
  @endif


<div class='container p-5'>

<!--احفظ المعلومات عن طريق store-->
<!--لان نستخدم صور لازم ذكر enctype-->
<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
@csrf 

<div class="mb-3">
  <!--'name'=> 'required', von productcontroller-->
  <label for="" class="form-label">Name</label>
  <input type="text" class="form-control" name="name" >
 </div>
 <div class="mb-3">
  <!--'details'=> 'required',, von productcontroller-->
   <label for="" class="form-label">Details</label>
   <textarea class="form-control" name="details" id="" rows="3"></textarea>
 </div>
 <div class="mb-3">
  <!--'image'=> 'required |image|mimes:jpeg,png,jpg,gif,svg|max:2048', von productcontroller-->
    <label for="" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" >
   </div>

   <button type="submit" class="btn btn-primary">Submit</button>
 

</form>
   

</div>

@endsection