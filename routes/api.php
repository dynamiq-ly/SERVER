<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SafetyMeasuresController;
use App\Http\Controllers\Api\ReminderCallController;
use App\Http\Controllers\Api\ActivitiesController;
use App\Http\Controllers\Api\ActivityListController;
use App\Http\Controllers\Api\BankATMController;
use App\Http\Controllers\Api\BarController;
use App\Http\Controllers\Api\BarMenuController;
use App\Http\Controllers\Api\BarMenuDrinksController;
use App\Http\Controllers\Api\ConnectivityController;
use App\Http\Controllers\Api\DrinkServiceCategoryController;
use App\Http\Controllers\Api\EntertainementController;
use App\Http\Controllers\Api\FoodServiceController;
use App\Http\Controllers\Api\FoodServicePlateController;
use App\Http\Controllers\Api\FoodServicePlateSupplementController;
use App\Http\Controllers\Api\GymController;
use App\Http\Controllers\Api\OtherRequestController;
use App\Http\Controllers\Api\PhoneDirectoryController;
use App\Http\Controllers\Api\PointInterestController;
use App\Http\Controllers\Api\PointInterestTypeController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\RestaurantMenu;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomRequestController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\ServiceRoomMiniBarController;
use App\Http\Controllers\Api\SwimmingPoolController;
use App\Http\Controllers\Api\SwimmingPoolListController;
use App\Http\Controllers\Api\TourAgencyController;
use App\Http\Controllers\Api\TourAgencyGuideController;
use App\Http\Controllers\Api\TourAgencyServiceController;

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
 * safety measures api
 */
Route::get('/measures', [SafetyMeasuresController::class, 'index']);
Route::post('/measures', [SafetyMeasuresController::class, 'store']);
Route::get('/measures/{_uid}', [SafetyMeasuresController::class, 'show']);
Route::patch('/measures/{_uid}', [SafetyMeasuresController::class, 'update']);
Route::delete('/measures/{_uid}', [SafetyMeasuresController::class, 'destroy']);

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
 * restaurant
 */
Route::get('/restaurant&status={bool}', [RestaurantController::class, 'index'])->where('bool', '1|0|-1');
Route::get('/restaurant/{id}', [RestaurantController::class, 'show']);
Route::post('/restaurant', [RestaurantController::class, 'store']);
Route::patch('/restaurant/{id}', [RestaurantController::class, 'update']);
Route::delete('/restaurant/{id}', [RestaurantController::class, 'destroy']);
// restaurant regulations
Route::post('/restaurant/regulations/{id}', [RestaurantController::class, 'addRestaurantRegulation']);
// restaurant food menu
Route::get('/restaurant/menu/food', [RestaurantMenu::class, 'index']);
Route::get('/restaurant/menu/food={id}', [RestaurantMenu::class, 'indexFood']);
Route::get('/restaurant/menu/food/{id}', [RestaurantMenu::class, 'showFood']);
Route::post('/restaurant/menu/food', [RestaurantMenu::class, 'storeFood']);
Route::patch('/restaurant/menu/food/{id}', [RestaurantMenu::class, 'updateFood']);
Route::delete('/restaurant/menu/food/{id}', [RestaurantMenu::class, 'destroyFood']);
// restaurant dishes
Route::get('/restaurant/menu/food?dish', [RestaurantMenu::class, 'indexDish']);
Route::get('/restaurant/menu/dish/{id}', [RestaurantMenu::class, 'indexFoodDish']);
Route::post('/restaurant/menu/food?dish', [RestaurantMenu::class, 'storeFoodDish']);
// restaurant drink menu
Route::get('/restaurant/menu/drink', [RestaurantMenu::class, 'index2']);
Route::get('/restaurant/menu/drink={id}', [RestaurantMenu::class, 'indexDrink']);
Route::get('/restaurant/menu/drink/{id}', [RestaurantMenu::class, 'showDrink']);
Route::post('/restaurant/menu/drink', [RestaurantMenu::class, 'storeDrink']);
Route::patch('/restaurant/menu/drink/{id}', [RestaurantMenu::class, 'updateDrink']);
Route::delete('/restaurant/menu/drink/{id}', [RestaurantMenu::class, 'destroyDrink']);
// restaurant drink menu soft drinks
Route::get('/restaurant/drinks/soft', [RestaurantMenu::class, 'indexSoftDrinks']);
Route::get('/restaurant/drinks/soft={id}', [RestaurantMenu::class, 'indexSoftDrink']);
Route::post('/restaurant/drinks/soft', [RestaurantMenu::class, 'storeSoftDrink']);
// restaurant drink menu alcohol drinks
Route::get('/restaurant/drinks/alcohol', [RestaurantMenu::class, 'indexAlcoholDrinks']);
Route::get('/restaurant/drinks/alcohol={id}', [RestaurantMenu::class, 'indexAlcoholDrink']);
Route::post('/restaurant/drinks/alcohol', [RestaurantMenu::class, 'storeAlcoholDrink']);
Route::get('/restaurant/drinks/alcohol/{id}', [RestaurantMenu::class, 'findAlcoholDrink']);

/**
 * bar
 */
Route::get('/bar&status={bool}', [BarController::class, 'index'])->where('bool', '1|0|-1');
Route::get('/bar/{id}', [BarController::class, 'show']);
Route::post('/bar', [BarController::class, 'store']);
Route::patch('/bar/{id}', [BarController::class, 'update']);
Route::delete('/bar/{id}', [BarController::class, 'destroy']);
// bar menu
Route::get('/bar/menu/type={id}', [BarMenuController::class, 'index']);
Route::get('/bar/menu/{id}', [BarMenuController::class, 'show']);
Route::post('/bar/menu', [BarMenuController::class, 'store']);
Route::patch('/bar/menu/{id}', [BarMenuController::class, 'update']);
Route::delete('/bar/menu/{id}', [BarMenuController::class, 'destroy']);
// bar menu drinks
Route::get('/bar/menu/drinks/{id}', [BarMenuDrinksController::class, 'index']);
Route::get('/bar/menu/drinks/search/{id}', [BarMenuDrinksController::class, 'show']);
Route::post('/bar/menu/drinks', [BarMenuDrinksController::class, 'store']);
Route::post('/bar/menu/drinks/{id}', [BarMenuDrinksController::class, 'update']);
Route::delete('/bar/menu/drinks/{id}', [BarMenuDrinksController::class, 'destroy']);

/**
 * room type
 */
Route::get('/rooms/room-category', [RoomTypeController::class, 'index']);
Route::get('/rooms/room-category/{id}', [RoomTypeController::class, 'show']);
Route::post('/rooms/room-category', [RoomTypeController::class, 'store']);
Route::patch('/rooms/room-category/{id}', [RoomTypeController::class, 'update']);
Route::delete('/rooms/room-category/{id}', [RoomTypeController::class, 'destroy']);
// room listing
Route::get('/rooms&status={bool}', [RoomController::class, 'index'])->where('bool', '1|0|-1');

/**
 * point interest
 */
Route::get('/point-of-interest/type', [PointInterestTypeController::class, 'index']);
Route::get('/point-of-interest/type/{id}', [PointInterestTypeController::class, 'show']);
Route::post('/point-of-interest/type', [PointInterestTypeController::class, 'store']);
Route::patch('/point-of-interest/type/{id}', [PointInterestTypeController::class, 'update']);
Route::delete('/point-of-interest/type/{id}', [PointInterestTypeController::class, 'destroy']);
// point of interest
Route::get('/point-of-interest&status={bool}', [PointInterestController::class, 'index'])->where('bool', '1|0|-1');
Route::get('/point-of-interest/{id}', [PointInterestController::class, 'show']);
Route::post('/point-of-interest', [PointInterestController::class, 'store']);
Route::patch('/point-of-interest/{id}', [PointInterestController::class, 'update']);
Route::delete('/point-of-interest/{id}', [PointInterestController::class, 'destroy']);
// image upload
Route::post('/point-of-interest/upload', [PointInterestController::class, 'uploadImage']);

/**
 * entertainement
 */
Route::get('/entertainement={type}', [EntertainementController::class, 'index']);
Route::get('/entertainement={type}/{id}', [EntertainementController::class, 'show']);
Route::post('/entertainement', [EntertainementController::class, 'store']);
Route::delete('/entertainement/{id}', [EntertainementController::class, 'destroy']);

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
Route::delete('/room-service/food-service', [FoodServiceController::class, 'destroy']);
// food service plates
Route::get('/room-service/food-service/plate/{id}', [FoodServicePlateController::class, 'show']);
Route::post('/room-service/food-service/plate', [FoodServicePlateController::class, 'store']);
Route::patch('/room-service/food-service/plate/{id}', [FoodServicePlateController::class, 'update']);
Route::delete('/room-service/food-service/plate', [FoodServicePlateController::class, 'destroy']);
// food service supplement
Route::post('/room-service/food-service/plate/supplement', [FoodServicePlateSupplementController::class, 'store']);
Route::patch('/room-service/food-service/plate/supplement/{id}', [FoodServicePlateSupplementController::class, 'update']);
Route::delete('/room-service/food-service/plate/supplement', [FoodServicePlateSupplementController::class, 'destroy']);
// drink service
Route::get('/room-service/drink-service/category', [DrinkServiceCategoryController::class, 'index']);
Route::get('/room-service/drink-service/category/{id}', [DrinkServiceCategoryController::class, 'show']);
Route::post('/room-service/drink-service/category', [DrinkServiceCategoryController::class, 'store']);
Route::patch('/room-service/drink-service/category/{id}', [DrinkServiceCategoryController::class, 'update']);
Route::delete('/room-service/drink-service/category', [DrinkServiceCategoryController::class, 'destroy']);
// phone directory
Route::get('/directory', [PhoneDirectoryController::class, 'index']);
Route::get('/directory/{id}', [PhoneDirectoryController::class, 'show']);
Route::post('/directory', [PhoneDirectoryController::class, 'store']);
Route::patch('/directory/{id}', [PhoneDirectoryController::class, 'update']);
Route::delete('/directory/{id}', [PhoneDirectoryController::class, 'destroy']);


/**
 * gym
 */
Route::get('/gym', [GymController::class, 'index']);
Route::get('/gym/{id}', [GymController::class, 'show']);
Route::post('/gym', [GymController::class, 'store']);
Route::patch('/gym', [GymController::class, 'update']);
Route::delete('/gym', [GymController::class, 'destroy']);
// gym_equipment
Route::get('/gym/equipments', [GymController::class, 'gymEquipment']);
Route::get('/gym/equipments/{id}', [GymController::class, 'show_gym_equipment']);
Route::post('/gym/equipments', [GymController::class, 'add_gym_equipment']);
Route::patch('/gym/equipments/{id}', [GymController::class, 'update_gym_equipment']);
Route::delete('/gym/equipments/{id}', [GymController::class, 'destroy_gym_equipment']);


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
