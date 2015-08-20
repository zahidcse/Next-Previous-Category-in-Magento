<?php

$currentCategory = Mage::registry('current_category');
$returndata = $this->getNextPreviousCategory($currentCategory);

function getNextPreviousCategory($currentCategory) {
    $parentcategories = Mage::getModel('catalog/category')->load($currentCategory->parent_id)->getChildrenCategories();
    $positoinindex = array();
    $count = 0;
    $data['cpos'] = $count;

    $data['preindex'] = 0;
    $data['nextindex'] = 0;
    if (count(parentcategories) > 0) {
        foreach ($parentcategories as $pcateid) {

            $_pcate = Mage::getModel('catalog/category')->load($pcateid->getId());
            if ($currentCategory->getId() == $pcateid->getId()) {
                $data['cpos'] = $count;

                $data['preindex'] = $cpos - 1;
                $data['nextindex'] = $cpos + 1;
            }

            $positoinindex[$count] = $_pcate->getURL();
            $count++;
        }
    }

    return $data;
}

