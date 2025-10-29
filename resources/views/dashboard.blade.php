<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Diskominfotik NTB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
            padding: 40px 0 80px;
        }

        .container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 1000px;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            font-weight: 700;
            color: #333;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #6610f2);
            border: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #0056d2, #520dc2);
        }

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

        table {
            font-size: 0.9rem;
        }

        thead th {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            text-align: center;
        }

        tbody td {
            vertical-align: middle;
            text-align: center;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            color: white;
            opacity: 0.9;
        }
    </style>
</head>
<body>

<!-- Tombol Logout -->
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn">Logout</button>
</form>

<div class="container mt-4">
    <h2 class="text-center mb-4">📊 Dashboard Admin - Data Identitas Pegawai</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($data->isEmpty())
        <p class="text-center text-muted">Belum ada data yang diinput.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama (Masked)</th>
                        <th>NIK (Masked)</th>
                        <th>Alamat (Masked)</th>
                        <th>Email (Masked)</th>
                        <th>Tanggal Input</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $d)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ substr($d->nama, 0, 2) . str_repeat('*', max(strlen($d->nama) - 2, 0)) }}</td>
                            <td>{{ substr($d->nik, 0, 4) . str_repeat('*', strlen($d->nik) - 8) . substr($d->nik, -4) }}</td>
                            <td>{{ substr($d->alamat, 0, 10) . '*****' }}</td>
                            <td>{{ substr($d->email, 0, 3) . '***' . strstr($d->email, '@') }}</td>
                            <td>{{ $d->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $d->id }}">
                                    Lihat Asli
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detail Data -->
                        <div class="modal fade" id="detailModal{{ $d->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Detail Data Pegawai</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama:</strong> {{ $d->nama }}</p>
                                        <p><strong>NIK:</strong> {{ $d->nik }}</p>
                                        <p><strong>Alamat:</strong> {{ $d->alamat }}</p>
                                        <p><strong>Email:</strong> {{ $d->email }}</p>
                                        <p><strong>Tanggal Input:</strong> {{ $d->created_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<footer>
    © 2025 Diskominfotik NTB. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
