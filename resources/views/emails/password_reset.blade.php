<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - InotalHub</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eaeaea;
        }
        .logo {
            color: #e60000;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }
        .content {
            padding: 30px 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            background-color: #e60000;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eaeaea;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="{{ url('/') }}" class="logo">InotalHub</a>
    </div>

    <div class="content">
        <h2>Halo {{ $userName }},</h2>

        <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun InotalHub Anda.</p>

        <p>Jika Anda meminta kami untuk mengatur ulang kata sandi Anda, klik tombol di bawah ini:</p>

        <div style="text-align: center;">
            <a href="{{ $resetUrl }}" class="button" style="color: white; text-decoration: none;">Reset Password</a>
        </div>

        <p>Atau salin dan tempel link berikut di browser Anda:</p>
        <p style="word-break: break-all; color: #666;">{{ $resetUrl }}</p>

        <p>Link reset password ini akan kadaluarsa dalam 60 menit.</p>

        <p>Jika Anda tidak meminta reset password, abaikan email ini. Password Anda tidak akan berubah.</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} InotalHub. Semua hak dilindungi undang-undang.</p>
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
