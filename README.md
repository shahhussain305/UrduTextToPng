# UrduTextToPng
Saving Urdu Text as a PNG image using html5 canvas.
<script>
$(function(){

    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");
	var $fontSize = document.getElementById("fontSize");
	var $canvasHeight = document.getElementById("canvasHeight");
	var $canvasWidth = document.getElementById("canvasWidth");
    var $txt=document.getElementById("txt");
	
    $txt.onkeyup=function(e){ redrawTexts(); }
	$fontSize.onkeyup=function(e){ redrawTexts(); }
	$canvasHeight.onkeyup=function(e){ redrawTexts(); }
	$canvasWidth.onkeyup=function(e){ redrawTexts(); }
    function redrawTexts(){
		canvas.height = $canvasHeight.value;
		canvas.width = $canvasWidth.value;
		ctx.clearRect(0,0,canvas.width,canvas.height); 
        wrapText(ctx,$txt.value,0,60,canvas.width,$fontSize.value,"Jameel Noori Nastaleeq");
    }

    function wrapText(context, text, x, y, maxWidth, fontSize, fontFace){
      var words = text.split(' ');
      var line = '';
      var lineHeight=40;

 	  context.font=fontSize+"px "+fontFace;
      for(var n = 0; n < words.length; n++) {
        var testLine = line + words[n] + ' ';
        var metrics = context.measureText(testLine);
        var testWidth = metrics.width;
        if(testWidth > maxWidth) {
          context.fillText(line, x, y);
          line = words[n] + ' ';
          y += lineHeight;
        }
        else {
          line = testLine;
        }
      }
      context.fillText(' '+line+' ', x, y);
      return(y);
    }

}); // end $(function(){});
//save canvas as image
function saveImage(){
	try{
		var canvas = document.getElementById("canvas");
		var data = canvas.toDataURL("image/png");
		$.ajax({
			url: "pages/saveAsImage.php",
			data:{data:data},
			type:"POST",
			success:function(r){
				$("#result").html(r);
			}
			
		});
	}catch(e){
		alert(e.message);
	}
}
</script>
Set Canvas Height = <input type="text" id="canvasHeight" value="300"> :: 
Set Canvas Width = <input type="text" id="canvasWidth" value="300"> :: 
Set Canvas Font Size = <input type="text" value="25" id="fontSize"><br>
<textarea rows="4" cols="40" style="width: 600px;" id="txt"></textarea><br>
   <canvas id="canvas" width="300" height="300" dir="ltr"></canvas>
<input type="button" onClick="saveImage();" value="Save as Image"> 
 <div id="result"></div>  
  
