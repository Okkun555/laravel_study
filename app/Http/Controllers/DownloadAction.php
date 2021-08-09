<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class DownloadAction extends Controller
{
    public function __invoke(Request $request): BinaryFileResponse
    {
        return Response::download('/path/to/file.pdf');
        // response()->download(パス);　でも可能
    }
}
