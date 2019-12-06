<?php

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
Route::get('test', function(){
    $suntrackBranches = App\Remote\Suntrack\Branch::all();
    foreach($suntrackBranches as $suntrackBranch){
       $brnch = App\BranchSunEnglish::where('branch_code', $suntrackBranch->branch_code)->first();
       $brnch->branch_uuid = $suntrackBranch->branch_uuid;
       $brnch->save();
    }
});

Route::get('clear-cache', function(){
  Artisan::call('clear-compiled');
  echo "clear-compiled: complete<br>";
  Artisan::call('cache:clear');
  echo "cache:clear: complete<br>";
  Artisan::call('config:clear');
  echo "config:clear: complete<br>";
  Artisan::call('view:clear');
  echo "view:clear: complete<br>";
  Artisan::call('optimize:clear');
  echo "optimize:clear: complete<br>";
  Artisan::call('config:cache');
  echo "config:cache: complete<br>";
  Artisan::call('view:cache');
  echo "view:cache: complete<br>";
});


Route::group(['prefix' => 'event-registration'], function () {
    Route::post('apply/group/{event_group_id}','Event\EventGroupController@applyEvent')->name('applyEventGroup');
    Route::post('apply/{event_id}','Event\EventController@applyEvent')->name('applyEvent');
    Route::get('group/{group_id}/{slug}/{lang_id}', 'Event\EventGroupController@registration')->name('linkRegistrationEventGroup');
    Route::get('{event_id}/{slug}/{lang_id}', 'Event\EventController@registration')->name('linkRegistrationEvent');
});

// Route::get('/event-registration', function() {
//     return view('pages.eventregistration.index');
//     // return redirect('/leads');
// })->name('eventRegistration');

Route::get('/event-registration2', function() {
    return view('pages.eventregistration2.index');
    // return redirect('/leads');
})->name('eventRegistration2');


Route::post('/thankyou', 'EventRegistrationController@create')->name('registration');

// Route::post('/event-registration', function() {
//     return view('pages.eventregistration.index');
//     // return redirect('/leads');
// });


// FOR VUE JS ROUTE
Route::group(['prefix' => 'registration'], function () {
    // Route::get('/', 'Leads\LeadsGenerator@index');
    Route::get('/{vue_capture?}', function () {
        return view('pages.leads.registration');
    })->where('vue_capture', '[\/\w\.-]*');
});

Route::get('sunsafe/login', 'Auth\SunSafe\LoginController@login');

Route::get('/', function() {
    return redirect('/login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('clear', function(){
            // Artisan::call('clear');
            sleep(1);
            Artisan::call('clear-compiled');
            sleep(1);
            Artisan::call('cache:clear');
            sleep(1);
            Artisan::call('config:clear');
            sleep(1);
            Artisan::call('view:clear');
            sleep(1);
            Artisan::call('optimize:clear');
            sleep(1);
            Artisan::call('config:cache');
            sleep(1);
            Artisan::call('view:cache');
    });

    // DASHBOARD
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('', 'Dashboard\DashboardController@index')->name('indexDashboard');
        Route::get('getDataOverview', 'Dashboard\DashboardController@getDataOverview')->name('getDataOverviewDashboard');
    });

    // Route::match(['get', 'post'], '/dashboard', function(){
    //     return view('dashboard');
    // });

    Route::group(['prefix' => 'leads', 'middleware' => ['permission:open_page_leads']], function () {
        Route::get('/', 'Leads\LeadsController@getAll')->name('getAllLeads');
        Route::post('/', 'Leads\LeadsController@searchData')->name('searchDataLeads');
        Route::get('/{type?}', 'Leads\LeadsController@getByType')->name('getDataByTypeLeads');
        Route::get('/{type?}/{id?}', 'Leads\LeadsController@getByID')->name('getDataByID');
    });


    Route::group(['prefix' => 'schools', 'middleware' => ['permission:open_page_schools']], function () {
      Route::get('/', 'School\SchoolController@index')->name('indexSchool');
      Route::get('/add', 'School\SchoolController@add')->name('addSchool');
      Route::post('/postAdd', 'School\SchoolController@postAdd')->name('postAddSchool');
      Route::get('/edit/{school_id}', 'School\SchoolController@edit')->name('editSchool');
      Route::post('/update/{school_id}', 'School\SchoolController@update')->name('updateSchool');
      Route::get('/delete/{school_id}', 'School\SchoolController@confirmDelete')->name('deleteSchool');
      Route::post('/confirmDelete', 'School\SchoolController@confirmDelete')->name('confirmDeleteSchool');
      Route::post('/import', 'School\SchoolController@import')->name('importSchool');

      Route::group(['prefix' => 'school-types', 'middleware' => ['permission:open_page_schools']], function () {
        Route::get('/', 'School\SchoolTypeController@index')->name('indexSchoolType');
        Route::get('/add', 'School\SchoolTypeController@add')->name('addSchoolType');
        Route::post('/postAdd', 'School\SchoolTypeController@postAdd')->name('postAddSchoolType');
        Route::get('/edit/{school_id}', 'School\SchoolTypeController@edit')->name('editSchoolType');
        Route::post('/update/{school_id}', 'School\SchoolTypeController@update')->name('updateSchoolType');
        Route::get('/delete/{school_id}', 'School\SchoolTypeController@confirmDelete')->name('deleteSchoolType');
        Route::post('/confirmDelete', 'School\SchoolTypeController@confirmDelete')->name('confirmDeleteSchoolType');
      });

      Route::get('/{type?}', 'School\SchoolController@getByType')->name('getDataByTypeSchool');
  });


    Route::group(['prefix' => 'postal-codes', 'middleware' => ['permission:open_page_postal_code']], function () {
        Route::get('/', 'PostalCode\PostalCodeController@index')->name('indexPostalCode');
        Route::post('/add', 'PostalCode\PostalCodeController@add')->name('addPostalCode');
        Route::get('/edit/{school_id}', 'PostalCode\PostalCodeController@edit')->name('editPostalCode');
        Route::post('/update/{school_id}', 'PostalCode\PostalCodeController@update')->name('updatePostalCode');
    });

    Route::group(['prefix' => 'field-of-studies', 'middleware' => ['permission:open_page_field_of_study']], function () {
        Route::get('/', 'FieldOfStudy\FieldOfStudyController@index')->name('indexFieldOfStudy');
        Route::get('/add', 'FieldOfStudy\FieldOfStudyController@add')->name('addFieldOfStudy');
        Route::post('/add', 'FieldOfStudy\FieldOfStudyController@postAdd')->name('postAddFieldOfStudy');
        Route::get('/edit/{field_of_study_id}', 'FieldOfStudy\FieldOfStudyController@edit')->name('editFieldOfStudy');
        Route::post('/update', 'FieldOfStudy\FieldOfStudyController@update')->name('updateFieldOfStudy');
    });

    Route::group(['prefix' => 'majors', 'middleware' => ['permission:open_page_major']], function () {
        Route::get('/', 'Major\MajorController@index')->name('indexMajor');
        Route::get('/add', 'Major\MajorController@add')->name('addMajor');
        Route::post('/add', 'Major\MajorController@postAdd')->name('postAddMajor');
        Route::get('/edit/{major_id}', 'Major\MajorController@edit')->name('editMajor');
        Route::post('/update', 'Major\MajorController@update')->name('updateMajor');
        Route::get('/{field_of_study_id?}', 'Major\MajorController@getDataByFieldOfStudy')->name('getDataByFieldOfStudyMajor');
    });

    Route::group(['prefix' => 'events', 'middleware' => ['permission:open_page_event']], function () {
        // Route::get('/', 'Event\EventController@index')->name('indexEvent');
        Route::get('/edit/{id}', 'Event\EventController@edit')->name('editEvent');
        Route::post('/update/{id}', 'Event\EventController@update')->name('updateEvent');
        Route::get('/delete/{id}', 'Event\EventController@delete')->name('deleteEvent');
        Route::post('/confirmDelete/{id}', 'Event\EventController@confirmDelete')->name('confirmDeleteEvent');
        Route::get('/add', 'Event\EventController@add')->name('addEvent');
        Route::post('/postAdd', 'Event\EventController@postAdd')->name('postAddEvent');

        Route::group(['prefix' => 'group'], function () {
            Route::get('/', 'Event\EventGroupController@index')->name('indexEventGroup');
            Route::get('/add', 'Event\EventGroupController@add')->name('addEventGroup');
            Route::post('/add', 'Event\EventGroupController@postAdd')->name('postAddEventGroup');
            Route::get('/edit/{event_group_id}', 'Event\EventGroupController@edit')->name('editEventGroup');
            Route::post('/update', 'Event\EventGroupController@update')->name('updateEventGroup');
            Route::get('/delete/{event_group_id}', 'Event\EventGroupController@delete')->name('deleteEventGroup');
            Route::post('/confirmDelete', 'Event\EventGroupController@confirmDelete')->name('confirmDeleteEventGroup');
            Route::get('/detail/{event_group_id}', 'Event\EventGroupController@detail')->name('detailEventGroup');
            Route::get('/detail/{event_group_id}/{event_id}/{event_registration_id}', 'Event\EventGroupController@detailRegistration')->name('eventRegistrationDetailEventGroup');
        });

        Route::get('/{slug}/en', 'Event\EventController@linkEventId')->name('linkEventId');
        Route::get('/{slug}/id', 'Event\EventController@linkEventEn')->name('linkEventEn');
        Route::get('/{slug?}', 'Event\EventController@getByType')->name('getDataByTypeEvents');

        Route::group(['prefix' => '{slug}/registration'], function () {
            Route::get('/{event_id}', 'Event\EventRegistrationController@index')->name('indexEventRegistration');
            Route::get('/{event_id}/detail/{event_registration_id}', 'Event\EventRegistrationController@detail')->name('eventRegistrationDetail');
        });



        // Route::post('/create', 'EventRegistrationController@create')->name('registration');
        Route::get('/view/{id}', 'EventRegistrationController@view')->name('viewEvent');
        Route::get('/view/detail/{id}', 'EventRegistrationController@details')->name('viewDetails');
        // Route::get('/{slug}/en', 'EventRegistrationController@index')->name('linkEventId');
        // Route::get('/{slug}/id', 'EventRegistrationController@index2')->name('linkEventEn');
    });

    Route::group(['prefix' => 'branches', 'middleware' => ['permission:open_page_branch']], function () {
        Route::get('/', 'Branch\BranchController@index')->name('indexBranch');
        Route::get('/add', 'Branch\BranchController@add')->name('addBranch');
        Route::post('/add', 'Branch\BranchController@postAdd')->name('postAddBranch');
        Route::get('/edit/{branch_id}', 'Branch\BranchController@edit')->name('editBranch');
        Route::post('/update', 'Branch\BranchController@update')->name('updateBranch');
        Route::get('/delete/{branch_id}', 'Branch\BranchController@delete')->name('deleteBranch');
        Route::post('/confirmDelete', 'Branch\BranchController@confirmDelete')->name('confirmDeleteBranch');
        Route::group(['prefix' => 'sun-education'], function () {
            Route::get('/', 'Branch\SunEducationController@index')->name('indexBranchSunEducation');
            Route::get('/add', 'Branch\SunEducationController@add')->name('addBranchSunEducation');
            Route::post('/add', 'Branch\SunEducationController@postAdd')->name('postAddBranchSunEducation');
            Route::get('/edit/{branch_id}', 'Branch\SunEducationController@edit')->name('editBranchSunEducation');
            Route::post('/update', 'Branch\SunEducationController@update')->name('updateBranchSunEducation');
            Route::get('/delete/{branch_id}', 'Branch\SunEducationController@delete')->name('deleteBranchSunEducation');
            Route::post('/confirmDelete', 'Branch\SunEducationController@confirmDelete')->name('confirmDeleteBranchSunEducation');
        });
        Route::group(['prefix' => 'sun-english'], function () {
            Route::get('/', 'Branch\SunEnglishController@index')->name('indexBranchSunEnglish');
            Route::get('/add', 'Branch\SunEnglishController@add')->name('addBranchSunEnglish');
            Route::post('/add', 'Branch\SunEnglishController@postAdd')->name('postAddBranchSunEnglish');
            Route::get('/edit/{branch_id}', 'Branch\SunEnglishController@edit')->name('editBranchSunEnglish');
            Route::post('/update', 'Branch\SunEnglishController@update')->name('updateBranchSunEnglish');
            Route::get('/delete/{branch_id}', 'Branch\SunEnglishController@delete')->name('deleteBranchSunEnglish');
            Route::post('/confirmDelete', 'Branch\SunEnglishController@confirmDelete')->name('confirmDeleteBranchSunEnglish');
        });
    });

    Route::group(['prefix' => 'countries', 'middleware' => ['permission:open_page_country']], function () {
        Route::get('/', 'Country\CountryController@index')->name('indexCountry');
        Route::get('/add', 'Country\CountryController@add')->name('addCountry');
        Route::post('/add', 'Country\CountryController@postAdd')->name('postAddCountry');
        Route::get('/edit/{country_id}', 'Country\CountryController@edit')->name('editCountry');
        Route::post('/update', 'Country\CountryController@update')->name('updateCountry');
        Route::get('/delete/{country_id}', 'Country\CountryController@delete')->name('deleteCountry');
        Route::post('/confirmDelete', 'Country\CountryController@confirmDelete')->name('confirmDeleteCountry');
    });

    Route::group(['prefix' => 'marketing-sources', 'middleware' => ['permission:open_page_marketing_source']], function () {
        Route::get('/', 'MarketingSource\MarketingSourceController@index')->name('indexMarketingSource');
        Route::get('/add', 'MarketingSource\MarketingSourceController@add')->name('addMarketingSource');
        Route::post('/add', 'MarketingSource\MarketingSourceController@postAdd')->name('postAddMarketingSource');
        Route::get('/edit/{marketing_source_id}', 'MarketingSource\MarketingSourceController@edit')->name('editMarketingSource');
        Route::post('/update', 'MarketingSource\MarketingSourceController@update')->name('updateMarketingSource');
        Route::get('/delete/{marketing_source_id}', 'MarketingSource\MarketingSourceController@delete')->name('deleteMarketingSource');
        Route::post('/confirmDelete', 'MarketingSource\MarketingSourceController@confirmDelete')->name('confirmDeleteMarketingSource');
    });

    Route::group(['prefix' => 'institutions', 'middleware' => ['permission:open_page_institution']], function () {
        Route::get('/', 'Institution\InstitutionController@index')->name('indexInstitution');
        Route::get('/add', 'Institution\InstitutionController@add')->name('addInstitution');
        Route::post('/add', 'Institution\InstitutionController@postAdd')->name('postAddInstitution');
        Route::get('/edit/{institution_id}', 'Institution\InstitutionController@edit')->name('editInstitution');
        Route::post('/update', 'Institution\InstitutionController@update')->name('updateInstitution');
        Route::get('/delete/{institution_id}', 'Institution\InstitutionController@delete')->name('deleteInstitution');
        Route::post('/confirmDelete', 'Institution\InstitutionController@confirmDelete')->name('confirmDeleteInstitution');

        Route::group(['prefix' => 'group', 'middleware' => ['permission:open_page_institution']], function () {
            Route::get('/', 'Institution\GroupController@index')->name('indexInstitutionGroup');
            Route::get('/add', 'Institution\GroupController@add')->name('addInstitutionGroup');
            Route::post('/add', 'Institution\GroupController@postAdd')->name('postAddInstitutionGroup');
            Route::get('/edit/{institution_group_id}', 'Institution\GroupController@edit')->name('editInstitutionGroup');
            Route::post('/update', 'Institution\GroupController@update')->name('updateInstitutionGroup');
            Route::get('/delete/{institution_group_id}', 'Institution\GroupController@delete')->name('deleteInstitutionGroup');
            Route::post('/confirmDelete', 'Institution\GroupController@confirmDelete')->name('confirmDeleteInstitutionGroup');
        });

        Route::group(['prefix' => 'contact', 'middleware' => ['permission:open_page_institution']], function () {
            Route::get('/', 'Institution\ContactController@index')->name('indexInstitutionContact');
            Route::get('/add', 'Institution\ContactController@add')->name('addInstitutionContact');
            Route::post('/add', 'Institution\ContactController@postAdd')->name('postAddInstitutionContact');
            Route::get('/edit/{institution_contact_id}', 'Institution\ContactController@edit')->name('editInstitutionContact');
            Route::post('/update', 'Institution\ContactController@update')->name('updateInstitutionContact');
            Route::get('/delete/{institution_contact_id}', 'Institution\ContactController@delete')->name('deleteInstitutionContact');
            Route::post('/confirmDelete', 'Institution\ContactController@confirmDelete')->name('confirmDeleteInstitutionContact');
        });
    });

    Route::group(['prefix' => 'family'], function () {
        Route::get('/', 'Family\FamilyController@index')->name('indexFamily');
        Route::get('/add', 'Family\FamilyController@form')->name('addForm');
        Route::post('/', 'Family\FamilyController@add')->name('addFamily');
        Route::get('/delete/{id_families}', 'Family\FamilyController@delete')->name('deleteFamily');
        Route::get('/view/{id_families}', 'Family\FamilyController@view')->name('viewFamily');
    });

    Route::group(['prefix' => 'users', 'middleware' => ['permission:open_page_users']], function () {
        Route::get('/', 'User\UserController@index')->name('indexUser');
        Route::get('/add', 'User\UserController@add')->name('addUser');
        Route::post('/add', 'User\UserController@postAdd')->name('postAddUser');
        Route::get('/edit/{id}', 'User\UserController@edit')->name('editUser');
        Route::post('/update', 'User\UserController@update')->name('updateUser');
        Route::get('/delete/{id}', 'User\UserController@delete')->name('deleteUser');
        Route::post('/confirmDelete', 'User\UserController@confirmDelete')->name('confirmDeleteUser');

        Route::group(['prefix' => 'role', 'middleware' => ['permission:open_page_users']], function () {
            Route::get('/', 'User\RoleController@index')->name('indexRoleUser');
            Route::get('/add', 'User\RoleController@add')->name('addRoleUser');
            Route::post('/add', 'User\RoleController@postAdd')->name('postAddRoleUser');
            Route::get('/edit/{id}', 'User\RoleController@edit')->name('editRoleUser');
            Route::post('/update', 'User\RoleController@update')->name('updateRoleUser');
            Route::get('/delete/{id}', 'User\RoleController@delete')->name('deleteRoleUser');
            Route::post('/confirmDelete', 'User\RoleController@confirmDelete')->name('confirmDeleteRoleUser');
        });

        Route::group(['prefix' => 'permission', 'middleware' => ['permission:open_page_users']], function () {
            Route::get('/', 'User\PermissionController@index')->name('indexPermissionUser');
            Route::get('/add', 'User\PermissionController@add')->name('addPermissionUser');
            Route::post('/add', 'User\PermissionController@postAdd')->name('postAddPermissionUser');
            Route::get('/edit/{id}', 'User\PermissionController@edit')->name('editPermissionUser');
            Route::post('/update', 'User\PermissionController@update')->name('updatePermissionUser');
            Route::get('/delete/{id}', 'User\PermissionController@delete')->name('deletePermissionUser');
            Route::post('/confirmDelete', 'User\PermissionController@confirmDelete')->name('confirmDeletePermissionUser');
        });
    });

    Route::group(['prefix' => 'passport'], function () {
        Route::get('/', function(){
            return view('pages.passport.index');
        });
    });
});

Auth::routes();

Route::get('logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('mailapp/test', function(){
    dd(App\Remote\Mailapp\SMCustomer::all());
});

// MailWizzApi_Autoloader::register();

// Route::get('/mailapp/sync/{count}', function($count = null){
//     $config = new MailWizzApi_Config(array(
//         'apiUrl' => 'https://mailapp.suneducationgroup.com/api',
//         'publicKey' => 'e2f6ef047c39331c831fb49a4cb66792f770a326',
//         'privateKey' => 'c52962731a7ced28dc2a638727dcd6c9f0a7bfeb',

//         // components
//         'components' => array(
//             'cache' => array(
//                 'class' => 'MailWizzApi_Cache_File',
//                 'filesPath' => dirname(__FILE__) . '/../MailWizzApi/Cache/data/cache', // make sure it is writable by webserver
//             )
//         ),
//     ));
//     // now inject the configuration and we are ready to make api calls
//     MailWizzApi_Base::setConfig($config);

//     // // CREATE THE ENDPOINT
//     // $endpoint = new MailWizzApi_Endpoint_ListSubscribers();

//     // /*===================================================================================*/
//     // // GET ALL ITEMS
//     // $response = $endpoint->getSubscribers('nq570v7p2za6d', $pageNumber = 1, $perPage = 10);
//     // dd($response);
//     // // DISPLAY RESPONSE
//     // echo '<pre>';
//     // print_r($response->body);
//     // echo '</pre>';


//     $endpoint = new MailWizzApi_Endpoint_ListSubscribers();
//     if(is_null($count)){
//         $leads = App\FStudentRemote::select('full_name','email')->get();
//     } else {
//         $leads = App\FStudentRemote::select('full_name','email')->take($count)->get();
//     }

//     foreach($leads as $lead){
//         $response = $endpoint->createUpdate('cr535kqnxv31a', array(
//             'EMAIL'    => $lead->email, // the confirmation email will be sent!!! Use valid email address
//             'FNAME'    => $lead->full_name,
//             'LNAME'    => ''
//         ));

//         // echo 'Email : ' . $lead->email;
//         // echo '<br>';
//         // echo 'Full Name : ' . $lead->full_name;
//         // echo '<br>';
//         // echo '<br>';
//     }

//     dd($leads->count());
//     // DISPLAY RESPONSE
//     // print_r($response->body);

// });

// Route::get('/mailapp/sync2', function($count = null){
//     $config = new MailWizzApi_Config(array(
//         'apiUrl' => 'http://mailapp.suneducationgroup.com/api',
//         'publicKey' => 'e2f6ef047c39331c831fb49a4cb66792f770a326',
//         'privateKey' => 'c52962731a7ced28dc2a638727dcd6c9f0a7bfeb',

//         // components
//         'components' => array(
//             'cache' => array(
//                 'class' => 'MailWizzApi_Cache_File',
//                 'filesPath' => dirname(__FILE__) . '/../MailWizzApi/Cache/data/cache', // make sure it is writable by webserver
//             )
//         ),
//     ));
//     // now inject the configuration and we are ready to make api calls
//     MailWizzApi_Base::setConfig($config);

//     // // CREATE THE ENDPOINT
//     // $endpoint = new MailWizzApi_Endpoint_ListSubscribers();

//     // /*===================================================================================*/
//     // // GET ALL ITEMS
//     // $response = $endpoint->getSubscribers('nq570v7p2za6d', $pageNumber = 1, $perPage = 10);
//     // dd($response);
//     // // DISPLAY RESPONSE
//     // echo '<pre>';
//     // print_r($response->body);
//     // echo '</pre>';


//     $endpoint = new MailWizzApi_Endpoint_ListSubscribers();
//     if(is_null($count)){
//         $leads = App\FStudentRemote::select('full_name','email')->get();
//     } else {
//         $leads = App\FStudentRemote::select('full_name','email')->take($count)->get();
//     }

//     foreach($leads as $lead){
//         $response = $endpoint->createUpdate('cr535kqnxv31a', array(
//             'EMAIL'    => $lead->email, // the confirmation email will be sent!!! Use valid email address
//             'FNAME'    => $lead->full_name,
//             'LNAME'    => ''
//         ));

//         echo 'Email : ' . $lead->email;
//         echo '<br>';
//         echo 'Full Name : ' . $lead->full_name;
//         echo '<br>';
//         echo '<br>';
//     }

//     // return response()->json($leads);

//     // dd($leads->count());
//     // DISPLAY RESPONSE
//     // print_r($response->body);

// });

use App\Remote\SCN\Country;
use GuzzleHttp\Psr7;
Route::get('bulkSunnies', function(){
  foreach(App\SchoolType::all() as $schoolType){
    $schools = App\School::where('name','LIKE','%' . $schoolType->name . '%')->get();
    foreach($schools as $school){
      $sch = App\School::find($school->school_id);
      $sch->school_type_id = $schoolType->school_type_id;
      $sch->save();
    }
  }
});

Route::get('/getData', function(){
    $datas = [
        [
          'kode_wilayah' => '010100',
          'nama' => 'Kab. Kepulauan Seribu',
          'mst_kode_wilayah' => '010000',
        ],
        [
          'kode_wilayah' => '016000',
          'nama' => 'Kota Jakarta Pusat',
          'mst_kode_wilayah' => '010000',
        ],
        [
          'kode_wilayah' => '016100',
          'nama' => 'Kota Jakarta Utara',
          'mst_kode_wilayah' => '010000',
        ],
        [
          'kode_wilayah' => '016200',
          'nama' => 'Kota Jakarta Barat',
          'mst_kode_wilayah' => '010000',
        ],
        [
          'kode_wilayah' => '016300',
          'nama' => 'Kota Jakarta Selatan',
          'mst_kode_wilayah' => '010000',
        ],
        [
          'kode_wilayah' => '016400',
          'nama' => 'Kota Jakarta Timur',
          'mst_kode_wilayah' => '010000',
        ],
        [
          'kode_wilayah' => '020500',
          'nama' => 'Kab. Bogor',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '020600',
          'nama' => 'Kab. Sukabumi',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '020700',
          'nama' => 'Kab. Cianjur',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '020800',
          'nama' => 'Kab. Bandung',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021000',
          'nama' => 'Kab. Sumedang',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021100',
          'nama' => 'Kab. Garut',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021200',
          'nama' => 'Kab. Tasikmalaya',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021400',
          'nama' => 'Kab. Ciamis',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021500',
          'nama' => 'Kab. Kuningan',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021600',
          'nama' => 'Kab. Majalengka',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021700',
          'nama' => 'Kab. Cirebon',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021800',
          'nama' => 'Kab. Indramayu',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '021900',
          'nama' => 'Kab. Subang',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '022000',
          'nama' => 'Kab. Purwakarta',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '022100',
          'nama' => 'Kab. Karawang',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '022200',
          'nama' => 'Kab. Bekasi',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '022300',
          'nama' => 'Kab. Bandung Barat',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '022500',
          'nama' => 'Kab. Pangandaran',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026000',
          'nama' => 'Kota Bandung',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026100',
          'nama' => 'Kota Bogor',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026200',
          'nama' => 'Kota Sukabumi',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026300',
          'nama' => 'Kota Cirebon',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026500',
          'nama' => 'Kota Bekasi',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026600',
          'nama' => 'Kota Depok',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026700',
          'nama' => 'Kota Cimahi',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026800',
          'nama' => 'Kota Tasikmalaya',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '026900',
          'nama' => 'Kota Banjar',
          'mst_kode_wilayah' => '020000',
        ],
        [
          'kode_wilayah' => '030100',
          'nama' => 'Kab. Cilacap',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030200',
          'nama' => 'Kab. Banyumas',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030300',
          'nama' => 'Kab. Purbalingga',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030400',
          'nama' => 'Kab. Banjarnegara',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030500',
          'nama' => 'Kab. Kebumen',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030600',
          'nama' => 'Kab. Purworejo',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030700',
          'nama' => 'Kab. Wonosobo',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030800',
          'nama' => 'Kab. Magelang',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '030900',
          'nama' => 'Kab. Boyolali',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031000',
          'nama' => 'Kab. Klaten',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031100',
          'nama' => 'Kab. Sukoharjo',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031200',
          'nama' => 'Kab. Wonogiri',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031300',
          'nama' => 'Kab. Karanganyar',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031400',
          'nama' => 'Kab. Sragen',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031500',
          'nama' => 'Kab. Grobogan',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031600',
          'nama' => 'Kab. Blora',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031700',
          'nama' => 'Kab. Rembang',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031800',
          'nama' => 'Kab. Pati',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '031900',
          'nama' => 'Kab. Kudus',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032000',
          'nama' => 'Kab. Jepara',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032100',
          'nama' => 'Kab. Demak',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032200',
          'nama' => 'Kab. Semarang',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032300',
          'nama' => 'Kab. Temanggung',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032400',
          'nama' => 'Kab. Kendal',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032500',
          'nama' => 'Kab. Batang',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032600',
          'nama' => 'Kab. Pekalongan',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032700',
          'nama' => 'Kab. Pemalang',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032800',
          'nama' => 'Kab. Tegal',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '032900',
          'nama' => 'Kab. Brebes',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '036000',
          'nama' => 'Kota Magelang',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '036100',
          'nama' => 'Kota Surakarta',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '036200',
          'nama' => 'Kota Salatiga',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '036300',
          'nama' => 'Kota Semarang',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '036400',
          'nama' => 'Kota Pekalongan',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '036500',
          'nama' => 'Kota Tegal',
          'mst_kode_wilayah' => '030000',
        ],
        [
          'kode_wilayah' => '040100',
          'nama' => 'Kab. Bantul',
          'mst_kode_wilayah' => '040000',
        ],
        [
          'kode_wilayah' => '040200',
          'nama' => 'Kab. Sleman',
          'mst_kode_wilayah' => '040000',
        ],
        [
          'kode_wilayah' => '040300',
          'nama' => 'Kab. Gunung Kidul',
          'mst_kode_wilayah' => '040000',
        ],
        [
          'kode_wilayah' => '040400',
          'nama' => 'Kab. Kulon Progo',
          'mst_kode_wilayah' => '040000',
        ],
        [
          'kode_wilayah' => '046000',
          'nama' => 'Kota Yogyakarta',
          'mst_kode_wilayah' => '040000',
        ],
        [
          'kode_wilayah' => '050100',
          'nama' => 'Kab. Gresik',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050200',
          'nama' => 'Kab. Sidoarjo',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050300',
          'nama' => 'Kab. Mojokerto',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050400',
          'nama' => 'Kab. Jombang',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050500',
          'nama' => 'Kab. Bojonegoro',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050600',
          'nama' => 'Kab. Tuban',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050700',
          'nama' => 'Kab. Lamongan',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050800',
          'nama' => 'Kab. Madiun',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '050900',
          'nama' => 'Kab. Ngawi',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051000',
          'nama' => 'Kab. Magetan',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051100',
          'nama' => 'Kab. Ponorogo',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051200',
          'nama' => 'Kab. Pacitan',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051300',
          'nama' => 'Kab. Kediri',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051400',
          'nama' => 'Kab. Nganjuk',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051500',
          'nama' => 'Kab. Blitar',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051600',
          'nama' => 'Kab. Tulungagung',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051700',
          'nama' => 'Kab. Trenggalek',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051800',
          'nama' => 'Kab. Malang',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '051900',
          'nama' => 'Kab. Pasuruan',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052000',
          'nama' => 'Kab. Probolinggo',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052100',
          'nama' => 'Kab. Lumajang',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052200',
          'nama' => 'Kab. Bondowoso',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052300',
          'nama' => 'Kab. Situbondo',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052400',
          'nama' => 'Kab. Jember',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052500',
          'nama' => 'Kab. Banyuwangi',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052600',
          'nama' => 'Kab. Pamekasan',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052700',
          'nama' => 'Kab. Sampang',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052800',
          'nama' => 'Kab. Sumenep',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '052900',
          'nama' => 'Kab. Bangkalan',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056000',
          'nama' => 'Kota Surabaya',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056100',
          'nama' => 'Kota Malang',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056200',
          'nama' => 'Kota Madiun',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056300',
          'nama' => 'Kota Kediri',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056400',
          'nama' => 'Kota Mojokerto',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056500',
          'nama' => 'Kota Blitar',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056600',
          'nama' => 'Kota Pasuruan',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056700',
          'nama' => 'Kota Probolinggo',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '056800',
          'nama' => 'Kota Batu',
          'mst_kode_wilayah' => '050000',
        ],
        [
          'kode_wilayah' => '060100',
          'nama' => 'Kab. Aceh Besar',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '060200',
          'nama' => 'Kab. Pidie',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '060300',
          'nama' => 'Kab. Aceh Utara',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '060400',
          'nama' => 'Kab. Aceh Timur',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '060500',
          'nama' => 'Kab. Aceh Tengah',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '060600',
          'nama' => 'Kab. Aceh Barat',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '060700',
          'nama' => 'Kab. Aceh Selatan',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '060800',
          'nama' => 'Kab. Aceh Tenggara',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061100',
          'nama' => 'Kab. Simeulue',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061200',
          'nama' => 'Kab. Bireuen',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061300',
          'nama' => 'Kab. Aceh Singkil',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061400',
          'nama' => 'Kab. Aceh Tamiang',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061500',
          'nama' => 'Kab. Nagan Raya',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061600',
          'nama' => 'Kab. Aceh Jaya',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061700',
          'nama' => 'Kab. Aceh Barat Daya',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061800',
          'nama' => 'Kab. Gayo Lues',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '061900',
          'nama' => 'Kab. Bener Meriah',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '062000',
          'nama' => 'Kab. Pidie Jaya',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '066000',
          'nama' => 'Kota Sabang',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '066100',
          'nama' => 'Kota Banda Aceh',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '066200',
          'nama' => 'Kota Lhokseumawe',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '066300',
          'nama' => 'Kota Langsa',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '066400',
          'nama' => 'Kota Subulussalam',
          'mst_kode_wilayah' => '060000',
        ],
        [
          'kode_wilayah' => '070100',
          'nama' => 'Kab. Deli Serdang',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070200',
          'nama' => 'Kab. Langkat',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070300',
          'nama' => 'Kab. Karo',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070400',
          'nama' => 'Kab. Simalungun',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070500',
          'nama' => 'Kab. Dairi',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070600',
          'nama' => 'Kab. Asahan',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070700',
          'nama' => 'Kab. Labuhan Batu',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070800',
          'nama' => 'Kab. Tapanuli Utara',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '070900',
          'nama' => 'Kab. Tapanuli Tengah',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '071000',
          'nama' => 'Kab. Tapanuli Selatan',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '071100',
          'nama' => 'Kab. Nias',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '071500',
          'nama' => 'Kab. Mandailing Natal',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '071600',
          'nama' => 'Kab. Toba Samosir',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '071700',
          'nama' => 'Kab. Nias Selatan',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '071800',
          'nama' => 'Kab. Pakpak Bharat',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '071900',
          'nama' => 'Kab. Humbang Hasudutan',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072000',
          'nama' => 'Kab. Samosir',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072100',
          'nama' => 'Kab. Serdang Bedagai',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072200',
          'nama' => 'Kab. Batubara',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072300',
          'nama' => 'Kab. Padang Lawas utara',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072400',
          'nama' => 'Kab. Padang Lawas',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072500',
          'nama' => 'Kab. Labuhan Batu Utara',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072600',
          'nama' => 'Kab. Labuhan Batu Selatan',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072700',
          'nama' => 'Kab. Nias Barat',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '072800',
          'nama' => 'Kab. Nias Utara',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076000',
          'nama' => 'Kota Medan',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076100',
          'nama' => 'Kota Binjai',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076200',
          'nama' => 'Kota Tebing Tinggi',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076300',
          'nama' => 'Kota Pematangsiantar',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076400',
          'nama' => 'Kota Tanjung Balai',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076500',
          'nama' => 'Kota Sibolga',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076600',
          'nama' => 'Kota Padang Sidimpuan',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '076700',
          'nama' => 'Kota Gunungsitoli',
          'mst_kode_wilayah' => '070000',
        ],
        [
          'kode_wilayah' => '080100',
          'nama' => 'Kab. Agam',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '080200',
          'nama' => 'Kab. Pasaman',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '080300',
          'nama' => 'Kab. Lima Puluh Koto',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '080400',
          'nama' => 'Kab. Solok',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '080500',
          'nama' => 'Kab. Padang Pariaman',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '080600',
          'nama' => 'Kab. Pesisir Selatan',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '080700',
          'nama' => 'Kab. Tanah Datar',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '080800',
          'nama' => 'Kab. Sijunjung',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '081000',
          'nama' => 'Kab. Kepulauan Mentawai',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '081100',
          'nama' => 'Kab. Solok Selatan',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '081200',
          'nama' => 'Kab. Dharmasraya',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '081300',
          'nama' => 'Kab. Pasaman Barat',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '086000',
          'nama' => 'Kota Bukittinggi',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '086100',
          'nama' => 'Kota Padang',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '086200',
          'nama' => 'Kota Padang Panjang',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '086300',
          'nama' => 'Kota Sawah Lunto',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '086400',
          'nama' => 'Kota Solok',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '086500',
          'nama' => 'Kota Payakumbuh',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '086600',
          'nama' => 'Kota Pariaman',
          'mst_kode_wilayah' => '080000',
        ],
        [
          'kode_wilayah' => '090100',
          'nama' => 'Kab. Kampar',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '090200',
          'nama' => 'Kab. Bengkalis',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '090400',
          'nama' => 'Kab. Indragiri Hulu',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '090500',
          'nama' => 'Kab. Indragiri Hilir',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '090800',
          'nama' => 'Kab. Pelalawan',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '090900',
          'nama' => 'Kab. Rokan Hulu',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '091000',
          'nama' => 'Kab. Rokan Hilir',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '091100',
          'nama' => 'Kab. Siak',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '091400',
          'nama' => 'Kab. Kuantan Singingi',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '091500',
          'nama' => 'Kab. Kepulauan Meranti',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '096000',
          'nama' => 'Kota Pekanbaru',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '096200',
          'nama' => 'Kota Dumai',
          'mst_kode_wilayah' => '090000',
        ],
        [
          'kode_wilayah' => '100100',
          'nama' => 'Kab. Batang Hari',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100200',
          'nama' => 'Kab. Bungo',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100300',
          'nama' => 'Kab. Sarolangun',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100400',
          'nama' => 'Kab. Tanjung Jabung Barat',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100500',
          'nama' => 'Kab. Kerinci',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100600',
          'nama' => 'Kab. Tebo',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100700',
          'nama' => 'Kab. Muaro Jambi',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100800',
          'nama' => 'Kab. Tanjung Jabung Timur',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '100900',
          'nama' => 'Kab. Merangin',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '106000',
          'nama' => 'Kota Jambi',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '106100',
          'nama' => 'Kota Sungai Penuh',
          'mst_kode_wilayah' => '100000',
        ],
        [
          'kode_wilayah' => '110100',
          'nama' => 'Kab. Musi Banyuasin',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110200',
          'nama' => 'Kab. Ogan Komering Ilir',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110300',
          'nama' => 'Kab. Ogan Komering Ulu',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110400',
          'nama' => 'Kab. Muara Enim',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110500',
          'nama' => 'Kab. Lahat',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110600',
          'nama' => 'Kab. Musi Rawas',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110700',
          'nama' => 'Kab. Banyuasin',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110800',
          'nama' => 'Kab. Ogan Komering Ulu Timur',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '110900',
          'nama' => 'Kab. Ogan Komering Ulu Selatan',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '111000',
          'nama' => 'Kab. Ogan Ilir',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '111100',
          'nama' => 'Kab. Empat Lawang',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '111200',
          'nama' => 'Kab. Penukal Abab Lematang Ilir',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '111300',
          'nama' => 'Kab. Musi Rawas Utara',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '116000',
          'nama' => 'Kota Palembang',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '116100',
          'nama' => 'Kota Prabumulih',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '116200',
          'nama' => 'Kota Lubuk Linggau',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '116300',
          'nama' => 'Kota Pagar Alam',
          'mst_kode_wilayah' => '110000',
        ],
        [
          'kode_wilayah' => '120100',
          'nama' => 'Kab. Lampung Selatan',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120200',
          'nama' => 'Kab. Lampung Tengah',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120300',
          'nama' => 'Kab. Lampung Utara',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120400',
          'nama' => 'Kab. Lampung Barat',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120500',
          'nama' => 'Kab. Tulang Bawang',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120600',
          'nama' => 'Kab. Tanggamus',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120700',
          'nama' => 'Kab. Lampung Timur',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120800',
          'nama' => 'Kab. Way Kanan',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '120900',
          'nama' => 'Kab. Pesawaran',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '121000',
          'nama' => 'Kab. Pringsewu',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '121100',
          'nama' => 'Kab. Mesuji',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '121200',
          'nama' => 'Kab. Tulang Bawang Barat',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '121300',
          'nama' => 'Kab. Pesisir Barat',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '126000',
          'nama' => 'Kota Bandar Lampung',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '126100',
          'nama' => 'Kota Metro',
          'mst_kode_wilayah' => '120000',
        ],
        [
          'kode_wilayah' => '130100',
          'nama' => 'Kab. Sambas',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '130200',
          'nama' => 'Kab. Mempawah',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '130300',
          'nama' => 'Kab. Sanggau',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '130400',
          'nama' => 'Kab. Sintang',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '130500',
          'nama' => 'Kab. Kapuas Hulu',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '130600',
          'nama' => 'Kab. Ketapang',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '130800',
          'nama' => 'Kab. Bengkayang',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '130900',
          'nama' => 'Kab. Landak',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '131000',
          'nama' => 'Kab. Sekadau',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '131100',
          'nama' => 'Kab. Melawi',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '131200',
          'nama' => 'Kab. Kayong Utara',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '131300',
          'nama' => 'Kab. Kuburaya',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '136000',
          'nama' => 'Kota Pontianak',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '136100',
          'nama' => 'Kota Singkawang',
          'mst_kode_wilayah' => '130000',
        ],
        [
          'kode_wilayah' => '140100',
          'nama' => 'Kab. Kapuas',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140200',
          'nama' => 'Kab. Barito Selatan',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140300',
          'nama' => 'Kab. Barito Utara',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140400',
          'nama' => 'Kab. Kotawaringin Timur',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140500',
          'nama' => 'Kab. Kotawaringin Barat',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140600',
          'nama' => 'Kab. Katingan',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140700',
          'nama' => 'Kab. Seruyan',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140800',
          'nama' => 'Kab. Sukamara',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '140900',
          'nama' => 'Kab. Lamandau',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '141000',
          'nama' => 'Kab. Gunung Mas',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '141100',
          'nama' => 'Kab. Pulang Pisau',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '141200',
          'nama' => 'Kab. Murung Raya',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '141300',
          'nama' => 'Kab. Barito Timur',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '146000',
          'nama' => 'Kota Palangka Raya',
          'mst_kode_wilayah' => '140000',
        ],
        [
          'kode_wilayah' => '150100',
          'nama' => 'Kab. Banjar',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150200',
          'nama' => 'Kab. Tanah Laut',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150300',
          'nama' => 'Kab. Barito Kuala',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150400',
          'nama' => 'Kab. Tapin',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150500',
          'nama' => 'Kab. Hulu Sungai Selatan',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150600',
          'nama' => 'Kab. Hulu Sungai Tengah',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150700',
          'nama' => 'Kab. Hulu Sungai Utara',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150800',
          'nama' => 'Kab. Tabalong',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '150900',
          'nama' => 'Kab. Kotabaru',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '151000',
          'nama' => 'Kab. Balangan',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '151100',
          'nama' => 'Kab. Tanah Bumbu',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '156000',
          'nama' => 'Kota Banjarmasin',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '156100',
          'nama' => 'Kota Banjarbaru',
          'mst_kode_wilayah' => '150000',
        ],
        [
          'kode_wilayah' => '160100',
          'nama' => 'Kab. Paser',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '160200',
          'nama' => 'Kab. Kutai Kartanegara',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '160300',
          'nama' => 'Kab. Berau',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '160900',
          'nama' => 'Kab. Kutai Barat',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '161000',
          'nama' => 'Kab. Kutai Timur',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '161100',
          'nama' => 'Kab. Penajam Paser Utara',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '161200',
          'nama' => 'Kab. Mahakam Ulu',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '166000',
          'nama' => 'Kota Samarinda',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '166100',
          'nama' => 'Kota Balikpapan',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '166300',
          'nama' => 'Kota Bontang',
          'mst_kode_wilayah' => '160000',
        ],
        [
          'kode_wilayah' => '170100',
          'nama' => 'Kab. Bolaang Mongondow',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '170200',
          'nama' => 'Kab. Minahasa',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '170300',
          'nama' => 'Kab. Kep. Sangihe',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '170400',
          'nama' => 'Kab. Kepulauan Talaud',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '170500',
          'nama' => 'Kab. Minahasa Selatan',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '170600',
          'nama' => 'Kab. Minahasa Utara',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '170800',
          'nama' => 'Kab. Bolaang Mongondow Utara',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '170900',
          'nama' => 'Kab. Kepulauan Siau Tagulandang Biaro',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '171000',
          'nama' => 'Kab. Minahasa Tenggara',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '171100',
          'nama' => 'Kab. Bolaang Mongondow Timur',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '171200',
          'nama' => 'Kab. Bolaang Mongondow Selatan',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '176000',
          'nama' => 'Kota Manado',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '176100',
          'nama' => 'Kota Bitung',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '176200',
          'nama' => 'Kota Tomohon',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '176300',
          'nama' => 'Kota Kotamobagu',
          'mst_kode_wilayah' => '170000',
        ],
        [
          'kode_wilayah' => '180100',
          'nama' => 'Kab. Banggai Kepulauan',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180200',
          'nama' => 'Kab. Donggala',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180300',
          'nama' => 'Kab. Poso',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180400',
          'nama' => 'Kab. Banggai',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180500',
          'nama' => 'Kab. Buol',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180600',
          'nama' => 'Kab. Tolitoli',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180700',
          'nama' => 'Kab. Morowali',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180800',
          'nama' => 'Kab. Parigi Moutong',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '180900',
          'nama' => 'Kab. Tojo Una-Una',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '181000',
          'nama' => 'Kab. Sigi',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '181100',
          'nama' => 'Kab. Banggai Laut',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '181200',
          'nama' => 'Kab. Morowali Utara',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '186000',
          'nama' => 'Kota Palu',
          'mst_kode_wilayah' => '180000',
        ],
        [
          'kode_wilayah' => '190100',
          'nama' => 'Kab. Maros',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190200',
          'nama' => 'Kab. Pangkajene Kepulauan',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190300',
          'nama' => 'Kab. Gowa',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190400',
          'nama' => 'Kab. Takalar',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190500',
          'nama' => 'Kab. Jeneponto',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190600',
          'nama' => 'Kab. Barru',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190700',
          'nama' => 'Kab. Bone',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190800',
          'nama' => 'Kab. Wajo',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '190900',
          'nama' => 'Kab. Soppeng',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191000',
          'nama' => 'Kab. Bantaeng',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191100',
          'nama' => 'Kab. Bulukumba',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191200',
          'nama' => 'Kab. Sinjai',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191300',
          'nama' => 'Kab. Kepulauan Selayar',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191400',
          'nama' => 'Kab. Pinrang',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191500',
          'nama' => 'Kab. Sidenreng Rappang',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191600',
          'nama' => 'Kab. Enrekang',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191700',
          'nama' => 'Kab. Luwu',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '191800',
          'nama' => 'Kab. Tana Toraja',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '192400',
          'nama' => 'Kab. Luwu Utara',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '192600',
          'nama' => 'Kab. Luwu Timur',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '192700',
          'nama' => 'Kab. Toraja Utara',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '196000',
          'nama' => 'Kota Makassar',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '196100',
          'nama' => 'Kota Parepare',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '196200',
          'nama' => 'Kota Palopo',
          'mst_kode_wilayah' => '190000',
        ],
        [
          'kode_wilayah' => '200100',
          'nama' => 'Kab. Konawe',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200200',
          'nama' => 'Kab. Muna',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200300',
          'nama' => 'Kab. Buton',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200400',
          'nama' => 'Kab. Kolaka',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200500',
          'nama' => 'Kab. Konawe Selatan',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200600',
          'nama' => 'Kab. Wakatobi',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200700',
          'nama' => 'Kab. Bombana',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200800',
          'nama' => 'Kab. Kolaka Utara',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '200900',
          'nama' => 'Kab. Konawe Utara',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '201000',
          'nama' => 'Kab. Buton Utara',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '201100',
          'nama' => 'Kab. Kolaka Timur',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '201200',
          'nama' => 'Kab. Konawe Kepulauan',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '201300',
          'nama' => 'Kab. Muna Barat',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '201400',
          'nama' => 'Kab. Buton Selatan',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '201600',
          'nama' => 'Kab. Buton Tengah',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '206000',
          'nama' => 'Kota Kendari',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '206100',
          'nama' => 'Kota Baubau',
          'mst_kode_wilayah' => '200000',
        ],
        [
          'kode_wilayah' => '210100',
          'nama' => 'Kab. Maluku Tengah',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210200',
          'nama' => 'Kab. Maluku Tenggara',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210300',
          'nama' => 'Kab. Buru',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210400',
          'nama' => 'Kab. Maluku Tenggara Barat',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210500',
          'nama' => 'Kab. Seram Bagian Barat',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210600',
          'nama' => 'Kab. Seram Bagian Timur',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210700',
          'nama' => 'Kab. Kepulauan Aru',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210800',
          'nama' => 'Kab. Maluku Barat Daya',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '210900',
          'nama' => 'Kab. Buru Selatan',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '216000',
          'nama' => 'Kota Ambon',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '216100',
          'nama' => 'Kota Tual',
          'mst_kode_wilayah' => '210000',
        ],
        [
          'kode_wilayah' => '220100',
          'nama' => 'Kab. Buleleng',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '220200',
          'nama' => 'Kab. Jembrana',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '220300',
          'nama' => 'Kab. Tabanan',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '220400',
          'nama' => 'Kab. Badung',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '220500',
          'nama' => 'Kab. Gianyar',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '220600',
          'nama' => 'Kab. Klungkung',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '220700',
          'nama' => 'Kab. Bangli',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '220800',
          'nama' => 'Kab. Karang Asem',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '226000',
          'nama' => 'Kota Denpasar',
          'mst_kode_wilayah' => '220000',
        ],
        [
          'kode_wilayah' => '230100',
          'nama' => 'Kab. Lombok Barat',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '230200',
          'nama' => 'Kab. Lombok Tengah',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '230300',
          'nama' => 'Kab. Lombok Timur',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '230400',
          'nama' => 'Kab. Sumbawa',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '230500',
          'nama' => 'Kab. Dompu',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '230600',
          'nama' => 'Kab. Bima',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '230700',
          'nama' => 'Kab. Sumbawa Barat',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '230800',
          'nama' => 'Kab. Lombok Utara',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '236000',
          'nama' => 'Kota Mataram',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '236100',
          'nama' => 'Kota Bima',
          'mst_kode_wilayah' => '230000',
        ],
        [
          'kode_wilayah' => '240100',
          'nama' => 'Kab. Kupang',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '240300',
          'nama' => 'Kab. Timor Tengah Selatan',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '240400',
          'nama' => 'Kab. Timor Tengah Utara',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '240500',
          'nama' => 'Kab. Belu',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '240600',
          'nama' => 'Kab. Alor',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '240700',
          'nama' => 'Kab. Flores Timur',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '240800',
          'nama' => 'Kab. Sikka',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '240900',
          'nama' => 'Kab. Ende',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241000',
          'nama' => 'Kab. Ngada',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241100',
          'nama' => 'Kab. Manggarai',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241200',
          'nama' => 'Kab. Sumba Timur',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241300',
          'nama' => 'Kab. Sumba Barat',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241400',
          'nama' => 'Kab. Lembata',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241500',
          'nama' => 'Kab. Rote-Ndao',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241600',
          'nama' => 'Kab. Manggarai Barat',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241700',
          'nama' => 'Kab. Nagakeo',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241800',
          'nama' => 'Kab. Sumba Tengah',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '241900',
          'nama' => 'Kab. Sumba Barat Daya',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '242000',
          'nama' => 'Kab. Manggarai Timur',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '242100',
          'nama' => 'Kab. Sabu Raijua',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '242200',
          'nama' => 'Kab. Malaka',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '246000',
          'nama' => 'Kota Kupang',
          'mst_kode_wilayah' => '240000',
        ],
        [
          'kode_wilayah' => '250100',
          'nama' => 'Kab. Jayapura',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '250200',
          'nama' => 'Kab. Biak Numfor',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '250300',
          'nama' => 'Kab. Kepulauan Yapen',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '250700',
          'nama' => 'Kab. Merauke',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '250800',
          'nama' => 'Kab. Jaya Wijaya',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '250900',
          'nama' => 'Kab. Nabire',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251000',
          'nama' => 'Kab. Paniai',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251100',
          'nama' => 'Kab. Puncak Jaya',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251200',
          'nama' => 'Kab. Mimika',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251300',
          'nama' => 'Kab. Boven Digoel',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251400',
          'nama' => 'Kab. Mappi',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251500',
          'nama' => 'Kab. Asmat',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251600',
          'nama' => 'Kab. Yahukimo',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251700',
          'nama' => 'Kab. Pegunungan Bintang',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251800',
          'nama' => 'Kab. Tolikara',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '251900',
          'nama' => 'Kab. Sarmi',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '252000',
          'nama' => 'Kab. Keerom',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '252600',
          'nama' => 'Kab. Waropen',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '252700',
          'nama' => 'Kab. Supiori',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '252800',
          'nama' => 'Kab. Memberamo Raya',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '252900',
          'nama' => 'Kab. Nduga',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '253000',
          'nama' => 'Kab. Lanny Jaya',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '253100',
          'nama' => 'Kab. Membramo Tengah',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '253200',
          'nama' => 'Kab. Yalimo',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '253300',
          'nama' => 'kab. Puncak',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '253400',
          'nama' => 'Kab. Dogiyai',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '253500',
          'nama' => 'Kab. Deiyai',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '253600',
          'nama' => 'Kab. Intan Jaya',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '256000',
          'nama' => 'Kota Jayapura',
          'mst_kode_wilayah' => '250000',
        ],
        [
          'kode_wilayah' => '260100',
          'nama' => 'Kab. Bengkulu Utara',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260200',
          'nama' => 'Kab. Rejang Lebong',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260300',
          'nama' => 'Kab. Bengkulu Selatan',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260400',
          'nama' => 'Kab. Muko-muko',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260500',
          'nama' => 'Kab. Kepahiang',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260600',
          'nama' => 'Kab. Lebong',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260700',
          'nama' => 'Kab. Kaur',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260800',
          'nama' => 'Kab. Seluma',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '260900',
          'nama' => 'Kab. Bengkulu Tengah',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '266000',
          'nama' => 'Kota Bengkulu',
          'mst_kode_wilayah' => '260000',
        ],
        [
          'kode_wilayah' => '270100',
          'nama' => 'Kab. Pulau Taliabu',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '270200',
          'nama' => 'Kab. Halmahera Tengah',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '270300',
          'nama' => 'Kab. Halmahera Barat',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '270400',
          'nama' => 'Kab. halmahera Utara',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '270500',
          'nama' => 'Kab. Halmahera Selatan',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '270600',
          'nama' => 'Kab. Halmahera Timur',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '270700',
          'nama' => 'Kab. Kepulauan Sula',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '270800',
          'nama' => 'Kab. Kepulauan Morotai',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '276000',
          'nama' => 'Kota Ternate',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '276100',
          'nama' => 'Kota Tidore Kepulauan',
          'mst_kode_wilayah' => '270000',
        ],
        [
          'kode_wilayah' => '280100',
          'nama' => 'Kab. Pandeglang',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '280200',
          'nama' => 'Kab. Lebak',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '280300',
          'nama' => 'Kab. Tangerang',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '280400',
          'nama' => 'Kab. Serang',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '286000',
          'nama' => 'Kota Cilegon',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '286100',
          'nama' => 'Kota Tangerang',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '286200',
          'nama' => 'Kota Serang',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '286300',
          'nama' => 'Kota Tangerang Selatan',
          'mst_kode_wilayah' => '280000',
        ],
        [
          'kode_wilayah' => '290100',
          'nama' => 'Kab. Bangka',
          'mst_kode_wilayah' => '290000',
        ],
        [
          'kode_wilayah' => '290200',
          'nama' => 'Kab. Belitung',
          'mst_kode_wilayah' => '290000',
        ],
        [
          'kode_wilayah' => '290300',
          'nama' => 'Kab. Bangka Tengah',
          'mst_kode_wilayah' => '290000',
        ],
        [
          'kode_wilayah' => '290400',
          'nama' => 'Kab. Bangka Barat',
          'mst_kode_wilayah' => '290000',
        ],
        [
          'kode_wilayah' => '290500',
          'nama' => 'Kab. Bangka Selatan',
          'mst_kode_wilayah' => '290000',
        ],
        [
          'kode_wilayah' => '290600',
          'nama' => 'Kab. Belitung Timur',
          'mst_kode_wilayah' => '290000',
        ],
        [
          'kode_wilayah' => '296000',
          'nama' => 'Kota Pangkalpinang',
          'mst_kode_wilayah' => '290000',
        ],
        [
          'kode_wilayah' => '300100',
          'nama' => 'Kab. Boalemo',
          'mst_kode_wilayah' => '300000',
        ],
        [
          'kode_wilayah' => '300200',
          'nama' => 'Kab. Gorontalo',
          'mst_kode_wilayah' => '300000',
        ],
        [
          'kode_wilayah' => '300300',
          'nama' => 'Kab. Pohuwato',
          'mst_kode_wilayah' => '300000',
        ],
        [
          'kode_wilayah' => '300400',
          'nama' => 'Kab. Bone Bolango',
          'mst_kode_wilayah' => '300000',
        ],
        [
          'kode_wilayah' => '300500',
          'nama' => 'Kab. Gorontalo Utara',
          'mst_kode_wilayah' => '300000',
        ],
        [
          'kode_wilayah' => '306000',
          'nama' => 'Kota Gorontalo',
          'mst_kode_wilayah' => '300000',
        ],
        [
          'kode_wilayah' => '310100',
          'nama' => 'Kab. Bintan',
          'mst_kode_wilayah' => '310000',
        ],
        [
          'kode_wilayah' => '310200',
          'nama' => 'Kab. Karimun',
          'mst_kode_wilayah' => '310000',
        ],
        [
          'kode_wilayah' => '310300',
          'nama' => 'Kab. Natuna',
          'mst_kode_wilayah' => '310000',
        ],
        [
          'kode_wilayah' => '310400',
          'nama' => 'Kab. Lingga',
          'mst_kode_wilayah' => '310000',
        ],
        [
          'kode_wilayah' => '310500',
          'nama' => 'Kab. Kepulauan Anambas',
          'mst_kode_wilayah' => '310000',
        ],
        [
          'kode_wilayah' => '316000',
          'nama' => 'Kota Batam',
          'mst_kode_wilayah' => '310000',
        ],
        [
          'kode_wilayah' => '316100',
          'nama' => 'Kota Tanjungpinang',
          'mst_kode_wilayah' => '310000',
        ],
        [
          'kode_wilayah' => '320100',
          'nama' => 'Kab. Fak-Fak',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320200',
          'nama' => 'Kab. Kaimana',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320300',
          'nama' => 'Kab. Teluk Wondama',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320400',
          'nama' => 'Kab. Teluk Bintuni',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320500',
          'nama' => 'Kab. Manokwari',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320600',
          'nama' => 'Kab. Sorong Selatan',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320700',
          'nama' => 'Kab. Sorong',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320800',
          'nama' => 'Kab. Raja Ampat',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '320900',
          'nama' => 'Kab. Tambrauw',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '321000',
          'nama' => 'Kab. Maybrat',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '321100',
          'nama' => 'Kab. Pegunungan Arfak',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '321200',
          'nama' => 'Kab. Manokwari Selatan',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '326000',
          'nama' => 'Kota Sorong',
          'mst_kode_wilayah' => '320000',
        ],
        [
          'kode_wilayah' => '330100',
          'nama' => 'Kab. Mamuju',
          'mst_kode_wilayah' => '330000',
        ],
        [
          'kode_wilayah' => '330200',
          'nama' => 'Kab. Pasangkayu',
          'mst_kode_wilayah' => '330000',
        ],
        [
          'kode_wilayah' => '330300',
          'nama' => 'Kab. Polewali Mandar',
          'mst_kode_wilayah' => '330000',
        ],
        [
          'kode_wilayah' => '330400',
          'nama' => 'Kab. Mamasa',
          'mst_kode_wilayah' => '330000',
        ],
        [
          'kode_wilayah' => '330500',
          'nama' => 'Kab. Majene',
          'mst_kode_wilayah' => '330000',
        ],
        [
          'kode_wilayah' => '330600',
          'nama' => 'Kab. Mamuju Tengah',
          'mst_kode_wilayah' => '330000',
        ],
        [
          'kode_wilayah' => '340100',
          'nama' => 'Kab. Malinau',
          'mst_kode_wilayah' => '340000',
        ],
        [
          'kode_wilayah' => '340200',
          'nama' => 'Kab. Bulungan',
          'mst_kode_wilayah' => '340000',
        ],
        [
          'kode_wilayah' => '340300',
          'nama' => 'Kab. Tana Tidung',
          'mst_kode_wilayah' => '340000',
        ],
        [
          'kode_wilayah' => '340500',
          'nama' => 'Kab. Nunukan',
          'mst_kode_wilayah' => '340000',
        ],
        [
          'kode_wilayah' => '346000',
          'nama' => 'Kota Tarakan',
          'mst_kode_wilayah' => '340000',
        ],
    ];

    foreach($datas as $data){
        $client = new \GuzzleHttp\Client();
        $guzzleResponse = $client->request('GET', 'http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=' . $data['mst_kode_wilayah']);
        // $stream = Psr7\stream_for($guzzleResponse->getBody()->getContents());
        // echo $stream;
        // string data
        // echo $stream->read(3);
        // str
        // $ss = json_decode(json_encode((String) $stream->getContents()));
        $string = substr_replace(substr($guzzleResponse->getBody()->getContents(), 11),"",-1);

        $someArray = json_decode($string, true);
        foreach($someArray as $dat){
            $sekol = new App\Sekolah2;
            $sekol->kode_prop = $dat['kode_prop'];
            $sekol->propinsi = $dat['propinsi'];
            $sekol->kode_kab_kota = $dat['kode_kab_kota'];
            $sekol->kabupaten_kota = $dat['kabupaten_kota'];
            $sekol->kode_kec = $dat['kode_kec'];
            $sekol->kecamatan = $dat['kecamatan'];
            $sekol->id = $dat['id'];
            $sekol->npsn = $dat['npsn'];
            $sekol->sekolah = $dat['sekolah'];
            $sekol->bentuk = $dat['bentuk'];
            $sekol->status = $dat['status'];
            $sekol->alamat_jalan = $dat['alamat_jalan'];
            $sekol->lintang = $dat['lintang'];
            $sekol->bujur = $dat['bujur'];
            $sekol->save();
        }


        // foreach($dd as $d){
        //     dd($d);
        // }
        // ing data
        // var_export($stream->eof());
        // true
        // var_export($stream->tell());
        // 11
    }
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


// For MailApp
// Route::group(['prefix' => 'mailapp'], function () {

// });

Route::group(['prefix' => 'email-marketing','middleware' => ['ipAddress']], function () {
    // Route::get('form/{list_uid}', 'SunEmailMarketing\EmailMarketingController@index');
    Route::get('form/{list_uid}/{customer_uid}', 'SunEmailMarketing\EmailMarketingController@index');
});
