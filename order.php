<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>預約系統</title>
    <link rel="stylesheet" href="style3.css">
    <link rel="icon" type="image/x-icon" href="image/loge-2.png">
</head>

<?php
$servername="localhost";
$username="laseine";
$password="123456";
$dbname="reserve";
$conn = new mysqli($servername, $username, $password, $dbname);

//檢查連線
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<body
    background="https://assets-au-01.kc-usercontent.com/e0a5d496-0e0b-02ac-957e-28068fa4bd4d/1d770df0-8588-44f8-be20-bbbc18bcf80d/cafe%20interior%20design.jpg">
    <header>
        <nav>
            <ul>
                <li><a href="seat.html">關於我們</a></li>
                <li><a href="MEMU.html">MEMU</a></li>
                <li><a href="order.html">我要訂位</a></li>
                <li><a href="nember.html">聯絡我們</a></li>
            </ul>
        </nav>
    </header>
    <h2>
        <div style="letter-spacing:10px;">線上預約</div>
    </h2>

    <?php
    session_start();

    // 取得前一位使用者的 A1 選擇狀態
    $A1_selected = isset($_SESSION["A1_selected"]) ? $_SESSION["A1_selected"] : false;
    // 取得前一位使用者的 A2 選擇狀態
    $A2_selected = isset($_SESSION["A2_selected"]) ? $_SESSION["A2_selected"] : false;
    // 取得前一位使用者的 B1 選擇狀態
    $B1_selected = isset($_SESSION["B1_selected"]) ? $_SESSION["B1_selected"] : false;
    // 取得前一位使用者的 B2 選擇狀態
    $B2_selected = isset($_SESSION["B2_selected"]) ? $_SESSION["B2_selected"] : false;
    // 取得前一位使用者的 C1 選擇狀態
    $C1_selected = isset($_SESSION["C1_selected"]) ? $_SESSION["C1_selected"] : false;
    // 取得前一位使用者的 C2 選擇狀態
    $C2_selected = isset($_SESSION["C2_selected"]) ? $_SESSION["C2_selected"] : false;
     
 
$sql = "SELECT * FROM reserve WHERE id=39";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

?>
    <form action="reserve.php" method="post">
        <table border="1" style="text-align:center">
            <form action="reserve.php" method="post">
                <tr>

                    <th width="500">
                        <input type="text" id="username" name="username" value="姓名">
                    </th>
                    <th width="500">
                        <input type="text" id="phonenumber" name="phonenumber" value="電話">
                    </th>
                </tr>
                <tr>
                    <td>
                        <input type="date" id="bookdate" placeholder="2014-09-18">
                    </td>
                    <td> <select id="time" name="time">
                            <label for="time">用餐時段：</label>
                            <option>用餐時段</option>
                            <option value="1">10:00~11:30</option>
                            <option value="2">11:30~13:00</option>
                            <option value="3">13:00~14:30</option>
                            <option value="4">14:30~16:00</option>
                            <option value="5">16:00~17:30</option>
                        </select></td>
                <tr>
                    <td><select id="adults" name="adults">
                            <p class="sc-evZas kFafaz">用餐人數</p>
                            <option value="2">2位大人</option>
                            <option value="3">3位大人</option>
                            <option value="4">4位大人</option>
                            <option value="5">5位大人</option>
                            <option value="6">6位大人</option>
                            <option value="7">7位大人</option>
                            <option value="8">8位大人</option>
                        </select></td>
                    <td><select id="children" name="children">
                            <label for="phonenumber">小孩：</label>
                            <option value="1">1位小孩</option>
                            <option value="2">2位小孩</option>
                            <option value="3">3位小孩</option>
                            <option value="4">4位小孩</option>
                            <option value="5">5位小孩</option>
                            <option value="6">6位小孩</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <font face="標楷體">
                            <div id="checkbox">
                                <label><input type="checkbox" name="A1"<?php echo $A1_selected ?'checked' : ''; ?>><span class="round button">A1</span></label>
                                <label><input type="checkbox" name="A2"<?php echo $A2_selected ?'checked' : ''; ?>><span class="round button">A2</span></label>
                                <label><input type="checkbox" name="B1"<?php echo $B1_selected ?'checked' : ''; ?>><span class="round button">B1</span></label>
                                <label><input type="checkbox" name="B2"<?php echo $B2_selected ?'checked' : ''; ?>><span class="round button">B2</span></label>
                                <label><input type="checkbox" name="C1"<?php echo $C1_selected ?'checked' : ''; ?>><span class="round button">C1</span></label>
                                <label><input type="checkbox" name="C2"<?php echo $C2_selected ?'checked' : ''; ?>><span class="round button">C2</span></label>
                            </div>
                        </font>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <input type="reset" class="B" style="background-color:white" value="確認送出">

                        <input type="reset" class="B" style="background-color:white" value="重新輸入">

                    </td>
                </tr>




                <?php           
        }
} else {
  echo "0 results";
}
$conn->close();
?>
            </form>
</body>

</html>