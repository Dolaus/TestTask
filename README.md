Створити REST АРІ  бази викрадених авто.</br>
2. Ендпоінти:</br>
1. Додавання авто до бази. Для запису в базу користувач вводить ім'я, державний
номер, колір і вин код (який програмно повинен декодуватись в марку, модель і
рік, все записується в базу для зберігання), валідація значень, що вводяться.
2. Виведення списку викрадених авто з
▪ пагінацією
▪ сортуванням по всіх полях
▪ пошуком по імені/номерному знаку/по вин-коду в одному полі (у своїй базі)
▪ фільтрами по марці, моделі, році - 3 різних фільтри
3. Редагування/видалення записів, також потрібна валідація значень, що
вводяться.
4. Експорт списку з урахуванням всіх фільтрів і сортувань до файлу XLS.
5. Реалізувати автооновлення бази марок і моделей із стороннього ресурсу раз на
місяць.
6. Реалізувати ендпоінт autocomplete марки та виведення всіх моделей цієї марки.

<h3>POST</h3>
http://127.0.0.1:8000/api/v1/cars/
{
    "userName":"Petro",
    "license_plate":"AK1234AB",
    "color":"red",
    "vin_code":"3FA6P0VP1HR282209"
}
<h4>Response</h4>
{
    "success": "Car created successfully"
}
<h3>GET</h3>
http://127.0.0.1:8000/api/v1/cars?brand=Ford&model=fusion&year=2017&search=3FA6P0VP1HR282209&sort_field=make&sort_order=desc&per_page=20</br>
<h4>Response</h4></br>
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

<h3>GET</h3>
http://127.0.0.1:8000/api/v1/cars/export</br>
<h4>Response</h4>
download xls file with all filters

<h3>GET</h3>
http://127.0.0.1:8000/api/v1/cars/updatebrandsmodels</br>
<h4>Response</h4>
Update database with make and model

<h3>GET</h3>
http://127.0.0.1:8000/api/v1/cars/brands/11897/modelsAPI</br>
<h4>Response</h4>
[
    {
        "Make_ID": 11897,
        "Make_Name": " Mid-Town Trailers",
        "Model_ID": 30727,
        "Model_Name": " Mid-Town Trailers"
    }
]

<h3>GET</h3>
http://127.0.0.1:8000/api/v1/cars/brands/11897/modelsDatabase</br>
<h4>Response</h4>
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


<h3>PUT</h3>
http://127.0.0.1:8000/api/v1/cars/1</br>

{
    "userName":"Ruslan",
    "license_plate":"AK1234AB",
    "color":"blue",
    "vin_code":"3FA6P0VP1HR282209"
}
<h4>Response</h4>
{
    "message": "Updated"
}

<h3>DELETE</h3>
http://127.0.0.1:8000/api/v1/cars/1</br>
<h4>Response</h4>
{
    "message": "Car deleted"
}
