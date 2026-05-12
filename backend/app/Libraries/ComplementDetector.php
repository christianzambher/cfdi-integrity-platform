<?php
namespace App\Libraries;
class ComplementDetector
{
    private array $complements;
    public function __construct()
    {
        $this->complements = require APPPATH . 'Config/CfdiComplements.php';
    }
    public function detect(array $namespaces): array
    {
        $detected = [];

        foreach ($this->complements as $key => $complement) {
            if (in_array($complement['namespace'], $namespaces)) {
                $detected[] = [
                    'key' => $key,
                    'name' => $complement['name']
                ];
            }
        }
        return $detected;
    }
}