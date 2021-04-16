var Typer = {
	text: null,
	accessCountimer: null,
	index: 0, 
	speed: 2,
	file: '', 
	accessCount: 0,
  deniedCount: 0, 
  
	init: function() {
		accessCountimer = setInterval(function() {
      Typer.updLstChr();
    },500); 
		$.get(Typer.file,function(data) {
			Typer.text=data;
			Typer.text = Typer.text.slice(0, Typer.text.length-1);
		});
  },

  content: function(){
		return $("#console").html();
	},

	write: function(str){
		$("#console").append(str);
		return false;
	},

	addText: function(key){
		if(key.keyCode==18){
			Typer.accessCount++; 
			if(Typer.accessCount>=3){
				Typer.makeAccess(); 
			}
		} else if(key.keyCode==20){
			Typer.deniedCount++; 
			
			if(Typer.deniedCount>=3){
				Typer.makeDenied(); 
			}
		} else if(key.keyCode==27){ 
			Typer.hidepop(); 
		} else if(Typer.text){ 
			var cont=Typer.content(); 
			if(cont.substring(cont.length-1,cont.length) == "|") {
        $("#console").html($("#console").html().substring(0,cont.length-1)); 
      }
			if(key.keyCode!=8){ 
				Typer.index+=Typer.speed;	
			} else {
			if(Typer.index > 0) 
				Typer.index -= Typer.speed;
			}
			var text=Typer.text.substring(0,Typer.index)
			var rtn= new RegExp("\n", "g"); 
	
			$("#console").html(text.replace(rtn,"<br/>"));
			window.scrollBy(0,50); 
		}
		
		if (key.preventDefault && key.keyCode != 122) { 
			key.preventDefault()
		};  
		
		if(key.keyCode != 122){ // otherway prevent keys default behavior
			key.returnValue = false;
		}
	},

	updLstChr: function() { 
		var cont = this.content(); 
		
		if (cont.substring(cont.length-1, cont.length) == "|") {
      $("#console").html($("#console").html().substring(0,cont.length-1)); 
    } else {
      this.write("|"); // else write it
    }
	}
}

function replaceUrls(text) {
	var http = text.indexOf("http://");
	var space = text.indexOf(".me ", http);
	
	if (space != -1) { 
		var url = text.slice(http, space-1);
		return text.replace(url, "<a href=\""  + url + "\">" + url + "</a>");
	} else {
		return text
	}
}

Typer.speed = 2;
Typer.file = "rasmeipagnatoung.txt"; 
Typer.init();

var timer = setInterval("t();", 30);
function t() {
	Typer.addText({"keyCode": 123748});
	
	if (Typer.index > Typer.text.length) {
		clearInterval(timer);
	}
}

// Set the date we're counting down to
var countDownDate = new Date("Sept 1, 2015 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate + now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + " days " + hours + " hours "
  + minutes + " minutes " + seconds + " secondes ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);