<?php 
require_once ('src/models/roleModel.php');

function displayRoles()
{
    $roles = getRoles();
    require "views/templates/roleListing.php";
}

function updateRole($dataRole, $id)
{
    foreach ($dataRole as $fieldName=>$value)
    {
        $filteredValue = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);    //Sanitizing value in array
        $dataRole[$fieldName] = $filteredValue;                                     //replacing original values by sanitized
    }
    var_dump($filteredValue);
    var_dump($id);
    updateRoleModel($filteredValue,$id);
}

function addRole($roleData)
{
    $filteredRoleData = filter_var($roleData,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    addRoleModel($filteredRoleData);
}
function deleteRole($id)
{
    deleteRoleModel($id);
}