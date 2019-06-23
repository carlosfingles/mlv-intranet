/**
 * MLV intranet v2.0 - Web oficial del intranet del MLV
 * 
 * @link https://github.com/carlosfingles/mlv-intranet
 * @license GNU GPL V3
 * @author Carlos Zambrano (carlosfingles)
 *         Facebook : http://facebook.com/carlosfingles
 *         Twitter : @carlosfingles
 *         Instagram : @carlosfingles
 */

var Users = {
	Login: function(email, pass, remember)
	{
		$.ajax({
			type: 'POST',
			data: 'email=' + email + '&password=' + pass + '&rememberMe=' + remember,
			url: site_url + '/Kernel/Actions/userLogin.php',
			beforeSend: function(data)
			{
                $("#login").attr('Disabled', '');
				$("#login").html('Cargando...');
                $('#email').removeClass('is-invalid');
                $('#password').removeClass('is-invalid');
			},
			success: function(data)
			{
                var dtos = data.split(",");
                var nulo = null;
                if(dtos[1]=="logueado"){
                    if(dtos[0].trim()=="remOn"){
                        Cookies.set('RememberMe', email, { expires: 15 });
                    }else{
                        Cookies.set('RememberMe', nulo, { expires: 15 });
                    }
                    location.reload();
                } 
                if(dtos[1]=="baneado"){
                    $('#email').addClass('is-invalid');
                    $("#resultEmail").html(dtos[0]);
                    $("#login").removeAttr('Disabled');
				    $("#login").html('Aceptar');
                }
                if(dtos[1]=="userNot"){
                    $('#email').addClass('is-invalid');
                    $("#resultEmail").html(dtos[0]);
                    $("#login").removeAttr('Disabled');
				    $("#login").html('Aceptar');
                }
                if(dtos[1]=="passInValid"){
                    $('#password').addClass('is-invalid');
                    $("#resultPass").html(dtos[0]);
                    $("#login").removeAttr('Disabled');
				    $("#login").html('Aceptar');
                }
                if(dtos[1]=="inputsNull"){
                    if(email ==''){
                       $('#email').addClass('is-invalid');
                       $("#resultEmail").html('No puedes dejar este campo vacio.');
                    }
                    if(pass ==''){
                       $('#password').addClass('is-invalid');
                        $("#resultPass").html('No puedes dejar este campo vacio.');
                    }
                    $("#login").removeAttr('Disabled');
				    $("#login").html('Aceptar');
                }
                                                    
			}
		});
	},

	editProfile: function(reg_name, reg_lastname, reg_CI, reg_birthdate, reg_profession, reg_codephone, reg_phone, reg_wtpp, reg_tlg, reg_country, reg_states, reg_city, reg_ideology, reg_social, reg_economic, reg_anotherOrganization, reg_net1, reg_net2, reg_net3, reg_collabNet, reg_collabVoluntary, reg_collabEvents, reg_collabFunds, reg_collabOther)
	{
        if( (reg_net1.indexOf("@") > -1) || (reg_net1.indexOf("http") > -1) ){
            $.ajax({
                type: 'POST',
                data: 'reg_name=' + reg_name + '&reg_lastname='  + reg_lastname + '&reg_CI=' + reg_CI + '&reg_birthdate=' + reg_birthdate + '&reg_profession=' + reg_profession + '&reg_codephone=' + reg_codephone + '&reg_phone=' + reg_phone + '&reg_wtpp=' + reg_wtpp + '&reg_tlg=' + reg_tlg + '&reg_country=' + reg_country + '&reg_states=' + reg_states + '&reg_city=' + reg_city + '&reg_ideology=' + reg_ideology + '&reg_social=' + reg_social + '&reg_economic=' + reg_economic + '&reg_anotherOrganization=' + reg_anotherOrganization + '&reg_net1=' + reg_net1 + '&reg_net2=' + reg_net2 + '&reg_net3=' + reg_net3 + '&reg_collabNet=' + reg_collabNet + '&reg_collabVoluntary=' + reg_collabVoluntary + '&reg_collabEvents=' + reg_collabEvents + '&reg_collabFunds=' + reg_collabFunds + '&reg_collabOther=' + reg_collabOther,
                url: site_url + '/Kernel/Actions/editProfile.php',

                beforeSend: function()
                {
                    $("#pro_saved").attr('Disabled', '');
                    $("#pro_saved").html('Cargando...');
                    $('#reg_name').removeClass('is-invalid');
                    $('#reg_lastname').removeClass('is-invalid');

                    $('#reg_CI').removeClass('is-invalid');
                    $('#reg_birthdate').removeClass('is-invalid');
                    $('#reg_profession').removeClass('is-invalid');
                    $('#reg_codephone').removeClass('is-invalid');
                    $('#reg_phone').removeClass('is-invalid');
                    $('#reg_country').removeClass('is-invalid');
                    $('#reg_states').removeClass('is-invalid');
                    $('#reg_ideology').removeClass('is-invalid');
                    $('#reg_net1').removeClass('is-invalid');
                    $('#reg_collabNet').removeClass('is-invalid');
                    $('#reg_collabVoluntary').removeClass('is-invalid');
                    $('#reg_collabEvents').removeClass('is-invalid');
                    $('#reg_collabFunds').removeClass('is-invalid');

                },
                success: function(data)
                {
                    if(reg_name == ''){
                        $('#reg_name').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_lastname == ''){
                        $('#reg_lastname').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }

                    if(reg_CI == ''){
                        $('#reg_CI').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_birthdate == ''){
                        $('#reg_birthdate').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_birthdate == 'aaaa-mm-dd'){
                        $('#reg_birthdate').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_profession == ''){
                        $('#reg_profession').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_codephone == ''){
                        $('#reg_codephone').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_phone == ''){
                        $('#reg_phone').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_country == ''){
                        $('#reg_country').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_country == 'nulo'){
                        $('#reg_country').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_states == ''){
                        $('#reg_states').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_states == 'nulo'){
                        $('#reg_states').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_ideology == ''){
                        $('#reg_ideology').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_net1 == ''){
                        $('#reg_net1').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_collabNet == ''){
                        $('#reg_collabNet').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_collabVoluntary == ''){
                        $('#reg_collabVoluntary').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_collabEvents == ''){
                        $('#reg_collabEvents').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }
                    if(reg_collabFunds == ''){
                        $('#reg_collabFunds').addClass('is-invalid');
                        $("#pro_saved").removeAttr('Disabled');
                        $("#pro_saved").html('Aceptar');
                    }

                    $('#restEditProfile').html(data);
                    $("#pro_saved").removeAttr('Disabled');
                    $("#pro_saved").html('Actualizar');
                }
            });
        }else{
            $('#reg_net1').addClass('is-invalid');
            $("#pro_saved").removeAttr('Disabled');
            $("#pro_saved").html('Aceptar');
        }
	},
    
    editConfiguration: function(mail, pass, repeatpass, actualpass)
	{
		$.ajax({
			type: 'POST',
			data: 'edit_email=' + mail + '&edit_password=' + pass + '&edit_repeatpass=' + repeatpass + '&edit_actualpass=' + actualpass,
			url: site_url + '/Kernel/Actions/editConfiguration.php',
			beforeSend: function(data)
			{
				$("#cong_save").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
                
                $("#cong_save").attr('disabled' , '');
			},
			success: function(data)
			{
                if(mail == '' || mail == undefined){
                    $("#edit_email").addClass('is-invalid');
                }
                if(mail != '' || mail != undefined){
                    $("#edit_email").addClass('is-valid');
                }
                
                if(pass == repeatpass && pass !='' && repeatpass != '' && pass != undefined && repeatpass != undefined){
					$("#edit_password").addClass('is-valid');
                    $("#edit_repeatpass").addClass('is-valid');
                }
                
                if(pass != repeatpass){
					$("#edit_password").addClass('is-invalid');
                    $("#edit_repeatpass").addClass('is-invalid');
                }
            
				if(actualpass == '' || actualpass == undefined){
					$("#edit_actualpass").addClass('is-invalid');
                }
                if(actualpass != '' || actualpass != undefined){
					$("#edit_actualpass").addClass('is-valid');
                }
                
                $("#cong_res").html(data);
                $("#cong_save").removeAttr('disabled')
				$("#cong_save").html('Guardar');
			}
		});
	},

	userRegister: function(reg_name, reg_lastname, reg_username, reg_email, reg_password, reg_CI, reg_birthdate, reg_profession, reg_codephone, reg_phone, reg_wtpp, reg_tlg, reg_country, reg_states, reg_city, reg_ideology, reg_social, reg_economic, reg_anotherOrganization, reg_net1, reg_net2, reg_net3, reg_collabNet, reg_collabVoluntary, reg_collabEvents, reg_collabFunds, reg_collabOther)
	{
        if( (reg_net1.indexOf("@") > -1) || (reg_net1.indexOf("http") > -1) ){
            $.ajax({
                type: 'POST',
                data: 'reg_name=' + reg_name + '&reg_lastname='  + reg_lastname + '&reg_username=' + reg_username + '&reg_email=' + reg_email  + '&reg_password=' + reg_password + '&reg_CI=' + reg_CI + '&reg_birthdate=' + reg_birthdate + '&reg_profession=' + reg_profession + '&reg_codephone=' + reg_codephone + '&reg_phone=' + reg_phone + '&reg_wtpp=' + reg_wtpp + '&reg_tlg=' + reg_tlg + '&reg_country=' + reg_country + '&reg_states=' + reg_states + '&reg_city=' + reg_city + '&reg_ideology=' + reg_ideology + '&reg_social=' + reg_social + '&reg_economic=' + reg_economic + '&reg_anotherOrganization=' + reg_anotherOrganization + '&reg_net1=' + reg_net1 + '&reg_net2=' + reg_net2 + '&reg_net3=' + reg_net3 + '&reg_collabNet=' + reg_collabNet + '&reg_collabVoluntary=' + reg_collabVoluntary + '&reg_collabEvents=' + reg_collabEvents + '&reg_collabFunds=' + reg_collabFunds + '&reg_collabOther=' + reg_collabOther,
                url: site_url + '/Kernel/Actions/userRegister.php',

                beforeSend: function(data)
                {
                    $("#register").attr('Disabled', '');
                    $("#register").html('Cargando...');
                    $('#reg_username').removeClass('is-invalid');
                    $('#reg_name').removeClass('is-invalid');
                    $('#reg_lastname').removeClass('is-invalid');
                    $('#reg_email').removeClass('is-invalid');
                    $('#reg_password').removeClass('is-invalid');

                    $('#reg_CI').removeClass('is-invalid');
                    $('#reg_birthdate').removeClass('is-invalid');
                    $('#reg_profession').removeClass('is-invalid');
                    $('#reg_codephone').removeClass('is-invalid');
                    $('#reg_phone').removeClass('is-invalid');
                    $('#reg_country').removeClass('is-invalid');
                    $('#reg_states').removeClass('is-invalid');
                    $('#reg_ideology').removeClass('is-invalid');
                    $('#reg_net1').removeClass('is-invalid');
                    $('#reg_collabNet').removeClass('is-invalid');
                    $('#reg_collabVoluntary').removeClass('is-invalid');
                    $('#reg_collabEvents').removeClass('is-invalid');
                    $('#reg_collabFunds').removeClass('is-invalid');

                },
                success: function(data)
                {
                    var dtosReg = data.split(",");

                     if(dtosReg[1].trim()=="registrado"){
                            Cookies.set('RememberMe', reg_email, { expires: 15 });
                            location.reload();
                    }
                    if(dtosReg[1].trim()=="errorEmail"){
                        $('#reg_email').addClass('is-invalid');
                        $("#resultRegEmail").html(dtosReg[0]);
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_email == ''){
                        $('#reg_email').addClass('is-invalid');
                        $("#resultRegEmail").html('No puedes dejar este campo vacio.');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_username == ''){
                        $('#reg_username').addClass('is-invalid');
                        $("#resultRegUsername").html('No puedes dejar este campo vacio.');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(dtosReg[1].trim()=="errorUser"){
                        $('#reg_username').addClass('is-invalid');
                        $("#resultRegUsername").html(dtosReg[0]);
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_name == ''){
                        $('#reg_name').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_lastname == ''){
                        $('#reg_lastname').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_password == ''){
                        $('#reg_password').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }

                    if(reg_CI == ''){
                        $('#reg_CI').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_birthdate == ''){
                        $('#reg_birthdate').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_birthdate == 'aaaa-mm-dd'){
                        $('#reg_birthdate').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_profession == ''){
                        $('#reg_profession').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_codephone == ''){
                        $('#reg_codephone').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_phone == ''){
                        $('#reg_phone').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_country == ''){
                        $('#reg_country').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_country == 'nulo'){
                        $('#reg_country').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_states == ''){
                        $('#reg_states').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_states == 'nulo'){
                        $('#reg_states').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_ideology == ''){
                        $('#reg_ideology').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_net1 == ''){
                        $('#reg_net1').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_collabNet == ''){
                        $('#reg_collabNet').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_collabVoluntary == ''){
                        $('#reg_collabVoluntary').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_collabEvents == ''){
                        $('#reg_collabEvents').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }
                    if(reg_collabFunds == ''){
                        $('#reg_collabFunds').addClass('is-invalid');
                        $("#register").removeAttr('Disabled');
                        $("#register").html('Aceptar');
                    }

                    if(dtosReg[1].trim()=="loginTrue"){
                        $('#resultRegEmail').addClass('is-invalid');
                        $("#resultEmail").html(dtosReg[0]);
                        location.reload();
                    }
                }
            });
        }else{
            $('#reg_net1').addClass('is-invalid');
            $("#register").removeAttr('Disabled');
            $("#register").html('Aceptar');
        }
	}
};