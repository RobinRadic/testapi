<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Traits;



/**
 * This is the EloquentWithConstraints trait.
 *
 * @package        App\Traits
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 */
trait EloquentWithConstraints
{

    public function withOnly($relation, $columns){
        return $this->with([$relation => function($query) use ($columns){
            $query->select($columns);
        }]);
    }
}
