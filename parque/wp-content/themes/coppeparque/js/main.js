jQuery(function(){
    jQuery('.disabled input').attr('readonly',true);

    //Equipe
    jQuery('.social_background a').click(function(){
        window.open(jQuery(this).attr('href'));
    })

    jQuery('.breadcrumb a').each(function(){
        if(jQuery(this).attr('href').indexOf('id=17')!=-1){
            jQuery(this).attr('href','javascript:void(0)');
            jQuery(this).click(function(e){
                e.preventDefault();
            });
        }
    });

    jQuery('.populate-empresas select').change(function(){
        jQuery('.email-destino-empresa input').attr('value', jQuery(this).val()!='null'?jQuery(this).val():'');
        jQuery('.nome-empresa input').attr('value',jQuery(this).val()!='null'?jQuery(this).find('option:selected').html():'');
    });
})