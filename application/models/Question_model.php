<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Question_model extends BaseModel {


    protected $table = "questions";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    public static function factory($attr = array()) {
        return new Question_model($attr);
    }
    private function deleteQuestionRelatedModels($foreignKey, $forceDelete = false) {
        if($forceDelete) {
            $this->db->query("DELETE FROM questions_images WHERE  question_id  = '" . (int)$foreignKey . "'");
            $this->db->query("DELETE FROM users_questions_answers WHERE  question_id  = '" . (int)$foreignKey . "'");
        }
        $this->db->query("UPDATE questions_images SET is_deleted = 1 WHERE question_id = '" . (int)$foreignKey . "'");
        $this->db->query("UPDATE users_questions_answers SET is_deleted = 1 WHERE question_id = '" . (int)$foreignKey . "'");
    }
    private function updateQuestionRelatedModels($foreignKey, $data = array()) {
        $this->db->query("INSERT INTO questions_images SET image = '".$data['image']."'  WHERE question_id = '" . (int)$foreignKey . "'");
    }
    public function drop($localeKey, $forceDelete = false) {
        if($forceDelete) {
            $this->delete($localeKey, true);
            $this->deleteQuestionRelatedModels($localeKey, true);
        }
        $this->delete($localeKey);
        $this->deleteQuestionRelatedModels($localeKey, false);
    }
    public function quiz() {
        return $this->hasOne(Quiz_model::class, 'id', 'quiz_id');
    }
}
