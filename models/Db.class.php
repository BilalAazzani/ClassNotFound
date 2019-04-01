<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:52
 */

class Db{
    private static $instance = null;
    private $_db;

    private function __construct() {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=database;charset=utf8', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error connecting to the database: ' . $e->getMessage());
        }
    }

    # Pattern Singleton
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public function select_question($keyword=''){
        if ($keyword != '') {
            $keyword = str_replace("%", "\%", $keyword);
            $query = "SELECT * FROM questions WHERE subjet LIKE :keyword COLLATE utf8_bin";
            $ps = $this->_db->prepare($query);
            $ps->bindValue(':keyword',"%$keyword%");
        } else {
            $query = 'SELECT * FROM questions ';
            $ps = $this->_db->prepare($query);
        }

        $ps->execute();

        $tableau = array();
        while ($row = $ps->fetch()) {
            $table[] = new Questions($row->id,$row->title,$row->subjet,$row->category,$row->member,$row->creation_date,$row->state,$row->goodanswer);
        }
        return $tableau;

    }

    public function insert_question($title,$subject,$category,$member,$creation_date,$state,$goodanswer) {
        # Solution d'INSERT avec prepared statement
        $query = 'INSERT INTO questions (title, subject, category, member, creation_date, state, goodanwser) values (:title, :subject, :category, :member, :creation_date, :state, :goodanwser)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':title',$title);
        $ps->bindValue(':subject',$subject);
        $ps->bindValue(':category',$category);
        $ps->bindValue(':member',$member);
        $ps->bindValue(':creation',$creation_date);
        $ps->bindValue(':state',$state);
        $ps->bindValue(':goodanswer',$goodanswer);
        return $ps->execute();
    }
}
?>