<?php

namespace App\System\Analyzers;


use App\Models\AnalyzerResults;
use App\Models\FrequencyCharacters;
use App\System\Builders\AnalyzerResultBuilder;
use Illuminate\Http\Request;

class TextAnalyzer
{

    protected string $text;

    public function __construct(Request $request)
    {
        $this->text = strip_tags(trim(($request->get('data'))));
    }

    public function analyze()
    {
        $hash = md5($this->text);
        $data = AnalyzerResults::whereHash($hash)->first();
        $result = $data ? AnalyzerResultBuilder::builder($data->id) : $this->generateResult($hash);

        session()->put("results$hash", $result);
        session()->save();

        return $result;
    }

    public function generateResult(string $hash)
    {
        $startTime = hrtime(true);
        $model = new AnalyzerResults();

        $model->hash = $hash;
        $model->number_characters = $this->numberOfCharacters();
        $model->number_words = $this->numberOfWords();
        $model->number_sentences = $this->numberOfSentences();
        $model->average_word_length = $this->averageWordLength();
        $model->average_number_words = $this->averageNumberOfWords();
        $model->palindrome_words = $this->palindromeWords();
        $model->top_palindrome_words = $this->topPalindromeWords();
        $model->is_palindrome_string = $this->isPalindromeString();
        $model->reversed_text = $this->reversedText();
        $model->reversed_word = $this->reversedWord();

        $model->save();

        $dataFC = $this->frequencyOfCharacters();

        foreach ($dataFC as $key => $item) {
            if (!empty($item) && $item != ' ') {
                $frequencyCharacters = new FrequencyCharacters();
                $frequencyCharacters->analyzer_result_id = $model->id;
                $frequencyCharacters->characters = $key;
                $frequencyCharacters->frequency = $item;
                $frequencyCharacters->save();
            }
        }

        $model->time = (hrtime(true) - $startTime) / 1e+6;
        $model->update();

        return AnalyzerResultBuilder::builder($model->id);
    }

    public function numberOfCharacters(): int
    {
        return strlen($this->text);
    }

    public function numberOfWords(): int
    {
        return str_word_count($this->text);
    }

    public function numberOfSentences(): int
    {
        return preg_match_all('/[^\s](\.|\!|\?)(?!\w)/', $this->text, $match);
    }

    public function frequencyOfCharacters(): array
    {
        $result = [];

        foreach (count_chars($this->text, 1) as $i => $val) {
            $result[$val] = chr($i);
        }

        return $result;
    }

    public function distributionPercentage(): array
    {
        $text = str_replace(' ', '', $this->text);
        $arrLetters = str_split($text);
        $countLetters = count($arrLetters);

        $letters = [];

        foreach ($arrLetters as $letter) {
            if (isset($letters[$letter])) {
                $letters[$letter] += 1;
            } else {
                $letters[$letter] = 1;
            }
        }

        return $letters = [
            'letters' => $letters,
            'countLetters' => $countLetters,
        ];
    }

    public function averageWordLength(): int
    {
        $characters = strlen($this->text);
        $words = str_word_count($this->text, 1);
        $words = count($words);

        return $characters / $words;
    }

    public function averageNumberOfWords(): int
    {
        $words = str_word_count($this->text, 1);
        $words = count($words);
        $sentence = preg_match_all('/[^\s](\.|\!|\?)(?!\w)/', $this->text, $match);

        if ($sentence == 0) {
            return $words;
        }

        return $words / $sentence;
    }

    public function topMostUsedWords($stop_words = []): array
    {
        $string = strtolower($this->text);

        $words = str_word_count($string, 1);
        $words = array_diff($words, $stop_words);
        $words = array_count_values($words);
        arsort($words);

        $words = array_slice($words, 0, 10);
        return $words;
    }

    public function topShortestWords(): array
    {
        $words = explode(' ', $this->text);
        $results = [];

        foreach ($words as $word) {
            $results[] = [
                'word' => $word,
                'characters' => strlen($word),
            ];
        }

        usort($results, function ($a, $b) {
            return ($a['characters'] - $b['characters']);
        });

        return $results;
    }

    public function palindromeWords(): int
    {
        $words = explode(' ', $this->text);
        $count = 0;

        foreach ($words as $word) {
            if (strrev($word) === $word) {
                $count++;
            }
        }

        return $count;
    }

    public function topPalindromeWords(): string
    {
        $l = 0;
        $r = strlen($this->text) - 1;
        $flag = 0;

        while ($r > $l) {
            if ($this->text[$l] != $this->text[$r]) {
                $flag = 1;
                break;
            }
            $l++;
            $r--;
        }

        if ($flag == 0) {
            $this->topLongestWords();
        } else {
            return "Text is not a Palindrome string";
        }
    }

    public function isPalindromeString(): string
    {
        $l = 0;
        $r = strlen($this->text) - 1;
        $flag = 0;

        while ($r > $l) {
            if ($this->text[$l] != $this->text[$r]) {
                $flag = 1;
                break;
            }
            $l++;
            $r--;
        }

        if ($flag == 0) {
            return "Text is a Palindrome string";
        } else {
            return "Text is not a Palindrome string";
        }
    }

    public function reversedText(): string
    {
        return strrev($this->text);
    }

    public function reversedWord(): string
    {
        $words = explode(' ', $this->text);
        $words = array_reverse($words);
        $words = implode(" ", $words);

        return $words;
    }
}