<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
  </head>
  <body>
      @include('admin.header')
      @include('admin.sidebar')

      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
             @include('admin.body')
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
