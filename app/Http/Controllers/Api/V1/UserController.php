<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Http\Controllers\Api\V1;

use App\Transformers\UserTransformer;
use App\User;
use Auth;
use Dingo\Blueprint\Annotation\Method\Delete;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Method\Post;
use Dingo\Blueprint\Annotation\Method\Put;
use Dingo\Blueprint\Annotation\Parameter;
use Dingo\Blueprint\Annotation\Parameters;
use Dingo\Blueprint\Annotation\Request;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Response;
use Dingo\Blueprint\Annotation\Transaction;
use Dingo\Blueprint\Annotation\Versions;
use Transformer;


/**
 * Handles user managament
 *
 * @package        App\Http
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 *
 * @Resource("Users", uri="/user")
 */
class UserController extends Controller
{
    public function __construct()
    {
        //app('api.transformer')->
        Transformer::register('App\User', 'App\Transformers\UserTransformer');
        $this->protect([ 'index', 'create',  'show', 'edit', 'update', 'destroy' ]);
    }


    /**
     * Show user
     *
     * Shows information about the current authenticated user
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Response(200, body={"id":"1","email":"robin@radic.nl","permissions":[],"last_login":null,"first_name":"Robin","last_name":"Radic","created_at":"2015-07-20 15:53:13","updated_at":"2015-07-20 15:53:13","roles":[{"id":"1","slug":"admin","name":"Admin","permissions":{"admin":true}}],"all_permissions":{"admin":true}})
     * @Response(401, body={"message": "Failed to authenticate because of bad credentials or an invalid authorization header.", "status_code": 401})
     */
    public function index()
    {
        $user = Auth::user(true)->load(['roles']);
      #  $user->addHidden(['updated_at']);
       # $h = $user->getHidden();
       # $aa = $user->roles()->getRelated(); //->addHidden(['created_at', 'updated_at', 'pivot']);
        #$s = get_class_methods($user->roles());
        return Transformer::transform($user);
    }


    /**
     * Register user
     *
     * Registers a new user
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Transaction(
     *  @Request({"name": "foo", "email": "valid@email.com", "password": "someGoodPassword"}),
     *  @Response(200, body={"id":"1"}),
     *  @Response(422, body={"error": "existing", "field": "username|email", "message": "{field} already exists" }),
     *  @Response(422, body={"error": "format", "field": "username|email|password", "message": "Bad {field} format: {reason}" }),
     * )
     */
    public function store(\Request $request)
    {

    }

    /**
     * Edit user
     *
     * Update the authorized user.
     *
     * @Put("/{user}")
     * @Versions({"v1"})
     * @Parameters({
     *     @Parameter("user", type="integer", description="The user ID", required=true)
     * })
     * @Transaction(
     *  @Request({"name": "foo", "email": "valid@email.com", "password": "someGoodPassword"}),
     *  @Response(200, body={"id":"1"}),
     *  @Response(422, body={"error": "existing", "field": "username|email", "message": "{field} already exists" }),
     *  @Response(422, body={"error": "format", "field": "username|email|password", "message": "Bad {field} format: {reason}" }),
     * )
     */
    public function update(Request $request, $user)
    {
        //
    }


}
