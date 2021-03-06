<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */


class cgl_AssignmentButton extends Basic
{
    public $new_schema = true;
    public $module_dir = 'cgl_AssignmentButton';
    public $object_name = 'cgl_AssignmentButton';
    public $table_name = 'cgl_assignmentbutton';
    public $importable = false;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $SecurityGroups;
    public $flow_module;
    public $show_view;
    public $cgl_functionbutton_id_c;
    public $button;

    public function __construct($init = true)
    {
        parent::__construct();
        if ($init) {
            $this->load_module_list();
        }
    }

    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }

    /*
    public function retrieve($id = -1, $encode = true, $deleted = true){
        parent::retrieve($id,$encode,$deleted);
        $this->flow_module = $this->show_module;
    }
    */
    public function save($check_notify = false)
    {
        if (empty($this->id) || (isset($_POST['duplicateSave']) && $_POST['duplicateSave'] == 'true')) {
            unset($_POST['aow_conditions_id']);
            unset($_POST['aow_actions_id']);
        }

        $return_id = parent::save($check_notify);

        require_once('modules/AOW_Conditions/AOW_Condition.php');
        $condition = BeanFactory::newBean('AOW_Conditions');
        $condition->save_lines($_POST, $this, 'aow_conditions_');
        //将按钮加到ACLActions中
        $this->addActions($this->functionbutton,$this->flow_module);

        return $return_id;
    }

    /**
    * static addActions($category, $type='module')
    * Adds all default actions for a category/type
    *
    * @param STRING $category - the category (e.g module name - Accounts, Contacts)
    * @param STRING $type - the type (e.g. 'module', 'field')
    */
    public function addActions($action_name,$category, $type='module'){
        global $ACLActions;
        $db = DBManagerFactory::getInstance();

        $action = new ACLAction();
        $query = "SELECT * FROM " . $action->table_name . " WHERE name='$action_name' AND category = '$category' AND acltype='$type' AND deleted=0 ";
        $result = $db->query($query);
        //only add if an action with that name and category don't exist
        $row=$db->fetchByAssoc($result);
        if ($row == null) {
            $action->name = strtolower($action_name);
            $action->category = $category;
            $action->aclaccess = 90;
            $action->acltype = $type;
            $action->modified_user_id = 1;
            $action->created_by = 1;
            $action->save();

        }

    }


    public function load_module_list()
    {
        global $beanList, $app_list_strings;

        if (!empty($app_list_strings['moduleList'])) {
            $app_list_strings['show_module_list'] = $app_list_strings['moduleList'];
            foreach ($app_list_strings['show_module_list'] as $mkey => $mvalue) {
                if (!isset($beanList[$mkey]) || str_begin($mkey, 'AOW_')) {
                    unset($app_list_strings['show_module_list'][$mkey]);
                }
            }
        }

        $app_list_strings['show_module_list'] = array_merge((array)array(''=>''), (array)$app_list_strings['show_module_list']);

        asort($app_list_strings['show_module_list']);
    }
    
}
