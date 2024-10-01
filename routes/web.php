<?php

use App\Enums\ArticleStatus;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect::route('dashboard');
});

Route::get('/dashboard', function () {
    // Get the current user 
    $user = User::find(Auth::user()->id);

    if (Auth::user()->is_editor) {
        // Show the publisher dashboard
        $forPublishArticles = Article::with(['writer', 'editor'])
            ->where('status', ArticleStatus::FOR_EDIT)
            ->latest()
            ->get();

        $publishedArticles = $user
            ->edited_articles()
            ->with(['writer', 'editor'])
            ->where('status', ArticleStatus::PUBLISHED)
            ->latest()
            ->get();
        
        return view('editor.dashboard', [
            'for_publish_articles' => $forPublishArticles,
            'published_articles' => $publishedArticles
        ]);
    }

    // Show the writer dashboard
    $forEditArticles = $user
        ->written_articles()
        ->with(['writer', 'editor'])
        ->where('status', ArticleStatus::FOR_EDIT)
        ->latest()
        ->get();

    $publishedArticles = $user
        ->written_articles()
        ->with(['writer', 'editor'])
        ->where('status', ArticleStatus::PUBLISHED)
        ->latest()
        ->get();

    return view('writer.dashboard', [
        'for_edit_articles' => $forEditArticles,
        'published_articles' => $publishedArticles
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/all_media', function () {
    // Show all the articles written in the system
    $articles = Article::with(['writer', 'editor'])
        ->latest()
        ->get();

    return view('all_media', [
        'articles' => $articles,
        'user' => User::find(Auth::user()->id)
    ]);
})->middleware(['auth', 'verified'])->name('all_media');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('company', CompanyController::class);
    Route::resource('article', ArticleController::class);
});
