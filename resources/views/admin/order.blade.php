<!DOCTYPE html>
<html>

<head>
    @include('admin.css')



    <style type="text/css">
        table {


            border: 2px solid skyblue;
            text-align: center;
        }

        th {
            background: skyblue;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            color: white;
        }

        td {


            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }

        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
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

                <h3>All Orders</h3>
                <br>
                <br>
                <div class="table_center">
                    <table>
                        <tr>
                            <th>Customer Name </th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>change  Status</th>
                            <th>Print PDF</th>
                        </tr>


           @if(count($data) > 0)
                    @foreach ($data as $order)
        <tr>
            <td>{{ $order->name }}</td>
            <td>{{ $order->rec_address }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->product->title }}</td>
            <td>{{ $order->product->price }}</td>
            <td>
                <img width="150" src="{{ asset('products/' . $order->product->image) }}">
            </td>
            <td>{{ $order->payment_status }}</td>
            <td>
                @if ( $order->status == 'in progress')

                <span style="color: red">{{ $order->status }}</span>

                @elseif( $order->status == 'On the way')

                <span style="color:skyblue">{{ $order->status }}</span>
                @else

                <span style="color: yellow">{{ $order->status }}</span>

                @endif
            </td>

             <td>
                <a class="btn btn-primary" href="{{url('on_the_way',$order->id)}}">On the way</a>
                 <br><br>
                <a class="btn btn-success" href="{{url('delivered',$order->id)}}">Delivered</a>


             </td>

             <td>
                 <a class="btn btn-secondary" href="{{url('print_pdf',$order->id)}}">Print PDF</a>
            </td>



        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" style="color: red;">No orders found.</td>
    </tr>
@endif






















                    </table>

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
