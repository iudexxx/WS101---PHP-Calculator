<?php
$result = '';
$num1 = $num2 = $operator = '';

// ---- function required by professor (now fixed / correct math) ----
function doStuff($a,$b,$c){
$r="";
if($c=="+"){
  $r=$a+$b;
}else{
  if($c=="-"){
    $r=$a-$b;
  }else{
    if($c=="*"){
      $r=$a*$b;
    }else{
      if($c=="/"){
        if($b==0){
          $r="err";
        }else{
          $r=$a/$b;
        }
      }else{
        $r="bad op";
      }
    }
  }
}
return $r;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operator = $_POST['operator'] ?? '';

    if (is_numeric($num1) && is_numeric($num2)) {
        $num1 = (float)$num1;
        $num2 = (float)$num2;
        $result = doStuff($num1, $num2, $operator);
    } else {
        $result = 'Please enter valid numbers';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Calculator</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 360px;
            position: relative;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
            margin-bottom: 24px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 12px 14px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        input[type="text"]:focus, select:focus {
            outline: none;
            border-color: #764ba2;
        }
        #calcBtn {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: top 0.15s ease, left 0.15s ease;
        }
        #calcBtn.dodging {
            position: fixed;
            width: 140px;
            z-index: 999;
        }
        .result {
            margin-top: 20px;
            padding: 16px;
            background: #f4f0fb;
            border-radius: 8px;
            text-align: center;
            font-size: 1.3em;
            font-weight: bold;
            color: #4b2e83;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>PHP Calculator</h2>
        <form method="POST" id="calcForm">
            <input type="text" name="num1" placeholder="Enter first number" value="<?= htmlspecialchars($num1) ?>" required>
            <select name="operator">
                <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+</option>
                <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>−</option>
                <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>×</option>
                <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>÷</option>
            </select>
            <input type="text" name="num2" placeholder="Enter second number" value="<?= htmlspecialchars($num2) ?>" required>
            <button type="button" id="calcBtn">Calculate</button>
        </form>

        <?php if ($result !== ''): ?>
            <div class="result">Result: <?= htmlspecialchars($result) ?></div>
        <?php endif; ?>
    </div>

    <script>
        const btn = document.getElementById('calcBtn');

        function moveButton() {
            btn.classList.add('dodging');
            const btnWidth = btn.offsetWidth;
            const btnHeight = btn.offsetHeight;
            const maxX = window.innerWidth - btnWidth - 20;
            const maxY = window.innerHeight - btnHeight - 20;
            const newX = Math.random() * maxX;
            const newY = Math.random() * maxY;
            btn.style.left = newX + 'px';
            btn.style.top = newY + 'px';
        }

        // stays put on load — only starts dodging once you try to reach it
        btn.addEventListener('mouseenter', moveButton);
    </script>
</body>
</html>