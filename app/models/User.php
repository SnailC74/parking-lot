<?php
namespace app\models;

use simplemvc\base\Model;


/**
 * User Model
 */
class User extends Model
{
    /**
     * Set the table name and primary key of current model
     */
    protected $table = 'user';
    protected $primary = 'user_id';
}
