<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Contracts;

use Illuminate\Support\MessageBag;

interface Validatable {

    /**
     * @param array $data
     * @param string $scenario
     * @return bool
     */
    public function validate($data = null, $scenario = null);

    /** @return array */
    public function failed();

    /** @return MessageBag */
    public function errors();

    /** @return bool */
    public function hasErrors();

    /**
     * get rules value
     *
     * @param bool $scenario
     * @return array
     */
    public function getRules($scenario=false);

    /**
     * Set the rules value
     *
     * @param array $rules
     * @param bool  $scenario
     * @return \App\Contracts\Validatable
     */
    public function setRules($rules, $scenario=false);
}
