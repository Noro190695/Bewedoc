<?php


namespace core\base\validation;


class Validate {
    /**
     * данны про ошибки
     * @var array
     */
    private static $errors = [];

    /**
     * возврашает конечне значения
     * @param array $data
     * @return array|bool
     */
    public static function check($data = []){
       return self::validation($data);
    }

    /**
     * проверка тип валидации
     * @param array $data
     * @return array|bool
     */
    private static function validation($data){

        foreach ($data as $key => $val){
            if(is_array($val)){
                foreach ($val as $k => $v){
                    switch ($v){
                        case 'required':
                            self::required($key);
                            break;
                        case 'email':
                            self::email($key);
                            break;
                    }
                    switch ($k){
                        case 'min':
                            self::min($key, $v);
                            break;
                        case 'max':
                            self::max($key, $v);
                            break;

                    }
                }
            }

        }
        if (empty(self::$errors)) return true;
        return self::$errors;

    }
    /**
     * проверяет диствителность e-mail
     * @param string $email
     * @return void
     */
    private static function email($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$errors[] = "not a valid email: <strong>$email</strong>";
        }
    }
    /**
     * полученное данны не должен быть пустой
     * @return void
     */
    public static function required($data){
        if (empty($data)){
            self::$errors[] = 'fields are required';
        }
    }
    /**
     * проверяет не менше ли максималное допмъистимое значения
     * @param string$key
     * @param integer $val
     * @return void
     */
    public static function min($key, $val){
        if (strlen($key)  < $val ){
            self::$errors[] = "fields must be: <strong>$key</strong> > 3 characters";
        }
    }
    /**
     * проверяет не больше ли максималное допмъистимое значения
     * @param string $key
     * @param integer $val
     * @return void
     */
    public static function max($key, $val){
        if (strlen($key) > $val){
            self::$errors[] = "fields must be: <strong>$key</strong> < 3 characters";
        }
    }


}