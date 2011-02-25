<?php
/**
 * Tabulka uzivatelskych skupin
 *
 * @author petr
 */
class Model_UsersGroups extends Zend_Db_Table_Abstract {
    /**
     * identifikacni cislo skupiny
     *
     * @var int
     */
    protected $_id;

    /**
     * jmeno skupiny
     *
     * @var string
     */
    protected $_group_name;

    /**
     * jmeno tabulky v DB
     *
     * @var string
     */
    protected $_name = "users_groups";

    /**
     * sloupec primarkniho klice
     *
     * @var string
     */
    protected $_primary = "id";

    /**
     * prepinac uziti auto_increment
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
        "Model_UsersHasManyUsersGroups",
        "Model_DocumentsDirectories",
        "Model_Documents"
    );
}
?>
