/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#fullcalendar').fullCalendar({
        // put your options and callbacks here
        events: '/calendar/events'
    })

});