<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Http\Controllers\Api\V1;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * This is the ApiController.
 *
 * @package        App\Http
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 * @property-read \Dingo\Api\Dispatcher                                             $api
 * @property-read  \Illuminate\Auth\GenericUser|\Illuminate\Database\Eloquent\Model $user
 * @property-read \Dingo\Api\Auth\Auth                                              $auth
 * @property-read \Dingo\Api\Http\Response\Factory                                  $response
 */
abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, Helpers;

    protected $crsfExclusions = [ ];

    public function getCrsfExclusions()
    {
        return $this->crsfExclusions;
    }

    protected function crsfExclude(array $exclude)
    {
        $this->crsfExclusions = $exclude;
    }
}
