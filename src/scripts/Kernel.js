/**
 * InfoSmart JavaScript Kernel.
 *
 * Archivo de procesamiento para JavaScipt con jQuery
 * recomendado para todas las aplicaciones de InfoSmart.
 *
 * InfoSmart. Todos los derechos reservados.
 * Copyright 2011 - Iv�n Bravo Bravo.
 * http://www.infosmart.mx/ - http://www.jquery.com/
**/

var Kernel = {

	TimeDate : function(time, hour)
	{
		if(!this.IsNumeric(time))
			return "";
			
		var result = "";
		
		try {
			var date = new Date(time * 1000);
			result = date.getDay() + "-" + date.getMonth() + "-" + date.getFullYear();
			
			if(hour == true)
				result += " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
				
		} catch(e) { }
			
		return result;
	},
	
	DateTime : function(date)
	{
		var result = "";
		
		try {
			var d = new Date(date);
			result = d.getTime() / 1000.0;
		} catch(e) { }
		
		return result;
	},
	
	CalculateTime: function(time)
	{
		var inte = ["segundo", "minuto", "hora", "d�a", "semana", "mes", "a�o"];
		var dur = [60, 60, 24, 7, 4.35, 12];
		
		time = parseInt(time);
		var now = parseInt(this.UnixTime());
		var j = 0;
		
		var dif = 0;
		var str = "";
		
		var sh = time + 10;
		
		if(now == time || now < sh)
			return "Justo ahora";
		else if(now > time)
		{
			dif = now - time;
			str = "Hace";
		}
		else
		{
			dif = time - now;
			str = "Dentro de";
		}
		
		for(j = 0; dif >= dur[j] && j < dur.length - 1; j++)
			dif /= dur[j];
			
		dif = Math.round(dif);
		
		if(dif != 1)
		{
			inte[5] += "e";
			inte[j] += "s";
		}
		
		return str + " " + dif + " " + inte[j];
	},
	
	UnixTime: function() 
	{
		return Math.round((new Date()).getTime() / 1000);
	},
	
	FilterHash: function()
	{
		return document.location.hash.substring(2);	
	}
}

function Location(Url)
{
	if(Url == "undefined")
		return false;
	
	window.location = Url;
	return true;
}
