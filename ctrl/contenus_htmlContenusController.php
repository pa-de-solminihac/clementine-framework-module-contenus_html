<?php
/**
 * contenus_htmlContenusController : gestion de contenus
 *
 * @package 
 * @version $id$
 * @copyright 
 * @author Pierre-Alexis <pa@quai13.com> 
 * @license 
 */
class contenus_htmlContenusController extends contenus_htmlContenusController_Parent
{
    /**
     * valid_clementine_cms_contenu_htmlAction 
     * 
     * @param mixed $request 
     * @access public
     * @return void
     */
    function valid_clementine_cms_contenu_htmlAction($request, $params = null) 
    {
        $ns = $this->getModel('fonctions');
        if ($this->getModel('users')->needPrivilege('manage_contents')) {
            if (!empty($request->POST)) {
                $type_content = 'clementine_cms_contenu_html';
                $id           = $request->post('int', 'id');
                $id_zone      = $request->post('int', 'id_zone');
                $id_page      = $request->post('int', 'id_page');
                $nom          = $request->post('html', 'nom');
                $contenu_html = $request->post('html', 'contenu_html');
                $contenus = $this->getModel('contenus');
                // ajoute le contenu s'il n'existe pas deja
                $request = $this->getRequest();
                $lang = $request->LANG;
                if (!$id) {
                    $id = $contenus->addContenu($nom, $type_content, $id_zone, $id_page, $lang);
                }
                if ($this->set_contenu_defaut($request, $id)) {
                    $contenus->updateContenuHtml($id, $contenu_html, $lang);
                }
            }
            if ($id_page) {
                $ns->redirect(__WWW__ . '/cms/editpage?id=' . $id_page);
            } else {
                $ns->redirect(__WWW__ . '/cms');
            }
        } else {
            $ns->redirect(__WWW__);
        }
    }
}
?>
