<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Traits;

use Illuminate\Support\MessageBag;
use Validator;

/**
 * This is the Validatable trait.
 *
 * @package        App\Traits
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 */
trait Validatable
{

    /** @var MessageBag */
    protected $messages;

    protected $failedRules = [ ];

    public function validate($data = null, $scenario = false)
    {
        if ( ! is_array($data) )
        {
            $data = $this->getAttributes();
        }

        $rules = $this->getRules($scenario);

        if ( empty($rules) )
        {
            return true;
        }

        $validator = Validator::make($data, $rules);

        if ( $validator->fails() )
        {
            $this->messages    = $validator->messages();
            $this->failedRules = $validator->failed();

            return false;
        }

        return true;
    }

    public function failed()
    {
        return isset($this->failedRules) ? $this->failedRules : [ ];
    }

    public function errors()
    {
        return isset($this->messages) ? $this->messages : new MessageBag();
    }

    public function hasErrors()
    {
        return ! $this->errors()->isEmpty();
    }

    /**
     * get rules value
     *
     * @return array
     */
    public function getRules($scenario = false)
    {
        return $scenario ? $this->rules[ $scenario ] : $this->rules;
    }

    /**
     * Set the rules value
     *
     * @param array $rules
     * @return self
     */
    public function setRules($rules, $scenario = false)
    {

        if ( $scenario !== false )
        {
            $this->rules[ $scenario ] = $rules;
        }
        else
        {
            $this->rules = $rules;
        }

        return $this;
    }

}
