<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Data Diskominfotik NTB</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 0 60px;
        }

        /* Tombol Logout */
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 30px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #b02a37;
            transform: scale(1.05);
        }

        .form-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            padding: 35px 40px;
            width: 90%;
            max-width: 650px;
            animation: fadeInUp 0.8s ease;
            margin-bottom: 40px;
        }

        .history-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            padding: 25px 30px;
            width: 90%;
            max-width: 900px;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2, h3 {
            text-align: center;
            font-weight: 700;
            color: #333;
        }

        h3 {
            margin-bottom: 20px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #6610f2);
            border: none;
            font-weight: 600;
            transition: transform 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056d2, #520dc2);
            transform: scale(1.03);
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
        }

        .footer-text {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .alert {
            border-radius: 10px;
        }

        img.logo {
            display: block;
            margin: 0 auto 20px;
            width: 170px;
        }

        table {
            font-size: 0.9rem;
        }

        th {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            text-align: center;
        }

        td {
            vertical-align: middle;
            text-align: center;
        }

        .empty-text {
            text-align: center;
            color: #777;
            font-style: italic;
        }
    </style>
</head>

<body>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>

    <!-- ===== FORM INPUT DATA ===== -->
    <div class="form-card">
        <img src="{{ asset('images/Gambar Diskominfotik.jpg') }}" alt="Logo" class="logo">
        <h2>Form Identitas Pegawai</h2>
        <p class="subtitle">Masukkan data pegawai dengan lengkap dan benar</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('simpan') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="fw-semibold">Nama</label>
                <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-semibold">NIK</label>
                <input type="text" name="nik" class="form-control" required value="{{ old('nik') }}" placeholder="Masukkan NIK">
                @error('nik')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Alamat</label>
                <input type="text" name="alamat" class="form-control" required value="{{ old('alamat') }}" placeholder="Masukkan alamat tempat tinggal">
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="Masukkan email aktif">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>

    <!-- ===== HISTORY DATA MASKING ===== -->
    <div class="history-card">
        <h3>Riwayat Data Pegawai (Masked)</h3>

        @if($identitas->isEmpty())
            <p class="empty-text">Belum ada data yang diinput.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($identitas as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ substr($p->nik, 0, 4) . str_repeat('*', strlen($p->nik) - 8) . substr($p->nik, -4) }}</td>
                            <td>{{ substr($p->alamat, 0, 10) . '*****' }}</td>
                            <td>{{ substr($p->email, 0, 3) . '***' . strstr($p->email, '@') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="footer-text">
        © 2025 Diskominfotik NTB. All rights reserved.
    </div>

</body>
</html>
