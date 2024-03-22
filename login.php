<?php
session_start();
require_once("entities/userclass.php");

// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận tên người dùng và mật khẩu từ biểu mẫu
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate inputs
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit;
    }

    // Tạo một đối tượng User mới
    $user = new User();

    // Thử đăng nhập
    $login_result = $user->login($username, $password);
    if ($login_result !== false) {
        // Đăng nhập thành công, hãy lưu thông tin người dùng vào session nếu cần
        $_SESSION['user'] = $login_result;

        // Chuyển hướng đến trang dashboard
        $user->redirectToDashboard($login_result['Role']);
    } else {
        // Đăng nhập không thành công, chuyển hướng trở lại trang đăng nhập với thông báo lỗi
        header("Location: login.php?error=login_failed");
        exit;
    }
}
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Login</button>
    <a href="register.php">New account?</a>
</form>
