<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/profiling.html
|
*/
$config['config'] = true;
$config['queries'] = true;
$config['memory_usage'] = true;
$config['post'] = true;
$config['uri_string'] = true;
$config['session_data'] = true;
$config['query_toggle_count'] = true;
