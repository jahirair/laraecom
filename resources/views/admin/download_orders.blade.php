
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>


<h1 style="text-align:center">{{$title}} : {{$date}}</h1>
    <h6></h6>
    
<table>
  <tr>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Price</th>
  </tr>
  @foreach($order_datas as $order_datas)
  <tr>
    <td>{{$order_datas->name}}</td>
    <td>{{$order_datas->product_title}}</td>
    <td>{{$order_datas->price}}</td>
  </tr>
  @endforeach
  
</table>

</body>
</html>

