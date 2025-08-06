<?php
class UserController {
    private $repo;

    public function __construct(UserRepository $repo) {
        $this->repo = $repo;
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'list';

        try {
            switch ($action) {
                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $this->addUser();
                    } else {
                        include "views/add_user_form.php";
                    }
                    break;

                case 'list':
                    $users = $this->repo->getAll();
                    include "views/user_list.php";
                    break;

                case 'view':
                    $id = $_GET['id'] ?? null;
                    $user = $this->repo->getById($id);
                    // If AJAX request, return JSON
                    if (
                        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
                    ) {
                        header('Content-Type: application/json');
                        echo json_encode($user);
                        exit;
                    } else {
                        var_dump($user); // fallback for direct view
                    }
                    break;

                case 'delete':
                    $id = $_GET['id'] ?? null;
                    $this->repo->delete($id);
                    header("Location: index.php?action=list");
                    break;

                default:
                    echo "Invalid action";
            }
        } catch (Exception $e) {
            echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }
    }

   private function addUser() {
    try {
        $id = time();
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = new User($id, $name, $email, $password);
        $this->repo->add($user);

        // If AJAX request → return JSON
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            header('Content-Type: application/json');
            echo json_encode(["status" => "success"]);
            exit;
        }

    } catch (Exception $e) {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            exit;
        } else {
            echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }
    }
}

}
?>
