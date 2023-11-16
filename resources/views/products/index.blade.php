@extends('products.layout')
<!-- للوراثه من layout-->
@section('content')
<br>
 <!--  اذا وصلتني رساله بمفتاح success قم بعرضها-->
  @if ($message = Session::get('success'))
  <div class="alert alert-success" role="alert">
   {{$message}}
  </div>
  @endif
<div class="row" >
    <div class="col align-self-start">
        <a class="btn btn-primary" href="{{route('products.create')}}">Create</a>

    </div>
</div>

  <br>
<div class="table-responsive">
    <table class="table table-striped table-hover table-borderless table-primary align-middle">
        <thead class="table-light">
           
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($product as $item)
                <tr class="table-primary" >
                    <td>{{$item->id}}</td>
                    <td><img src="/images/{{$item->image}}" width="150px" height="170px"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->details}}</td>
                    <td>
                        <form action="{{route('products.destroy',$item->id)}}" method="post">
                            @csrf <!--تاغ لامان من الهكر -->
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-3 mx-3 px-3">Delete</button>
                             </form>
                             
                    
                   
                        
                        <a class="btn btn-primary mb-3 mx-3 px-4" href="{{route('products.edit',$item->id)}}">Edit</a>
                    <a class="btn btn-info mb-3 mx-3 px-3" href="{{route('products.show',$item->id)}}">Show</a>     
                    </td>
                </tr>
                @endforeach
               
                
            </tbody>
            <tfoot>
                
            </tfoot>
    </table>
<!--يتم وضع هذا الأقواس حتى يتم ترجمة تاج html و-css-->
    {!!  $product->links()   !!}
</div>



@endsection