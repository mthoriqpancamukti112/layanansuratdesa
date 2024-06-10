<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PermohonanSuratController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuratAhliWarisController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SuratPendudukController;
use App\Http\Controllers\SuratPindahController;
use App\Http\Controllers\SuratRekomendasiBBMController;
use App\Http\Controllers\SuratTanahController;
use App\Http\Controllers\SuratTidakMampuController;
use App\Http\Controllers\SuratUsahaController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('content.home.index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('permohonan-surat', [PermohonanSuratController::class, 'create'])->name('permohonansurat.create');
Route::post('permohonan-surat', [PermohonanSuratController::class, 'store'])->name('permohonansurat.store');

// Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
    Route::get('/user-login', [UserLoginController::class, 'index'])->name('user.login.index');
    Route::post('/user-login', [UserLoginController::class, 'authenticate'])->name('user.login.post');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('daftar-surat-permohonan-penduduk', [SuratPendudukController::class, 'index'])->name('surat.penduduk.index');
    Route::post('surat-penduduk/acc/{id}', [SuratPendudukController::class, 'acc'])->name('surat.penduduk.acc');
    Route::delete('surat-penduduk/{id}', [SuratPendudukController::class, 'destroy'])->name('surat.penduduk.destroy');
    Route::resource('desa', DesaController::class);
    Route::resource('penduduk', PendudukController::class);

    Route::get('surat/arsip', [DashboardController::class, 'arsipsurat'])->name('arsip.surat');
    Route::get('admin/notifications', [SuratPendudukController::class, 'notifications'])->name('admin.notifications');

    // Rute utama untuk form surat
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/surat/{id}', [SuratController::class, 'update'])->name('surat.update');
    Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
    Route::get('api/surat/{id}', [SuratController::class, 'getNoSurat']);

    Route::get('pembuatan-surat-permohonan', [PermohonanSuratController::class, 'index'])->name('daftarbuatpermohonan.index');
    Route::post('pembuatan-surat-permohonan/{id}/acc', [PermohonanSuratController::class, 'acc'])->name('daftarbuatpermohonan.acc');
    Route::delete('pembuatan-surat-permohonan/{id}', [PermohonanSuratController::class, 'destroy'])->name('daftarbuatpermohonan.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('surat/verifikasi/{id}', [SuratPendudukController::class, 'verifikasi'])->name('surat.verifikasi');

    // Route untuk surat usaha
    Route::get('surat/usaha', [SuratUsahaController::class, 'index'])->name('surat.usaha.index');
    Route::get('surat/usaha/create', [SuratUsahaController::class, 'create'])->name('surat.usaha.create');
    Route::post('surat/usaha', [SuratUsahaController::class, 'store'])->name('surat.usaha.store');
    Route::get('surat/usaha/{id}/edit', [SuratUsahaController::class, 'edit'])->name('surat.usaha.edit');
    Route::post('surat/usaha/{id}', [SuratUsahaController::class, 'update'])->name('surat.usaha.update');
    Route::delete('surat/usaha/{id}', [SuratUsahaController::class, 'destroy'])->name('surat.usaha.destroy');
    Route::get('surat/usaha/{id}/print', [SuratUsahaController::class, 'print'])->name('surat.usaha.print')->middleware('verify.surat.status');

    // Route untuk surat tidak mampu
    Route::get('surat/tidakmampu', [SuratTidakMampuController::class, 'index'])->name('surat.tidakmampu.index');
    Route::get('surat/tidakmampu/create', [SuratTidakMampuController::class, 'create'])->name('surat.tidakmampu.create');
    Route::post('surat/tidakmampu', [SuratTidakMampuController::class, 'store'])->name('surat.tidakmampu.store');
    Route::get('surat/tidakmampu/{id}/edit', [SuratTidakMampuController::class, 'edit'])->name('surat.tidakmampu.edit');
    Route::post('surat/tidakmampu/{id}', [SuratTidakMampuController::class, 'update'])->name('surat.tidakmampu.update');
    Route::delete('surat/tidakmampu/{id}', [SuratTidakMampuController::class, 'destroy'])->name('surat.tidakmampu.destroy');
    Route::get('surat/tidakmampu/{id}/print', [SuratTidakMampuController::class, 'print'])->name('surat.tidakmampu.print')->middleware('verify.surat.status');

    Route::get('surat/rekomendasibbm', [SuratRekomendasiBBMController::class, 'index'])->name('surat.rekomendasibbm.index');
    Route::get('surat/rekomendasibbm/create', [SuratRekomendasiBBMController::class, 'create'])->name('surat.rekomendasibbm.create');
    Route::post('surat/rekomendasibbm', [SuratRekomendasiBBMController::class, 'store'])->name('surat.rekomendasibbm.store');
    Route::get('surat/rekomendasibbm/{id}/edit', [SuratRekomendasiBBMController::class, 'edit'])->name('surat.rekomendasibbm.edit');
    Route::post('surat/rekomendasibbm/{id}', [SuratRekomendasiBBMController::class, 'update'])->name('surat.rekomendasibbm.update');
    Route::delete('surat/rekomendasibbm/{id}', [SuratRekomendasiBBMController::class, 'destroy'])->name('surat.rekomendasibbm.destroy');
    Route::get('surat/rekomendasibbm/{id}/print', [SuratRekomendasiBBMController::class, 'print'])->name('surat.rekomendasibbm.print')->middleware('verify.surat.status');

    Route::get('surat/tanah', [SuratTanahController::class, 'index'])->name('surat.tanah.index');
    Route::get('surat/tanah/create', [SuratTanahController::class, 'create'])->name('surat.tanah.create');
    Route::post('surat/tanah', [SuratTanahController::class, 'store'])->name('surat.tanah.store');
    Route::get('surat/tanah/{id}/edit', [SuratTanahController::class, 'edit'])->name('surat.tanah.edit');
    Route::post('surat/tanah/{id}', [SuratTanahController::class, 'update'])->name('surat.tanah.update');
    Route::delete('surat/tanah/{id}', [SuratTanahController::class, 'destroy'])->name('surat.tanah.destroy');
    Route::get('surat/tanah/{id}/print', [SuratTanahController::class, 'print'])->name('surat.tanah.print')->middleware('verify.surat.status');

    Route::get('surat/ahliwaris', [SuratAhliWarisController::class, 'index'])->name('surat.ahliwaris.index');
    Route::get('surat/ahliwaris/create', [SuratAhliWarisController::class, 'create'])->name('surat.ahliwaris.create');
    Route::post('surat/ahliwaris', [SuratAhliWarisController::class, 'store'])->name('surat.ahliwaris.store');
    Route::get('surat/ahliwaris/{id}/edit', [SuratAhliWarisController::class, 'edit'])->name('surat.ahliwaris.edit');
    Route::post('surat/ahliwaris/{id}', [SuratAhliWarisController::class, 'update'])->name('surat.ahliwaris.update');
    Route::delete('surat/ahliwaris/{id}', [SuratAhliWarisController::class, 'destroy'])->name('surat.ahliwaris.destroy');
    Route::get('surat/ahliwaris/{id}/print', [SuratAhliWarisController::class, 'print'])->name('surat.ahliwaris.print')->middleware('verify.surat.status');

    Route::get('surat/pindah', [SuratPindahController::class, 'index'])->name('surat.pindah.index');
    Route::get('surat/pindah/create', [SuratPindahController::class, 'create'])->name('surat.pindah.create');
    Route::post('surat/pindah', [SuratPindahController::class, 'store'])->name('surat.pindah.store');
    Route::get('surat/pindah/{id}/edit', [SuratPindahController::class, 'edit'])->name('surat.pindah.edit');
    Route::post('surat/pindah/{id}', [SuratPindahController::class, 'update'])->name('surat.pindah.update');
    Route::delete('surat/pindah/{id}', [SuratPindahController::class, 'destroy'])->name('surat.pindah.destroy');
    Route::get('surat/pindah/{id}/print', [SuratPindahController::class, 'print'])->name('surat.pindah.print')->middleware('verify.surat.status');
});

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
