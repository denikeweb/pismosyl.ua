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
        $query = \App\Core::db()->query('SELECT *
                    FROM  `templates_categories`
                    WHERE `templates_categories`.`templates_categories_parent_id` IS NULL');
        $tempCategoriesRep = $query->fetch_all(MYSQL_ASSOC);
        $categories[] = array();
        foreach ($tempCategoriesRep as $key => $value){
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
        unset($categories[0]);
        foreach ($categories as $key => $value) {
            if ($value['subcategory'] != null) {
                foreach ($value['subcategory'] as $subKey => $subVal) {
                    $templates = $this->getTemplateCategoryPreview($subVal['templates_categories_id']);
                    if (count($templates)!= 0)
                        $categories[$key]['subcategory'][$subKey]['templatesData'] = $templates;
                }
                continue;
            }
            $templates = $this->getTemplateCategoryPreview($value['templates_categories_id']);
            if (count($templates)!= 0)
                $categories[$key]['templatesData'] = $templates;

        }
        \Anex::showArray($categories);
        return $categories;
    }

    public function getTemplateCategoryPreview($tempCatId)
    {
        $queryString = 'SELECT `templates_id`,`templates_title`,`templates_prev`,`templates_datetime`
                    FROM  `templates`
                    WHERE `templates`.`templates_categories_id`='.$tempCatId;
        $query = \App\Core::db()->query($queryString);
        $result = $query->fetch_all(MYSQL_ASSOC);
        return $result;
    }
} 