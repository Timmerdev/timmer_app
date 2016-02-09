            $("ul.nav-tabs a").click(function (e) {
              e.preventDefault();  
                $(this).tab('show');
            });

        // load first tab content
        $('#home').load($('.active a').attr("data-url"),function(result){
          $('.active a').tab('show');
        });

        $('.collapse').collapse();



        $( "#datepicker" ).datepicker({
            showOtherMonths: true,
            dateFormat:"DD, d MM, yy",
            changeMonth: true,
            changeYear: true,
            minDate: "D",
            selectOtherMonths: true,
            altField: "#altDate",
            altFormat: "d/m/yy",
            showButtonPanel: true
        });

        $( "#getDate" ).datepicker({
            showOtherMonths: true,
            dateFormat:"DD, d MM, yy",
            changeMonth: true,
            changeYear: true,
            minDate: "D",
            selectOtherMonths: true,
            altField: "#alternate",
            altFormat: "d/m/yy",
            showButtonPanel: true
        });

        $( "#slider-range-min1" ).slider({
            range: "min",
            value: 0,
            min: 0,
            max: 24,
            slide: function( event, ui ) {
                $( "#hour1" ).val(ui.value);
            }
        });
        $( "#hour1" ).val($( "#slider-range-min1" ).slider( "value" ));


        $( "#slider-range-min2" ).slider({
            range: "min",
            value: 30,
            min: 0,
            max: 59,
            slide: function( event, ui ) {
                $( "#min1" ).val(ui.value);
            }
        });
        $( "#min1" ).val($( "#slider-range-min2" ).slider( "value" ));

         $( "#slider-range-min3" ).slider({
            range: "min",
            value: 0,
            min: 0,
            max: 24,
            slide: function( event, ui ) {
                $( "#hour2" ).val(ui.value);
            }
        });
        $( "#hour2" ).val($( "#slider-range-min3" ).slider( "value" ));


        $( "#slider-range-min4" ).slider({
            range: "min",
            value: 30,
            min: 0,
            max: 59,
            slide: function( event, ui ) {
                $( "#min2" ).val(ui.value);
            }
        });
        $( "#min2" ).val($( "#slider-range-min4" ).slider( "value" ));

$('#idTourDateDetails').datepicker({
            dateFormat:"DD, d MM, yy",
            changeMonth: true,
            changeYear: true,
            altField: "#idTourDateDetailsHidden",
            altFormat: "d/m/yy",
     beforeShow: function()
      {
           setTimeout(function()
           {
               $(".ui-datepicker").css("z-index", 99999999);
           }, 10); 
      }
 });


$('body').scrollspy({ target: '#my-nav' });