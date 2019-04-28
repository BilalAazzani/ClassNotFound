<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:52
 */

class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=database;charset=utf8', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error connecting to the database: ' . $e->getMessage());
        }
    }

    # Singleton pattern
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public static function select_question($keyword = '')
    {
        if ($keyword != '') {
            $keyword = str_replace("%", "\%", $keyword);
            $query = "SELECT * FROM questions q inner join categories c on c.category_id = q.category_id WHERE title LIKE '%$keyword%' OR subject LIKE '%$keyword%' COLLATE utf8_bin";
            $ps = Db::getInstance()->_db->prepare($query);
            $ps->bindValue(':keyword', "%$keyword%");
        } else {
            $query = 'SELECT * FROM questions q inner join categories c on c.category_id = q.category_id ';
            $ps = Db::getInstance()->_db->prepare($query);
        }

        $ps->execute();

        $table = array();
        while ($row = $ps->fetch()) {
            $table[] = new Question($row->question_id, $row->title, $row->subject, $row->category_id, $row->member_id, $row->creation_date, $row->state, $row->answer_id, $row->name);
        }
        return $table;

    }

    public static function get_question($id)
    {

        $query = "SELECT * FROM questions inner join members m on m.member_id = questions.member_id WHERE question_id = :id";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        $ps->execute();
        return $ps->fetchAll()[0];

    }

    public static function get_answers($question_id)
    {
        $query = "SELECT * FROM answers inner join members m on m.member_id = answers.member_id WHERE question_id = :question_id ";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':question_id', $question_id, PDO::PARAM_INT);
        $ps->execute();
        return $ps->fetchAll();
    }


    public function insert_question($title, $subject, $category, $member)
    {
        # Solution d'INSERT avec prepared statement
        $query = 'INSERT INTO questions (title, subject, category_id, member_id) values (:title, :subject, :category, :member)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':title', $title);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':category', $category);
        $ps->bindValue(':member', $member);


        if ($ps->execute()) {
            // cette fonction sert a recuperer l'id de la derniere question inseree
            return $this->_db->lastInsertId();
        } else {
            return false;
        }
    }

    public function select_answer($keyword = '')
    {
        if ($keyword != '') {
            $keyword = str_replace("%", "\%", $keyword);
            $query = "SELECT * FROM answers WHERE subject LIKE :keyword COLLATE utf8_bin";
            $ps = $this->_db->prepare($query);
            $ps->bindValue(':keyword', "%$keyword%");
        } else {
            $query = 'SELECT * FROM answers ';
            $ps = $this->_db->prepare($query);
        }

        $ps->execute();

        $table = array();
        while ($row = $ps->fetch()) {
            $table[] = new Answer($row->answer_id, $row->subject, $row->member_id, $row->creation_date, $row->question_id);
        }
        return $table;

    }

    public function validate_member($email, $password)
    {
        $query = 'SELECT * from members WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        if ($ps->rowcount() == 0)
            return false;

        $user = $ps->fetch();

        if (password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }

    }

    public function verify_admin($email)
    {
        $query = 'SELECT is_admin from members WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        $hash = $ps->fetch()->is_admin;
        return $hash = 1;
    }

    public function insert_member($first_name, $last_name, $email, $password)
    {
        $query = 'INSERT INTO members (first_name,last_name,email,password) values (:first_name,:last_name,:email,:password)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':first_name', $first_name);
        $ps->bindValue(':last_name', $last_name);
        $ps->bindValue(':email', $email);
        $ps->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        return $ps->execute();
    }

    public static function get_members()
    {
        $query = "SELECT * FROM members";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->execute();
        return $ps->fetchAll();
    }

    public static function select_categories()
    {

        $query = 'SELECT * FROM categories';
        $ps = Db::getInstance()->_db->prepare($query);

        $ps->execute();

        $table = array();
        while ($row = $ps->fetch()) {
            $table[] = new Category($row->category_id, $row->name);
        }
        return $table;

    }

    public static function get_question_cat($id)
    {

        $query = 'SELECT * FROM questions q inner join categories c on c.category_id = q.category_id WHERE c.category_id=:id';
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        $ps->execute();
        return $ps->fetchAll();
    }

    public static function suspend_user($id)
    {
        $query = "UPDATE members SET is_active = '0' WHERE member_id=:id";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        $ps->execute();
    }

    public static function unsuspend_user($id)
    {
        $query = "UPDATE members SET is_active = '1' WHERE member_id=:id";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        $ps->execute();
    }

    public static function make_admin($id)
    {
        $query = "UPDATE members SET is_admin = '1' WHERE member_id=:id";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        $ps->execute();
    }

    public static function make_member($id)
    {
        $query = "UPDATE members SET is_admin = '0' WHERE member_id=:id";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        $ps->execute();
    }

    public function insert_answer($subject, $question_id, $member_id)
    {
        $query = 'INSERT INTO answers (subject, question_id, member_id) values (:subject,:question_id,:member_id)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':question_id', $question_id);
        $ps->bindValue(':member_id', $member_id);
        return $ps->execute();
    }

    public function update_question($subject, $id)
    {
        $query = 'UPDATE questions SET subject=:subject WHERE member_id=:id  ';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':id', $id);

        return $ps->execute();
    }

    public function vote($member_id, $answer_id, $vote_value)
    {
        $query = 'INSERT INTO votes (member_id, answer_id, vote_value) values (:member_id, :answser_id, :vote_value)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':member_id', $member_id);
        $ps->bindValue(':answer_id', $answer_id);
        $ps->bindValue(':vote_value', $vote_value);
        return $ps->execute();
    }
}
?>