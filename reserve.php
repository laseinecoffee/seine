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

// 取得表單資料
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$phonenumber = isset($_POST["phonenumber"]) ? $_POST["phonenumber"] : "";
$bookdate = $_POST["bookdate"];
$time = isset($_POST["time"]) ? $_POST["time"] : "";
$adults = isset($_POST["adults"]) ? $_POST["adults"] : "";
$children = isset($_POST["children"]) ? $_POST["children"] : "";
$A1 = $_POST["A1"];
$A2 = $_POST["A2"];
$B1 = $_POST["B1"];
$B2 = $_POST["B2"];
$C1 = $_POST["C1"];
$C2 = $_POST["C2"];


// 檢查電話號碼
$phonenumber = preg_replace('/\s+/', '', $phonenumber);

if (!(strlen($phonenumber) === 9 || strlen($phonenumber) === 10) || !is_numeric($phonenumber)){
    echo '<script>
        alert("請輸入正確的電話號碼。");
        window.location.href = "order_list.php"; // 導航到 order_list.php
      </script>';
    exit; // 如果電話號碼不符合標準，停止執行程式
}

// 資料驗證
if (empty($username) || preg_match('/姓名/', $username)) {
    echo '<script>
            alert("請輸入姓名。");
            window.history.back(); // 回到上一個畫面
          </script>';
    exit; // 如果姓名資訊為空，停止執行程式
}

if (empty($phonenumber)) {
    echo '<script>
            alert("請輸入電話號碼。");
            window.history.back(); // 回到上一個畫面
          </script>';
    exit; // 如果電話資訊為空，停止執行程式
}



if (empty($time)) {
    echo '<script>
            alert("請選擇時段。");
            window.history.back(); // 回到上一個畫面
          </script>';
    exit; // 如果時段資訊為空，停止執行程式
}

$query = "INSERT INTO `reserve`(`username`, `phonenumber`, `bookdate`, `time`, `adults`, `children`, `A1`, `A2`, `B1`, `B2`, `C1`, `C2`) VALUES ('$username','$phonenumber','$bookdate','$time','$adults','$children','$A1','$A2','$B1','$B2','$C1','$C2')";

session_start();

$seatNames = ["A1", "A2", "B1", "B2", "C1", "C2"];

foreach ($seatNames as $seat) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST[$seat]) && $_POST[$seat] == 'on') {
            $_SESSION[$seat . "_selected"] = true;
        } else {
            $_SESSION[$seat . "_selected"] = false;
        }
    }

    $seatSelected = isset($_SESSION[$seat . "_selected"]) ? $_SESSION[$seat . "_selected"] : false;

  // 不在這裡顯示警告，而是在下方的提交表單後顯示
}





// 在提交表單後檢查座位是否已經被選擇，並顯示警告
foreach ($seatNames as $seat) {
    $seatSelected = isset($_SESSION[$seat . "_selected"]) ? $_SESSION[$seat . "_selected"] : false;

    if ($seatSelected && isset($_POST[$seat]) && $_POST[$seat] == 'on') {
        echo '<script>alert("' . $seat . '已經被選擇");</script>';
    }
}

if ($conn->query($query) === TRUE) {
    echo "<br/>"."<div align='center'> 訂位成功！"."<div/>"."<br/>";
    echo "<div align='center'> 姓名：".$username."<div/>";
    echo "電話：".$phonenumber."<br/>";
    echo "日期：".$bookdate."<br/>";
    echo "時間：".$time."<br/>";
    echo "大人：".$adults."位"."<br/>";
    echo "小孩：".$children."位"."<br/>";
    // 顯示所選座位
echo "所選座位：";
$selectedSeats = [];

foreach ($seatNames as $seat) {
    if ($_SESSION[$seat . "_selected"]) {
        $selectedSeats[] = $seat;
    }
}

echo implode(", ", $selectedSeats) . "<br/>";
    echo '<div align="center"><button type="button" onclick="location.href=\'order_list.php\'">回首頁再訂一次</button></div>';
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>