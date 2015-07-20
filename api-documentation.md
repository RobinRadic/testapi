FORMAT: 1A

# packadic

# Users [/user]
Handles user managament

## Show user [GET /user]
Shows information about the current authenticated user

+ Response 200 (application/json)
    + Body

            {
                "id": "1",
                "name": "radic",
                "created_at": "2015-07-20 09:57:07",
                "updated_at": "2015-07-20 09:57:07",
                "admin": "1",
                "age": "0"
            }

## Register user [POST /user]
Registers a new user

+ Request (application/json)
    + Body

            {
                "name": "foo",
                "email": "valid@email.com",
                "password": "someGoodPassword"
            }

+ Response 200 (application/json)
    + Body

            {
                "id": "1"
            }

+ Response 422 (application/json)
    + Body

            {
                "error": "existing",
                "field": "username|email",
                "message": "{field} already exists"
            }

+ Response 422 (application/json)
    + Body

            {
                "error": "format",
                "field": "username|email|password",
                "message": "Bad {field} format: {reason}"
            }

## Edit user [PUT /user/{user}]
Update the authorized user.

+ Parameters
    + user (integer, required) - The user ID

+ Request (application/json)
    + Body

            {
                "name": "foo",
                "email": "valid@email.com",
                "password": "someGoodPassword"
            }

+ Response 200 (application/json)
    + Body

            {
                "id": "1"
            }

+ Response 422 (application/json)
    + Body

            {
                "error": "existing",
                "field": "username|email",
                "message": "{field} already exists"
            }

+ Response 422 (application/json)
    + Body

            {
                "error": "format",
                "field": "username|email|password",
                "message": "Bad {field} format: {reason}"
            }