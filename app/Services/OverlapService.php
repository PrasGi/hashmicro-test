<?php

namespace App\Services;

use App\Models\OverlapLog;

class OverlapService
{
    public function computePercentage(string $inputA, string $inputB, bool $sensitive = true): int
    {
        if (!$sensitive) {
            $inputA = mb_strtolower($inputA);
            $inputB = mb_strtolower($inputB);
        }

        $uniqA = [];
        $lenA = mb_strlen($inputA);
        for ($i = 0; $i < $lenA; $i++) {
            $ch = mb_substr($inputA, $i, 1);
            if ($ch !== ' ') {
                if (!in_array($ch, $uniqA, true)) {
                    $uniqA[] = $ch;
                }
            }
        }

        $matched = 0;
        $lenB = mb_strlen($inputB);

        foreach ($uniqA as $chA) {
            $found = false;
            for ($j = 0; $j < $lenB; $j++) {
                $chB = mb_substr($inputB, $j, 1);
                if ($chA === $chB) {
                    $found = true;
                    break;
                }
            }
            if ($found) $matched++;
        }

        if (count($uniqA) === 0) return 0;
        return (int) round(($matched / count($uniqA)) * 100);
    }

    public function computeAndLog(string $inputA, string $inputB, bool $sensitive = true): int
    {
        $pct = $this->computePercentage($inputA, $inputB, $sensitive);
        OverlapLog::create([
            'input_a'   => $inputA,
            'input_b'   => $inputB,
            'sensitive' => $sensitive,
            'result_pct'=> $pct,
        ]);
        return $pct;
    }
}
