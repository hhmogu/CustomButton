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

require_once('include/DetailView/DetailView2.php');

/**
 * Default view class for handling DetailViews
 *
 * @package MVC
 * @category Views
 */
class ViewDetail extends SugarView
{
    /**
     * @see SugarView::$type
     */
    public $type = 'detail';

    /**
     * @var DetailView2 object
     */
    public $dv;

    /**
     * Constructor
     *
     * @see SugarView::SugarView()
     */
    public function __construct()
    {
        global $ACLActions;
        parent::__construct();
        $this->fill_custom_actiondefs();
    }

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    public function ViewDetail()
    {
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if (isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        } else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }

    /**
     * @see SugarView::preDisplay()
     */
    public function preDisplay()
    {
        $metadataFile = $this->getMetaDataFile();
        $this->dv = new DetailView2();
        $this->dv->ss =&  $this->ss;
        $this->dv->setup($this->module, $this->bean, $metadataFile, get_custom_file_if_exists('include/DetailView/DetailView.tpl'));
    }

    /**
     * @see SugarView::display()
     */
    public function display()
    {
    	//在此处进行自定义按钮的填充
    	$this->assembleButton();
        if (empty($this->bean->id)) {
            sugar_die($GLOBALS['app_strings']['ERROR_NO_RECORD']);
        }
        $this->dv->process();
        echo $this->dv->display();
    }

    public function assembleButton()
    {
    	//自定义按钮定义
	    $ab_bean = BeanFactory::getBean('cgl_AssignmentButton');
	    $log_arr = [];
	    $total_count = 0;
	    $where = "show_view = '{$this->type}' and flow_module = '{$this->bean->module_dir}'";
	    $ab_beans = $ab_bean->get_full_list("id asc",$where);
	    foreach ($ab_beans as $key => $button_bean) {
	    	//js加载
	    	//customCode组装
			$r_button_bean = BeanFactory::getBean('cgl_FunctionButton',$button_bean->cgl_functionbutton_id_c);

            $button_name = 'button'.$r_button_bean->name;

            if (file_exists('custom/Extension/modules/cgl_FunctionButton/Ext/functions/'.$button_name.'.php')) {
                require_once('custom/Extension/modules/cgl_FunctionButton/Ext/functions/'.$button_name.'.php');
            } elseif (file_exists('modules/cgl_FunctionButton/functions/'.$button_name.'.php')) {
                require_once('modules/cgl_FunctionButton/functions/'.$button_name.'.php');
            } else {
                continue;
            }

            $button = new $button_name();
        	if(!isset($this->dv->defs['templateMeta']['includes'])){
        		$this->dv->defs['templateMeta']['includes'] = [];
        	}
        	array_push(
        		$this->dv->defs['templateMeta']['includes'], 
        		[
      				'file' => 'custom/Extension/modules/cgl_FunctionButton/Ext/functions/functions.js',
        		]
        	);        	
            $GLOBALS['log']->fatal($this->dv->defs['templateMeta']['includes']);
            foreach ($button->loadJS() as $js_file) {
            	array_push(
            		$this->dv->defs['templateMeta']['includes'], 
            		[
          				'file' => $js_file,
            		]
            	);
            }
            
	    	$GLOBALS['log']->fatal($this->dv->defs['templateMeta']['includes']);
            //根据用户选择语言来决定显示标签
            $app_list_actions[$r_button_bean->name] = $r_button_bean->label_zh;

            $btn = [
                'btn_name' => strtolower($r_button_bean->name),
            	'customCode' => '<input type="button" class="button" '.$r_button_bean->response_event.'="'.$r_button_bean->function_event.'();" value="'.$r_button_bean->label_zh.'">'
            ];
            array_push($this->dv->defs['templateMeta']['form']['buttons'], $btn);

	    }
    }

    public function fill_custom_actiondefs(){
        global $ACLActions;
        $ab_bean = BeanFactory::getBean('cgl_AssignmentButton');
        $where = "";
        $ab_beans = $ab_bean->get_full_list("id asc",$where);
        foreach ($ab_beans as $key => $button_bean) {
            //js加载
            //customCode组装
            $r_button_bean = BeanFactory::getBean('cgl_FunctionButton',$button_bean->cgl_functionbutton_id_c);

            //根据用户选择语言来决定显示标签
            $button_label = $r_button_bean->label_zh;
            //填充权限配置下拉列表
            $ACLActions['module']['actions'][strtolower($r_button_bean->name)] = array(
                'aclaccess'=>array(ACL_ALLOW_ALL,ACL_ALLOW_OWNER,ACL_ALLOW_DEFAULT, ACL_ALLOW_NONE),
                'label'=> $button_label,
                'default'=>ACL_ALLOW_ALL,
            );

        }
    }
}
