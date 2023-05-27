<?php

namespace App\Helpers;

use App\Models\Word;
use Illuminate\Support\Facades\Http;

class WordsLoader {
    function loadAndSaveWords(string $topic, array $words, string $targetLanguage)
    {
        // Загрузка данных из API Oxford Dictionaries
        foreach ($words as $word) {
            // Получение переводов слова на указанный язык
            $response = Http::withHeaders([
                'app_id' => env('OXFORD_DICTIONARIES_APP_ID'),
                'app_key' => env('OXFORD_DICTIONARIES_APP_KEY'),
            ])->get("https://od-api.oxforddictionaries.com/api/v2/translations/en/$targetLanguage/$word");

            $data = $response->json();

            $senses = $data['results'][0]['lexicalEntries'][0]['entries'][0]['senses'];

            if (array_key_exists('subsenses', $senses[0])) {
                $translations = $senses[0]['subsenses'][0]['translations'] ?? [];

                // Получение примеров использования
                $examples = $senses[0]['subsenses'][0]['examples'] ?? [];
            } else {
                $translations = $senses[0]['translations'] ?? [];

                // Получение примеров использования
                $examples = $senses[0]['examples'] ?? [];
            }

            // Сохранение слова и его данные в базу данных
            $wordModel = new Word();
            $wordModel->language = $targetLanguage;
            $wordModel->topic = $topic;
            $wordModel->word = $word;
            $wordModel->translations = json_encode($translations);
            $wordModel->examples = json_encode($examples);
            $wordModel->save();
        }
    }
}