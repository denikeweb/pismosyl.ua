<?php
/**
 * Created by PhpStorm.
 * User: Andriy
 * Date: 15.02.2015
 * Time: 17:13
 */

namespace Models;


class Templates {
    public function getAllTemplatesCategoriesPreviews()
    {
        $query = \App\Core::db()->query('SELECT `templates_categories_id`,
                      `templates_categories_name`,
                      `templates_categories_eventdate`
                    FROM  `templates_categories`
                    WHERE `templates_categories`.`templates_categories_parent_id` IS NULL');
        $tempCategoriesRep = $query->fetch_all(MYSQL_ASSOC);
        $categories = [];
        foreach ($tempCategoriesRep as $key => $value) {
            $categories[$value['templates_categories_id']] = $value;
        }
        $query = \App\Core::db()->query('SELECT *
                    FROM  `templates_categories`
                    WHERE `templates_categories`.`templates_categories_parent_id` IS NOT NULL');
        $tempCategoriesRep = $query->fetch_all(MYSQL_ASSOC);
        foreach ($tempCategoriesRep as $key => $value){
            if ($categories[$value['templates_categories_parent_id']]['subcategory'] == null)
                $categories[$value['templates_categories_parent_id']]['subcategory'] = array();
            array_push($categories[$value['templates_categories_parent_id']]['subcategory'],$value);
        }
        foreach ($categories as $key => $value) {
            if ($value['subcategory'] != null) {
                foreach ($value['subcategory'] as $subKey => $subVal) {
                    $templates = $this->getTemplateCategoryPreview($subVal['templates_categories_id']);
                    if (count($templates) != 0)
                        $categories[$key]['subcategory'][$subKey]['templatesData'] = $templates;
                }
                continue;
            }
            $templates = $this->getTemplateCategoryPreview($value['templates_categories_id']);
            if (count($templates)!= 0)
                $categories[$key]['templatesData'] = $templates;

        }
        return $categories;
    }

    public function getTemplateCategoryPreview($tempCatId)
    {
        $queryString = 'SELECT `templates_id`,`templates_title`,`templates_prev`,`templates_datetime`
                    FROM  `templates`
                    WHERE `templates`.`templates_categories_id`='.intval($tempCatId);
        $query = \App\Core::db()->query($queryString);
        $result = $query->fetch_all(MYSQL_ASSOC);
        return $result;
    }

    public function getTemplateText($templateId)
    {
        $queryString = 'SELECT `templates_text`
                    FROM  `templates`
                    WHERE `templates`.`templates_id`='.intval($templateId);
        $query = \App\Core::db()->query($queryString);
        $queryRes = $query->fetch_all(MYSQL_ASSOC);
        $templateText = $this->substitutePattern($queryRes[0]['templates_text']);
        return $templateText;
    }

    public function substitutePattern($templateText) {
        $replacedString = $templateText;
        $subStrings = explode('[$INPUT$]',$replacedString);
        $numSubStr = count($subStrings);
        if ($numSubStr > 1) {
            $replacedString = implode("<input class='templateInput' type='text'/>", $subStrings);
        }

        $subStrings = explode('[$TEXT$]',$replacedString);
        $numSubStr = count($subStrings);
        if ($numSubStr > 1) {
            $replacedString = implode("<textarea class='templateTextArea'></textarea>", $subStrings);
        }
        return $replacedString;
    }
} 