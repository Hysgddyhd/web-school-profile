<!DOCTYPE html>
<html>
<head>
  <title>My Bike Ordering System : Products</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="products.php" method="post">
      Product ID
      <input name="pid" type="text"> <br>
      Name
      <input name="name" type="text"> <br>
      Brand
      <input name="brand" type="text"> <br>
      Price
      <input name="price" type="range" value="12" min="1" max="200" pace="2.5" oninput="this.nextElementSibling.value=this.value"> <output>12</output><br>
      room_position
      <select name="room_position" >
        <option value="lobby">lobby</option>
        <option value="livingRoom">living room</option>
        <option value="bedroom">bedroom</option>
        <option value="study">study</option>
        <option value="bathroom">bathroom</option>
        <option value="Balcony">balcony</option>
        <option value="outside">outside</option>
      </select>
       <br>
      material
      <input name="material" type="text"> <br>
      specialty
      <textarea name="specialty"></textarea><br>
      Quantity
      <input name="quantity" type="number" value="1"> <br>
      <button type="submit" name="create">Create</button>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <thead>
        <td>Product ID</td>
        <td>Name</td>
        <td>Brand</td>
        <td>Price</td>
        <td>room_position</td>
        <td>material</td>
        <td>specifity</td><td>______________</td>
        <td>quantity</td>
      </thead>
      <tr>
        <td>P001</td>
        <td>Bedside Table Lamp for Bedroom</td>
        <td>Fenmzee</td>
        <td>Kawasaki</td>
        <td>study</td>
        <td>Wooden Base</td>
        <td colspan="2">Use 15% brightness as a bedroom night light for a restful sleep.
    Switch to 60% brightness for a comfortable study desk lamp.
    Use 100% brightness as a living room table lamp for family gatherings.</td>
        <td>4</td>
      </tr>
    </table>
  </center>
</body>
</html>