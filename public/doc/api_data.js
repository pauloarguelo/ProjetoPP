define({ "api": [
  {
    "type": "post",
    "url": "/auth/login",
    "title": "Login",
    "version": "1.0.0",
    "name": "Login",
    "group": "Auth",
    "description": "<p>Login</p>",
    "sampleRequest": [
      {
        "url": "/api/v1/auth/login"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>The user email.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "password",
            "description": "<p>The user password.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"email\":\"paulo@teste.com\",\n    \"password\": \"secret\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "JWT",
            "description": "<p>with given credentials</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE2NTE4NzIwNjUsImV4cCI6MTY1MTg3NTY2NSwibmJmIjoxNjUxODcyMDY1LCJqdGkiOiJwNWdYRDN1S0t2WlhiY3N5Iiwic3ViIjoiNTEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.j0GEtCnWQE0jkVvQIuprXthufHEwyHJJHPRDhnu-uWc\",\n  \"token_type\": \"bearer\",\n  \"expires_in\": 3600\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>Login failed.</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/V1/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "get",
    "url": "/auth/me",
    "title": "Me",
    "version": "1.0.0",
    "name": "Me",
    "group": "Auth",
    "description": "<p>Return the authenticated user</p>",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"id\": 51,\n     \"name\": \"Paulo\",\n     \"email\": \"paulo@teste.com\",\n     \"document\": \"09420900045\",\n     \"user_category_id\": 1,\n     \"created_at\": \"2022-05-06T23:50:29.000000Z\",\n     \"updated_at\": \"2022-05-06T23:50:29.000000Z\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V1/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/auth/register",
    "title": "Register",
    "name": "Register",
    "group": "Auth",
    "description": "<p>Register a new user</p>",
    "sampleRequest": [
      {
        "url": "/api/v1/auth/register"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>The user name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>The user email.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>The user password.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "document",
            "description": "<p>The user document.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "user_category_id",
            "description": "<p>The user category id.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"email\":\"paulo@teste.com\",\n    \"password\": \"secret\",\n    \"name\": \"Paulo\",\n    \"document\": \"09420900045\",\n    \"user_category_id\": 1\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/V1/AuthController.php",
    "groupTitle": "Auth"
  }
] });
