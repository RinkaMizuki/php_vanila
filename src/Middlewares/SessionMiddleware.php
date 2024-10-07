<?php

namespace App\Middlewares;

class SessionMiddleware implements IMiddleware
{
    public function handle()
    {
        // start session task
        session_start();

        // check user don't continuous active in 60s => cancel session
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
            // last request was more than 1 minutes ago
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
        }
        // update to check for next request
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

        // avoid attack session-fixaction
        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        } else if (time() - $_SESSION['CREATED'] > 60) {
            // session started more than 1 minutes ago
            session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
            $_SESSION['CREATED'] = time();  // update creation time
        }
    }
}
