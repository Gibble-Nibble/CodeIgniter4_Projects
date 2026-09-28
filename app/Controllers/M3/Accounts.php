<?php

namespace App\Controllers\M3;

use App\Controllers\BaseController;
use App\Models\M3\CustomerModel;
use App\Models\M3\UserModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class Accounts extends BaseController
{
    public function index()
    {
        return view('M3/index');
    }

    public function customers()
    {
        return view('M3/customers', [
            'customers' => (new CustomerModel())->orderBy('id', 'DESC')->findAll(),
            'message' => session()->getFlashdata('message'),
        ]);
    }

    public function newCustomer()
    {
        return view('M3/customer_form', [
            'customer' => [], 'errors' => [],
            'formAction' => site_url('customers'), 'heading' => 'Add Customer',
        ]);
    }

    public function createCustomer()
    {
        $model = new CustomerModel();
        $data = $this->request->getPost(['full_name', 'email', 'phone']);

        if (! $model->validate($data)) {
            return view('M3/customer_form', [
                'customer' => $data, 'errors' => $model->errors(),
                'formAction' => site_url('customers'), 'heading' => 'Add Customer',
            ]);
        }

        $model->insert($data);
        return redirect()->to('/customers')->with('message', 'Customer added successfully.');
    }

    public function editCustomer(int $id)
    {
        $customer = (new CustomerModel())->find($id);
        if ($customer === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found.');
        }

        return view('M3/customer_form', [
            'customer' => $customer, 'errors' => [],
            'formAction' => site_url('customers/' . $id), 'heading' => 'Edit Customer',
        ]);
    }

    public function updateCustomer(int $id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);
        if ($customer === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found.');
        }

        $data = $this->request->getPost(['full_name', 'email', 'phone']);
        if (! $model->validate($data)) {
            return view('M3/customer_form', [
                'customer' => array_merge($customer, $data), 'errors' => $model->errors(),
                'formAction' => site_url('customers/' . $id), 'heading' => 'Edit Customer',
            ]);
        }

        $model->update($id, $data);
        return redirect()->to('/customers')->with('message', 'Customer updated successfully.');
    }

    public function users()
    {
        return view('M3/users', [
            'users' => (new UserModel())->orderBy('id', 'DESC')->findAll(),
            'message' => session()->getFlashdata('message'),
        ]);
    }

    public function newUser()
    {
        return view('M3/user_form', [
            'user' => [], 'errors' => [],
            'formAction' => site_url('users'), 'heading' => 'Add User',
        ]);
    }

    public function createUser()
    {
        $model = new UserModel();
        $data = $this->request->getPost(['username', 'full_name']);
        $errors = $this->validateUserData($model, $data);
        if ($errors !== []) {
            return view('M3/user_form', [
                'user' => $data, 'errors' => $errors,
                'formAction' => site_url('users'), 'heading' => 'Add User',
            ]);
        }

        $model->insert($data);
        return redirect()->to('/users')->with('message', 'User added successfully.');
    }

    public function editUser(int $id)
    {
        $user = (new UserModel())->find($id);
        if ($user === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found.');
        }

        return view('M3/user_form', [
            'user' => $user, 'errors' => [],
            'formAction' => site_url('users/' . $id), 'heading' => 'Edit User',
        ]);
    }

    public function updateUser(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        if ($user === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found.');
        }

        $data = $this->request->getPost(['username', 'full_name']);
        $errors = $this->validateUserData($model, $data, $id);
        $avatar = $this->request->getFile('avatar');
        if ($avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $avatarName = $this->prepareAvatar($avatar, $errors);
            if ($avatarName !== null) {
                if ($errors === []) {
                    $data['avatar'] = $avatarName;
                } else {
                    @unlink(FCPATH . 'uploads/' . $avatarName);
                }
            }
        }

        if ($errors !== []) {
            return view('M3/user_form', [
                'user' => array_merge($user, $data), 'errors' => $errors,
                'formAction' => site_url('users/' . $id), 'heading' => 'Edit User',
            ]);
        }

        $model->update($id, $data);
        if (isset($data['avatar']) && ! empty($user['avatar'])) {
            $oldAvatar = FCPATH . 'uploads/' . basename($user['avatar']);
            if (is_file($oldAvatar)) {
                @unlink($oldAvatar);
            }
        }

        return redirect()->to('/users')->with('message', 'User updated successfully.');
    }

    private function validateUserData(UserModel $model, array $data, ?int $ignoreId = null): array
    {
        $model->validate($data);
        $errors = $model->errors();
        $existing = $model->where('username', $data['username'] ?? '')->first();
        if ($existing !== null && (int) $existing['id'] !== $ignoreId) {
            $errors['username'] = 'That username is already in use.';
        }
        return $errors;
    }

    private function prepareAvatar(UploadedFile $avatar, array &$errors): ?string
    {
        if (! $avatar->isValid()) {
            $errors['avatar'] = $avatar->getErrorString();
            return null;
        }

        $mime = $avatar->getMimeType();
        if (! in_array($mime, ['image/jpeg', 'image/png'], true)) {
            $errors['avatar'] = 'The avatar must be a JPG or PNG image.';
            return null;
        }
        if ($avatar->getSize() > 2 * 1024 * 1024) {
            $errors['avatar'] = 'The avatar must not be larger than 2MB.';
            return null;
        }

        $uploadDirectory = FCPATH . 'uploads/';
        if (! is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $extension = $mime === 'image/png' ? 'png' : 'jpg';
        $filename = pathinfo($avatar->getRandomName(), PATHINFO_FILENAME) . '.' . $extension;
        $sourceName = 'source_' . $filename;
        $sourcePath = $uploadDirectory . $sourceName;
        $avatar->move($uploadDirectory, $sourceName);

        try {
            service('image')->withFile($sourcePath)->fit(300, 300, 'center')->save($uploadDirectory . $filename, 85);
        } catch (\Throwable $exception) {
            @unlink($sourcePath);
            $errors['avatar'] = 'The avatar could not be prepared as an image.';
            return null;
        }

        @unlink($sourcePath);
        return $filename;
    }
}
