<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Api\V1\Controller;
use App\User;
use Auth;
use Dingo\Api\Contract\Http\Request as RequestContract;
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
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;


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
class UsersController extends Controller
{


    public function __construct()
    {
        $this->protect([ 'index', 'create', 'show', 'edit', 'update', 'destroy' ]);
        if ( config('app.debug') )
        {
            $this->crsfExclude([ 'store' ]);
        }
    }


    /**
     * Show all users
     *
     * Shows information about the current authenticated user
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Parameters({
     *  @Parameter('page', type="integer")
     *  @Parameter('columns[]', type="array[string]", default="*")
     *  @Parameter('per_page', type='integer', default=15)
     * })
     * @Response(200, body={"id":"1","email":"robin@radic.nl","permissions":[],"last_login":null,"first_name":"Robin","last_name":"Radic","created_at":"2015-07-20 15:53:13","updated_at":"2015-07-20 15:53:13","roles":[{"id":"1","slug":"admin","name":"Admin","permissions":{"admin":true}}],"all_permissions":{"admin":true}})
     * @Response(401, body={"message": "Failed to authenticate because of bad credentials or an invalid authorization header.", "status_code": 401})
     */
    public function index()
    {
        $user = Auth::user()->withOnly('roles', [ 'name', 'slug', 'id' ])->paginate(
            \Request::get('per_page', null), \Request::get('columns', [ '*' ])
        );

        return $user; //$this->response->paginator($user, new \Dingo\Api\Transformer\Adapter\Fractal(new \League\Fractal\Manager));
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
     * @param \Dingo\Api\Contract\Http\Request $request
     * @return \Cartalyst\Sentinel\Users\UserInterface
     */
    public function store(RequestContract $request)
    {
        $data  = $request->all();
        $users = \Sentinel::getUserRepository();
        try
        {
            if ( $valid = $users->validForCreation($data) )
            {
                $user = $users->create($data);
                \Sentinel::cre
                return $user;
            }
        }
        catch (InvalidArgumentException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }
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
    public function update(RequestContract $request, $user)
    {
        //
    }


}
