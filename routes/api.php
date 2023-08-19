<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ReminderCallController;
use App\Http\Controllers\Api\ActivitiesController;
use App\Http\Controllers\Api\ActivityListController;
use App\Http\Controllers\Api\AirConditionnerController;
use App\Http\Controllers\Api\BankATMController;
use App\Http\Controllers\Api\ConnectivityController;
use App\Http\Controllers\Api\DrinkServiceCategoryController;
use App\Http\Controllers\Api\ElectricityController;
use App\Http\Controllers\Api\FileManagerController;
use App\Http\Controllers\Api\FoodServiceController;
use App\Http\Controllers\Api\FoodServicePlateController;
use App\Http\Controllers\Api\FoodServicePlateSupplementController;
use App\Http\Controllers\Api\HairDryerController;
use App\Http\Controllers\Api\HouseKeepingController;
use App\Http\Controllers\Api\LaundriesController;
use App\Http\Controllers\Api\LaundryTypeController;
use App\Http\Controllers\Api\MedicalAssistanceController;
use App\Http\Controllers\Api\OtherRequestController;
use App\Http\Controllers\Api\PhoneDirectoryController;
use App\Http\Controllers\Api\PoolTowelsController;
use App\Http\Controllers\Api\ReportIncidentController;
use App\Http\Controllers\Api\RoomRequestController;
use App\Http\Controllers\Api\ServiceRoomMiniBarController;
use App\Http\Controllers\Api\SwimmingPoolController;
use App\Http\Controllers\Api\SwimmingPoolListController;
use App\Http\Controllers\Api\TelevisionController;
use App\Http\Controllers\Api\TourAgencyController;
use App\Http\Controllers\Api\TourAgencyGuideController;
use App\Http\Controllers\Api\TourAgencyServiceController;
use App\Http\Controllers\Api\TowelsController;
use App\Http\Controllers\bar\BarsListController;
use App\Http\Controllers\entertainement\EntertainementController;
use App\Http\Controllers\entertainement\EntertainementDayController;
use App\Http\Controllers\entertainement\EntertainementNightController;
use App\Http\Controllers\entertainement\EntertainementSportController;

use App\Http\Controllers\hotel\HotelLocationPartsController;

use App\Http\Controllers\Pension\PensionController;

use App\Http\Controllers\restaurant\RestaurantChefController;
use App\Http\Controllers\restaurant\RestaurantController;
use App\Http\Controllers\restaurant\RestaurantDrinkMenuController;
use App\Http\Controllers\restaurant\RestaurantFoodMenuController;
use App\Http\Controllers\restaurant\RestaurantRegulationsController;
use App\Http\Controllers\restaurant\RestaurantReservationController;
use App\Http\Controllers\restaurant\RestaurantServingController;
use App\Http\Controllers\restaurant\RestaurantSpecialityController;

use App\Http\Controllers\policies\hotel\HotelPoliciesController;

use App\Http\Controllers\gym\GymController;
use App\Http\Controllers\gym\GymEquipementController;
use App\Http\Controllers\gym\GymStaffController;

use App\Http\Controllers\point\PointOfInterestCategoryController;
use App\Http\Controllers\point\PointOfInterestController;

use App\Http\Controllers\room\RoomCategoryController;
use App\Http\Controllers\room\RoomAddOnController;
use App\Http\Controllers\room\RoomController;
use App\Http\Controllers\room\RoomFeaturesController;

use App\Http\Controllers\room\RoomAddonsManytoManyController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * hotel
 */
Route::prefix('/hotel')->group(function () {
    // location parts
    Route::get('/location-parts', [HotelLocationPartsController::class, 'index']);
    Route::post('/location-parts', [HotelLocationPartsController::class, 'store']);
    Route::get('/location-parts/{id}', [HotelLocationPartsController::class, 'show']);
    Route::patch('/location-parts/{id}', [HotelLocationPartsController::class, 'update']);
    Route::delete('/location-parts/{id}', [HotelLocationPartsController::class, 'destroy']);
});

/**
 * file system manager
 */
Route::get('/file-manager', [FileManagerController::class, 'getFiles']);
Route::get('/file-manager/directories', [FileManagerController::class, 'getAllDirectories']);

/**
 * reminder call api
 */
Route::get('/reception/reminder', [ReminderCallController::class, 'index']);
Route::post('/reception/reminder', [ReminderCallController::class, 'store']);
Route::get('/reception/reminder/{id}', [ReminderCallController::class, 'show']);
Route::patch('/reception/reminder/{id}', [ReminderCallController::class, 'update']);
Route::delete('/reception/reminder/{id}', [ReminderCallController::class, 'destroy']);

/**
 * types of activites and excursion call api
 */
Route::get('/excursion/activities', [ActivitiesController::class, 'index']);
Route::post('/excursion/activities', [ActivitiesController::class, 'store']);
Route::get('/excursion/activities/{id}', [ActivitiesController::class, 'show']);
Route::patch('/excursion/activities/{id}', [ActivitiesController::class, 'update']);
Route::delete('/excursion/activities/{id}', [ActivitiesController::class, 'destroy']);

// name of activities in each excursion call api
Route::get('/excursion/activity', [ActivityListController::class, 'index']);
Route::post('/excursion/activity', [ActivityListController::class, 'store']);
Route::get('/excursion/activity/{id}', [ActivityListController::class, 'show']);
Route::patch('/excursion/activity/{id}', [ActivityListController::class, 'update']);
Route::delete('/excursion/activity/{id}', [ActivityListController::class, 'destroy']);
Route::get('/excursion/{id}/specific', [ActivityListController::class, 'indexFilteredList']);
Route::get('/excursion', [ActivitiesController::class, 'indexWithRelations']);

/**
 * swimming pool
 */
Route::get('/swimming-pool', [SwimmingPoolController::class, 'index']);
Route::post('/swimming-pool', [SwimmingPoolController::class, 'store']);
Route::get('/swimming-pool/{id}', [SwimmingPoolController::class, 'show']);
Route::patch('/swimming-pool/{id}', [SwimmingPoolController::class, 'update']);
Route::delete('/swimming-pool/{id}', [SwimmingPoolController::class, 'destroy']);
Route::get('/pools', [SwimmingPoolListController::class, 'index']);
Route::post('/swimming-pool/pools', [SwimmingPoolListController::class, 'store']);
Route::get('/swimming-pool/pools/type={id}', [SwimmingPoolListController::class, 'searchByPoolType']);
Route::get('/swimming-pool/pools/{id}', [SwimmingPoolListController::class, 'show']);
Route::patch('/swimming-pool/pools/{id}', [SwimmingPoolListController::class, 'update']);
Route::delete('/swimming-pool/pools/{id}', [SwimmingPoolListController::class, 'destroy']);

/**
 * gym
 */
Route::prefix('/gym')->group(function () {
    // gym equipements
    Route::get('/equipements', [GymEquipementController::class, 'index']);
    Route::post('/equipements', [GymEquipementController::class, 'store']);
    Route::get('/equipements/{id}', [GymEquipementController::class, 'show']);
    Route::patch('/equipements/{id}', [GymEquipementController::class, 'update']);
    Route::delete('/equipements/{id}', [GymEquipementController::class, 'destroy']);

    // gym staff
    Route::get('/staff', [GymStaffController::class, 'index']);
    Route::post('/staff', [GymStaffController::class, 'store']);
    Route::get('/staff/{id}', [GymStaffController::class, 'show']);
    Route::patch('/staff/{id}', [GymStaffController::class, 'update']);
    Route::delete('/staff/{id}', [GymStaffController::class, 'destroy']);

    Route::get('/', [GymController::class, 'index']);
    Route::post('/', [GymController::class, 'store']);
    Route::get('/{id}', [GymController::class, 'show']);
    Route::patch('/{id}', [GymController::class, 'update']);
    Route::delete('/{id}', [GymController::class, 'destroy']);
});

/**
 * rooms
 */
Route::prefix('/rooms')->group(function () {
    // addons *.* room -> {ManytoMany}
    Route::get('/link-addons-room', [RoomAddonsManytoManyController::class, 'index']);
    Route::post('/link-addons-room', [RoomAddonsManytoManyController::class, 'store']);
    Route::get('/link-addons-room/{id}', [RoomAddonsManytoManyController::class, 'show']);
    Route::patch('/link-addons-room/{id}', [RoomAddonsManytoManyController::class, 'update']);
    Route::delete('/link-addons-room/{id}', [RoomAddonsManytoManyController::class, 'destroy']);

    // categories
    Route::get('/categories', [RoomCategoryController::class, 'index']);
    route::post('/categories', [RoomCategoryController::class, 'store']);
    Route::get('/categories/{id}', [RoomCategoryController::class, 'show']);
    Route::patch('/categories/{id}', [RoomCategoryController::class, 'update']);
    Route::delete('/categories/{id}', [RoomCategoryController::class, 'destroy']);

    // addons
    Route::get('/addons', [RoomAddOnController::class, 'index']);
    Route::post('/addons', [RoomAddOnController::class, 'store']);
    Route::get('/addons/{id}', [RoomAddOnController::class, 'show']);
    Route::patch('/addons/{id}', [RoomAddOnController::class, 'update']);
    Route::delete('/addons/{id}', [RoomAddOnController::class, 'destroy']);

    // features
    Route::get('/features', [RoomFeaturesController::class, 'index']);
    Route::post('/features', [RoomFeaturesController::class, 'store']);
    Route::get('/features/{id}', [RoomFeaturesController::class, 'show']);
    Route::patch('/features/{id}', [RoomFeaturesController::class, 'update']);
    Route::delete('/features/{id}', [RoomFeaturesController::class, 'destroy']);

    // rooms
    route::get('/', [RoomController::class, 'index']);
    Route::post('/', [RoomController::class, 'store']);
    Route::get('/{id}', [RoomController::class, 'show']);
    Route::patch('/{id}', [RoomController::class, 'update']);
    Route::delete('/{id}', [RoomController::class, 'destroy']);

});

/**
 * policies
 */
Route::prefix('/policies')->group(function() {
    Route::get('/', [HotelPoliciesController::class, 'index']);
    Route::post('/', [HotelPoliciesController::class, 'store']);
    Route::get('/{id}', [HotelPoliciesController::class, 'show']);
    Route::patch('/{id}', [HotelPoliciesController::class, 'update']);
    Route::delete('/{id}', [HotelPoliciesController::class, 'destroy']);
});

/**
 * point of interest
 */
Route::prefix('/point-of-interest')->group(function () {
    // categories
    Route::get('/categories', [PointOfInterestCategoryController::class, 'index']);
    route::post('/categories', [PointOfInterestCategoryController::class, 'store']);
    Route::get('/categories/{id}', [PointOfInterestCategoryController::class, 'show']);
    Route::patch('/categories/{id}', [PointOfInterestCategoryController::class, 'update']);
    Route::delete('/categories/{id}', [PointOfInterestCategoryController::class, 'destroy']);

    // points of interest
    Route::get('/', [PointOfInterestController::class, 'index']);
    Route::post('/', [PointOfInterestController::class, 'store']);
    Route::get('/{id}', [PointOfInterestController::class, 'show']);
    Route::patch('/{id}', [PointOfInterestController::class, 'update']);
    Route::delete('/{id}', [PointOfInterestController::class, 'destroy']);
});

/**
 * pension upgrade
 */
Route::prefix('/pension')->group(function () {

    Route::get('/', [PensionController::class, 'index']);
    Route::post('/', [PensionController::class, 'store']);
    Route::get('/{id}', [PensionController::class, 'show']);
    Route::patch('/{id}', [PensionController::class, 'update']);
    Route::delete('/{id}', [PensionController::class, 'destroy']);
});


/**
 * bars
 */
Route::prefix('/bars')->group(function () {
    // bars
    Route::get('/', [BarsListController::class, 'index']);
    Route::post('/', [BarsListController::class, 'store']);
    Route::get('/{id}', [BarsListController::class, 'show']);
    Route::patch('/{id}', [BarsListController::class, 'update']);
    Route::delete('/{id}', [BarsListController::class, 'destroy']);
});

/**
 * restaurant
 */
Route::prefix('/restaurant')->group(function () {
    // reservations
    Route::get('/reservations', [RestaurantReservationController::class, 'index']);
    Route::get('/reservations/{id}', [RestaurantReservationController::class, 'show']);
    Route::post('/reservations', [RestaurantReservationController::class, 'store']);
    Route::patch('/reservations/{id}', [RestaurantReservationController::class, 'update']);
    Route::delete('/reservations/{id}', [RestaurantReservationController::class, 'destroy']);

    // regulations
    Route::get('/regulations', [RestaurantRegulationsController::class, 'index']);
    Route::get('/regulations/{id}', [RestaurantRegulationsController::class, 'show']);
    Route::post('/regulations', [RestaurantRegulationsController::class, 'store']);
    Route::patch('/regulations/{id}', [RestaurantRegulationsController::class, 'update']);
    Route::delete('/regulations/{id}', [RestaurantRegulationsController::class, 'destroy']);

    // drink cataog
    Route::get('/drink', [RestaurantDrinkMenuController::class, 'index']);
    Route::get('/drink/{id}', [RestaurantDrinkMenuController::class, 'show']);
    Route::post('/drink', [RestaurantDrinkMenuController::class, 'store']);
    Route::patch('/drink/{id}', [RestaurantDrinkMenuController::class, 'update']);
    Route::delete('/drink/{id}', [RestaurantDrinkMenuController::class, 'destroy']);

    // food catalog
    Route::get('/menu', [RestaurantFoodMenuController::class, 'index']);
    Route::get('/menu/{id}', [RestaurantFoodMenuController::class, 'show']);
    Route::post('/menu', [RestaurantFoodMenuController::class, 'store']);
    Route::patch('/menu/{id}', [RestaurantFoodMenuController::class, 'update']);
    Route::delete('/menu/{id}', [RestaurantFoodMenuController::class, 'destroy']);

    // speciality
    Route::get('/speciality', [RestaurantSpecialityController::class, 'index']);
    Route::get('/speciality/{id}', [RestaurantSpecialityController::class, 'show']);
    Route::post('/speciality', [RestaurantSpecialityController::class, 'store']);
    Route::patch('/speciality/{id}', [RestaurantSpecialityController::class, 'update']);
    Route::delete('/speciality/{id}', [RestaurantSpecialityController::class, 'destroy']);

    // chefs
    Route::get('/chef', [RestaurantChefController::class, 'index']);
    Route::get('/chef/{id}', [RestaurantChefController::class, 'show']);
    Route::post('/chef', [RestaurantChefController::class, 'store']);
    Route::patch('/chef/{id}', [RestaurantChefController::class, 'update']);
    Route::delete('/chef/{id}', [RestaurantChefController::class, 'destroy']);

    // serving list
    Route::get('/serving', [RestaurantServingController::class, 'index']);
    Route::get('/serving/{id}', [RestaurantServingController::class, 'show']);
    Route::post('/serving', [RestaurantServingController::class, 'store']);
    Route::patch('/serving/{id}', [RestaurantServingController::class, 'update']);
    Route::delete('/serving/{id}', [RestaurantServingController::class, 'destroy']);

    // restaurant
    Route::get('/', [RestaurantController::class, 'index'])->name('Restaurant.Main');
    Route::get('/{id}', [RestaurantController::class, 'show']);
    Route::post('/', [RestaurantController::class, 'store']);
    Route::patch('/{id}', [RestaurantController::class, 'update']);
    Route::delete('/{id}', [RestaurantController::class, 'destroy']);
});

/**
 * entertainment
 */
Route::prefix('/entertainement')->group(function () {

    // sport events
    Route::get('/sport-events', [EntertainementSportController::class, 'index']);
    Route::get('/sport-events/{id}', [EntertainementSportController::class, 'show']);
    Route::post('/sport-events', [EntertainementSportController::class, 'store']);
    Route::patch('/sport-events/{id}', [EntertainementSportController::class, 'update']);
    Route::delete('/sport-events/{id}', [EntertainementSportController::class, 'destroy']);

    // night shows
    Route::get('/night-shows', [EntertainementNightController::class, 'index']);
    Route::get('/night-shows/{id}', [EntertainementNightController::class, 'show']);
    Route::post('/night-shows', [EntertainementNightController::class, 'store']);
    Route::patch('/night-shows/{id}', [EntertainementNightController::class, 'update']);
    Route::delete('/night-shows/{id}', [EntertainementNightController::class, 'destroy']);

    // day activities
    Route::get('/day-activities', [EntertainementDayController::class, 'index']);
    Route::get('/day-activities/{id}', [EntertainementDayController::class, 'show']);
    Route::post('/day-activities', [EntertainementDayController::class, 'store']);
    Route::patch('/day-activities/{id}', [EntertainementDayController::class, 'update']);
    Route::delete('/day-activities/{id}', [EntertainementDayController::class, 'destroy']);

    // helpers
    Route::get('/weekly-count', [EntertainementController::class, 'totalTiming']);
});


/**
 * room service
 */

// mini bar
Route::get('/room-service/mini-bar', [ServiceRoomMiniBarController::class, 'index']);
Route::get('/room-service/mini-bar/{id}', [ServiceRoomMiniBarController::class, 'show']);
Route::post('/room-service/mini-bar', [ServiceRoomMiniBarController::class, 'store']);
Route::patch('/room-service/mini-bar/{id}', [ServiceRoomMiniBarController::class, 'update']);
Route::delete('/room-service/mini-bar/{id}', [ServiceRoomMiniBarController::class, 'destroy']);
// food service
Route::get('/room-service/food-service', [FoodServiceController::class, 'index']);
Route::get('/room-service/food-service/{id}', [FoodServiceController::class, 'show']);
Route::post('/room-service/food-service', [FoodServiceController::class, 'store']);
Route::patch('/room-service/food-service/{id}', [FoodServiceController::class, 'update']);
Route::delete('/room-service/food-service/{id}', [FoodServiceController::class, 'destroy']);
// food service plates
Route::get('/room-service/food-service/{id}/plate', [FoodServicePlateController::class, 'index']);
Route::get('/room-service/food-service/plate/{id}', [FoodServicePlateController::class, 'show']);
Route::post('/room-service/food-service/plate', [FoodServicePlateController::class, 'store']);
Route::patch('/room-service/food-service/plate/{id}', [FoodServicePlateController::class, 'update']);
Route::delete('/room-service/food-service/plate/{id}', [FoodServicePlateController::class, 'destroy']);
// food service supplement
Route::get('/room-service/food-service/plate/supplement', [FoodServicePlateSupplementController::class, 'index']);
Route::get('/room-service/food-service/plate/supplement/{id}', [FoodServicePlateSupplementController::class, 'show']);
Route::post('/room-service/food-service/plate/supplement', [FoodServicePlateSupplementController::class, 'store']);
Route::patch('/room-service/food-service/plate/supplement/{id}', [FoodServicePlateSupplementController::class, 'update']);
Route::delete('/room-service/food-service/plate/supplement/{id}', [FoodServicePlateSupplementController::class, 'destroy']);
// drink service
Route::get('/room-service/drink-service/category', [DrinkServiceCategoryController::class, 'index']);
Route::get('/room-service/drink-service/category/{id}', [DrinkServiceCategoryController::class, 'show']);
Route::post('/room-service/drink-service/category', [DrinkServiceCategoryController::class, 'store']);
Route::patch('/room-service/drink-service/category/{id}', [DrinkServiceCategoryController::class, 'update']);
Route::delete('/room-service/drink-service/category/{id}', [DrinkServiceCategoryController::class, 'destroy']);
// phone directory
Route::get('/directory', [PhoneDirectoryController::class, 'index']);
Route::get('/directory/{id}', [PhoneDirectoryController::class, 'show']);
Route::post('/directory', [PhoneDirectoryController::class, 'store']);
Route::patch('/directory/{id}', [PhoneDirectoryController::class, 'update']);
Route::delete('/directory/{id}', [PhoneDirectoryController::class, 'destroy']);

/**
 * connectivity
 */
Route::get('/connectivity', [ConnectivityController::class, 'index']);
Route::get('/connectivity/{id}', [ConnectivityController::class, 'show']);
Route::post('/connectivity', [ConnectivityController::class, 'store']);
Route::patch('/connectivity/{id}', [ConnectivityController::class, 'update']);
Route::delete('/connectivity/{id}', [ConnectivityController::class, 'destroy']);

/**
 * bank and atm
 */
Route::get('/banks', [BankATMController::class, 'index']);
Route::get('/banks/{id}', [BankATMController::class, 'show']);
Route::post('/banks', [BankATMController::class, 'store']);
Route::patch('/banks/{id}', [BankATMController::class, 'update']);
Route::delete('/banks/{id}', [BankATMController::class, 'destroy']);

/**
 * other request
 */
Route::get('/other-request', [OtherRequestController::class, 'index']);
Route::get('/other-request/{id}', [OtherRequestController::class, 'show']);
Route::post('/other-request', [OtherRequestController::class, 'store']);
Route::patch('/other-request/{id}', [OtherRequestController::class, 'update']);
Route::delete('/other-request/{id}', [OtherRequestController::class, 'destroy']);

/**
 * tour operators
 */
Route::get('/tour-operator/agency', [TourAgencyController::class, 'index']);
Route::get('/tour-operator/agency/{id}', [TourAgencyController::class, 'show']);
Route::post('/tour-operator/agency', [TourAgencyController::class, 'store']);
Route::patch('/tour-operator/agency/{id}', [TourAgencyController::class, 'update']);
Route::delete('/tour-operator/agency/{id}', [TourAgencyController::class, 'destroy']);
// tour operators services
Route::get('/tour-operator/services', [TourAgencyServiceController::class, 'index']);
Route::get('/tour-operator/services/{id}', [TourAgencyServiceController::class, 'show']);
Route::post('/tour-operator/services', [TourAgencyServiceController::class, 'store']);
Route::patch('/tour-operator/services/{id}', [TourAgencyServiceController::class, 'update']);
Route::delete('/tour-operator/services/{id}', [TourAgencyServiceController::class, 'destroy']);
// tour operators guide
Route::get('/tour-operator/guides', [TourAgencyGuideController::class, 'index']);
Route::get('/tour-operator/guides/{id}', [TourAgencyGuideController::class, 'show']);
Route::post('/tour-operator/guides', [TourAgencyGuideController::class, 'store']);
Route::patch('/tour-operator/guides/{id}', [TourAgencyGuideController::class, 'update']);
Route::delete('/tour-operator/guides/{id}', [TourAgencyGuideController::class, 'destroy']);

/**
 * room request
 */
Route::get('/room-request', [RoomRequestController::class, 'index']);
Route::get('/room-request/{id}', [RoomRequestController::class, 'show']);
Route::post('/room-request', [RoomRequestController::class, 'store']);
Route::patch('/room-request/{id}', [RoomRequestController::class, 'update']);
Route::delete('/room-request/{id}', [RoomRequestController::class, 'destroy']);

/**
 * house keeping
 */
Route::get('/house-keeping', [HouseKeepingController::class, 'index']);
Route::get('/house-keeping/{id}', [HouseKeepingController::class, 'show']);
Route::post('/house-keeping', [HouseKeepingController::class, 'store']);
Route::patch('/house-keeping/{id}', [HouseKeepingController::class, 'update']);
Route::delete('/house-keeping/{id}', [HouseKeepingController::class, 'destroy']);

/**
 * television
 */
Route::get('/television', [TelevisionController::class, 'index']);
Route::get('/television/{id}', [TelevisionController::class, 'show']);
Route::post('/television', [TelevisionController::class, 'store']);
Route::patch('/television/{id}', [TelevisionController::class, 'update']);
Route::delete('/television/{id}', [TelevisionController::class, 'destroy']);

/**
 * pool towels
 */
Route::get('/pool-towels', [PoolTowelsController::class, 'index']);
Route::get('/pool-towels/{id}', [PoolTowelsController::class, 'show']);
Route::post('/pool-towels', [PoolTowelsController::class, 'store']);
Route::patch('/pool-towels/{id}', [PoolTowelsController::class, 'update']);
Route::delete('/pool-towels/{id}', [PoolTowelsController::class, 'destroy']);

/**
 * towels
 */
Route::get('/towels', [TowelsController::class, 'index']);
Route::get('/towels/{id}', [TowelsController::class, 'show']);
Route::post('/towels', [TowelsController::class, 'store']);
Route::patch('/towels/{id}', [TowelsController::class, 'update']);
Route::delete('/towels/{id}', [TowelsController::class, 'destroy']);

/**
 * Laundry
 */
Route::get('/laundry', [LaundriesController::class, 'index']);
Route::get('/laundry/{id}', [LaundriesController::class, 'show']);
Route::post('/laundry', [LaundriesController::class, 'store']);
Route::patch('/laundry/{id}', [LaundriesController::class, 'update']);
Route::delete('/laundry/{id}', [LaundriesController::class, 'destroy']);
// Laundry Menu
Route::get('/laundry-menu', [LaundryTypeController::class, 'index']);
Route::get('/laundry-menu/{id}', [LaundryTypeController::class, 'show']);
Route::post('/laundry-menu', [LaundryTypeController::class, 'store']);
Route::patch('/laundry-menu/{id}', [LaundryTypeController::class, 'update']);
Route::delete('/laundry-menu/{id}', [LaundryTypeController::class, 'destroy']);

/**
 * Electricity and cables
 */
Route::get('/electricity', [ElectricityController::class, 'index']);
Route::get('/electricity/{id}', [ElectricityController::class, 'show']);
Route::post('/electricity', [ElectricityController::class, 'store']);
Route::patch('/electricity/{id}', [ElectricityController::class, 'update']);
Route::delete('/electricity/{id}', [ElectricityController::class, 'destroy']);

/**
 * Air Conditionner
 */
Route::get('/air-conditionner', [AirConditionnerController::class, 'index']);
Route::get('/air-conditionner/{id}', [AirConditionnerController::class, 'show']);
Route::post('/air-conditionner', [AirConditionnerController::class, 'store']);
Route::patch('/air-conditionner/{id}', [AirConditionnerController::class, 'update']);
Route::delete('/air-conditionner/{id}', [AirConditionnerController::class, 'destroy']);

/**
 * Hair Dryer
 */
Route::get('/hair-dryer', [HairDryerController::class, 'index']);
Route::get('/hair-dryer/{id}', [HairDryerController::class, 'show']);
Route::post('/hair-dryer', [HairDryerController::class, 'store']);
Route::patch('/hair-dryer/{id}', [HairDryerController::class, 'update']);
Route::delete('/hair-dryer/{id}', [HairDryerController::class, 'destroy']);

/**
 * Report Incident
 */
Route::get('/report-incident', [ReportIncidentController::class, 'index']);
Route::get('/report-incident/{id}', [ReportIncidentController::class, 'show']);
Route::post('/report-incident', [ReportIncidentController::class, 'store']);
Route::patch('/report-incident/{id}', [ReportIncidentController::class, 'update']);
Route::delete('/report-incident/{id}', [ReportIncidentController::class, 'destroy']);

/**
 * MedicalAssistance
 */
Route::get('/medical-assistance', [MedicalAssistanceController::class, 'index']);
Route::get('/medical-assistance/{id}', [MedicalAssistanceController::class, 'show']);
Route::post('/medical-assistance', [MedicalAssistanceController::class, 'store']);
Route::patch('/medical-assistance/{id}', [MedicalAssistanceController::class, 'update']);
Route::delete('/medical-assistance/{id}', [MedicalAssistanceController::class, 'destroy']);
