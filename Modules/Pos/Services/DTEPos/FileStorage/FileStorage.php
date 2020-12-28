<?php

namespace Modules\Pos\Services\DTEPos\FileStorage;

interface FileStorage
{
    // Methods
    public static function base64ToFile(string $path, string $folio, string $logoBase64, string $pdfBase64, string $timbreBase64, string $xmlBase64);
}