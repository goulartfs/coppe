jQuery(function(){
    jQuery('.disabled input').attr('readonly',true);

    //Equipe
    jQuery('.social_background a').click(function(){
        window.open(jQuery(this).attr('href'));
    })
})