### File Upload

| Method | Endpoint                                      |
| ------ | --------------------------------------------- |
| POST   | http://jjm.sumato.tech/api/v1/uploads |

| Request | Field Type  | Description |
| ------- | ----------- | ----------- |
| file    | file object |

### Login

| Method | Endpoint                                    |
| ------ | ------------------------------------------- |
| POST   | http://jjm.sumato.tech/api/v1/login |

| Request     | Field Type | Description         |
| ----------- | ---------- | ------------------- |
| email       | string     | valid email address |
| password    | string     |
| device_name | string     |

```json
{
    "status": 201,
    "message": "Token created",
    "data": {
        "token_type": "Bearer",
        "access_token": "1|RyDwKwsYfwg0vUvPK8vXOvhNQ1WWbwaAfg4pFB2V",
        "user": {
            "type": "user",
            "id": "12085210678169600",
            "attributes": {
                "name": "Cassandra Stephens",
                "email": "gydyriwyfi@mailinator.com",
                "role": "office",
                "created": {
                    "human": "5 days ago",
                    "date": "2022-02-03",
                    "formatted": "Feb 3, 2022"
                }
            },
            "relationships": [],
            "links": []
        }
    }
}
```

### Logout

| Method | Endpoint                                     |
| ------ | -------------------------------------------- |
| POST   | http://jjm.sumato.tech/api/v1/logout |

```json
{
    "status": 201,
    "message": "success"
}
```

### Change Password

| Method | Endpoint                                                       |
| ------ | -------------------------------------------------------------- |
| POST   | http://jjm.sumato.tech/api/v1/profiles/change-password |

| Request               | Field Type | Description |
| --------------------- | ---------- | ----------- |
| current_password      | string     |
| password              | string     |
| password_confirmation | string     |

```json
{
    "status": 201,
    "message": "success"
}
```