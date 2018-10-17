			<script>
				msieversion();
				function msieversion() 
					{
						
						var ua = window.navigator.userAgent;
						var msie = ua.indexOf("Edge");
						if(msie > 0){
							var onPrintFinished=function(printed){console.log("do something...");}
							console.log("Loged string!!");
							//print command
							onPrintFinished(window.print());
							
						}else{
							console.log(ua);
						}
					}
			</script>
		