<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User as ModelsUser;

class User extends BaseController
{
    private $validation;
    private $variable = 'user';
    private $title = "User";
    protected $models; // Changed to protected to match standard inheritance, or keep private if preferred

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->models = new ModelsUser();
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
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $data['variable'] = $this->variable;
        $data['title'] = $this->title;
        // If you have a RoleModel, fetch roles here. 
        // For now, the view uses hardcoded fallbacks or you can pass them here.

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

        // Add specific rule for password on Creation (Required)
        $this->rules['password'] = [
            'rules' => 'required|min_length[6]',
            'errors' => [
                'required' => 'Password wajib diisi',
                'min_length' => 'Password minimal 6 karakter'
            ]
        ];

        if (!$this->validation->setRules($this->rules)->run($data)) {
            $errors = $this->validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // Hash the password before inserting
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

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
        $data['data'] = $this->models->where(['id' => $id])->first();
        
        if (empty($data['data'])) {
            return redirect()->to(site_url($this->variable))->with('error', 'Data tidak ditemukan');
        }

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

        // Password is optional on Update. 
        // If empty, we remove it from validation and data to keep old password.
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            // If provided, validate length and hash it
            $this->rules['password'] = [
                'rules' => 'min_length[6]',
                'errors' => ['min_length' => 'Password minimal 6 karakter']
            ];
        }

        if (!$this->validation->setRules($this->rules)->run($data)) {
            $errors = $this->validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // Hash password if it exists in the data array
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $this->models->update($id, $data);
        return redirect()->to(site_url($this->variable))->with('success', "Data $this->title Berhasil Diupdate");
    }

    /**
     * Custom function to reset password to 123456
     * * @param mixed $id
     */
    public function reset($id = null)
    {
        if ($id == null) {
            return redirect()->back()->with('error', 'ID User tidak valid');
        }

        // Hash the default password
        $newPassword = password_hash('123456', PASSWORD_DEFAULT);
        
        $this->models->update($id, ['password' => $newPassword]);

        return redirect()->to(site_url($this->variable))->with('success', 'Password berhasil direset menjadi 123456');
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
        // Prevent deleting yourself (optional safety check)
        if (session('user_id') == $id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri saat sedang login.');
        }

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
        return redirect()->to(site_url($this->variable))->with('success', 'Data Berhasil Dihapus Permanen');
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
                ->where(['id' => $id]) // Changed from id_dosen to id
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

    // Validation Rules
    public array $rules = [
        'name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap Tidak Boleh Kosong',
            ]
        ],
        'username' => [
            'rules' => 'required|alpha_dash|is_unique[users.username,id,{id}]', 
            // Note: Adjust table name 'users' and primary key 'id' if different in DB
            'errors' => [
                'required' => 'Username Tidak Boleh Kosong',
                'alpha_dash' => 'Username hanya boleh huruf, angka, dan garis bawah',
                'is_unique' => 'Username sudah digunakan'
            ]
        ],
        'role_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Role (Peran) Harus Dipilih',
            ]
        ],
        // Password rule is handled dynamically in create() and update()
    ];
}