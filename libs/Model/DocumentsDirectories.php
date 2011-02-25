<?php
/**
 * Tabulka reprezentace adresarove struktury
 *
 * @author petr
 */
class Model_DocumentsDirectories extends Zend_Db_Table_Abstract {
    /**
     * identifikacni cislo adresare
     *
     * @var int
     */
    protected $_id;

    /**
     * jmeno adresare
     *
     * @var string
     */
    protected $_directory_name;

    /**
     * identifikacni cislo uzivatele
     *
     * @var int
     */
    protected $_user_id;

    /**
     * identifikacni cislo skupiny
     *
     * @var int
     */
    protected $_group_id;

    /**
     * masak opravneni pristupu
     *
     * @var string
     */
    protected $_mask;

    /**
     * identifikacni cislo rodicovskeho adresare
     *
     * @var int
     */
    protected $_parent_id;

    /**
     * hloubka zanoreni adresare
     *
     * @var int
     */
    protected $_depth;

    /**
     * tmestamp vytvoreni adresare
     *
     * @var string
     */
    protected $_created_at;

    /**
     * jmeno tabulky v dtabazi
     *
     * @var string
     */
    protected $_name = "documents_directories";

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
        "Model_DocumentsDirectoriesHasManyDocuments",
        "Model_DocumentsDirectories"
    );

    /**
     * referencni mapa rodicovskych tabulek
     *
     * @var array
     */
    protected $_referenceMap = array(
        "user" => array(
            "columns" => "user_id",
            "refTableClass" => "Model_Users",
            "refColumns" => "id"
        ),

        "group" => array(
            "columns" => "groupid",
            "refTableClass" => "Model_UsersGroups",
            "refColumns" => "id"
        ),

        "parent" => array(
            "columns" => "parent_id",
            "refTableClass" => "Model_DocumentsDirectories",
            "refColumns" => "id"
        )
    );

    /**
     * jmeno tridy pouzite pro uchovani radku
     *
     * @var string
     */
    protected $_rowClass = "Model_Row_Directory";
}
?>
