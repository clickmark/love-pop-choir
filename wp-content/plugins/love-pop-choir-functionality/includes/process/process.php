<?php
/**
* Process - Process
* 
* File to handle the header function checks
*/

function lovepopchoir_header(){
	
    /* 
     *
     * Initialise the lovepopchoir redirects
     *
     */

    lovepopchoir_redirects();

     /*
     *
     * Guest submits registration form 
     *
     */
    
	/*
	if(is_page('guest/register')):

        guest_register();

    endif; //is register success page
	*/
	
}

function lovepopchoir_footer() {
	
	//free_trial_dates();
    
}

?>