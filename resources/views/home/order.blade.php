<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Order </title>

    @include('home.css')

    <style type="text/css">

    .div_center{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px;
    }

    table{
        border: 2px solid black;
        text-align: center;
        width: 800px;
    }

    th{
        border: 2px solid skyblue;
        background-color: black;
        color: white;
        font-size: 19px;
        font-weight: bold;
        text-align: center;
    }
    td{
        border: 1px solid skyblue;
        padding: 10px;
    }

    </style>
</head>
<body>

    <div class="hero_area">
        <!-- header section strats -->
         @include('home.header')
        <!-- end header section -->

      </div>

      <div class="div_center">

        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Deliver Status</th>
                <th>Image</th>
            </tr>

            @foreach ($order as $orders )

            <tr>

                <td>{{$orders->product->title}}</td>
                <td>{{$orders->product->price}}</td>
                <td>{{$orders->status}}</td>
                <td>
                    <img height="200" width="300" src="products/{{$orders->product->image}}" alt="">
                </td>
            </tr>

            @endforeach

        </table>
      </div>

      <div class="order_deg" style="justify-content: center; display: flex; align-items: center; margin: 20px;" >
        <form action="{{url('confirm_order')}}" method="post">

            @csrf
         <div class="div_gap">
            <label>Receiver Name</label>
            <input type="name" name="name" value="{{Auth::user()->name}}">
        </div><br>
         <div class="div_gap">
            <label>Receiver Address</label>
            <br>
            <textarea name="address" >{{Auth::user()->address}}</textarea>
        </div>
        <br>
         <div class="div_gap">
            <label>Receiver Phone</label>
            <input type="name" name="phone" value="{{Auth::user()->phone}}">
        </div><br>
         <div class="div_gap">

            <input class="btn btn-primary" type="submit" value="place Cash on Delivery" ><br><br>

            <a class="btn btn-success" href="{{url('stripe')}}">Pay using card</a>
        </div>

        </form>
    </div>

      @include('home.footer')

</body>
</html>
