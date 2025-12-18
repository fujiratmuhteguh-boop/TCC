<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User - Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #6610f2, #007bff); min-height: 100vh; font-family: 'Poppins', sans-serif; padding: 40px; }
        .container { background: #fff; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
    </style>
</head>
<body>

<div class="container text-center">
    <h2>Halo, {{ Auth::user()->name }}! 👋</h2>
    <p class="text-muted">Silakan lakukan absensi harian Anda di bawah ini.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card my-4 border-0 shadow-sm p-4 bg-light">
        <form action="{{ route('user.absen.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold shadow">
                📍 KLIK UNTUK ABSEN MASUK
            </button>
        </form>
    </div>

    <h4 class="mt-5 text-start">Riwayat Absen Anda</h4>
    <table class="table table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absensis as $absen)
                <tr>
                    <td>{{ $absen->tanggal }}</td>
                    <td>{{ $absen->jam_masuk }}</td>
                    <td><span class="badge bg-success">{{ $absen->status }}</span></td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-muted">Belum ada riwayat absen.</td></tr>
            @endforelse
        </tbody>
    </table>

    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>

</body>
</html>