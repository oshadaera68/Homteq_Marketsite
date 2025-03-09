<?php
session_start();
include("db.php");
$pagename = "Smart Basket"; 

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; 
echo "<title>" . $pagename . "</title>"; 
echo "<body>";
include("headfile.html"); 
include ("detectlogin.php"); 

echo "<h4>" . $pagename . "</h4>"; 

if (isset($_POST['h_prodid'])) {
    $newprodid = $_POST['h_prodid'];
    $reququantity = $_POST['p_quantity'];
    $_SESSION['basket'][$newprodid] = $reququantity;
    echo "<p>1 item added to the basket</p>";
} else {
    echo "<p>Basket unchanged</p>";
}

$total = 0;

echo "<p><table id='baskettable'>";
echo "<tr>";
echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Remove Product</th>";
echo "</tr>";

if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])) {
    foreach ($_SESSION['basket'] as $index => $value) {
        $SQL = "SELECT prodId, prodName, prodPrice FROM Product WHERE prodId='$index'";
        $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        $arrayp = mysqli_fetch_array($exeSQL);

        echo "<tr>";
        echo "<td>" . $arrayp['prodName'] . "</td>";
        echo "<td>&pound" . number_format($arrayp['prodPrice'], 2) . "</td>";
        echo "<td style='text-align:center;'>" . $value . "</td>";

        $subtotal = $arrayp['prodPrice'] * $value;
        echo "<td>&pound" . number_format($subtotal, 2) . "</td>";

        // Add remove button
        echo "<td>";
        echo "<form action='remove.php' method='post'>";
        echo "<input type='hidden' name='del_prodid' value='" . $arrayp['prodId'] . "'>";
        echo "<input type='submit' value='Remove' id='submitbtn'>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";

        $total += $subtotal;
    }

    // Display total
    echo "<tr>";
    echo "<td colspan='3'><b>Total</b></td>";
    echo "<td>&pound" . number_format($total, 2) . "</td>";
    echo "<td></td>";
    echo "</tr>";
} else {
    echo "<tr><td colspan='5'><p>Empty basket</p></td></tr>";
}

echo "</table>";
echo "<br><p><a href='clearbasket.php'>CLEAR BASKET</a></p>";
echo "<br><p>New homteq customers: <a href='signup.php'>Sign up</a></p>";
echo "<br><p>Returning homteq customers: <a href='login.php'>Login</a></p>";
if (isset($_SESSION['userid']))  
{ 
 echo "<br><p><a href=checkout.php>CHECKOUT</a></p>";  
} 
else 
{ 
 echo "<br><p>New homteq customers: <a href='signup.php'>Sign up</a></p>"; 
 echo "<p>Returning homteq customers: <a href='login.php'>Login</a></p>"; 
}
include("footfile.html");
echo "</body>";
?>