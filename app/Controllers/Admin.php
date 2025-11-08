<?php

namespace App\Controllers;

use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    
    public function index()
    {
       
        $this->ensureAdmin();
        $users = (new UserModel())
            ->orderBy('id', 'desc')
            ->findAll();
        return view('admin/users_list', ['users' => $users]);
    }

    public function view($id)
    {
        $this->ensureAdmin();
        $user = (new UserModel())->find($id);
        return view('users/view', ['user' => $user]);
    }

    public function edit($id)
    {
        $this->ensureAdmin();
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'date_of_birth' => $this->request->getPost('date_of_birth') ?: null,
                'gender' => $this->request->getPost('gender') ?: null,
                'address' => $this->request->getPost('address') ?: null,
                'is_admin' => $this->request->getPost('is_admin') ? 1 : 0,
            ];
            $userModel->update($id, $data);
            return redirect()->to('/admin')->with('success', 'User updated');
        }
        return view('users/edit', ['user' => $user]);
    }

    public function delete($id)
    {
        $this->ensureAdmin();
        (new UserModel())->delete($id);
        return redirect()->to('/admin')->with('success', 'User deleted');
    }

    public function exportExcel()
    {
        $this->ensureAdmin();
        if (!class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet')) {
            return redirect()->to('/admin')->with('error', 'Excel export library not installed. Run: composer require phpoffice/phpspreadsheet');
        }
        $users = (new UserModel())->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([
            ['ID','First Name','Last Name','Email','DOB','Gender','Address','Is Admin']
        ], null, 'A1');
        $row = 2;
        foreach ($users as $u) {
            $sheet->fromArray([
                [$u['id'], $u['first_name'], $u['last_name'], $u['email'], $u['date_of_birth'], $u['gender'], $u['address'], $u['is_admin'] ? 'Yes' : 'No']
            ], null, 'A' . $row);
            $row++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'users_' . date('Ymd_His') . '.xlsx';
        $tmp = WRITEPATH . 'exports/' . $fileName;
        if (! is_dir(dirname($tmp))) { mkdir(dirname($tmp), 0775, true); }
        $writer->save($tmp);
        return $this->response->download($tmp, null)->setFileName($fileName);
    }

    public function exportPdf()
    {
        $this->ensureAdmin();
        if (!class_exists(\Dompdf\Dompdf::class)) {
            return redirect()->to('/admin')->with('error', 'PDF export library not installed. Run: composer require dompdf/dompdf');
        }
        $users = (new UserModel())->findAll();
        $html = view('admin/users_pdf', ['users' => $users]);
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('users_' . date('Ymd_His') . '.pdf', ['Attachment' => 0]);
        exit;
    }

    private function ensureAdmin(): void
    {
        $user = session('user');
        if (! $user || empty($user['is_admin'])) {
            redirect()->to('/login')->send();
            exit;
        }
    }
}


