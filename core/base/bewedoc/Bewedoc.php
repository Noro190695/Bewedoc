<?php
namespace core\base\bewedoc;

class Bewedoc {
    /**
     * @return void
     */
    public static function services() {
        require_once ROOT . '/core/base/errors/errors.php';
        require_once ROOT . '/app/routes/routes.php';
        require_once ROOT . '/core/helpers.php';

    }
}
