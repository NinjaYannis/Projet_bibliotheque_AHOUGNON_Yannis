<?php  
  
use App\Http\Controllers\ProfileController;  
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\AbonneController;  
use App\Http\Controllers\LivreController;  
use App\Http\Controllers\PretController;  
use App\Http\Controllers\PenaliteController;  
  
Route::get('/', function () {  
    return redirect('/dashboard');  
});  
  
Route::get('/dashboard', function () {  
    return view('dashboard');  
})->middleware(['auth', 'verified'])->name('dashboard');  
  
Route::middleware('auth')->group(function () {  
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');  
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');  
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');  
  
    // Routes principales sous auth :  
    Route::resource('abonnes', AbonneController::class);  
    Route::resource('livres', LivreController::class);  
      
    Route::get('/prets/historique', [PretController::class, 'historique'])->name('prets.historique');  
    Route::resource('prets', PretController::class);  
      
    Route::resource('penalites', PenaliteController::class);  
    Route::post('/prets/{pret}/retour', [PretController::class, 'retour'])->name('prets.retour');  
    Route::post('/penalites/{penalite}/regler', [PenaliteController::class, 'regler'])->name('penalites.regler');  
});  
  
require __DIR__.'/auth.php';