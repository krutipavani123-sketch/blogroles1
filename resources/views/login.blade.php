<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body{
          
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .login-card{
            width: 380px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .login-card h2{
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .form-control{
            border-radius: 10px;
            padding: 10px;
        }

        .btn-login{
            width: 100%;
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
            background: #667eea;
            border: none;
        }

        .btn-login:hover{
            background: #5a67d8;
        }

        .icon{
            position: absolute;
            margin-left: 10px;
            margin-top: 12px;
            color: #888;
        }

        .input-group-text{
            background: transparent;
            border-right: 0;
        }

        .form-group{
            margin-bottom: 15px;
        }

        .footer-text{
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>

<body>

<form method="post" action="/login">
    @csrf

    <div class="login-card">

        <h2>Login</h2>

        <!-- NAME -->
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name">
        </div>

        <!-- EMAIL -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email">
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password">
        </div>

        <!-- BUTTON -->
        <button type="submit" class="btn btn-primary btn-login mt-2">
            Login
        </button>

        <div class="footer-text">
            Welcome back 👋
        </div>

    </div>

</form>

</body>
</html>