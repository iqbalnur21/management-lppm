<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\PenelitianModel;

class Penelitian extends BaseController
{
    private $allocations;
    private $blocks;
    private $validation;
    private $lots;
    private $variable = 'penelitian';
    private $title = "Penelitian";

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->models = new PenelitianModel();
        $this->dosenModels = new DosenModel();
        $this->mahasiswaModels = new MahasiswaModel();
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
        $data['data'] = $this->models->findAll();

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
        $data['list_dosen'] = $this->dosenModels->findAll();
        $data['list_mahasiswa'] = $this->mahasiswaModels->findAll();

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
        $fileSuratTugas = $this->request->getFile('file_surat_tugas');
        $fileProposal = $this->request->getFile('file_proposal');
        $fileLaporan = $this->request->getFile('file_laporan_akhir');
        if ($fileSuratTugas->isValid() && !$fileSuratTugas->hasMoved()) {
            $newNameSuratTugas = $fileSuratTugas->getRandomName();
            $fileSuratTugas->move(ROOTPATH . env('app.assetsPath') . '/upload/penelitian/surat_tugas', $newNameSuratTugas);
            $data['file_surat_tugas'] = $newNameSuratTugas;
        }
        if ($fileProposal->isValid() && !$fileProposal->hasMoved()) {
            $newNameProposal = $fileProposal->getRandomName();
            $fileProposal->move(ROOTPATH . env('app.assetsPath') . '/upload/penelitian/proposal', $newNameProposal);
            $data['file_proposal'] = $newNameProposal;
        }
        if ($fileLaporan->isValid() && !$fileLaporan->hasMoved()) {
            $newNameLaporan = $fileLaporan->getRandomName();
            $fileLaporan->move(ROOTPATH . env('app.assetsPath') . '/upload/penelitian/laporan', $newNameLaporan);
            $data['file_laporan_akhir'] = $newNameLaporan;
        }
        $this->models->insert($data);
        return redirect()->to(site_url($this->variable))->with('success', "Data $this->title Berhasil Ditambah");
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
        $data['list_dosen'] = $this->dosenModels->findAll();
        $data['list_mahasiswa'] = $this->mahasiswaModels->findAll();
        $data['data'] = $this->models->where(['penelitian.id_penelitian' => $id])->first();
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
        $fileSuratTugas = $this->request->getFile('file_surat_tugas');
        $fileProposal = $this->request->getFile('file_proposal');
        $fileLaporan = $this->request->getFile('file_laporan_akhir');
        if ($fileSuratTugas->isValid() && !$fileSuratTugas->hasMoved()) {
            $newNameSuratTugas = $fileSuratTugas->getRandomName();
            $fileSuratTugas->move(ROOTPATH . env('app.assetsPath') . '/upload/penelitian/surat_tugas', $newNameSuratTugas);
            $data['file_surat_tugas'] = $newNameSuratTugas;
        } else {
            $blockDetail = $this->models->where(['id_penelitian' => $id])->first();
            $data['file_surat_tugas'] = $blockDetail['file_surat_tugas'];
        }
        if ($fileProposal->isValid() && !$fileProposal->hasMoved()) {
            $newNameProposal = $fileProposal->getRandomName();
            $fileProposal->move(ROOTPATH . env('app.assetsPath') . '/upload/penelitian/proposal', $newNameProposal);
            $data['file_proposal'] = $newNameProposal;
        } else {
            $blockDetail = $this->models->where(['id_penelitian' => $id])->first();
            $data['file_proposal'] = $blockDetail['file_proposal'];
        }
        if ($fileLaporan->isValid() && !$fileLaporan->hasMoved()) {
            $newNameProposal = $fileLaporan->getRandomName();
            $fileLaporan->move(ROOTPATH . env('app.assetsPath') . '/upload/penelitian/laporan', $newNameProposal);
            $data['file_laporan_akhir'] = $newNameProposal;
        } else {
            $blockDetail = $this->models->where(['id_penelitian' => $id])->first();
            $data['file_laporan_akhir'] = $blockDetail['file_laporan_akhir'];
        }
        $this->models->update($id, $data);
        return redirect()->to(site_url($this->variable))->with('success', "Data $this->title Berhasil Diupdate");
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
        return redirect()->to(site_url($this->variable))->with('warning', 'Data Berhasil Dihapus');
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
                ->where(['id_penelitian' => $id])
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
        'id_dosen' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'ID Dosen Tidak Boleh Kosong',
            ]
        ],
        'id_mahasiswa' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'ID Mahasiswa Tidak Boleh Kosong',
            ]
        ],
        'tujuan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tujuan Tidak Boleh Kosong',
            ]
        ],
        'nomor_surat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nomor Surat Tidak Boleh Kosong',
            ]
        ],
        'judul_penelitian' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Judul Penelitian Tidak Boleh Kosong',
            ]
        ],
        'skema_penelitian' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Skema Penelitian Tidak Boleh Kosong',
            ]
        ],
        'tanggal_penelitian' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Penelitian Tidak Boleh Kosong',
            ]
        ],
        'sumber_dana' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Sumber Dana Tidak Boleh Kosong',
            ]
        ],
        'jumlah_dana' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jumlah Dana Tidak Boleh Kosong',
            ]
        ],
        'status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Status Tidak Boleh Kosong',
            ]
        ],
        'catatan_verifikator' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Catatan Verifikator Tidak Boleh Kosong',
            ]
        ],
    ];
}
