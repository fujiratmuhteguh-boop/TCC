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
            max-width: 1100px;
            animation: fadeIn 0.8s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .logout-btn {
            position: fixed; top: 20px; right: 30px;
            background: #dc3545; color: white; border: none;
            border-radius: 8px; padding: 8px 14px; font-weight: 600;
        }
        thead th { background: linear-gradient(135deg, #007bff, #6610f2); color: white; }
    </style>
</head>
<body>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn">Logout</button>
</form>

<div class="container mt-4">
    <h2 class="text-center mb-4">📊 Manajemen Data Pegawai (Admin)</h2>

    <div class="card mb-5 border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Tambah Data Baru</h5>
            <form action="{{ route('admin.identitas.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password untuk Login User</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 6 Karakter" required>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary w-100">Simpan Data Pegawai</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama (Masked)</th>
                    <th>NIK (Masked)</th>
                    <th>Email (Masked)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($identitas as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ substr($p->nama, 0, 2) . '***' }}</td>
                        <td>{{ substr($p->nik, 0, 4) . '****' . substr($p->nik, -4) }}</td>
                        <td>{{ substr($p->email, 0, 3) . '***' . strstr($p->email, '@') }}</td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->id }}">
                                Lihat Data Asli
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Detail Data Asli</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p><strong>Nama:</strong> {{ $p->nama }}</p>
                                    <p><strong>NIK:</strong> {{ $p->nik }}</p>
                                    <p><strong>Alamat:</strong> {{ $p->alamat }}</p>
                                    <p><strong>Email:</strong> {{ $p->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>