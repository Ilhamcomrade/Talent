<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            margin-bottom: 30px;
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
        /* TOMBOL RESET PASSWORD KAMPUS - HANYA WARNA YANG BERBEDA #00b14f */
        .button {
            display: inline-block;
            background-color: #00b14f; /* PERUBAHAN SATU-SATUNYA */
            color: white !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            border: 2px solid #00b14f; /* PERUBAHAN SATU-SATUNYA */
            transition: all 0.3s ease;
        }
        .button:hover {
            background-color: #009944; /* PERUBAHAN SATU-SATUNYA */
            border-color: #009944; /* PERUBAHAN SATU-SATUNYA */
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eaeaea;
            margin-top: 30px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .url-text {
            word-break: break-all;
            color: #666;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 4px;
            border-left: 3px solid #00b14f; /* WARNA BIRU SAMA DENGAN PERUSAHAAN */
            margin: 15px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="{{ url('/') }}" class="logo">InotalHub</a>
    </div>

    <div class="content">
           <h2>Halo {{ $campuses->nama_lengkap }},</h2>

        <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun InotalHub Anda.</p>

        <p>Jika Anda meminta kami untuk mengatur ulang kata sandi Anda, klik tombol di bawah ini:</p>

        <div style="text-align: center;">
            <a href="{{ $resetUrl }}" class="button" style="color: white !important; text-decoration: none;">
                Reset Password
            </a>
        </div>

        <p>Atau salin dan tempel link berikut di browser Anda:</p>

        <div class="url-text">
            {{ $resetUrl }}
        </div>

        <p>Link reset password ini akan kadaluarsa dalam 60 menit.</p>

        <div class="warning">
            <p><strong>Perhatian:</strong> Jika Anda tidak meminta reset password, abaikan email ini. Password Anda tidak akan berubah.</p>
        </div>

        <p>Email ini dikirim untuk akun kampus/sekolah di platform InotalHub.</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} InotalHub. Semua hak dilindungi undang-undang.</p>
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
