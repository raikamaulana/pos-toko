<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>403 - Akses Ditolak | POS Barokah Mart</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-sm max-w-md w-full text-center">
        <div class="text-red-600 text-5xl font-bold mb-2">403</div>
        <h1 class="text-xl font-semibold text-gray-800 mb-2">Akses Ditolak</h1>
        <p class="text-sm text-gray-600 mb-6">
            Maaf, akun Anda (<span class="font-medium">{{ auth()->user()->role ?? 'tamu' }}</span>) tidak memiliki izin untuk mengakses halaman ini.
        </p>
        <a href="{{ route('dashboard') }}"
            class="inline-block bg-indigo-600 text-white text-sm font-medium px-5 py-2.5 rounded-md hover:bg-indigo-700">
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>

