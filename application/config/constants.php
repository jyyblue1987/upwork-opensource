<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

define('IMAGE_PATH', './uploads/logo/');
define('CF', 'https://dsma8qelec6j2.cloudfront.net/');


/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//haseeburrehman.com's stripe module's API setting
define('STRIPE_PK', "pk_test_Wio5VP1sClhcPWSBz0g5Jaso");//define('STRIPE_PK', "pk_test_STFZOvi67NhV0ydVERCLBByh");
define('STRIPE_SK', "sk_test_kdRIBeicKrJLaTboAAjehFED");//define('STRIPE_SK', "sk_test_mEvbbHFxresUiBbeyKl6bmum");

defined('PAYPAL_CLIENT_ID')     || define('PAYPAL_CLIENT_ID',"AaCqfMPsmVaeU0OhsTpAh__ZuEJTBcVEA0wV-hQezHP0Ezpd0VOr0PNdQYxMrgfWmqG3KtkpCdQ3eoLz");
defined('PAYPAL_CLIENT_SECRET') || define('PAYPAL_CLIENT_SECRET', "EAIWEBhehKwDNfCDzOUwU0aenkj4zL3Kk86j2S9wrJ-igeqzzdBL0TgVAEwhSg0ofiUMWwcI50de9QPp");

define('PAYPAL_BASE_URL',"http://www.winjob.com/pay/addPP");
define('PAYPAL_URL',"https://www.sandbox.paypal.com/webscr&cmd=_ap-preapproval&preapprovalkey=");
define('PAYPAL_PAYMENT_RECEIVER',"seller.test@haseeburrehman.com"); 
define('PAYPAL_API_USER', "seller.test_api1.haseeburrehman.com");
define('PAYPAL_API_PASS', "HY6ENM7SA5SNFQNA");
define('PAYPAL_API_SIGN', "AFcWxV21C7fd0v3bYYYRCpSSRl31AnJosL9DcfX40xgafuxK5ReHIdQB");
define('PAYPAL_BILLING_API_URL',"https://api-3t.sandbox.paypal.com/nvp");
define('PAYPAL_USER_AUTH_URL',"https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=");

defined('PAYPAL_MERCHANT_EMAIL') || define('PAYPAL_MERCHANT_EMAIL', 'business@winjob.com');
defined('PAYPAL_APP_ID') || define('PAYPAL_APP_ID', 'APP-80W284485P519543T');
defined('PAYPAL_BUSINESS_NAME') || define('PAYPAL_BUSINESS_NAME', 'WINJOB, LLC');
defined('PAYPAL_IPN_NOTIFY_URL') || define('PAYPAL_IPN_NOTIFY_URL', "cli/charge/handle_paypal_ipn");

/*
 * Some constant for using severall place to avoid typing mistake
 */
define('WARNING_MESSAGE', "warningMessage");
define('SUCCESS_MESSAGE', "successMessage");
define('ERROR_MESSAGE', "errorMessage");
define('ACTION_DATA', "actionData");
define('WINJOB_FEE', .1);

define('USER_ID', "id");
define('USER_NAME', "username");

/*
 * tables name as contant as if it can be change any time by
 * changing in one place
 */
define('WEB_USER_BASIC_PROFILE_TABLE', "webuser_basic_profile");
define('WEB_USER_PORTFOLIO_TABLE', "webuser_portfolio");
define('WEB_USER_TABLE', "webuser");
define('COUNTEY_TABLE', "country");
define('COUNTRY_TABLE', "country");
define('SUBCATEGORY_TABLE', "job_subcategories");
define('WEB_USER_ADDRESS', "webuseraddresses");
define('WB_PAYMENT_METHODS', "webuser_payment_methods");
define('WB_TAX_INFO', "webuser_tax_information");

defined('FIXED_JOB_TYPE') || define('FIXED_JOB_TYPE', 'fixed');
defined('HOURLY_JOB_TYPE') || define('HOURLY_JOB_TYPE', 'hourly');

defined('CONTRACT_JOB_TITLE_MAX') || define('CONTRACT_JOB_TITLE_MAX', 68);
defined('LIST_JOB_TITLE_MAX') || define('LIST_JOB_TITLE_MAX', 88);
defined('CONTRACT_JOB_COMPANY_NAME_MAX') || define('CONTRACT_JOB_COMPANY_NAME_MAX', 35);

defined('BID_STATE_APPLIED') || define('BID_STATE_APPLIED', 0);
defined('BID_STATE_PAUSED') || define('BID_STATE_PAUSED', 2);

defined('BID_PROGRESS_APPLIED') || define('BID_STATE_APPLIED', 0);
defined('BID_PROGRESS_INTERVIEWS') || define('BID_PROGRESS_INTERVIEWS', 1);
defined('BID_PROGRESS_OFFER') || define('BID_PROGRESS_OFFER', 2);
defined('BID_PROGRESS_HIRED') || define('BID_PROGRESS_HIRED', 3);


defined('EMPLOYER')   || define('EMPLOYER', 1);
defined('FREELANCER') || define('FREELANCER', 2);

defined('JOB_ENDED')  || define('JOB_ENDED', 1);

defined('PAYMENT_HOURLY_CONTRACT_PLAN') || define('PAYMENT_HOURLY_CONTRACT_PLAN', 'pay-hourly-contracts');

defined('INVOICE_UNPAID')          || define('INVOICE_UNPAID', 'UNPAID');
defined('INVOICE_PAID')            || define('INVOICE_PAID', 'PAID');
defined('INVOICE_PROCESSING_PAID') || define('INVOICE_PROCESSING_PAID', 'PROCESSING_FAILED');


defined('WITHDRAW_PAYPAL')    || define('WITHDRAW_PAYPAL', 'paypal');
defined('WITHDRAW_SKRILL')    || define('WITHDRAW_SKRILL', 'skrill');
defined('WITHDRAW_PAYONEER')  || define('WITHDRAW_PAYONEER', 'payoneer');

defined('WITHDRAW_PROCESSED')    || define('WITHDRAW_PROCESSED', 'processed');
defined('WITHDRAW_PENDING')    || define('WITHDRAW_PENDING', 'pending');


defined('POSTED_JOB_VALID_DURATION')  || define('POSTED_JOB_VALID_DURATION', 30); //30 days before display job expiration.