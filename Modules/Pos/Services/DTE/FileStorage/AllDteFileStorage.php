<?php

namespace Modules\Pos\Services\DTE\FileStorage;

use Modules\Pos\Services\DTE\FileStorage\LogoDteFileStorage;
use Modules\Pos\Services\DTE\FileStorage\PdfDteFileStorage;
use Modules\Pos\Services\DTE\FileStorage\SignatureDteFileStorage;
use Modules\Pos\Services\DTE\FileStorage\XmlDteFileStorage;

class AllDteFileStorage
{
    /**
     * FIXME: add comments
     */
    public static function base64ToFile(string $path, int $folio, string $logoBase64, string $pdfBase64, string $timbreBase64, string $xmlBase64)
    {
        $pathLogo       = LogoDteFileStorage::base64ToFile($path, $logoBase64, $folio);
        $pathPdf        = PdfDteFileStorage::base64ToFile($path, $pdfBase64, $folio);
        $pathSignature  = SignatureDteFileStorage::base64ToFile($path, $timbreBase64, $folio);
        $pathXml        = XmlDteFileStorage::base64ToFile($path, $xmlBase64, $folio);

        return [
            'status' => 'success',
            'message' => 'Files Stored in file system',
            'paths' => [
                'logo_path' => $pathLogo,
                'pdf_path' => $pathPdf,
                'signature_path' => $pathSignature,
                'xml_path' => $pathXml,
            ],
        ];
    } // end function
}