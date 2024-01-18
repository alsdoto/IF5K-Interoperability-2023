<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenApi\Generator;
class SwaggerDocScanner extends Command
{
    protected $signature = 'swaggerdoc:scan';

    public function handle()
    {
        $path = dirname(__DIR__);

        // will create file in public/swaggerdoc.json
        $outputPath = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . '/public/swaggerdoc.json';

        $this->info('Scanning for OpenAPI annotations...'. $path);

        $openApi = Generator::scan([$path]);

        header('Content-Type: application/json');
        file_put_contents($outputPath, $openApi->toJson());
        $this->info('Output ' . $outputPath);
    }
}
