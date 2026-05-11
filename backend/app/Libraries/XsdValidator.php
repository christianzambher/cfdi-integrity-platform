<?php

namespace App\Libraries;

use DOMDocument;

class XsdValidator
{
    public function validate(string $content): array
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadXML($content);

        $xsdPath = ROOTPATH . 'storage/xsd/cfdi/cfdv40.xsd';

        $isValid = $dom->schemaValidate($xsdPath);

        if ($isValid) {
            return [
                'valid' => true,
                'errors' => []
            ];
        }

        $errors = array_map(function ($error) {
            return [
                'message' => trim($error->message),
                'line' => $error->line
            ];
        }, libxml_get_errors());

        libxml_clear_errors();

        return [
            'valid' => false,
            'errors' => $errors
        ];
    }
}