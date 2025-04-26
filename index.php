<?php
session_start();
$connectionStatus = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbType = $_POST['db_type'];
    $host = $_POST['host'];
    $dbname = $_POST['dbname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        if ($dbType === 'mysql') {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        } elseif ($dbType === 'pgsql') {
            $dsn = "pgsql:host=$host;dbname=$dbname";
        } else {
            throw new Exception('Unsupported database type.');
        }

        $pdo = new PDO($dsn, $username, $password);
        $_SESSION['db_connected'] = true;
        $connectionStatus = 'success';
    } catch (Exception $e) {
        $connectionStatus = 'error';
        $errorCode = $e->getCode();
        switch ($errorCode) {
            case '1044':
                $errorMessage = "Access denied to the database. Please check your username and permissions.";
                break;
            case '1045':
                $errorMessage = "Incorrect username or password. Please enter the correct credentials.";
                break;
            case '1049':
                $errorMessage = "The specified database could not be found. Please provide a valid database name.";
                break;
            case '2002':
                $errorMessage = "Unable to connect to the MySQL server. Is the server running? The port might be blocked.";
                break;
            case '2003':
                $errorMessage = "Unable to connect to the specified server. Please check the host address.";
                break;
            case '2013':
                $errorMessage = "Connection lost with the database server. Please check your connection.";
                break;
            case '1054':
                $errorMessage = "The specified column could not be found in the database. Please check your query.";
                break;
            case '1146':
                $errorMessage = "The specified table could not be found in the database. Please check the table name.";
                break;
            case '1062':
                $errorMessage = "An error occurred while inserting data. A record with the same value already exists.";
                break;
            default:
                $errorMessage = $e->getMessage();
                break;
        }
    }
}

if (isset($_GET['disconnect'])) {
    unset($_SESSION['db_connection']);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DB Connection Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://static.vecteezy.com/system/resources/previews/009/328/801/non_2x/business-background-of-blockchain-technology-cryptocurrency-security-mining-distributed-database-anonymous-transmission-background-in-dark-blue-colors-vector.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
        <div class="bg-primary text-white text-center p-3 rounded-top shadow-sm">
            <i class="bi bi-database"></i>
            <span class="ms-2">DB Connection Checker</span>
        </div>
        <div class="bg-white p-4 rounded-bottom shadow-sm">
            <?php if ($connectionStatus === 'success'): ?>
                <div class="alert alert-success d-flex align-items-center py-2 mx-4 my-0" role="alert"
                    style="font-size: 14px;">
                    <div class="me-2">
                        ✅
                    </div>
                    <div>Connection Successful!</div>
                    <a href="?disconnect=true" class="btn btn-danger btn-sm ms-auto">
                        <i class="bi bi-x-circle-fill"></i> Disconnect
                    </a>
                </div>
            <?php elseif ($connectionStatus === 'error'): ?>
                <div class="alert alert-danger py-2 mx-4 my-0" role="alert" style="font-size: 14px;">
                    ❌ Connection Failed: <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>

            <form method="post" class="p-4 bg-white">
                <div class="mb-3">
                    <label for="db_type" class="form-label">Database Type</label>
                    <select class="form-select" id="db_type" name="db_type" required>
                        <option value="mysql">MySQL</option>
                        <option value="pgsql">PostgreSQL</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="host" class="form-label">Host</label>
                    <input type="text" class="form-control" id="host" name="host" placeholder="localhost" required>
                </div>

                <div class="mb-3">
                    <label for="dbname" class="form-label">Database Name</label>
                    <input type="text" class="form-control" id="dbname" name="dbname" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary w-100">Test Connection</button>
            </form>
        </div>

        <!-- Bootstrap icons for close icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>

</html>
<php>