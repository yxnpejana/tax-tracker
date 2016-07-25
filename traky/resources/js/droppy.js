$(document).ready(function(){
        var redirect = window.location.origin+'/tax_types/view_all/';
        console.log(redirect);
        
        //Authorization
        $.getJSON("https://www.dropbox.com/oauth2/authorize?response_type='token'\n\
                    &client_id='dd2e64zfiau3zpo'", function(data){
            console.log(data);
        });
        
});

