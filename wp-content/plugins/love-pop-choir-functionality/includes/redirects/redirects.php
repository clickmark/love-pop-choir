<?php
  /**
   * Redirects - General
   * 
   * Functions which check if the users needs to be redirected to a specific page
   */

    function lovepopchoir_redirects(){
    
        /* Define the session data */
        //session_start();

        /********************************************
        * 
        * Redirects for logged in guests and hosts
        *
        ********************************************/

        /* Check if user is logged in */
        if(is_user_logged_in()):

            /* get user type */
            $user = wp_get_current_user();

            /* 
             * _______ Redirects 
             */
            if ( in_array( '______', (array) $user->roles ) ):

                /* ____ blacklisted pages */
                if(
                    (is_page('blacklisted page1'))||
                    (is_page('blacklisted page2'))
                ):

                    /* 
                     * Logged in guest accessing blacklist page, 
                     * redirect to the guest my page
                     */

                    header('location: '. get_home_url() . '/my-account'); 

                endif;

            else:
        
                /* 
                 *
                 * Must be an admin user, do not redirect away from hidden pages
                 *
                 */
        
            endif; //blacklisted pages

        else: 

            /***********************************
             * 
             * Logged out user blacklist
             * 
             ***********************************/
        
            /* 
             * _____ Redirects 
             */ 
            if(
               (is_page('blacklisted page1'))||
               (is_page('blacklisted page2'))
            ):
        
                /*
                 * Redirect user to the guest login page
                 */
                
                header('location: '. get_home_url() . '/my-account'); 
                
           endif;
		
        endif; //user logged in check
        
    }

?>