<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $words = $this->getWords($request['language']);

        if (!$words->count()) {
            $word = new Word();
            $word->initWordsLoading();

            $words = $this->getWords($request['language']);
        }

        $words = $words->map(function ($topic) {
            $topic->map(function ($word) {
                $word['translations'] = json_decode($word['translations'], true);
                $word['examples'] = json_decode($word['examples'], true);
                return $word;
            });
            return $topic;
        });

        return response()->json($words);
    }

    public function search_specific_word(Request $request): JsonResponse
    {
        $word = Word::where([
                'word' => $request['word'],
                'language' => $request['language']
            ])
            ->first();

        if ($word) {
            $word['translations'] = json_decode($word['translations'], true);
            $word['examples'] = json_decode($word['examples'], true);
        }

        return response()->json($word);
    }

    private function getWords($language = null): Collection
    {
        return $language
            ? Word::where('language', $language)
                ->get()
                ->groupBy('topic')
            : Word::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
