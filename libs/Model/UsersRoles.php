<?php
/**
 * Tabulka uzivatelskych roli
 *
 * @author petr
 */
class Model_UsersRoles extends Zend_Db_Table_Abstract {
    /**
     * identifikacni cislo role
     *
     * @var int
     */
    protected $_id;

    /**
     * jmeno role
     *
     * @var string
     */
    protected $_group_name;

    /**
     * jmeno tabulky
     *
     * @var string
     */
    protected $_name = "users_groups";

    /**
     * sloupec primarniho klice
     *
     * @var string
     */
    protected $_primary = "id";

    /**
     * indikace auto_increment
     *
     * @var bool
     */
    protected $_sequence = true;

    /**
     * seznam zavislych tabulek
     *
     * @var array
     */
    protected $_dependentTables = array(
        "Model_UsersHasanyUsersGroups"
    );
}
?>
