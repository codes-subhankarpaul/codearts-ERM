// JavaScript Document
jQuery('#custom-owl').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

jQuery('.multi-field-wrapper').each(function() {
    var $wrapper = jQuery('.multi-fields', this);
    jQuery(".add-field", jQuery(this)).click(function(e) {
        jQuery('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });
   jQuery('.multi-field .remove-field', $wrapper).click(function() {
        if (jQuery('.multi-field', $wrapper).length > 1)
            jQuery('.multi-field:first-child').remove();
    });
});


jQuery('.multi-field-wrapper-2').each(function() {
    var $wrapper = jQuery('.multi-fields-2', this);
    jQuery(".add-field-2", jQuery(this)).click(function(e) {
        jQuery('.multi-field-2:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });
   jQuery('.multi-field-2 .remove-field-2', $wrapper).click(function() {
        if (jQuery('.multi-field-2', $wrapper).length > 1)
            jQuery('.multi-field-2:first-child').remove();
    });
});



jQuery(document).ready(function(){
  jQuery('.datetimepicker').datepicker({
      timepicker: true,
      language: 'en',
      range: true,
      multipleDates: true,
		  multipleDatesSeparator: " - "
    });
  jQuery("#add-event").submit(function(){
      alert("Submitted");
      var values = {};
      $.each($('#add-event').serializeArray(), function(i, field) {
          values[field.name] = field.value;
      });
      console.log(
        values
      );
  });
});

(function () {    
    'use strict';
    // ------------------------------------------------------- //
    // Calendar
    // ------------------------------------------------------ //
	jQuery(function() {
		// page is ready
		jQuery('#calendar').fullCalendar({
			themeSystem: 'bootstrap4',
			// emphasizes business hours
			businessHours: false,
			defaultView: 'month',
			// event dragging & resizing
			editable: true,
			// header
			header: {
				left: 'title',
				center: 'month,agendaWeek,agendaDay',
				right: 'today prev,next'
			},
			events: [
				{
					title: 'Barber',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-07-07',
					end: '2019-07-07',
					className: 'fc-bg-default',
					icon : "circle"
				},
				{
					title: 'Flight Paris',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-08-08T14:00:00',
					end: '2019-08-08T20:00:00',
					className: 'fc-bg-deepskyblue',
					icon : "cog",
					allDay: false
				},
				{
					title: 'Team Meeting',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-07-10T13:00:00',
					end: '2019-07-10T16:00:00',
					className: 'fc-bg-pinkred',
					icon : "group",
					allDay: false
				},
				{
					title: 'Meeting',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-08-12',
					className: 'fc-bg-lightgreen',
					icon : "suitcase"
				},
				{
					title: 'Conference',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-08-13',
					end: '2019-08-15',
					className: 'fc-bg-blue',
					icon : "calendar"
				},
				{
					title: 'Baby Shower',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-08-13',
					end: '2019-08-14',
					className: 'fc-bg-default',
					icon : "child"
				},
				{
					title: 'Birthday',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-09-13',
					end: '2019-09-14',
					className: 'fc-bg-default',
					icon : "birthday-cake"
				},
				{
					title: 'Restaurant',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-10-15T09:30:00',
					end: '2019-10-15T11:45:00',
					className: 'fc-bg-default',
					icon : "glass",
					allDay: false
				},
				{
					title: 'Dinner',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-11-15T20:00:00',
					end: '2019-11-15T22:30:00',
					className: 'fc-bg-default',
					icon : "cutlery",
					allDay: false
				},
				{
					title: 'Shooting',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-08-25',
					end: '2019-08-25',
					className: 'fc-bg-blue',
					icon : "camera"
				},
				{
					title: 'Go Space :)',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-12-27',
					end: '2019-12-27',
					className: 'fc-bg-default',
					icon : "rocket"
				},
				{
					title: 'Dentist',
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					start: '2019-12-29T11:30:00',
					end: '2019-12-29T012:30:00',
					className: 'fc-bg-blue',
					icon : "medkit",
					allDay: false
				}
			],
			eventRender: function(event, element) {
				if(event.icon){
					element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");
				}
			  },
			dayClick: function() {
				jQuery('#modal-view-event-add').modal();
			},
			eventClick: function(event, jsEvent, view) {
			        jQuery('.event-icon').html("<i class='fa fa-"+event.icon+"'></i>");
					jQuery('.event-title').html(event.title);
					jQuery('.event-body').html(event.description);
					jQuery('.eventUrl').attr('href',event.url);
					jQuery('#modal-view-event').modal();
			},
		})
	});
  
})(jQuery);





function formatRows(start, end, project, type, issue, comment, remarks) {
  return '<tr><td><select  value="' +start+ '" class="form-control editable"><option>12.00 am</option><option>12.30am</option>					  <option>1am</option><option>1.30am</option><option>2am</option><option>2.30am</option><option>3am</option><option>3.30am</option>  <option>4am</option><option>4.30am</option><option>5am</option><option>5.50am</option><option>6am</option><option>6.30am</option><option>7am</option><option>7.30am</option><option>8am</option><option>8.30am</option><option>9am</option><option>9.30am</option><option>10am</option><option>10.30am</option><option>11am</option><option>11.30am</option><option>12pm</option><option>12.30pm</option><option>1pm</option><option>1.30pm</option><option>2pm</option><option>2.30pm</option><option>3pm</option><option>3.30pm</option><option>4pm</option><option>4.30pm</option><option>5pm</option><option>5.30pm</option><option>6pm</option><option>6.30pm</option><option>7pm</option><option>7.30pm</option><option>8pm</option><option>8.30pm</option><option>9pm</option><option>9.30pm</option><option>10pm</option><option>10.30pm</option><option>11pm</option><option>11.30pm</option></select></td>' +
  '<td><select  value="' +end+ '" class="form-control editable"><option>12.00 am</option><option>12.30am</option>					  <option>1am</option><option>1.30am</option><option>2am</option><option>2.30am</option><option>3am</option><option>3.30am</option>  <option>4am</option><option>4.30am</option><option>5am</option><option>5.50am</option><option>6am</option><option>6.30am</option><option>7am</option><option>7.30am</option><option>8am</option><option>8.30am</option><option>9am</option><option>9.30am</option><option>10am</option><option>10.30am</option><option>11am</option><option>11.30am</option><option>12pm</option><option>12.30pm</option><option>1pm</option><option>1.30pm</option><option>2pm</option><option>2.30pm</option><option>3pm</option><option>3.30pm</option><option>4pm</option><option>4.30pm</option><option>5pm</option><option>5.30pm</option><option>6pm</option><option>6.30pm</option><option>7pm</option><option>7.30pm</option><option>8pm</option><option>8.30pm</option><option>9pm</option><option>9.30pm</option><option>10pm</option><option>10.30pm</option><option>11pm</option><option>11.30pm</option></select></td>' +
  '<td><select  value="' +project+ '"  class="form-control editable"><option>#123456</option><option>#123457</option>				  <option>#123458</option><option>#123459</option><option>#123450</option></select></td>' +  
'<td><select value="' +type+ '"  class="form-control"><option>Type A</option><option>Type B</option><option>Type C</option><option>Type D</option><option>Type E</option></select></td>' +
 '<td><select value="' +issue+ '"   class="form-control"><option>Issue No. 1</option><option>Issue No. 2</option><option>Issue No. 3</option>	<option>Issue No. 4</option><option>Issue No. 5</option></select></td>' +
 '<td><input type="text" class="form-control editable" placeholder="" /></td>' +
	   '<td><input type="text" class="form-control editable" placeholder="" /><a class="dlt-btn-dp" href="#" onClick="deleteRow(this)"><i class="fas fa-trash-alt"></i></a></td>';
};

function deleteRow(trash) {
  jQuery(trash).closest('tr').remove();
};

function addRow() {
  var start = jQuery('.addStart').val();
  var end = jQuery('.addEnd').val();
  var project = jQuery('.addProject').val();
  var type = jQuery('.addType').val();
  var issue = jQuery('.addIssue').val();
var comment = jQuery('.addComment').val();
	var remarks = jQuery('.addRemarks').val();
  jQuery(formatRows(start,end,project,type,issue,comment,remarks)).insertAfter('#addRow');
  jQuery(input).val('');  
}

jQuery('.addBtn').click(function()  {
  addRow();
});





function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = jQuery('.custom-main-salary-slip')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Test.pdf');
    }, margins);
};

jQuery(document).ready(function() {
  jQuery("#example").DataTable();
});



d = new Date();
weekendTimes = [
  "11:00",
  "11:30",
  "12:00",
  "12:30",
  "13:00",
  "13:30",
  "14:00",
  "14:30",
  "15:00",
  "15:30",
  "16:00",
  "16:30",
  "17:00",
  "17:30"
];
weekdayTimes = [
  "7:00",
  "7:30",
  "8:00",
  "8:30",
  "9:00",
  "9:30",
  "10:00",
  "10:30",
  "11:00",
  "11:30",
  "12:00",
  "12:30",
  "13:00",
  "13:30",
  "14:00",
  "14:30"
];

if (d.getDay() == 6 || d.getDay() == 0) {
  times = weekendTimes;
} else {
  times = weekdayTimes;
}

var datePickerTime = function (currentDateTime) {
  // 'this' is jquery object datetimepicker
  var day = currentDateTime.getDay();
  if (day === 0 || day === 6) {
    this.setOptions({
      allowTimes: weekendTimes
    });
  } else {
    this.setOptions({
      allowTimes: weekdayTimes
    });
  }
};
jQuery("#datetimepicker_unixtime , #datetimepicker_unixtime-1").datetimepicker({
  inline: false,
  minDate: 0,
  onSelectDate: datePickerTime,
  defaultDate: d,
  allowTimes: times,
  formatTime: "h:i a",
  step: 60,
  format: "d/m/y h:i a",
  onGenerate: function (hu) {
    jQuery(this)
      .find(".xdsoft_date.xdsoft_day_of_week5")
      .addClass("xdsoft_disabled");
  }
});
jQuery("#CalendarBtn").click(function () {
  jQuery("#datetimepicker_unixtime , #datetimepicker_unixtime-1").datetimepicker("show"); //support hide,show and destroy command
});

// Saraswata js used for task module ..

$('.ui.dropdown')
  .dropdown()
;

$(document).ready(function() {
  $(".js-example-basic-single").select2();
});



webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
$.webshims.formcfg = {
en: {
    dFormat: '-',
    dateSigns: '-',
    patterns: {
        d: "yy-mm-dd"
    }
}
};

var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;       
document.getElementById("theDate").value = today;







