<?php
/**
 * Reprezentace tabulky uzivatelu
 *
 * @author petr
 */
class Model_Users extends Zend_Db_Table_Abstract {
    /**
     * identifikacni cislo uzivatele
     *
     * @var int
     */
    protected $_id;

    /**
     * uzivatelske jmeno
     *
     * @var string
     */
    protected  $_username;

    /**
     * kontaktni email
     *
     * @var string
     */
    protected $_email;

    /**
     * hashovane a osolene heslo
     *
     * @var string
     */
    protected $_password;

    /**
     * sul
     *
     * @var string
     */
    protected $_salt;

    /**
     * aktualni cookie
     *
     * @var string
     */
    protected $_cookie;

    /**
     * id korenoveho adresare uzivatele
     *
     * @var int
     */
    protected $_root_directory_id;

    /**
     * jmeno tabulky v databazi
     *
     * @var string
     */
    protected $_name = "users";

    /**
     * sloupec primarniho klice
     *
     * @var string
     */
    protected $_primary = "id";

    /**
     * prepinac zapnuti auto_increment
     *
     * @var bool
     */
    protected $_squence = true;

    /**
     * seznam zavislych tabulek
     *
     * @var array
     */
    protected $_dependentTables = array(
        "Model_UsersHasManyUsersGroups",
        "Model_UsersHasManyUsersRoles",
        "Model_Documents",
        "Model_DocumentsUnassigned",
        "Model_DocumentsDirectories"
    );
}
?>
