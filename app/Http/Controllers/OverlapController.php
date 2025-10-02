<?php

namespace App\Http\Controllers;

use App\Services\OverlapService;
use Illuminate\Http\Request;

class OverlapController extends Controller
{
    public function __construct(private OverlapService $svc) {}

    public function page()
    {
        return view('overlap.index');
    }

    public function calc(Request $req)
    {
        $data = $req->validate([
            'inputA'    => ['required','string'],
            'inputB'    => ['required','string'],
            'sensitive' => ['nullable','boolean'],
        ]);
        $sensitive = $req->boolean('sensitive');
        $pct = $this->svc->computeAndLog($data['inputA'], $data['inputB'], $sensitive);
        return back()->withInput()->with('pct', $pct);
    }

    public function apiCalc(Request $req)
    {
        $data = $req->validate([
            'inputA'    => ['required','string'],
            'inputB'    => ['required','string'],
            'sensitive' => ['nullable','boolean'],
        ]);
        $pct = $this->svc->computeAndLog($data['inputA'], $data['inputB'], (bool)($data['sensitive'] ?? true));
        return response()->json(['percentage' => $pct]);
    }
}
