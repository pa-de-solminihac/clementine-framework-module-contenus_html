<?php
/**
 * contenus_htmlContenusModel : gestion de contenus
 *
 * @package 
 * @version $id$
 * @copyright 
 * @author Pierre-Alexis <pa@quai13.com> 
 * @license 
 */
class contenus_htmlContenusModel extends contenus_htmlContenusModel_Parent
{

    /**
     * updateContenuHtmlCkeditor : update le contenu $id_content de type "contenu_html"
     * 
     * @param mixed $id_content 
     * @param mixed $contenu_html 
     * @access public
     * @return void
     */
    public function updateContenuHtml($id_content, $contenu_html,  $lang) 
    {
        $id_content = (int) $id_content; 
        if ($cms = $this->getModel('cms')) {
            $contenu_html = $cms->escape_content($contenu_html);
        }
        $db = $this->getModel('db');
        $sql  = "INSERT INTO " . $this->table_cms_contenu . "_html (`id`, `lang`, `contenu_html`) 
                 VALUES ('$id_content', '$lang', '" . $db->escape_string($contenu_html) . "') 
                 ON DUPLICATE KEY UPDATE `contenu_html` = '" . $db->escape_string($contenu_html) . "' "; 
        $stmt = $db->query($sql);
    }

}
?>
