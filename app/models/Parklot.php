<?php
namespace app\models;

use simplemvc\base\Model;


/**
 * Parklot Model
 */
class Parklot extends Model
{
    /**
     * Set the table name and primary key of current model
     */
    protected $table = 'parklot';
    protected $primary = 'parklot_id';
}