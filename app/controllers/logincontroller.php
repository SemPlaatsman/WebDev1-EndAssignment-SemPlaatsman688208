<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class LoginController extends Controller {
    private $loginService;

    function __construct() {
        $this->loginService = new LoginService();
    }

    public function index() {
        // handle POST
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
            // login process
            if (!empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['username']) && isset($_POST['password'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $user = $this->validateUser($username, $password);
                if ($user != null) {
                    // start session if it hasn't been started yet
                    (session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED) ? session_start() : null;
                    $_SESSION['user'] = serialize($user);
                    // redirect to dashboard
                    header('Location: /dashboard');
                    exit();
                }
            }
        }
        $this->displayView();
    }

    public function validateUser(string $username, string $password) : ?User {
        return $this->loginService->validateUser($username, $password);
    }
}
?>