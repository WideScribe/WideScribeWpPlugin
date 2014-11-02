/* 
 ** Plugin Name: Widescribe Simulator
* Plugin URI: http://www.widescribe.com
* Description: This plugin simulates an WideScribe installation on your site 
* Version: 1.0
* Author: Jens Tandstad, WIDESCRIBE AS
* Author URI: jens@widescribe.com
* License: GPL-2.0+
 */


(function ($) {
"use strict";
$(function () {
// Place your public-facing JavaScript here
   
    var uniqueVisitorsPerWeek = 0;
    var registerConversionRate =0;
    var topupConversionRate =0;
    var subscriptionConversionRate =0;
    var numberOfWeeks =0;
    var averageSubscriptionLength =0;
    // Assign Change events to the sliders in the view
    jQuery( "#uniqueVisitorsPerWeek" ).on('change', function(){
        uniqueVisitorsPerWeek = jQuery( "#uniqueVisitorsPerWeek" ).val();
          update();
    });
    
      jQuery( "#registerConversionRate" ).on('change', function(){
        registerConversionRate = jQuery( "#registerConversionRate" ).val();
          update();
    });
      jQuery( "#topupConversionRate" ).on('change', function(){
        topupConversionRate = jQuery( "#topupConversionRate" ).val();
          update();
    });
    
    jQuery( "#subscriptionConversionRate" ).on('change', function(){
        subscriptionConversionRate = jQuery( "#subscriptionConversionRate" ).val();
          update();
    });
    
    jQuery( "#numberOfWeeks" ).on('change', function(){
        numberOfWeeks = jQuery( "#numberOfWeeks" ).val();
        update();
    });
      jQuery( "#averageSubscriptionLength" ).on('change', function(){
        averageSubscriptionLength = jQuery( "#averageSubscriptionLength" ).val();
        update();
    });
      jQuery( "#calculateBtn" ).on('click', function(){
    
        calculate();
    });
    
    // Trigger initial change event to populate legend boxes
    $("#uniqueVisitorsPerWeek").trigger("change");
    $("#registerConversionRate").trigger("change");
    $("#topupConversionRate").trigger("change");
    $("#subscriptionConversionRate").trigger("change");
    $("#numberOfWeeks").trigger("change");
    $("#averageSubscriptionLength").trigger("change");
    
 
    function update(){
       
        // Apply calculated values to the information boxe
        jQuery( "#uniqueVisitorsPerWeekTxt" ).html(uniqueVisitorsPerWeek +' unique visitors');
        jQuery( "#registerConversionRateTxt" ).html(Math.round(registerConversionRate, 2)+'%');
        jQuery( "#topupConversionRateTxt" ).html(Math.round(topupConversionRate, 2)+'%');
        jQuery( "#subscriptionConversionRateTxt" ).html(Math.round(subscriptionConversionRate, 2)+'%');
        jQuery( "#numberOfWeeksTxt" ).html(Math.round(numberOfWeeks) + ' weeks');
        jQuery( "#averageSubscriptionLengthTxt" ).html(averageSubscriptionLength+ ' weeks');
      
    }
    // Perform the calculations
    function calculate(){
        var newIncomePPA =0;        // PPA income for each iteration
        var newIncomePPAS =0;        // PPAs income for each iteration
        var newIncomeKickback =0;   // Kickback income for each iteration
        var incomePPA = 0       // Total PPA income
        var incomePPAS = 0;     // Total PPAS income
        var incomeKickback = 0; // Total Kickback income
        var newReg = 0; // New registration this iterations
        var reg = 0;    // Total number of registered users
        var topup = 0;  // Total number of users opted to top up customers
        var newSubsc = 0;   // New subscribers this iteration
        var subsc = 0;  //Total number of active number of subscribers
        var totalSubsc = 0; // Total number of converted subscribers
        var lost = 0;   // Subscribers lost this turn
        var lostSubsc = 0; // Total lost subscribers
        
        // Variables
        
        var avgPPA = 2; // Average price on site
        var avgPPAconsumption = 5; // Average PPA conumsption each week;
        var avgKickback = 6.23; // Monte Carlo sampled avg kickback - dependent on 129 monthly subsc fee
        var avgPPAS = 26; // Monte carlo sampled avg PPAS consumption
        var wideScribePenetration = 0; // Percentage of unique weekly visists that are active subscribers
        var registrationPenetration = 0; // Percentage of unique weekly visists that are registered
        var unregisteredUserPool = uniqueVisitorsPerWeek; // Remainder of unregistered user pool. IMPLEMENT, this can be designed to grow or to renew.
      
        console.log('Performing calculation');
        
        for(var i = 1; i <= numberOfWeeks; i++){
            // For each week 
             console.log('Week '+i+' of '+numberOfWeeks);
             console.log('From a pool of '+uniqueVisitorsPerWeek+' unique visitors');
             // Calculate unregistered pool
             unregisteredUserPool = Math.max(0, uniqueVisitorsPerWeek - reg); 
             console.log('There are '+unregisteredUserPool+' users left');
             // Register conversion of unregistered pool
             newReg = (unregisteredUserPool) * (registerConversionRate/100);
           
             console.log('Registered '+newReg+' new users');
             // Add registered to registered base
             reg += newReg;
             // Calculate registration penetration
             registrationPenetration = reg / uniqueVisitorsPerWeek;
         
             // TOPUP conversion
             // Cacluate conversion for topup 
             topup += ( newReg )   * (topupConversionRate / 100);
             console.log('Of these '+topup+' decided to top up, and');
             //Abandonmentof account ratio 
             topup -= topup * (1/averageSubscriptionLength);
             // SUBSC CONVERSION
             // Calculate churn
             lost = subsc * (1/averageSubscriptionLength);
             // Add to total of lost subscriptions
             lostSubsc += lost;
             // Lost subscriptions automatically convert to paying
             topup += lost;
             // Calculate new subscribers from registered base, including topup customers
             newSubsc = (reg - subsc) * (subscriptionConversionRate /100);
             console.log(newSubsc+' became WideScribers');
             console.log('but sadly, we also lost '+lost+' subscribers');
             totalSubsc +=newSubsc;
             
             // Active subscribers 
             subsc += newSubsc - lost;
               console.log('Now total of '+subsc+' subscribers');
             // Calculate the current wideScribe penetration
             wideScribePenetration = (subsc + topup) / uniqueVisitorsPerWeek;
           
                 console.log('A penetration of '+wideScribePenetration+' %');
            
            // Money making
         
             // PPA (Pay Per Article from cash customers, minus WideScribe free, this iteration
             newIncomePPA += topup * avgPPAconsumption * avgPPA *  0.9;
             // PPAS(Pay Per Article Subscribers cash subscribers, minus WideScribe free, this iteration
             newIncomePPAS += subsc * avgPPAS *  0.9; 
             // Kickback payment this iteration
             newIncomeKickback += subsc * avgKickback * 0.9;
          
           
             console.log('Generating '+newIncomePPA+' income from PPA');
             console.log('Generating '+newIncomePPAS+' income from PPAS');
             console.log('Generating '+newIncomeKickback+' income from Kickback payments');
             // Total income PPA, PPAS and Kickback
             incomePPA += newIncomePPA;
             incomePPAS += newIncomePPAS;
             incomeKickback += newIncomeKickback;
             
        }
        
        // Apply calculated results
        
        jQuery( "#totalSubscGained" ).html(Math.round(totalSubsc));
        jQuery( "#totalSubscLost" ).html(Math.round(lostSubsc));
        jQuery( "#totalSubscActive" ).html(Math.round(subsc));
        jQuery( "#registrationPenetration" ).html(Math.round(registrationPenetration*100, 2) + '%');
        jQuery( "#widescribePenetration" ).html(Math.round(wideScribePenetration*100, 2) + '%');
        jQuery( "#incomePPA" ).html(Math.round(incomePPA)+' kr');
        jQuery( "#incomePPAS" ).html(Math.round(incomePPAS)+' kr');
        jQuery( "#incomeKickback" ).html(Math.round(incomeKickback)+ 'kr');
 
        
    }
    
    // END
});


}(jQuery));