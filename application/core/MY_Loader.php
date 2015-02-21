<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader{

    public function layout($template_name, $vars = array(), $jsLibraries = array())
    {            
        //Settings
        $ci = get_instance();
        $vars['config'] = $ci->config->item('websarrollo'); //configuration info
        
        //language
        $ci->session->set_userdata('ws-language', get_language()); //get_language()
        $ci->lang->load('general', $ci->session->userdata('ws-language'));
        $vars['idiom'] = ($ci->session->userdata('ws-language')=='english') ? '_'.$ci->session->userdata('ws-language') : ''; //dinamic field control (English/Spanish)
        $vars['language'] = $ci->lang; //multi language control

        //Models
        $ci->load->model('ModelContents');
        $ci->load->model('Company');

        //Data
        $vars['mainMenu'] = $ci->ModelContents->getRows(" WHERE id_type = '1' AND id_content = '0' "); //top menu
        $vars['servicesMenu'] = $ci->ModelContents->getRows(" WHERE id_type = '2' AND id_status='1'"); //footer menu
        $vars['blogMenu'] = $ci->ModelContents->getRows(" WHERE id_type = '3' AND id_status='1'"); //right blog menu

        if (isset($vars['wp_user']) && count($vars['wp_user']) > 1) {
            $vars['wpanelMenu'] = $ci->ModelContents->getRows(" WHERE id_type = '5' AND id NOT IN ('5', '6', '8') "); //wpanel session
        }

        $vars['companyInfo'] = $ci->Company->getRow(); //footer info

        //Body
        $content  = $this->view('partial/header', $vars);
        $content .= $this->view($template_name, $vars);
        $content .= $this->view('partial/sideBar', $vars);

        if (count($jsLibraries)>0)
            $vars['jsLibraries'] = $jsLibraries;

        $content .= $this->view('partial/footer', $vars);
    }
}
?>