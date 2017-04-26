<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/************************************
 * USER FRIENDLY URL FOR FREELANCER
 ************************************/
$route['win-jobs']               = 'win_jobs';
$route['ended-jobs']             = 'ended_jobs';
$route['my-balance']             = 'pay/balance';
$route['jobs/my-bids']           = 'job/bids';
$route['jobs/my-bids/archived']  = 'job/bids/archived';


$route['my-offers']                 = 'job/offers/active';
$route['jobs/interviews/(:any)']    = 'jobs/interviews/($1)';

$route['jobs/proposals/(:any)/(:any)'] = 'jobs/withdraw_system/($2)'; 
$route['my-offers/archived']           = 'Active_interview/declined_interview';
$route['my-interviews']                = 'Active_interview';
$route['proposals/my-interview']       = 'freelancerinvite';
$route['jobs/offers']                  = 'job/offers';
$route['jobs/offers/accept']           = 'job/offers/accept';
$route['jobs/offers/decline']          = 'job/offers/decline';

/****************************************
 * USER FRIENDLY URL FOR CLIENT/EMPLOYER
 ****************************************/
$route['jobs/my-freelancers']     = 'job/my_freelancers'; 
$route['jobs/past-hires']         = 'job/past_hires';
$route['jobs/offers-sent']        = 'job/offers_sent';
$route['jobs/my-contracts']       = 'job/my_contracts';
$route['jobs/ended-contracts']    = 'job/ended_contracts';
$route['jobs/work-diary']         = 'job/work_diary';
$route['pay/add-card']            = 'pay/add_card';
$route['pay/add-paypal-account']  = 'pay/add_paypal_account';
$route['billing-history']         = 'pay';
$route['edit-jobs/(:any)']        = 'jobs/edit/($1)';
$route['jobs/applications/(:any)']  = 'job/applications/index/($1)';
$route['jobs/applied/(:any)']       = 'jobs/applied/($1)';
$route['jobs/(:any)/(:any)']        = 'jobs/view/($1)/($2)';
$route['jobs/preview-job-posting']  = 'jobs/preview_job_posting';
$route['freelancer/(:any)']         = 'profile/profileSearch/($1)';


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['app'] = 'app/index';
$route['app/(:any)'] = 'app/index/';
$route['materia'] = 'materia/index';
$route['materia/(:any)'] = 'materia/index';

$route['jobs/(:any)/(:any)/apply'] = 'jobs/apply/($1)/($2)';

$route['administrator'] = 'administrator/home';
$route['post-job'] = 'jobs/create';
$route['find-jobs'] = 'jobs/find';
$route['jobs-search'] = 'jobs/find';
$route['jobs-search/(:any)'] = 'jobs/find/($1)';
$route['jobs-search/(:any)/(:any)'] = 'jobs/find/($1)/($2)';
$route['jobs-home'] = 'jobs/status';
$route['payment-methods'] = 'payment/methods';
$route['payment-methods/remove'] = 'payment/removeAccount';
$route['payment-methods/add-account'] = 'payment/addPaymentMethodAcc';
$route['payment/tax-information'] = 'payment/taxInformation';
$route['payment/tax-information-save'] = 'payment/updateTaxInformation';
$route['profile-settings'] = 'profilesetting';
$route['administrator/(:any)'] = 'administrator/$1';
$route['profile/update-basic-profile'] = "profile/updateBasicProfile";
$route['profile/update-portfolio'] = "profile/updatePortfolio";
$route['profile/my-freelancer-profile'] = "profile/freelancerProfile";
$route['profile/update-contact-details'] = "profile/updateContactDetails";
$route['profile/remove-portfolio'] = "profile/removePortfolio";
$route['profile/edit-portfolio'] = "profile/editPortfolio";
$route['freelancers-search'] = "profile/searchFreelancer";
$route['search'] = "search";
$route['homepage'] = "home/homepage";
$route['json/(:any)'] = 'json/(:any)';

$route['end-contract'] = 'jobs/ended_contract';
$route['contract/restart'] = 'jobs/restart';
$route['contract/paused'] = 'jobs/paused';
$route['notifications/contracts'] = 'jobs/notifications';
$route['contracts'] = 'jobs/contracts';


$route['profile/manageaccount'] = "profile/manageaccount";
$route['profile/basic'] = "profile/basic";
$route['profile/addedu'] = "profile/addedu";
$route['profile/add_education'] = "profile/add_education";
$route['profile/basic_bio'] = "profile/basic_bio";
$route['profile/add-exp'] = "profile/addExp";
$route['profile/search-freelancer'] = 'profile/searchFreelancer';
$route['profile/basic-profile-page'] = 'profile/basicProfilePage';
$route['profile/add_experience'] = 'profile/add_experience';
$route['profile/edit-portfolio'] = 'profile/editPortfolio';
$route['profile/edit-exp-profile'] = 'profile/editExpProfile';
$route['profile/remove-portfolio'] = 'profile/removePortfolio';
$route['profile/do-upload'] = 'profile/doUpload';
$route['profile/freelancer-profile'] = 'profile/freelancerProfile';
$route['profile/profile_freelancer'] = 'profile/profile_freelancer';

$route['profile/remove-edu/(:num)'] = 'profile/removeEdu/$1';
$route['profile/remove-exp/(:num)'] = 'profile/removeExp/$1';
$route['profile/remove-edu/(:num)/(:any)'] = 'profile/removeEdu/$1/$2';
$route['profile/remove-exp/(:num)/(:any)'] = 'profile/removeExp/$1/$2';

$route['profile/(:any)'] = 'profile/index/($1)';

//Routes for Footer
$route['add-fund'] = 'footerPages/add_fund';
$route['cancellation-refund'] = 'footerPages/cancellation';
$route['desktop-app'] = 'footerPages/desktop_app';
$route['enterprise-solution'] = 'footerPages/enterprise';
$route['fees-charges'] = 'footerPages/fees';
$route['getwork-done'] = 'footerPages/getwork_done';

//added by Ralfh 3/23/2017
$route['employer-help'] = 'footerPages/employer_help';
$route['freelancer-help'] = 'footerPages/freelancer_help';

//employer help pages start
$route['employer-help/registering-account'] = 'footerPages/registering_account';
$route['employer-help/costs-to-use'] = 'footerPages/costs_to_use';
$route['employer-help/understanding-account-settings'] = 'footerPages/understanding_account_settings';
$route['employer-help/verified-payments'] = 'footerPages/verified_payments';

$route['employer-help/posting-jobs'] = 'footerPages/posting_jobs';
$route['employer-help/jobs-description'] = 'footerPages/jobs_description';
$route['employer-help/featuring-jobs'] = 'footerPages/featuring_jobs';
$route['employer-help/job-status'] = 'footerPages/job_status';
$route['employer-help/posting-restrictions'] = 'footerPages/posting_restrictions';

$route['employer-help/finding-freelancers'] = 'footerPages/finding_freelancers';
$route['employer-help/viewing-quotes'] = 'footerPages/viewing_quotes';
$route['employer-help/awarding-job'] = 'footerPages/awarding_job';
$route['employer-help/deciding-agreement'] = 'footerPages/deciding_agreement';


$route['employer-help/communicating-with-freelancers'] = 'footerPages/communicating_with_freelancers';
$route['employer-help/adding-files'] = 'footerPages/adding_files';
$route['employer-help/managing-team'] = 'footerPages/managing_team';
$route['employer-help/understanding-time-tracker'] = 'footerPages/understanding_time_tracker';
$route['employer-help/understanding-workroom'] = 'footerPages/understanding_workroom';

$route['employer-help/understanding-invoce-safepay'] = 'footerPages/understanding_invoce_safepay';
$route['employer-help/paying-invoice'] = 'footerPages/paying_invoice';
$route['employer-help/adding-funds'] = 'footerPages/adding_funds';
$route['employer-help/understanding-autopay'] = 'footerPages/understanding_autopay';
$route['employer-help/managing-feedback'] = 'footerPages/managing_feedback';
$route['employer-help/adding-payment-methods'] = 'footerPages/adding_payment_methods';
$route['employer-help/our-service'] = 'footerPages/our_service';

$route['employer-help/requesting-safepay-refund'] = 'footerPages/requesting_safepay_refund';
$route['employer-help/requesting-invoice-refund'] = 'footerPages/requesting_invoice_refund';
$route['employer-help/entering-negotiation'] = 'footerPages/entering_negotiation';
$route['employer-help/escalating-dispute'] = 'footerPages/escalating_dispute';
//employer help pages end

//freelancer help start
$route['freelancer-help/registering-account'] = 'footerPages/f_registering_account';
$route['freelancer-help/costs-to-use'] = 'footerPages/f_costs_to_use';
$route['freelancer-help/editing-account'] = 'footerPages/f_editing_account';

$route['freelancer-help/understanding-profile'] = 'footerPages/f_understanding_profile';
$route['freelancer-help/adding-portfolio-services'] = 'footerPages/f_adding_portfolio_services';
$route['freelancer-help/taking-skill-tests'] = 'footerPages/f_taking_skill_tests';
$route['freelancer-help/purchasing-membership'] = 'footerPages/f_purchasing_membership';

$route['freelancer-help/searching-jobs'] = 'footerPages/f_searching_jobs';
$route['freelancer-help/receiving-invitations'] = 'footerPages/f_receiving_invitations';
$route['freelancer-help/receiving-job-matches'] = 'footerPages/f_receiving_job_matches';
$route['freelancer-help/adding-jobs-to-wishlist'] = 'footerPages/f_adding_jobs_to_wishlist';
$route['freelancer-help/submitting-quotes'] = 'footerPages/f_submitting_quotes';
$route['freelancer-help/understanding-quotes-terms'] = 'footerPages/f_understanding_quotes_terms';

$route['freelancer-help/communicating-with-employers'] = 'footerPages/f_communicating_with_employers';
$route['freelancer-help/sending-agreement'] = 'footerPages/f_sending_agreement';
$route['freelancer-help/adding-files-to-workroom'] = 'footerPages/f_adding_files_to_workroom';
$route['freelancer-help/using-timetracker'] = 'footerPages/f_using_timetracker';
$route['freelancer-help/managing-team'] = 'footerPages/f_managing_team';
	
$route['freelancer-help/understanding-payment'] = 'footerPages/f_understanding_payment';
$route['freelancer-help/sending-invoices'] = 'footerPages/f_sending_invoices';
$route['freelancer-help/payment-schedule'] = 'footerPages/f_payment_schedule';
$route['freelancer-help/verified-payment-methods'] = 'footerPages/f_verified_payment_methods';
$route['freelancer-help/adding-transfer-method'] = 'footerPages/f_adding_transfer_method';
$route['freelancer-help/managing-feedback'] = 'footerPages/f_managing_feedback';

$route['freelancer-help/issuing-safepay-refund'] = 'footerPages/f_issuing_safepay_refund';
$route['freelancer-help/issuing-invoice-refund'] = 'footerPages/f_issuing_invoice_refund';
$route['freelancer-help/entering-negotiation'] = 'footerPages/f_entering_negotiation';
$route['freelancer-help/escalating-dispute-arbitration'] = 'footerPages/f_escalating_dispute_arbitration';
//Ralfh -- end

$route['how-to-join'] = 'footerPages/join';
$route['make-better'] = 'footerPages/make_better';
$route['press'] = 'footerPages/press';
$route['create-ticket'] = 'footerPages/create_ticket';
$route['trust-safety'] = 'footerPages/trust_safety';
$route['feedback'] = 'footerPages/feedback';

$route['freelance-jobs'] = 'jobs/jobs_no_auth';
//$route['jobs-search'] = 'jobs/jobs_no_auth';
$route['freelance-jobs/(:any)'] = 'jobs/jobs_no_auth/($1)';
$route['freelance-jobs/(:any)/(:any)'] = 'jobs/jobs_no_auth/($1)/($2)';