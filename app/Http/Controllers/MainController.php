<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 1/13/22
 * Time: 6:15 PM
 */

namespace App\Http\Controllers;


use App\System\Analyzers\TextAnalyzer;
use App\System\Builders\AnalyzerResultBuilder;
use App\System\Builders\FileBuilderFactory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function analyzeText(Request $request)
    {
//        try {
            return view('pages.home', [
                'data' => (new TextAnalyzer($request))->analyze()
            ]);
//        } catch (\Exception $e) {
//            return back()->with('error', $e->getMessage());
//        }

    }

    public function analyzeFile(Request $request)
    {
//        try {
        return view('pages.home', [
            'data' => (new FileAnalyzer($request))->analyze()
        ]);
//        } catch (\Exception $e) {
//            return back()->with('error', $e->getMessage());
//        }

    }

    public function download(Request $request, string $typeFile, int $id)
    {
        $file = (FileBuilderFactory::getBuilder($typeFile))->build(AnalyzerResultBuilder::builder($id));

        $header = sprintf(
            'attachment: filename="%s"',
            $file
        );

        return response()->file(
            $file,
            ['Content-Disposition' => $header]
        )
            ->deleteFileAfterSend();
    }
}