<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengabdianModel;

class Pengabdian extends BaseController
{
    private $allocations;
    private $blocks;
    private $validation;
    private $lots;
    private $variable = 'pengabdian';
    private $title = "Pengabdian";

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->models = new PengabdianModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['variable'] = $this->variable;
        $data['data'] = $this->models->FindAll();

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
        $data['variable'] = $this->variable;
        $data['title'] = $this->title;
        $data['Block'] = $this->models->findAll();
        $data['lots'] = $this->lots->select('lots.*, buyers.name as lot_owner')
            ->join('buyers', 'buyers.buyer_id = lots.buyer_id')
            ->findAll();
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
        $file = $this->request->getFile('certificate');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . env('app.assetsPath') . '/upload/block', $newName);
            $data['certificate'] = $newName;
        }
        $this->models->insert($data);
        return redirect()->to(site_url('Lot/' . $this->variable))->with('success', "Data $this->title Berhasil Ditambah");
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
        $data['data'] = $this->models->where(['blocks.block_id' => $id])->first();
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
        $file = $this->request->getFile('certificate');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . env('app.assetsPath') . '/upload/block', $newName);
            $data['certificate'] = $newName;
        } else {
            $blockDetail = $this->models->where(['block_id' => $id])->first();
            $data['certificate'] = $blockDetail['certificate'];
        }
        $this->models->update($id, $data);
        return redirect()->to(site_url('Lot/' . $this->variable))->with('success', "Data $this->title Berhasil Diupdate");
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
        return redirect()->to(site_url('Lot/' . $this->variable))->with('success', 'Data Berhasil Dihapus');
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
        return redirect()->to(site_url('Lot/' . $this->variable . '/trash'))->with('success', 'Data Berhasil Dihapus');
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
                ->where(['block_id' => $id])
                ->update();
            return redirect()->to(site_url('Lot/' . $this->variable))->with('success', 'Data Berhasil Direstore');
        } else {
            $this->models
                ->set('deleted_at', null, true)
                ->where('deleted_at is NOT NULL', NULL, FALSE)
                ->update();
        }
        return redirect()->to(site_url('Lot/' . $this->variable))->with('success', 'Semua Data Berhasil Direstore');
    }
    public array $rules = [
        'name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Blok Tidak Boleh Kosong',
            ]
        ],
        'land_size' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Luas Blok Tidak Boleh Kosong',
            ]
        ],
        'total_lot' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jumlah Kavling Tidak Boleh Kosong',
            ]
        ],
        'northern_boundary' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Batas Utara Tidak Boleh Kosong',
            ]
        ],
        'southern_boundary' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Batas Selatan Tidak Boleh Kosong',
            ]
        ],
        'eastern_boundary' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Batas Timur Tidak Boleh Kosong',
            ]
        ],
        'western_boundary' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Batas Barat Tidak Boleh Kosong',
            ]
        ]
    ];
}
