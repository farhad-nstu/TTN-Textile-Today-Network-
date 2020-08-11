<?php

use Illuminate\Http\Request;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;

    Route::get('get-user-info/{id}', 'ProfilesController@get_user_info');
    //profile settings User controller
    Route::put('active-admin-account', 'UsersController@active_admin_account');
    Route::put('active-user-account', 'UsersController@active_user_account');
    Route::put('reset-password', 'UsersController@reset_password');
    Route::get('forgot-password/{email}', 'UsersController@forgot_password');
    Route::get('check-phone-exist/{phone}', 'UsersController@check_phone_exist');
    Route::get('check-email-exist/{email}', 'UsersController@check_email_exist');
    Route::post('login', 'UsersController@login');
    Route::post('register', 'UsersController@register');
    Route::post('controller-login', 'UsersController@admin_login');
    Route::post('controller-register', 'UsersController@admin_register');
    ////////////Events////////////////
    Route::get('get-connected-users/{userId}/{eventId}', 'EventsController@get_connected_users');
    Route::get('get-event-details/{eventId}/{userId}', 'EventsController@get_event_details');
    Route::get('get-event-comments/{eventId}/{userId}', 'EventsController@get_event_comments');
    Route::get('get-edit-event/{eventId}/{userId}', 'EventsController@get_edit_event');
    Route::get('get-events/{event}/{eventTypeId}/{userId}/{eventTag}', 'EventsController@get_events');
    Route::post('send-event-invitation', 'EventsController@send_event_invitation');
    Route::post('event-invitation-accept-or-not', 'EventsController@event_invitation_accept_or_not');
    Route::post('share-event', 'EventsController@share_event');
    Route::post('add-event-comment', 'EventsController@add_event_comment');
    Route::post('update-event-comment', 'EventsController@update_event_comment');
    Route::post('like-event', 'EventsController@like_event');
    Route::post('unlike-event', 'EventsController@unlike_event');
    Route::post('like-event-comment', 'EventsController@like_event_comment');
    Route::post('unlike-event-comment', 'EventsController@unlike_event_comment');
    Route::delete('delete-event-comment/{commentId}', 'EventsController@delete_event_comment');

    ///////Terms and policies
    // Route::resource('policies_for_admin', 'Admin\PoliciesController');
    // Route::resource('policy-details', 'Admin\PolicyDetailsController');


    ///////News Feed
    Route::post('get-feeds', 'FeedsController@get_feeds');
    Route::post('submit-post', 'PostsController@submit_post');
    Route::post('like-post', 'PostsController@like_post');
    Route::post('unlike-post', 'PostsController@unlike_post');
    Route::post('comment', 'PostsController@comment');
    Route::post('update-comment', 'PostsController@update_comment');
    Route::post('delete-comment', 'PostsController@delete_comment');
    Route::get('get-post-comments/{id}', 'PostsController@get_comments');
    Route::post('share-post', 'PostsController@share_post');
    Route::post('like-comment', 'PostsController@like_comment');
    Route::post('unlike-comment', 'PostsController@unlike_comment');

    ////////////// invitations ////////////////////


    ////userscontroller
    Route::get('admin-list', 'UsersController@admin_list');
    Route::put('admin-verify/{id}', 'UsersController@admin_verify');
    Route::put('admin-disapprove/{id}', 'UsersController@admin_disapprove');
    Route::get('get-user-privay-data/{id}', 'UsersController@get_user_privay_data');
    Route::put('change-user-Privacy/{id}', 'UsersController@change_user_Privacy');
    Route::post('update-resume/{id}', 'UsersController@update_resume');
    Route::put('change-password/{id}', 'UsersController@change_password');
    Route::put('update-profile-picture/{id}', 'UsersController@update_profile_picture');
    Route::put('update-cover-picture/{id}', 'UsersController@update_cover_picture');
    Route::put('update-user-basic-Info/{id}', 'UsersController@update_user_basic_Info');
    // user  profiles  Controller
    Route::put('update-Location/{id}', 'ProfilesController@update_Location');
    Route::put('update-about-your-self/{id}', 'ProfilesController@update_about_your_self');
    Route::put('update-experience/{id}', 'ProfilesController@update_experience');
    Route::put('add-experience/{id}', 'ProfilesController@add_experience');
    Route::put('update-experience/{id}', 'ProfilesController@update_experience');
    Route::put('add-education/{id}', 'ProfilesController@add_education');
    Route::put('update-education/{id}', 'ProfilesController@update_education');
    Route::delete('delete-education/{id}', 'ProfilesController@delete_education');
    Route::delete('delete-experience/{id}', 'ProfilesController@delete_experience');
    Route::put('add-skills/{id}', 'ProfilesController@add_skills');
    Route::get('get-all-skills', 'ProfilesController@get_all_skills');
    Route::get('get-user-educations/{id}', 'ProfilesController@get_user_educations');
    Route::get('get-user-experiences/{id}', 'ProfilesController@get_user_experiences');
    Route::get('get-user-skills/{id}', 'ProfilesController@get_user_skills');
    Route::post('search', 'Controller@search');
    //////// Countries /////////////////
    Route::get('get-countries', 'UsersController@get_countries');
    Route::get('get-states/{country_id}', 'UsersController@get_states');
    Route::get('get-cities/{state_id}', 'UsersController@get_cities');
    //////////////Events ////////////////
    Route::get('get-mentor/{mentor_email}', 'EventsController@get_mentor');
    Route::get('get-interest-groups', 'EventsController@get_interest_groups');
    Route::get('get-event-types', 'EventsController@get_event_types');
    Route::put('create-event/{id}', 'EventsController@create_event');
    Route::put('update-event/{id}', 'EventsController@update_event');
    Route::delete('delete-event/{id}', 'EventsController@delete_event');
    /////////// Forum /////////////////

    ///////// User ////// 
    Route::resource('questions', 'QuestionsController');
    Route::get('question/{id}', 'QuestionsController@get_question_details');
    Route::get('popular-question', 'QuestionsController@get_popular_question');
    Route::get('get-question-categories', 'QuestionsController@get_question_categories');
    // Route::get('get-questions/{userId}/{categoryId}', 'QuestionsController@get_questions');
    Route::get('get-questions/{userId}/{categoryId}/{limit}/{page}', 'QuestionsController@get_questions');
    Route::get('up-vote/{id}/{userId}/{types}', 'VotesController@is_eligible_for_up_vote');
    Route::get('down-vote/{id}/{userId}/{contents}', 'VotesController@is_eligible_for_down_vote');
    Route::post('answer/{id}', 'AnswersController@store');
    // Route::get('get-my-answers/{userId}/{categoryId}', 'AnswersController@get_my_answers');
    Route::post('get-my-answers', 'AnswersController@get_my_answers');
    Route::get('get-my-answer/{answerId}', 'AnswersController@get_my_answer');
    Route::put('update-my-answer/{answerId}', 'AnswersController@update_my_answer');
    Route::delete('delete-answer/{id}', 'AnswersController@delete_answer');
    Route::put('answer/is-accept/{id}/{userId}', 'AnswersController@accept_answer');

    //Policy
    Route::get('policies', 'PoliciesController@get_policy_list');
    Route::get('policy/{id}', 'PoliciesController@get_policy');
    //Message
    Route::get('users', 'MessagesController@get_users');




  // User Connections
  Route::post('connection-request', 'UserConnectionsController@connection');
  Route::get('get-notification/{id}', 'UserConnectionsController@get_notification');
  Route::post('accept-connection', 'UserConnectionsController@accept_connection');
  Route::post('block-connection', 'UserConnectionsController@block_connection');


  Route::resource('posts', 'PostsController');
  Route::get('types-status', 'PostsController@get_types_and_status');

  //Single Article
  Route::get('post/{id}', 'PostsController@singleArticle');

  // Route::resource('images', 'ImagesController');
  Route::put('store', 'ImagesController@store');

//////////////// Admin Routes /////////////////
// Route::namespace('Admin')->group(function(){
Route::middleware('auth:api')->namespace('Admin')->group(function(){
    //Countries
    Route::get('countries', 'CountriesController@index');
    Route::get('country/{id}', 'CountriesController@show');
    Route::post('country', 'CountriesController@store');
    Route::put('country', 'CountriesController@store');
    Route::delete('country/{id}', 'CountriesController@destroy');
    //------------------------------------------------------//
    Route::resource('apps', 'AppsController');
    Route::resource('badges', 'BadgesController');
    Route::resource('access-points', 'AccessPointsController');
    Route::resource('classified-categories', 'ClassifiedCategoriesController');
    Route::resource('email-templates', 'EmailTemplatesController');
    Route::resource('states', 'StatesController');
    Route::resource('cities', 'CitiesController');
    Route::resource('post-types', 'PostTypesController');
    Route::resource('event-types', 'EventTypesController');
    Route::resource('interest-groups', 'InterestGroupsController');
    Route::resource('jobs', 'JobsController');
    Route::resource('job-types', 'JobTypesController');
    Route::resource('languages', 'LanguagesController');
    Route::resource('user-privacy-status', 'UserPrivacyStatusSettingsController');
    Route::resource('page-categories', 'PageCategoriesController');
    Route::resource('question-categories', 'QuestionCategoriesController');
    Route::resource('skills', 'SkillsController');
    Route::resource('tags', 'TagsController');
    Route::resource('tag-categories', 'TagCategoriesController');
    Route::resource('training-categories', 'TrainingCategoriesController');
    Route::resource('user-types', 'UserTypesController');
    Route::resource('roles', 'RolesController');
    Route::resource('services', 'ServicesController');
    Route::resource('organizations', 'OrganizationsController');
    Route::get('organization-details/{id}', 'OrganizationsController@get_organization_details');
    Route::resource('settings', 'SettingsController');
    // Route::resource('policies', 'PoliciesController');
    // Route::resource('policy-details', 'PolicyDetailsController');
});

//Admin
Route::resource('policy-index', 'Admin\PoliciesController');
Route::get('policy-details-index/{id}', 'Admin\PolicyDetailsController@index');
Route::post('add-policy-details/{id}', 'Admin\PolicyDetailsController@store');
Route::get('show-policy-details/{id}', 'Admin\PolicyDetailsController@show');
Route::put('update-policy-details/{id}', 'Admin\PolicyDetailsController@update');
Route::delete('policy-details/{id}', 'Admin\PolicyDetailsController@destroy');
Route::resource('question-index', 'Admin\QuestionsController');
Route::get('single-question/{id}', 'Admin\QuestionsController@get_single_question');
Route::get('question-with-answer/{id}', 'Admin\QuestionsController@get_question_with_answers');
Route::get('answer-details/{id}', 'Admin\QuestionsController@get_answer_details');
Route::get('get-answer/{id}', 'Admin\QuestionsController@get_answer');
Route::put('update-answer/{id}', 'Admin\QuestionsController@update_answer');
Route::delete('delete-answer/{id}', 'Admin\QuestionsController@delete_answer');






