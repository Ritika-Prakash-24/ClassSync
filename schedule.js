// Using FullCalendar for Schedule Page
document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: '/api/schedules',  // Assumes backend API is set up to return JSON events
      eventClick: function(info) {
        // Show Modal with event details
        alert('Class Details:\n' + info.event.title);
      }
    });
    calendar.render();
  });
  