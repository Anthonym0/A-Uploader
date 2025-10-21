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

        protected function user_match($username) {
            $query = 'SELECT * FROM users';
            $result = $this->pdo->query($query);
            
            foreach ($result as $row) {
                if ($row['Username'] == $username)
                    return true;
            }
            return false;
        }

        function create_user($username, $pass, $confirm_pass) {
            if (empty($username) || empty($pass) || empty($confirm_pass))
                return 'ERROR: The fields should not be empty.';
            if ($pass != $confirm_pass)
                return 'ERROR: Passwords do not match';
            if ($this->user_match($username) == true)
                return 'ERROR: The username is already taken.';

            $data = [
                'Username' => $username,
                'Password' => password_hash($pass, PASSWORD_BCRYPT),
            ];
            $query = 'INSERT INTO users(Username, Password) VALUES(:Username, :Password)';
            $this->pdo->prepare($query)->execute($data);
            return '';
        }
    };
?>