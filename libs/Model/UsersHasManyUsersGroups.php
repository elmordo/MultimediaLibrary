<?php
/**
 * Asociace skupin a uzivatelu
 *
 * @author petr
 */
class Model_UsersHasManyUsersGroups extends Zend_Db_Table_Abstract {
    protected $_user_id;

    protected $_user_group_id;

    protected $_name = "users_has_many_users_groups";

    protected $_primary = array(
        "user_id",
        "user_group_id"
    );

    protected $_sequence = true;

    protected $_referenceMap = array(
        "user" => array(
            "columns" => "user_id",
            "refTableClass" => "Model_Users",
            "refColumns" => "id"
        ),

        "group" => array(
            "columns" => "user_group_id",
            "refTableClass" => "Model_UsersGroups",
            "refColumns" => "id"
        )
    );
}
?>
