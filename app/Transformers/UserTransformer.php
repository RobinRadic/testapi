<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Transformers;

use Dingo\Api\Contract\Transformer\Adapter;
use Dingo\Api\Http\Request;
use Dingo\Api\Transformer\Binding;


/**
 * This is the UserTransfomer.
 *
 * @package        App\Transformers
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 */
class UserTransformer implements Adapter
{
    /**
     * Create a new fractal transformer instance.
     *
     * @param \League\Fractal\Manager $fractal
     * @param string                  $includeKey
     * @param string                  $includeSeparator
     * @param bool                    $eagerLoading
     *
     * @return void
     */
    public function __construct()
    {
        $this->fractal          = new \League\Fractal\Manager;
        $this->includeKey       = 'include';
        $this->includeSeparator = ',';
        $this->eagerLoading     = true;
    }

    /**
     * Transform a response with a transformer.
     *
     * @param mixed                          $response
     * @param object                         $transformer
     * @param \Dingo\Api\Transformer\Binding $binding
     * @param \Dingo\Api\Http\Request        $request
     *
     * @return array
     */
    public function transform($response, $transformer, Binding $binding, Request $request)
    {
        return $response->toArray();

        $arr                      = $response->toArray();
        $arr[ 'all_permissions' ] = $arr[ 'permissions' ];
        array_walk($arr[ 'roles' ], function ($role, $rolei) use (&$arr)
        {
            // the all_permissions is initially only the user permissions, which override role permissions. So we reverse-merge here, always keeping the user permissions
            $arr[ 'all_permissions' ] = array_merge($role[ 'permissions' ], $arr[ 'all_permissions' ]);
            #$arr[ 'roles' ][ $rolei ] = array_only($role, [ 'id', 'name', 'slug', 'permissions' ]);
        }, $arr[ 'roles' ]);

        return $arr;
    }
}
