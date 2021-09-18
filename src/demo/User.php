<?php
namespace Monkeyhh\Pdo;

use Monkeyhh\Pdo\Model;

/**
 * Class User
 * @package Monkeyhh\Pdo
 */
class User extends Model
{
    public static $_prefix = 'crm_';
    public static $_table_name = 'crm_user_admin';

    //The model should and only inherit Bee\PDO\Model.
    //You do not need to code anything more. So it is simple.
}
