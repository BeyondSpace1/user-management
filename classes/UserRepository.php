<?php
class UserRepository {
    private $file;

    public function __construct($filePath) {
        $this->file = $filePath;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }
    }

    private function readData() {
        return json_decode(file_get_contents($this->file), true) ?? [];
    }

    private function writeData($data) {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getAll() {
        $users = $this->readData();
        foreach ($users as &$u) unset($u['password']);
        return $users;
    }

    public function getById($id) {
        foreach ($this->readData() as $user) {
            if ($user['id'] == $id) {
                unset($user['password']);
                return $user;
            }
        }
        return null;
    }

    public function add(User $user) {
        $data = $this->readData();

        // Email uniqueness check
        foreach ($data as $u) {
            if ($u['email'] === $user->getEmail()) {
                throw new Exception("Email already exists");
            }
        }

        $data[] = $user->toArray();
        $this->writeData($data);
    }

    public function update($id, User $updatedUser) {
        $data = $this->readData();
        foreach ($data as &$u) {
            if ($u['id'] == $id) {
                $u = $updatedUser->toArray();
                $this->writeData($data);
                return true;
            }
        }
        return false;
    }

    public function delete($id) {
        $data = array_filter($this->readData(), fn($u) => $u['id'] != $id);
        $this->writeData(array_values($data));
    }
}
?>
