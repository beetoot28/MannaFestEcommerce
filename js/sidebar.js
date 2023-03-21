  $(document).ready(function () {
        
          $('#slideleft').click(function() { 
            $(this).addClass('d-none');
            $('#slideright').removeClass('d-none');
           
            $('.sidenav').animate({
                  left: '-200px'
              },150);
            $('.main').css("margin-left","0");
            
           

          })

             $('#slideright').click(function() { 
               $(this).addClass('d-none');
            $('#slideleft').removeClass('d-none');
           // $('.sidenav').css( "width", "200px" );
           $('.sidenav').animate({
                  left: '0px'
              },105);

            $('.main').css("margin-left","200px");

            $('.main').animate({left:'200px'})
            
          })

          if ($(window).width() <= 768) { 
            $('#slideleft').addClass('d-none');
            $('#slideright').removeClass('d-none');
           
            $('.sidenav').animate({
                  left: '-200px'
              },150);
            $('.main').css("margin-left","0");
            
          } 

        });