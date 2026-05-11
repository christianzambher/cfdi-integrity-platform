<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Services\XmlService;

class ApiController extends ResourceController
{
    public function index()
    {
        //
    }

    public function health()
    {
        return $this->respond([
            'status' => 'ok',
            'message' => 'CFDI Integrity Platform API'
        ]);
    }

    public function validateXml()
    {
        $file = $this->request->getFile('xmlFile');

        if (!$file || !$file->isValid()) {
            return $this->fail([
                'message' => 'Invalid file upload'
            ], 400);
        }

        $content = file_get_contents($file->getTempName());

        $xmlService = new XmlService();
        $result = $xmlService->analyze($content);

        return $this->respond($result);
    }
}
