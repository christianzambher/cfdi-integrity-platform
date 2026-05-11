<?php

namespace App\Libraries;

class XmlSanitizer
{
    private array $warnings = [];
    
    /**
     * Sanitize XML content by removing BOM, normalizing encoding, and stripping invalid characters.
     * @param  mixed $content The raw XML content to sanitize.
     * @return string The sanitized XML content.
     */
    public function sanitize(string $content): string
    {
        $content = $this->removeBom($content); // Remove UTF-8 BOM if present
        $content = $this->normalizeEncoding($content); // Convert to UTF-8 if needed
        $content = $this->removeInvalidCharacters($content); // Remove characters not allowed in XML

        return $content;
    }
    
    /**
     * Get any warnings generated during the sanitization process.
     * @return array List of warning messages.
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }
    
    /**
     * Remove UTF-8 Byte Order Mark (BOM) if present at the beginning of the content.
     * @param  mixed $content The XML content to check for BOM.
     * @return string The content with BOM removed if it was present.
     */
    private function removeBom(string $content): string
    {
        if (str_starts_with($content, "\xEF\xBB\xBF")) {
            $this->warnings[] = 'UTF-8 BOM detected and removed';
            $content = substr($content, 3);
        }
        return $content;
    }
    
    /**
     * Normalize the encoding of the content to UTF-8 if it is detected as a different encoding.
     * @param  mixed $content The XML content to check and convert encoding if necessary.
     * @return string The content converted to UTF-8 encoding if it was detected as a different encoding.
     */
    private function normalizeEncoding(string $content): string
    {
        $encoding = mb_detect_encoding(
            $content,
            ['UTF-8', 'ISO-8859-1', 'WINDOWS-1252'],
            true
        );

        if ($encoding && $encoding !== 'UTF-8') {
            $this->warnings[] = "Encoding converted from {$encoding} to UTF-8";

            $content = mb_convert_encoding(
                $content,
                'UTF-8',
                $encoding
            );
        }

        return $content;
    }
    
    /**
     * Remove invalid characters from the XML content.
     * @param  mixed $content The XML content to clean.
     * @return string The content with invalid characters removed.
     */
    private function removeInvalidCharacters(string $content): string
    {
        // XML 1.0 valid characters: #x9 | #xA | #xD | [#x20-#xD7FF] | [#xE000-#xFFFD] | [#x10000-#x10FFFF]
        $cleaned = preg_replace(
            '/[^\x09\x0A\x0D\x20-\x7E\x80-\xFF]/u',
            '',
            $content
        );
    
        if ($cleaned !== $content) {
            $this->warnings[] = 'Invalid XML characters removed';
        }

        return $cleaned;
    }
}