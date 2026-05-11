<?php

namespace App\Services;

use App\Libraries\XmlSanitizer;

class XmlService
{
    public function analyze(string $content): array
    {
        $sanitizer = new XmlSanitizer();

        $content = $sanitizer->sanitize($content);

        $warnings = $sanitizer->getWarnings();

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
                'errors' => $errors,
                'warnings' => $warnings,
            ];
        }

        $namespaces = $xml->getNamespaces(true);
        $cfdiNamespace = $namespaces['cfdi'] ?? null;
        $tfdNamespace = $namespaces['tfd'] ?? null;

        $metadata = [
            'version' => null,
            'fecha' => null,
            'total' => null,
            'emisor' => null,
            'receptor' => null,
            'uuid' => null
        ];

        if ($cfdiNamespace) {
            $xml->registerXPathNamespace('cfdi', $cfdiNamespace);

            $comprobante = $xml->xpath('//cfdi:Comprobante');
            if (!empty($comprobante)) {
                $node = $comprobante[0];
                $metadata['version'] = (string) ($node['Version'] ?? $node['version']);
                $metadata['fecha'] = (string) $node['Fecha'];
                $metadata['total'] = (string) $node['Total'];
            }

            $emisor = $xml->xpath('//cfdi:Emisor');
            if (!empty($emisor)) {
                $metadata['emisor'] = (string) $emisor[0]['Rfc'];
            }

            $receptor = $xml->xpath('//cfdi:Receptor');
            if (!empty($receptor)) {
                $metadata['receptor'] = (string) $receptor[0]['Rfc'];
            }
        }

        if ($tfdNamespace) {
            $xml->registerXPathNamespace('tfd', $tfdNamespace);

            $timbre = $xml->xpath('//tfd:TimbreFiscalDigital');

            if (!empty($timbre)) {
                $metadata['uuid'] = (string) $timbre[0]['UUID'];
            }
        }

        return [
            'valid' => true,
            'errors' => [],
            'warnings' => $warnings,
            'metadata' => $metadata,
        ];
    }
}