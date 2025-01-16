<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;


//Метод getByBuilding($buildingId) ищет все организации, находящиеся в конкретном здании по его ID.
//Метод getByActivity($activityId) ищет все организации, относящиеся к заданному виду деятельности.
//Метод getByRadius(Request $request) реализует поиск организаций в радиусе от заданной точки, используя географические координаты.
//Метод getById($id) возвращает полную информацию о организации, включая связанные данные.
//Метод searchByActivity(Request $request, $activityName) реализует поиск организаций, которые относятся к виду деятельности и всем его подкатегориям (3 уровня вложенности).
//    Метод searchByName(Request $request) позволяет искать организации по названию.
//Метод getActivitiesTree() возвращает дерево видов деятельности, ограниченное 3 уровнями вложенности.

//Пример запроса для получения всех организаций в здании с ID 1:
//
//GET /api/organizations/building/1
//
//Пример запроса для получения организаций в радиусе 10 км от точки с координатами (55.7558, 37.6173):
//
//GET /api/organizations/radius?latitude=55.7558&longitude=37.6173&radius=10
//
//    Пример поиска организаций по виду деятельности "Еда":
//
//GET /api/organizations/search/activity/Еда
//
//Пример поиска организации по названию:
//
//GET /api/organizations/search/name?name=Рога

Route::middleware('api_key')->group(function () {
    Route::get('organizations/building/{buildingId}', [OrganizationController::class, 'getByBuilding']);
    Route::get('organizations/activity/{activityId}', [OrganizationController::class, 'getByActivity']);
    Route::get('organizations/radius', [OrganizationController::class, 'getByRadius']);
    Route::get('organizations/{id}', [OrganizationController::class, 'getById']);
    Route::get('organizations/search/activity/{activityName}', [OrganizationController::class, 'searchByActivity']);
    Route::get('organizations/search/name', [OrganizationController::class, 'searchByName']);
    Route::get('activities/tree', [OrganizationController::class, 'getActivitiesTree']);
});
