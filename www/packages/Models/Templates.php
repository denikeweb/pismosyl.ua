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
                    FROM  `templates_categories`');
        $tempCategories = $query->fetch_all(MYSQL_ASSOC);
        foreach ($tempCategories as $key => $value)
        {
            $curTemplateCategoryId = $value['templates_categories_id'];
            $curTemplatePreview = $this->getTemplateCategoryPreview($curTemplateCategoryId);
            $tempCategories[$key]['templates'] = $curTemplatePreview;
        }
        \Anex::showArray($tempCategories);
        //return $result;
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