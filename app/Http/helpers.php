<?php

function displayValue($action, $article, $field){
    return $action == 'create' ? old($field) : $article->{$field};
}