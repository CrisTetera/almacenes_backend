<?php

namespace Modules\Pos\Services\DTE\FileStorage;

interface FileStorage
{
    // Methods
    public static function base64ToFile(string $path, int $folio, string $logoBase64, string $pdfBase64, string $timbreBase64, string $xmlBase64);
}