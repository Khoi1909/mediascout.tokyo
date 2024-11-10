<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .error-code {
            font-size: 48px;
            font-weight: bold;
            color: #e74c3c;
        }
        .error-message {
            font-size: 18px;
            margin: 10px 0;
        }
        .error-details {
            font-size: 14px;
            color: #777;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="error-container">
    <div class="error-code">
        <?php echo isset($errorCode) ? htmlspecialchars($errorCode) : 'Error'; ?>
    </div>
    <div class="error-message">
        <?php echo isset($errorMessage) ? htmlspecialchars($errorMessage) : 'Something went wrong.'; ?>
    </div>
    <div class="error-details">
        <?php echo isset($errorDetails) ? htmlspecialchars($errorDetails) : 'Please try again later or contact support if the problem persists.'; ?>
    </div>
    <a href="../../../../index.php" class="back-link">Go Back to Home</a>
</div>
</body>
</html>
