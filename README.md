

<h3>POST</h3></br>
http://127.0.0.1:8000/api/v1/cars/
{
    "userName":"Petro",
    "license_plate":"AK1234AB",
    "color":"red",
    "vin_code":"3FA6P0VP1HR282209"
}
Response</br>
{
    "success": "Car created successfully"
}
<h3>GET</h3></br>
http://127.0.0.1:8000/api/v1/cars?brand=Ford&model=fusion&year=2017&search=3FA6P0VP1HR282209&sort_field=make&sort_order=desc&per_page=20
Response</br>
{
    "data": [
        {
            "id": 1,
            "userName": "Petro",
            "license_plate": "AK1234AB",
            "color": "red",
            "vin_code": "3FA6P0VP1HR282209",
            "make": "FORD",
            "model": "Fusion",
            "year": 2017,
            "deleted_at": null,
            "created_at": "2023-06-30T13:38:23.000000Z",
            "updated_at": "2023-06-30T13:38:23.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/cars?page=1",
        "last": "http://127.0.0.1:8000/api/v1/cars?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/cars?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/cars",
        "per_page": 20,
        "to": 1,
        "total": 1
    }
}

GET
http://127.0.0.1:8000/api/v1/cars/export
Response
download xls file with all filters

GET
http://127.0.0.1:8000/api/v1/cars/updatebrandsmodels
Response
Update database with make and model

GET
http://127.0.0.1:8000/api/v1/cars/brands/11897/modelsAPI
Response
[
    {
        "Make_ID": 11897,
        "Make_Name": " Mid-Town Trailers",
        "Model_ID": 30727,
        "Model_Name": " Mid-Town Trailers"
    }
]

GET
http://127.0.0.1:8000/api/v1/cars/brands/11897/modelsDatabase
Response
{
    "data": [
        {
            "id": 1,
            "Make_Name": " MID-TOWN TRAILERS",
            "Make_ID": 11897,
            "created_at": "2023-06-30T13:44:08.000000Z",
            "updated_at": "2023-06-30T13:44:08.000000Z",
            "Model_Name": " Mid-Town Trailers",
            "Model_ID": 30727
        }
}


PUT
http://127.0.0.1:8000/api/v1/cars/1

{
    "userName":"Ruslan",
    "license_plate":"AK1234AB",
    "color":"blue",
    "vin_code":"3FA6P0VP1HR282209"
}
Response
{
    "message": "Updated"
}

http://127.0.0.1:8000/api/v1/cars/1
Response
{
    "message": "Car deleted"
}
