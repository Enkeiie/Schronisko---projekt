<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', function () {
    if(Auth::user()->address==null && Auth::user()->shelter==null)
    {
        return redirect()->route('first-boot');
    }
    return redirect("/");
});

//KONTROLKI PROFILÓW

Route::get('/profile', [App\Http\Controllers\UserController::class, 'showUserProfile'])->name('profile');

Route::get('/profile/edit-data', [App\Http\Controllers\UserController::class, 'showUserForm'])->name('profile-data-edit');

Route::get('/profile/edit-address', [App\Http\Controllers\AddressController::class, 'showAddressForm'])->name('profile-data-edit');

Route::post('/profile/edit-address/apply',[App\Http\Controllers\AddressController::class, 'editAddress'])->name('profile-address-edit-apply');

Route::post('/profile/edit-data/apply',[App\Http\Controllers\UserController::class, 'editUserData'])->name('profile-data-edit-apply');

Route::get('/shelter/home', [App\Http\Controllers\HomeController::class, 'firstboot'])->name('first-boot');

Route::get('/first-boot', [App\Http\Controllers\HomeController::class, 'firstboot'])->name('first-boot');

Route::post('first-boot/add', [App\Http\Controllers\AddressController::class, 'createUserAddress'])->name('first-boot-add-address');

//PANEL ADMINISTRATORA

Route::get('/admin-panel', [App\Http\Controllers\UserController::class, 'showAdminPanel'])->name('admin-panel');

Route::get('/admin-panel/user-list', [App\Http\Controllers\UserController::class, 'showUserList'])->name('user-list');

Route::get('/admin-panel/user-list/delete/{id}', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('user-list-delete');

Route::get('/admin-panel/user-list/edit/{id}', [App\Http\Controllers\UserController::class, 'showEditUserForm'])->name('user-list-edit');

Route::post('/admin-panel/user-list/edit/{id}/apply', [App\Http\Controllers\UserController::class, 'editUserData'])->name('user-list-edit-apply');

Route::get('/admin-panel/user-list/change-permission/{uid}/{role}', [App\Http\Controllers\UserController::class, 'setUserRole'])->name('user-list-edit-swap-role');

Route::get('/admin-panel/races-list', [App\Http\Controllers\RacesSpeciesController::class, 'showRacesList'])->name('races-list');

Route::get('/admin-panel/races-list/delete-race/{id}', [App\Http\Controllers\RacesSpeciesController::class, 'deleteRace'])->name('races-list-delete');

Route::get('/admin-panel/races-list/edit-race/{id}', [App\Http\Controllers\RacesSpeciesController::class, 'showEditRaceForm'])->name('races-list-edit');

Route::post('/admin-panel/races-list/edit-race/{id}/apply', [App\Http\Controllers\RacesSpeciesController::class, 'editRace'])->name('races-list-edit-apply');

Route::get('/admin-panel/races-list/delete-specie/{id}', [App\Http\Controllers\RacesSpeciesController::class, 'deleteSpecie'])->name('species-list-delete');

Route::get('/admin-panel/races-list/edit-specie/{id}', [App\Http\Controllers\RacesSpeciesController::class, 'showEditSpecieForm'])->name('species-list-edit');

Route::post('/admin-panel/races-list/edit-specie/{id}/apply', [App\Http\Controllers\RacesSpeciesController::class, 'editSpecie'])->name('species-list-edit-apply');

Route::post('/admin-panel/races-list/race/create', [App\Http\Controllers\RacesSpeciesController::class, 'createRace'])->name('races-list-create-race');

Route::post('/admin-panel/races-list/specie/create', [App\Http\Controllers\RacesSpeciesController::class, 'createSpecie'])->name('species-list-create-specie');

Route::get('/admin-panel/shelters-list', [App\Http\Controllers\ShelterController::class, 'showShelterList'])->name('shelters-list');

Route::get('/admin-panel/shelters-list/create', [App\Http\Controllers\ShelterController::class, 'showShelterForm'])->name('shelters-list-create');

Route::post('/admin-panel/shelters-list/create/add', [App\Http\Controllers\ShelterController::class, 'createShelter'])->name('shelters-list-create-add');

Route::get('/admin-panel/shelters-list/delete/{id}', [App\Http\Controllers\ShelterController::class, 'deleteShelter'])->name('shelters-list-delete');

Route::get('/admin-panel/shelters-list/edit/{id}', [App\Http\Controllers\ShelterController::class, 'showEditShelterForm'])->name('shelters-list-edit');

Route::post('/admin-panel/shelters-list/edit/{id}/apply', [App\Http\Controllers\ShelterController::class, 'editShelterInformation'])->name('shelters-list-edit-apply');

Route::get('/shelter/{id}', [App\Http\Controllers\ShelterController::class, 'showShelterProfile'])->name('shelters-profile');

//WYSZUKIWARKA

Route::get('/browser', [App\Http\Controllers\AnimalController::class, 'showAnimalBrowser'])->name('animal-browser');

//ATRYKUŁY

Route::get('/article/{id}',[App\Http\Controllers\HomeController::class,'articles'])->name('article');

//ZWIERZAKI

Route::get('/my-animals', [App\Http\Controllers\AnimalController::class, 'showMyAnimalList'])->name('animal-list-profile');

Route::get('/admin-panel/animal-list', [App\Http\Controllers\AnimalController::class, 'showAnimalList'])->name('animal-list');

Route::get('/animal-panel/create', [App\Http\Controllers\AnimalController::class, 'showAnimalForm'])->name('animal-create');

Route::post('/animal-panel/create/add', [App\Http\Controllers\AnimalController::class, 'createAnimal'])->name('animal-create-add');

Route::get('/admin-panel/animal-list/edit/{id}', [App\Http\Controllers\AnimalController::class, 'showEditAnimalForm'])->name('animal-edit');

Route::get('/admin-panel/animal-list/edit/{id}', [App\Http\Controllers\AnimalController::class, 'showEditAnimalForm'])->name('animal-edit');

Route::get('/animal-panel/animal/{id}', [App\Http\Controllers\AnimalController::class, 'showAnimalProfile'])->name('animal-profile');

Route::get('/animal-panel/delete/{id}', [App\Http\Controllers\AnimalController::class, 'deleteAnimal'])->name('animal-delete');

Route::post('animal-panel/healthcard/add',[App\Http\Controllers\HealthcardAssesmentController::class,'createAssesment'])->name('animal-profile-details-healthcard-add');

Route::post('animal-panel/animalinfo/add',[App\Http\Controllers\AnimalDetailsController::class,'addAnimalDetail'])->name('animal-profile-details-detail-add');

Route::get('animal-panel/healthcard/delete/{id}',[App\Http\Controllers\HealthcardAssesmentController::class,'deleteAssesment'])->name('animal-profile-details-healthcard-delete');

Route::get('animal-panel/animalinfo/delete/{id}',[App\Http\Controllers\AnimalDetailsController::class,'deleteAnimalDetail'])->name('animal-profile-details-detail-delete');

