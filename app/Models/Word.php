<?php

namespace App\Models;

use App\Helpers\WordsLoader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $casts = [
        'translations' => 'array',
        'examples' => 'array',
    ];

    const TOPICS = [
        'Transport' => ['bus', 'car', 'train', 'bicycle'],
        'Family' => ['mother', 'father', 'son', 'daughter']
    ];

    public function initWordsLoading()
    {
        $wordsLoader = new WordsLoader();
        foreach (Word::TOPICS as $topic => $words) {
            $wordsLoader->loadAndSaveWords($topic, $words, 'ru'); // Загрузка на русский язык
            $wordsLoader->loadAndSaveWords($topic, $words, 'es'); // Загрузка на испанский язык
        }
    }
}
