<?php
namespace app\models;

use simplemvc\base\Model;


/**
 * User Model
 */
class UserParklot extends Model
{
    /**
     * Set the table name and primary key of current model
     */
    protected $table = 'user_parklot';
    protected $primary = 'user_parklot_id';
}
