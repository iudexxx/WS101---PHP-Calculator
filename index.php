<?php
$result = '';
$num1 = $num2 = $operator = '';

// required "ugly" function — handles the math
function doStuff($a, $b, $op) {
    switch ($op) {
        case '+': return $a + $b;
        case '-': return $a - $b;
        case '*': return $a * $b;
        case '/': return $b == 0 ? 'Error: divide by zero' : $a / $b;
        default: return 'Invalid operator';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operator = $_POST['operator'] ?? '';

    if (is_numeric($num1) && is_numeric($num2)) {
        $result = doStuff((float)$num1, (float)$num2, $operator);
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
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 6px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
            box-sizing: border-box;
        }
        button {
            background: #764ba2;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
        .result {
            margin-top: 15px;
            padding: 12px;
            background: #f4f0fb;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>PHP Calculator</h2>
        <form method="POST">
            <input type="text" name="num1" value="<?= htmlspecialchars($num1) ?>" placeholder="Number 1" required>
            <select name="operator">
                <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+</option>
                <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>−</option>
                <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>×</option>
                <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>÷</option>
            </select>
            <input type="text" name="num2" value="<?= htmlspecialchars($num2) ?>" placeholder="Number 2" required>
            <button type="submit">Calculate</button>
        </form>
        <?php if ($result !== ''): ?>
            <div class="result">Result: <?= htmlspecialchars($result) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>