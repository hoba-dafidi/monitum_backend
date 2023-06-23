# monitum_backend

### The HTTP verbs used

- GET: To retrive resources
- POST: TO create resources
- PUT: To Update resources
- DELETE: To delete resources

## Features

- For a new client to register by admin

```PHP
//Endpoint is
/api/v1/client/signup
// Data to be sent
{
    "username" => "username",
    "password" => "password",
    "email" => "email",
    "firstname" => "firstname",
    "lastname" => "lastname",
    "organisation" => "organisation",
    "department" => "department",
    "phone" => "phone",
    "user_id" => "user_id"
}

- For a new client to register by themselves

//Endpoint is
/api/v1/client/signup
// Data to be sent
{
    "username" => "username",
    "password" => "password",
    "email" => "email",
    "firstname" => "firstname",
    "lastname" => "lastname",
    "organisation" => "organisation",
    "department" => "department",
    "phone" => "phone"
}


-Response is
-status code is 201 created

{
    success: true,
    message: "Successful",
    data: null
}
```

- For client login

```PHP
//Endpoint is

/api/v1/clients/login
// Data to be sent
{
    "email": "ty@g.co",
    "password": "Aa111111"
}

-Response is
-status code is 200 Ok

{
    "success": true,
    "message": "Successfully logged in",
    "data": {
        "id": 16,
        "username": "ty",
        "email": "ty@g.co",
        "firstname": "ty",
        "lastname": "ty",
        "organisation": null,
        "department": "t",
        "user_id": null
    }
}
```

### Get all categories for each client using HTTP GET method

- This route will get all the categories data for the particular client

```PHP
//Endpoint is

/api/v1/categories/read?user_id=4


-Response is
-status code is 200 Ok

{
    "success": true,
    "message": "Successful",
    "data": [
        {
            "id": 4,
            "name": "Business"
        },
        {
            "id": 5,
            "name": "Business"
        },
    ]
}
```

### Create a category using HTTP POST method

- This route will create the category data by the particular client

```PHP
//Endpoint is

/api/v1/categories/create
// Data to be sent
{
    "name": "finance"
    "user_id" => 4,
}

-Response is
-status code is 201 Created

{
  "success": true,
  "message": "Successful",
   "data": null
}
```

### Update categories using HTTP PUT method

- This route will update the particular category data: { name }

```PHP
//Endpoint is

/api/v1/categories/update
// Data to be sent
{
    "id" => 4,
  "name": "finance"
}

-Response is
-status code is 200 Ok

{
  "success": true,
  "message": "Successful",
   "data": null
}
```
