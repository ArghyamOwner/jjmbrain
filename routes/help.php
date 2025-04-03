<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Front\ArticleShow;
use App\Http\Livewire\Front\CategoryArticlesList;
use App\Http\Controllers\HelpAndSupportController;

// Help & Support Pages
Route::get('/', HelpAndSupportController::class)->name('helpdesk');
Route::get('/c/{category:slug}', CategoryArticlesList::class)->name('categoryArticles');
Route::get('/a/{article:slug}', ArticleShow::class)->name('articlesShow');
