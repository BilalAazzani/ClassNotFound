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
            $table[] = new Question($row->question_id, $row->title, $row->subject, $row->category_id, $row->member_id, $row->creation_date, $row->state, $row->goodanswer_id, $row->name);
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
        //$query = "SELECT * FROM answers inner join members m on m.member_id = answers.member_id WHERE question_id = :question_id ";
        $query = "select answer.member_id, answer.subject, answer.question_id, answer.creation_date, answer.answer_id, 
                  m.first_name, m.last_name,
                  ((select count(*) from votes where vote_value = 'p' and answer_id = answer.answer_id)-
                  (select count(*) from votes where vote_value = 'n' and answer_id = answer.answer_id))  as totalVote 
                  from answers answer inner join members m on m.member_id = answer.member_id WHERE answer.question_id = :question_id ";
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':question_id', $question_id, PDO::PARAM_INT);
        $ps->execute();
        return $ps->fetchAll();
    }

    //Displaying the questions
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

    //Displaying the answers
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

    //login
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

    //register
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

    //display categories
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

    //to get all the question related to the category you clicked on
    public static function get_question_cat($id)
    {
        $query = 'SELECT * FROM questions q inner join categories c on c.category_id = q.category_id WHERE c.category_id=:id';
        $ps = Db::getInstance()->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        $ps->execute();
        return $ps->fetchAll();
    }

    //active/suspended
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

    //admin/member
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

    //Add an answer
    public function insert_answer($subject, $question_id, $member_id)
    {
        $query = 'INSERT INTO answers (subject, question_id, member_id) values (:subject,:question_id,:member_id)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':question_id', $question_id);
        $ps->bindValue(':member_id', $member_id);
        return $ps->execute();
    }

    //Update the subject of a question
    public function update_question($subject, $id)
    {
        $query = 'UPDATE questions SET subject=:subject WHERE question_id=:id ';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':id', $id);

        return $ps->execute();
    }

    //Vote
    public function vote($question_id, $member_id, $answer_id, $vote_value)
    {
        $query = 'INSERT INTO votes (question_id, member_id, answer_id, vote_value) values (:question_id, :member_id,:answer_id,:vote_value)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':question_id', $question_id);
        $ps->bindValue(':member_id', $member_id);
        $ps->bindValue(':answer_id', $answer_id);
        $ps->bindValue(':vote_value', $vote_value);
        return $ps->execute();
    }

    //Question state
    public function mark_duplicate($id){
        $query = "UPDATE questions SET state = 'D' WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        return $ps->execute();
    }

    public function mark_open($id){
        $query = "UPDATE questions SET state = 'O' WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id, PDO::PARAM_INT);
        return $ps->execute();
    }

    public function mark_as_solved ($id){
        $query ="UPDATE questions SET state = 'S' WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        return $ps->execute();
    }

    //Delete from db
    public function delete_answer($id){
        $query = "DELETE FROM answers WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        return $ps->execute();

    }

    public function delete_question($id){
        $query = "DELETE FROM questions WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        return $ps->execute();
    }

    public function delete_answers($id){
        $query = "DELETE FROM answers WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        return $ps->execute();
    }

    public function delete_votes($id){
        $query = "DELETE FROM votes WHERE question_id=:id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        return $ps->execute();
    }

    //Good answer
    public function good_answer($goodanswer_id, $question_id){
        $query = "UPDATE questions SET goodanswer_id=:goodanswer_id WHERE question_id=:question_id";
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':goodanswer_id', $goodanswer_id);
        $ps->bindValue(':question_id', $question_id);
        return $ps->execute();
    }

}