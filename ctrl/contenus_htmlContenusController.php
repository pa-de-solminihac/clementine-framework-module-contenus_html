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
    function valid_clementine_cms_contenu_htmlAction($request) 
    {
        if ($this->getModel('users')->needPrivilege('manage_contents')) {
            $ns = $this->getModel('fonctions');
            if (!empty($_POST)) {
                $type_content = 'clementine_cms_contenu_html';
                $id           = $ns->ifPost('int', 'id');
                $id_zone      = $ns->ifPost('int', 'id_zone');
                $id_page      = $ns->ifPost('int', 'id_page');
                $nom          = $ns->ifPost('html', 'nom');
                $contenu_html = $ns->ifPost('html', 'contenu_html');
                $contenus = $this->getModel('contenus');
                // ajoute le contenu s'il n'existe pas deja
                $request = $this->getRequest();
                $lang = $request->LANG;
                if (!$id) {
                    $id = $contenus->addContenu($nom, $type_content, $id_zone, $id_page, $lang);
                }
                if ($this->set_contenu_defaut($id)) {
                    $contenus->updateContenuHtml($id, $contenu_html, $lang);
                }
            }
            if ($id_page) {
                $ns->redirect(__WWW__ . '/cms/editpage?id=' . $id_page);
            } else {
                $ns->redirect(__WWW__ . '/cms');
            }
        } else {
            $this->getModel('fonctions')->redirect(__WWW__);
        }
    }
}
?>
