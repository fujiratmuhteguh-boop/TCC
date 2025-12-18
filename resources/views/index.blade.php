<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai - Diskominfotik NTB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
            padding-top: 50px;
        }
        .container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 1000px;
        }
        h2 { color: #333; font-weight: 700; }
        .table thead { background-color: #0d6efd; color: white; }
        .btn-login {
            position: absolute; top: 20px; right: 30px;
            text-decoration: none; font-weight: bold; color: #0d6efd;
        }
    </style>
</head>
<body>

<a href="{{ route('login') }}" class="btn-login">Login Admin →</a>

<div class="container">
    <h2 class="text-center mb-4">📂 Daftar Data Pegawai (Publik)</h2>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama (Sensor)</th>
                    <th>NIK (Sensor)</th>
                    <th>Email (Sensor)</th>
                    <th>Waktu Input</th>
                </tr>
            </thead>
            <tbody>
                @forelse($identitas as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->nama }}</td> 
                        <td>{{ $p->nik }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">Belum ada data pegawai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>