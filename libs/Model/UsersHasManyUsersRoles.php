<?php
/**
 * Tabulka asociaci mezi uzivateli a skupinami
 *
 * @author petr
 */
class Model_UsersHasManyUsersRoles extends Zend_Db_Table_Abstract {
    /**
     * idnetifikacni cislo uzivatele
     *
     * @var int
     */
    protected $_user_id;

    /**
     * identifikacni cislo role
     *
     * @var int
     */
    protected $_user_role_id;

    /**
     * jmeno tabulky v databaze
     *
     * @var string
     */
    protected $_name = "users_has_many_users_roles";

    /**
     * primarni klice tabulky
     *
     * @var array
     */
    protected  $_primary = array(
        "user_id",
        "user_role_id"
    );

    /**
     * indikace auto_increment
     *
     * @var bool
     */
    protected $_sequence = false;

    /**
     * referencni mapa na rodicovske tabulky
     *
     * @var array
     */
    protected $_referenceMap = array(
        "user" => array(
            "columns" => "user_id",
            "refTableClass" => "Model_Users",
            "refTableColumns" => "id"
        ),

        "group" => array(
            "columns" => "user_role_id",
            "refTableClass" => "Model_UsersRoles",
            "refColumns" => "id"
        )
    );
}
?>
