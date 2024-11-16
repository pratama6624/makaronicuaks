<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ImageController extends Controller
{
    public function upload()
    {
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            try {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'temp', $newName);

                return $this->response->setJSON([
                    'status' => 'success',
                    'path' => base_url('writable/temp/' . $newName)
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'File upload failed']);
    }
}
