<?php

namespace App\Services;

class XmlService
{
    public function analyze(string $content): array
    {
        libxml_use_internal_errors(true);

        $xml = simplexml_load_string($content);

        if ($xml === false) {
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

        return [
            'valid' => true,
            'errors' => []
        ];
    }
}