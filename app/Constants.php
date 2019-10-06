<?php
namespace App;

/**
 * Class Constants
 * @package App
 */
class Constants{

    const SUCCESSFUL_REGISTRATION = [
        "success" => 1,
        "heading" => "Thank you!",
        "message" => "Account was successfully registered!"
    ];

    const SUCCESSFUL_LOGIN = [
        "success" => 1,
        "heading" => "Authentication Successful",
        "message" => "Redirecting..."
    ];

    const OPERATION_FAILED = ["failed" => 1];
    const OPERATION_SUCCESSFUL = ["success" => 1];

    const OPERATION_SUPER_FAILED = ["failed" => 1, "message" => "Выйды отсюда, розбийнык!"];


    const SESSION_USER_DATA_KEYS = [
        "id",
        "email",
        "logged",
        "firstName",
        "surname",
        "middleName",
        "theme",
        "isAdmin",
    ];

    const FACULTY_REQUIRED = [
        "fullName",
        "abbreviation",
    ];
}
