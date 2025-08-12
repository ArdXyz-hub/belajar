<?php
session_start();

// Pastikan sudah login
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

$user = $_SESSION['username'];
$admin_user = $_SESSION['admin_user'] ?? $user;

// Pesan update (kalau ada)
$update_msg = $_SESSION['update_msg'] ?? '';
unset($_SESSION['update_msg']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Selamat Datang</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    h1 {
      font-size: 3em;
      margin-bottom: 0.2em;
      animation: glow 2s ease-in-out infinite alternate;
    }
    @keyframes glow {
      0% { text-shadow: 0 0 10px #fff, 0 0 20px #9f7aff; }
      100% { text-shadow: 0 0 20px #fff, 0 0 40px #bb8aff; }
    }
    form {
      background: rgba(255,255,255,0.2);
      padding: 20px;
      border-radius: 15px;
      width: 300px;
      color: #333;
      margin-top: 20px;
    }
    input[type=text], input[type=password] {
      width: 100%;
      padding: 10px;
      margin: 8px 0 15px 0;
      border-radius: 10px;
      border: none;
      font-size: 1em;
    }
    button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background: #764ba2;
      color: white;
      font-weight: bold;
      cursor: pointer;
      font-size: 1em;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background: #5a2d81;
    }
    .message {
      margin: 10px 0;
      color: #a0f0a0;
      font-weight: bold;
      text-align: center;
    }
    a.logout {
      margin-top: 25px;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border: 2px solid white;
      padding: 10px 20px;
      border-radius: 20px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    a.logout:hover {
      background: white;
      color: #764ba2;
    }
  </style>
</head>
<body>
  <h1>Selamat Datang, <?=htmlspecialchars($user)?>!</h1>

  <?php if($update_msg): ?>
    <div class="message"><?=htmlspecialchars($update_msg)?></div>
  <?php endif; ?>

  <form action="update.php" method="post">
    <label>Username baru:</label>
    <input type="text" name="new_username" value="<?=htmlspecialchars($admin_user)?>" required />

    <label>Password baru:</label>
    <input type="password" name="new_password" placeholder="Masukkan password baru" required />

    <button type="submit">Update Username & Password</button>
  </form>

  <a href="logout.php" class="logout">Logout</a>
</body>
</html>
