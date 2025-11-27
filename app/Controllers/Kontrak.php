<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KontrakModel;

class Kontrak extends BaseController
{
    private $allocations;
    private $blocks;
    private $validation;
    private $lots;
    private $variable = 'kontrak';
    private $title = "Kontrak";

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->models = new KontrakModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index($penelitian_or_pengabdian = null)
    {
        // $data['title'] = $this->title;
        // $data['variable'] = $this->variable;
        // $data['data'] = $this->models->where('jenis_kontrak', $penelitian_or_pengabdian)->findAll();
        // return view($data['variable'] . '/index', $data);
    }
    public function kategori($penelitian_or_pengabdian = null)
    {
        $data['title'] = $this->title;
        $data['variable'] = $this->variable;
        $data['data'] = $this->models->where('jenis_kontrak', $penelitian_or_pengabdian)->findAll();
        return view($data['variable'] . '/index', $data);
    }
    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        // $data['variable'] = $this->variable;
        // $data['title'] = $this->title;

        // return view($data['variable'] . '/new', $data);
    }


    public function custom_new($penelitian_or_pengabdian)
    {
        $data['variable'] = $this->variable;
        $data['title'] = $this->title;
        $data['penelitian_or_pengabdian'] = $penelitian_or_pengabdian;

        return view($data['variable'] . '/new', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getPost();
        if (!$this->validation->setRules($this->rules)->run($data)) {
            $errors = $this->validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        $file = $this->request->getFile('file_kontrak');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . env('app.assetsPath') . '/upload/kontrak', $newName);
            $data['file_kontrak'] = $newName;
        }
        $this->models->insert($data);
        return redirect()->to(site_url($this->variable.'/kategori/'.$data['jenis_kontrak']))->with('success', "Data $this->title Berhasil Ditambah");
    }
    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data['title'] = $this->title;
        $data['variable'] = $this->variable;
        $data['data'] = $this->models->where(['kontrak.id_kontrak' => $id])->first();
        return view($data['variable'] . '/edit', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getPost();
        if (!$this->validation->setRules($this->rules)->run($data)) {
            $errors = $this->validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        $file = $this->request->getFile('file_kontrak');
        if ($file !== null && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . env('app.assetsPath') . '/upload/kontrak', $newName);
            $data['file_kontrak'] = $newName;
        } else {
            $blockDetail = $this->models->where(['id_kontrak' => $id])->first();
            $data['file_kontrak'] = $blockDetail['file_kontrak'];
        }
        $this->models->update($id, $data);
        return redirect()->to(site_url($this->variable.'/kategori/'.$data['jenis_kontrak']))->with('success', "Data $this->title Berhasil Diupdate");
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        $this->models->delete($id);
        return redirect()->to(site_url($this->variable))->with('warning', 'Data Berhasil Dihapus');
    }

    /**
     * Process the permanent deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        if ($id != null) {
            $this->models->delete($id, true);
        } else {
            $this->models->purgeDeleted();
        }
        return redirect()->to(site_url($this->variable . '/kategori/1'))->with('warning', 'Data Berhasil Dihapus');
    }
    public function trash()
    {
        $data['variable'] = $this->variable;
        $data['title'] = $this->title;
        $data['data'] = $this->models->onlyDeleted()->findAll();
        return view($data['variable'] . '/trash', $data);
    }
    public function restore($id = null)
    {
        if ($id != null) {
            $this->models
                ->set('deleted_at', null, true)
                ->where(['id_kontrak' => $id])
                ->update();
            return redirect()->to(site_url($this->variable))->with('success', 'Data Berhasil Direstore');
        } else {
            $this->models
                ->set('deleted_at', null, true)
                ->where('deleted_at is NOT NULL', NULL, FALSE)
                ->update();
        }
        return redirect()->to(site_url($this->variable))->with('success', 'Semua Data Berhasil Direstore');
    }
    public function updateStatus($id)
    {
        $status = $this->request->getPost('status') ?? 1;
        $this->models->update($id, ['status' => $status]);
        return $this->response->setJSON(['success' => true]);
    }
    public array $rules = [
        'judul_artikel' => [
            'rules'  => 'required|string',
            'errors' => [
                'required' => 'Judul Artikel Tidak Boleh Kosong',
            ],
        ],

        'jenis_kontrak' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Jenis Kontrak Tidak Boleh Kosong',
            ],
        ],

        'nomor_kontrak' => [
            'rules'  => 'required|string',
            'errors' => [
                'required' => 'Nomor Kontrak Tidak Boleh Kosong',
            ],
        ],

        'tanggal_tanda_tangan' => [
            'rules'  => 'required|date',
            'errors' => [
                'required'     => 'Tanggal Tanda Tangan Tidak Boleh Kosong',
                'date'          => 'Tanggal Tanda Tangan harus berupa tanggal yang valid',
            ],
        ],

        'jumlah_dana_disetujui' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required'     => 'Jumlah Dana Disetujui Tidak Boleh Kosong',
                'numeric'      => 'Jumlah Dana Disetujui harus berupa angka',
            ],
        ],

        'tahun_anggaran' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tahun Anggaran Tidak Boleh Kosong',
            ],
        ],

        'target_luaran' => [
            'rules'  => 'required|string',
            'errors' => [
                'required' => 'Target Luaran Tidak Boleh Kosong',
            ],
        ],
    ];
}
