<?php   


    class db {
        protected $pdo;
        protected $dsn;

        function init() {
            require_once("connect.php");

            $this->$dsn = "mysql:host=${DB_HOST};dbname=${DB_NAME}";
            
            try {
                $this->pdo = new PDO($this->$dsn, $DB_USER, $DB_PASS);
            } catch (PDOExeption $e){
                echo $e->getMessage();
                exit;
            }
        }

        protected function getUserByName($username) {
            $query = 'SELECT * FROM users';
            $result = $this->pdo->query($query);
            
            foreach ($result as $row) {
                if ($row['Username'] == $username)
                    return $row;
            }
            return NULL;
        }

        function create_user($username, $pass, $confirm_pass) {
            if (empty($username) || empty($pass) || empty($confirm_pass))
                return 'ERROR: The fields should not be empty.';
            if ($pass != $confirm_pass)
                return 'ERROR: Passwords do not match';
            if ($this->getUserByName($username) != NULL)
                return 'ERROR: The username is already taken.';

            $data = [
                'Username' => $username,
                'Password' => password_hash($pass, PASSWORD_BCRYPT),
            ];
            $query = 'INSERT INTO users(Username, Password) VALUES(:Username, :Password)';
            $this->pdo->prepare($query)->execute($data);
            return '';
        }


        function login($username, $pass) {
            if (empty($username) || empty($pass))
                return 'ERROR: The fields should not be empty.';
            $user = $this->getUserByName($username);
            if ($user == NULL || !password_verify($pass, $user['Password']))
                return 'ERROR: Invalid username or password.';
            return '';
        }



        function SaveFileToDB($username, $url) {
            $data = [
                'user' => $username,
                'url' => $url,
            ];
            $query = 'INSERT INTO uploads(user, url) VALUES(:user, :url)';
            $this->pdo->prepare($query)->execute($data);
        }


        function getUploads($username) {
            $query = 'SELECT * FROM uploads';
            $result = $this->pdo->query($query);
            
            $tbl_uploads = [];
            foreach ($result as $row) {
                if ($row['user'] == $username)
                    $tbl_uploads[] = $row;
            }
            
            return $tbl_uploads;
        }


    };
?>