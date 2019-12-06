<?php

use Illuminate\Http\Request;
use App\Http\Resources\Leads\SuntrackCollection;

// Temporarly
// header("Access-Control-Allow-Origin: *");
// header('Access-Control-Allow-Methods: POST,GET,PUT,PATCH,OPTIONS');
// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors']], function () {
    Route::group(['prefix' => 'registration'], function () {
        Route::post('/add', 'Registration\RegistrationController@add');
    });

    Route::group(['prefix' => 'data'], function() {
        Route::get('branch','MasterData\MasterDataController@getBranch')->name('getDataBranch');
        Route::get('highest-edu','MasterData\MasterDataController@getHighestEdu')->name('getHighestEduApplyAPI');
        Route::get('precur-school','MasterData\MasterDataController@getPrecureSchool')->name('getPrecureSchoolApplyAPI');
        Route::get('postal-code/search/{query?}','MasterData\MasterDataController@getPostalCode')->name('getPostalCodeApplyAPI');
        Route::get('destination-study','MasterData\MasterDataController@getDestinationStudy')->name('getDestinationStudyApplyAPI');
        Route::get('program-interested','MasterData\MasterDataController@getProgramInterested')->name('getProgramInterestedApplyAPI');
        Route::get('marketing-source','MasterData\MasterDataController@getMarketingSource')->name('getMarketingSourceApplyAPI');

        // New
        // Route::get('school','MasterData\MasterDataController@getSchool')->name('getSchoolAPI');
        Route::get('school','MasterData\MasterDataController@getDataSchool')->name('getDataSchoolAPI');
        Route::post('school','MasterData\MasterDataController@getDataSchool')->name('postGetDataSchoolAPI');
        Route::get('school/search/{query?}','MasterData\MasterDataController@getSchool')->name('getSchool');

        // New For Email Marketing
        Route::get('branch-sunnies','MasterData\MasterDataController@getBranchSunnies')->name('getBranchSunnies');
        Route::get('country','MasterData\MasterDataController@getCountry')->name('getCountry');
        Route::get('institution','MasterData\MasterDataController@getInstitution')->name('getInstitutionAPI');
        Route::post('institution','MasterData\MasterDataController@getInstitution')->name('postGetInstitutionAPI');
        Route::get('program-study','MasterData\MasterDataController@getProgramStudy')->name('getProgramStudyAPI');
        Route::get('study-classification','MasterData\MasterDataController@getStudyClassification')->name('getStudyClassificationAPI');
        Route::get('study-sector','MasterData\MasterDataController@getStudySector')->name('getStudySectorAPI');
        Route::get('event','MasterData\MasterDataController@getEvent')->name('getEventAPI');
        Route::post('event','MasterData\MasterDataController@getEvent')->name('getEventAPI');
        Route::get('counselor','MasterData\MasterDataController@getCounselor')->name('getCounselorAPI');
        Route::post('counselor','MasterData\MasterDataController@postGetCounselor')->name('postGetCounselorAPI');
        Route::get('major-interested','MasterData\MasterDataController@getMajorInterested')->name('getMajorInterestedAPI');
        Route::get('role-sunnies','MasterData\MasterDataController@getRoleSunnies')->name('getRoleSunniesAPI');
        Route::get('country-scn','MasterData\MasterDataController@getCountrySCN')->name('getCountrySCNAPI');
        Route::get('university-scn','MasterData\MasterDataController@getUniversitySCN')->name('getUniversitySCNAPI');
        Route::post('university-scn','MasterData\MasterDataController@getUniversitySCN')->name('getUniversitySCNAPI');
        Route::post('booth','MasterData\MasterDataController@getBooth')->name('getBoothAPI');
        Route::post('parents-name','MasterData\MasterDataController@getParentsName')->name('getParentsNameAPI');
        Route::post('student-name','MasterData\MasterDataController@getStudentName')->name('getStudentNameAPI');
        Route::get('country-md','MasterData\MasterDataController@getCountryMD')->name('getCountryMDAPI');
        Route::get('institution-group-md','MasterData\MasterDataController@getInstitutionGroupMD')->name('getInstitutionGroupMDAPI');
        Route::get('institution-md','MasterData\MasterDataController@getInstitutionMD')->name('getInstitutionMDAPI');
        Route::post('institution-md','MasterData\MasterDataController@getInstitutionMD')->name('getInstitutionMDAPI');


        // For Event Registration
        Route::post('ajaxSchool','MasterData\MasterDataController@getDataAjaxSchool')->name('getDataAjaxSchoolAPI');
        Route::post('ajaxPostalCode','MasterData\MasterDataController@getDataAjaxPostalCode')->name('getDataAjaxPostalCodeAPI');

        Route::post('ajaxBranchCoverage','MasterData\MasterDataController@getDataAjaxBranchCoverage')->name('getDataAjaxBranchCoverageAPI');
    });

    Route::group(['prefix' => 'mailapp'], function (){
        Route::get('form', 'MailApp\MailAppController@getFormSunnies');
        Route::post('check', 'API\EmailMarketing\EmailMarketingController@check');
        Route::post('submit', 'API\EmailMarketing\EmailMarketingController@submit');
        Route::post('importEmail', 'API\EmailMarketing\EmailMarketingController@importEmail');
    });
});

// Route::group(['prefix' => 'data'], function () {
//     Route::post('/add', 'Registration\RegistrationController@add');
// });

Route::group(['middleware' => ['client']], function () {
    Route::group(['prefix' => 'leads'], function () {
        // Route::post('syncToSunnies', 'Leads\LeadsController@syncToSunnies');
        Route::group(['prefix' => 'integration'], function () {
            Route::group(['prefix' => 'sunnies'], function () {
                Route::post('getDataSuntrack','Leads\Integration\SunniesController@getDataSuntrack');

                Route::post('getDataMobileApp','Leads\Integration\SunniesController@getDataMobileApp');
                Route::post('getDataMobileAppApplyProgram','Leads\Integration\SunniesController@getDataMobileAppApplyProgram');
                Route::post('getDataMobileAppApplyEvent','Leads\Integration\SunniesController@getDataMobileAppApplyEvent');
                Route::post('getDataMobileAppApplyExpo','Leads\Integration\SunniesController@getDataMobileAppApplyExpo');
                Route::post('getDataMobileAppApplyWorkshop','Leads\Integration\SunniesController@getDataMobileAppApplyWorkshop');
                Route::post('getDataMobileAppApplyEventSeminar','Leads\Integration\SunniesController@getDataMobileAppApplyEventSeminar');
                Route::post('getDataMobileAppApplyEventInfoSession','Leads\Integration\SunniesController@getDataMobileAppApplyEventInfoSession');

                Route::post('getDataSunEduWeb','Leads\Integration\SunniesController@getDataSunEduWeb');
                Route::post('getDataSunEduWebGeneral','Leads\Integration\SunniesController@getDataSunEduWebGeneral');
                Route::post('getDataSunEduWebApplyProgram','Leads\Integration\SunniesController@getDataSunEduWebApplyProgram');

                Route::post('getDataSunEngWeb','Leads\Integration\SunniesController@getDataSunEngWeb');
                Route::post('getDataSunEngWebGeneral','Leads\Integration\SunniesController@getDataSunEngWebGeneral');
                Route::post('getDataSunEngWebApplyProgram','Leads\Integration\SunniesController@getDataSunEngWebApplyProgram');
                Route::post('getDataSunEngWebInternational','Leads\Integration\SunniesController@getDataSunEngWebInternational');

                // Event
                Route::post('getDataEventWorkshop','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 1);
                Route::post('getDataEventSeminar','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 2);
                Route::post('getDataEventInfoSession','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 3);
                Route::post('getDataEventSunEngEvent','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 4);
                Route::post('getDataEventSunEngClass','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 5);
                Route::post('getDataEventPartnerEvent','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 6);
                Route::post('getDataEventSchoolExpo','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 7);
                Route::post('getDataEventIndependent','Leads\Integration\SunniesController@getDataEvent')->defaults('event_type_id', 8);

                Route::post('syncToSunnies','Leads\Integration\SunniesController@syncToSunnies');
                Route::post('syncAllToSunnies','Leads\Integration\SunniesController@syncAllToSunnies');
                // Route::post('syncToSunnies', 'Leads\LeadsController@syncToSunnies');

                Route::post('getCount','Leads\Integration\SunniesController@getCount');
            });

            Route::group(['prefix' => 'suntrack'], function () {
                Route::post('getCount','Leads\Integration\SuntrackController@getCount');

                Route::post('getDataSunnies','Leads\Integration\SuntrackController@getDataSunnies');
                Route::post('allocateTo','Leads\Integration\SuntrackController@allocateTo');
                Route::post('allocateSelection','Leads\Integration\SuntrackController@allocateSelection');
                Route::post('allocateAll','Leads\Integration\SuntrackController@allocateAll');

                Route::post('getDataMobileApp','Leads\Integration\SuntrackController@getDataMobileApp');
                Route::post('getDataMobileAppApplyProgram','Leads\Integration\SuntrackController@getDataMobileAppApplyProgram');
                Route::post('getDataMobileAppApplyEvent','Leads\Integration\SuntrackController@getDataMobileAppApplyEvent');
                Route::post('getDataMobileAppApplyExpo','Leads\Integration\SuntrackController@getDataMobileAppApplyExpo');
                Route::post('getDataMobileAppApplyWorkshop','Leads\Integration\SuntrackController@getDataMobileAppApplyWorkshop');
                Route::post('getDataMobileAppApplyEventSeminar','Leads\Integration\SuntrackController@getDataMobileAppApplyEventSeminar');
                Route::post('getDataMobileAppApplyEventInfoSession','Leads\Integration\SuntrackController@getDataMobileAppApplyEventInfoSession');

                Route::post('getDataSunEngWeb','Leads\Integration\SuntrackController@getDataSunEngWeb');
                Route::post('getDataSunEduWebGeneral','Leads\Integration\SuntrackController@getDataSunEduWebGeneral');
                Route::post('getDataSunEduWebApplyProgram','Leads\Integration\SuntrackController@getDataSunEduWebApplyProgram');
                Route::post('getDataSunEngWebGeneral','Leads\Integration\SuntrackController@getDataSunEngWebGeneral');
                Route::post('getDataSunEngWebApplyProgram','Leads\Integration\SuntrackController@getDataSunEngWebApplyProgram');
                Route::post('getDataSunEngWebInternational','Leads\Integration\SuntrackController@getDataSunEngWebInternational');

                Route::post('getDataMasterDataEvent/{id}','Leads\Integration\SuntrackController@getDataMasterDataEvent');

                Route::post('syncToSunnies', 'Leads\LeadsController@syncToSunnies');
            });
        });
    });

    Route::group(['prefix' => 'check'], function () {
        Route::get('email/{email}', function($email){
            $emailVerification = App\EmailVerification::where('email', $email)->first();
            if(is_null($emailVerification)){
                $client = new \GuzzleHttp\Client();
                $guzzleResponse = $client->request('GET', 'https://api.my-addr.com/email/api.php?secret=3B9EE8463A8746FB0654D072A2D3B96C&email=' . $email . '&ext=1'); // .
                if($guzzleResponse->getStatusCode() == 200){
                    $emailVerification = App\EmailVerification::firstOrNew([
                            'email' => $email
                    ]);
                    // $emailVerification->email = $email;
                    if(!is_null($guzzleResponse->getBody()) && !empty($guzzleResponse->getBody())){
                        $verificationStatus = explode('|', $guzzleResponse->getBody());
                        $emailVerification->status = isset($verificationStatus[0]) ? $verificationStatus[0] : 'unknown';
                        $emailVerification->sub_status = isset($verificationStatus[1]) ? $verificationStatus[1] : 'unknown';
                    } else {
                        $emailVerification->status = 'unknown';
                        $emailVerification->sub_status = 'unknown';
                    }

                    try {
                        $emailVerification->save();
                        return new App\Http\Resources\EmailVerificationResource($emailVerification);
                    } catch (Exception $e) {
                    }
                }

                return response()->json([
                    'data' => [
                        'email_verification_id' => null,
                        'email' => null,
                        'status' => null,
                        'sub_status' => null,
                    ]
                ]);
            } else {
                return new App\Http\Resources\EmailVerificationResource($emailVerification);
            }
        });
    });

    Route::group(['prefix' => 'country'], function () {

    });

    Route::group(['prefix' => 'level-of-study'], function () {

    });

    Route::group(['prefix' => 'major'], function () {

    });

    Route::group(['prefix' => 'university'], function () {

    });

    Route::group(['prefix' => 'university-program'], function () {

    });

    // Combine Master Data School and Sunnies Precur School
    // Route::group(['prefix' => 'school'], function () {
    //     Route::get('sunnies', 'API\School\SchoolController@getDataForSunnies');
    //     // Route::post('sunnies', 'API\School\SchoolController@getDataForSunnies');
    // });
});

Route::group(['prefix' => 'school'], function () {
    Route::get('sunnies', 'API\School\SchoolController@getDataForSunnies');
    Route::get('sunnies2', 'API\School\SchoolController@getDataForSunnies2');
    // Route::post('sunnies', 'API\School\SchoolController@getDataForSunnies');
    Route::post('checkSchoolSunnies', 'API\School\SchoolController@checkSchoolSunnies');
});

Route::group(['prefix' => 'major'], function () {
    Route::get('sunnies', 'API\Major\MajorController@getDataForSunnies');
    Route::get('sunnies2', 'API\Major\MajorController@getDataForSunnies2');
    // Route::post('sunnies', 'API\Major\MajorController@getDataForSunnies');
    Route::post('checkMajorSunnies', 'API\Major\MajorController@checkMajorSunnies');
});
