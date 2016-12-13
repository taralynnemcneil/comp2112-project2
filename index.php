<!DOCTYPE html>
<head>
    <!-- Meta Data -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat Room</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <!-- JS - must load before page to get the users name -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="js/chat.js"></script>
    <script type="text/javascript">
    
        // ask the user for their name when the page opens    
        var name = prompt("Enter your chat name:", "Guest");
        
        // set the defalut name to Guest
    	if (!name || name === ' ') {
    	   name = "Guest";	
    	}
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	$("#name-area").html("You are: <span>" + name + "</span>");
    	
    	// start the chat room
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 
    		 
    		 // watch textarea for typing
             $("#sender").keydown(function(event) {  
             
                 var key = event.which;  
           
                 // set a max lengnth  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // stop typing if user passes the max length
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key
    		 $('#sender').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    			  }
             });
    	});
    </script>

</head>

<body onload="setInterval('chat.update()', 1000)">

    <div id="page-wrap">
    
        <h2>Project 2 - Chat</h2>
        
        <!-- Set up the name area -->
        <p id="name-area"></p>

        <!-- Set up the chat area -->
        <div id="chat-wrap"><div id="chat-area"></div></div>

        <!-- Set up the message area -->
        <form id="send-message-area">
            <p>Your message: </p>
            <textarea id="sender" maxlength = '100' ></textarea>
        </form>

    </div><!-- end div.page-wrap -->
</body>
</html>