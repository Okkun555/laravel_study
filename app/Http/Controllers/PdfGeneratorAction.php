<?php

namespace App\Http\Controllers;

use App\Jobs\PdfGenerator;
use Illuminate\Contracts\Bus\Dispatcher;

final class PdfGeneratorAction extends Controller
{
    private $dispatcher;

    public function __construct(
        Dispatcher $dispatcher
    ) {
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(): void
    {
        $generator = new PdfGenerator(storage_path('pdf/sample.pdf'));
//        $this->dispatcher->dispatch($generator);
        $this->dispatch($generator);
    }
}
