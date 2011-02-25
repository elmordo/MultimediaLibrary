<?php
/**
 * Tabulka dokumentu
 *
 * @author petr
 */
class Model_Documents extends Zend_Db_Table_Abstract {
    /**
     * UUID dokumentu
     *
     * @var string
     */
    protected $_uuid;

    /**
     * jmeno dokumnetu
     *
     * @var string
     */
    protected $_document_name;

    /**
     * mime typ
     *
     * @var string
     */
    protected $_mime_type;

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
     * maska pristupovych prav
     *
     * @var string
     */
    protected $_mask;

    /**
     * timestmap vytvoreni souboru (revize)
     *
     * @var string
     */
    protected $_created_at;

    /**
     * prepinac, jestli se jedna o aktualni verzi
     *
     * @var bool
     */
    protected $_is_latest;

    /**
     * velikost souboru v bytech
     *
     * @var int
     */
    protected $_size;

    /**
     * jmeno tabulky v databazi
     *
     * @var string
     */
    protected $_name = "documents";

    /**
     * sloupec primarniho klice
     *
     * @var string
     */
    protected $_primary = "uuid";

    /**
     * indikace auto_increment
     *
     * @var bool
     */
    protected $_sequence = false;

    /**
     * seznam zavislych tabulek
     *
     * @var array
     */
    protected $_dependentTables = array(
        "Model_DocumentsHistory",
        "Model_DocumentsShortcuts",
        "Model_DocumentsUnassigned",
        "Model_DocumentsDirectoriesHasManyDocuments"
    );

    /**
     * referencni mapa na rodicovske tabulky
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
            "columns" => "group_id",
            "refTableClass" => "Model_UsersGroups",
            "refColumns" => "id"
        )
    );

    protected $_rowClass = "Model_Row_Document";
}
?>
