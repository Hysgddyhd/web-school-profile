<!DOCTYPE html>
<html>
<head>
  <title>Ordering System : Orders</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="orders.php" method="post">
      Order ID
      <input name="oid" type="text" disabled> <br>
      Time of Order
      <input name="time" type="date" disabled> <br>
      Customer
      <select name="cid">
        <option value="C001">Maria Garcia</option>
        <option value="C002">Antonio Goldman</option>
        <option value="C003">William Johnson</option>
      </select> <br>
      Staff
      <select name="sid">
        <option value="S001">Larry Bay</option>
        <option value="S002">James Martin</option>
        <option value="S003">Jennifer Henderson</option>
      </select> <br>
      Transcation
      <input type="number" name="transcation"><br>
      <button type="submit" name="create">Create</button>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order ID</td>
        <td>Time</td>
        <td>Customer ID</td>
        <td>Staff ID</td>
        <td>Transcation(RM)</td>
        <td></td>
      </tr>
      <tr>
        <td>O5603f03a9349f0.39900158</td>
        <td>09-09-2015</td>
        <td>James Martin</td>
        <td>Maria Garcia</td>
        <td>50</td>
        <td>
          <a href="orders_details.php">Details</a>
          <a href="orders.php">Edit</a>
          <a href="orders.php">Delete</a>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>