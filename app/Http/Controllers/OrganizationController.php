<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    // Метод для получения организаций по зданию
    public function getByBuilding($buildingId)
    {
        $organizations = Organization::where('building_id', $buildingId)->get();

        return response()->json($organizations);
    }

    // Метод для получения организаций по виду деятельности
    public function getByActivity($activityId)
    {
        $organizations = Organization::whereHas('activities', function ($query) use ($activityId) {
            $query->where('activity_id', $activityId);
        })->get();

        return response()->json($organizations);
    }

    // Метод для поиска организаций по радиусу/области
    public function getByRadius(Request $request)
    {
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');
        $radius = $request->get('radius'); // радиус в километрах

        // Примерная формула для поиска в радиусе
        $organizations = Organization::whereRaw(
            "ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ? * 1000",
            [$longitude, $latitude, $radius]
        )->get();

        return response()->json($organizations);
    }

    // Метод для получения информации об организации по идентификатору
    public function getById($id)
    {
        $organization = Organization::with(['building', 'activities', 'phones'])->findOrFail($id);
        return response()->json($organization);
    }

    // Метод для поиска организаций по виду деятельности и всех его подкатегорий
    public function searchByActivity(Request $request, $activityName)
    {
        $activities = Activity::where('name', $activityName)
            ->orWhere('parent_id', Activity::where('name', $activityName)->first()->id)
            ->orWhereIn('parent_id', Activity::where('parent_id', Activity::where('name', $activityName)->first()->id)->pluck('id'))
            ->pluck('id');

        $organizations = Organization::whereHas('activities', function ($query) use ($activities) {
            $query->whereIn('activity_id', $activities);
        })->get();

        return response()->json($organizations);
    }

    // Метод для поиска организации по названию
    public function searchByName(Request $request)
    {
        $name = $request->get('name');
        $organizations = Organization::where('name', 'like', '%' . $name . '%')->get();

        return response()->json($organizations);
    }

    // Метод для получения организаций по виду деятельности с ограничением на 3 уровня вложенности
    public function getActivitiesTree()
    {
        $activities = Activity::whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->with(['children' => function ($query) {
                    $query->with('children');
                }]);
            }])
            ->get();

        return response()->json($activities);
    }
}

