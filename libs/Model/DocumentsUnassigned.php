<?php
/**
 * Reprezentace tabulky dokumentu, ktere nebyly prirazeny do zadneho adresare (kos)
 *
 * @author petr
 */
class Model_DocumentsUnassigned extends Zend_Db_Table_Abstract {
    /**
     * UUID dokumentu
     *
     * @var string
     */
    protected $_uuid;

    /**
     * identifikacni cislo uzivatele
     *
     * @var int
     */
    protected $_user_id;

    /**
     * jmeno dokumentu
     *
     * @var string
     */
    protected $_document_name;

    /**
     * jmeno tabulky v databazi
     *
     * @var string
     */
    protected $_name = "documents_unassigned";

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
     * referencni mapa na rodicovske tabulky
     *
     * @var array
     */
    protected $_referenceMap = array(
        "document" => array(
            "columns" => "uuid",
            "refTableClass" => "Model_Documents",
            "refColumns" => "uuid"
        ),

        "user" => array(
            "columns" => "user_id",
            "refTableClass" => "Users",
            "refColumns" => "id"
        )
    );
}
?>
