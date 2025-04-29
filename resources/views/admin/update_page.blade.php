
<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style>

        .div_deg{
           display: flex;
           justify-content: center;
           align-items: center;
        }
        label{
            display: inline-block;
            width: 200px;
            padding: 20px;
        }
        input[type="text"]{
            width: 300px;
            height: 60px;
        }
        textarea{
            height: 100px;
            width: 450px;

        }
    </style>
  </head>
  <body>
      @include('admin.header')
      @include('admin.sidebar')

      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
               <h2>Update Product</h2>

               <div class="div_deg">

                <form action="{{url('edit_product',$data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label >Title</label>
                        <input type="text" name="title" value="{{$data->title}}">
                    </div>
                    <div>
                        <label >Description</label>
                        <textarea type="text" name="description" value="{{$data->description}}"></textarea>
                    </div>
                    <div>
                        <label >Price</label>
                        <input type="text" name="price" value="{{$data->price}}">
                    </div>
                    <div>
                        <label >Category</label>
                        <select name="category" >
                            <option  value="{{$data->category}}"> {{$data->category}}</option>

                            @foreach ($category as $category)

                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label >Current Image</label>
                        <img height="150" width="150" src="/products/{{$data->image}}" alt="">
                    </div>

                    <div>
                        <label >New Image</label>
                        <input type="file" name="image" >
                    </div>

                    <div>
                        <button class="btn btn-success" type="submit" >Update Product</button>
                    </div>
                </form>
               </div>


            </div>

      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/admin/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/admin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/admin/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/admin/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/admin/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/admin/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/admin/js/front.js')}}"></script>
  </body>
</html>
