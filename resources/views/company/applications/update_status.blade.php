<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Status Pelamar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background: #0056b3;
        }

        .info-box {
            background: #fafafa;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

<div class="container">

    <h2>Update Status Pelamar</h2>

    <div class="info-box">
        <p><strong>Nama Pelamar:</strong> {{ $applicant->nama }}</p>
        <p><strong>Email:</strong> {{ $applicant->email }}</p>
        <p><strong>Lowongan:</strong> {{ $applicant->job->judul }}</p>
        <p><strong>Status Saat Ini:</strong> <b>{{ $applicant->status }}</b></p>
    </div>

    <form action="{{ route('company.applicants.updateStatus', $applicant->id) }}" method="POST">
        @csrf

        <label for="status">Pilih Status Baru</label>
        <select name="status" id="status" required>
            <option value="">-- Pilih Status --</option>
            <option value="pending">Pending</option>
            <option value="review">Review</option>
            <option value="interview">Interview</option>
            <option value="diterima">Diterima</option>
            <option value="ditolak">Ditolak</option>
        </select>

        <button type="submit">Simpan Perubahan</button>
    </form>

</div>

</body>
</html>
