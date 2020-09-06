<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example for Data Class</title>
    <link href="style.css" rel="stylesheet"> 
    <link rel="stylesheet" href= "https://bootswatch.com/3/darkly/bootstrap.min.css">
</head>
<body>
<div class="container">
                  <nav class="navbar">
                    <img src="logo1.png">
                <ul>
                    <li class="active"><a>Home</a></li>
                    <li><a>Order</a></li>
                    </ul>  
                </nav>     
                 
                 <div id="heading">
                    <h1 align="center">Welcome To Davids Restaurant</h1>
                    <h2 align="center">Place your order</h2>
                </div>
                <div id="opselect" align="center">
                    <label>Choose Your Menulist :- </label>
<select id="menu" onchange="getOrderByid()">
<option selected>Items</option>
</select>
</div>
</div>
     <div class="display">
         <b>Your order details <b><br>
      <b>ID: </b><span id="Id"></span><br>
      <b> Short Name :</b><span id="S_name"></span><br>
      <b> Name :</b><span id="name"></span><br>
      <b> Description: </b><span id="Desc"></span><br>
      <b> Cost of small portion :</b><span id="s_cost"></span><br> 
      <b> Cost of large portion :</b><span id="l_cost"></span><br>
      <b> Small Portion name :</b><span id="s_p_name"></span><br>
      <b> Large portion name :</b><span id="l_p_name"></span><br>
    </div>

    <div class="footer">
    <p>All Rights Reserved The Davids Restaurant</p>
    </div>


    <script src="jquery-3.5.1.min.js"></script>
    <script>
let base_url ="http://localhost/WT-Php/menu.php";

var output ='';
var g;
var items;
var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
		var response = 	JSON.parse(xhttp.responseText);
		items = response.menu_items;
        // var output ='';
		for(var i=0;i<items.length;i++)
		{
			output = output +"<option>"+ items[i].name+"</option>";
		}
        document.getElementById('menu').innerHTML=output;
        g = document.getElementById('menu');
	}
};
xhttp.open("GET","restaurant.json",true);
xhttp.send();
        
        $("document").ready(function(){
            getOrderNameList();
            getOrderByid();
        });

        function getOrderNameList() {
            let url = base_url + "?req=name_list";
        }

        function getOrderByid() {
            var d = g.selectedIndex;
            var orderid = items[d].id;
            let url = base_url + "?req=restro&id="+ orderid;
            $.get(url,function(data,success){
                document.getElementById('Id').innerHTML= data.id ;
                document.getElementById('S_name').innerHTML= data.short_name ;
                document.getElementById('name').innerHTML= data.name ;
                document.getElementById('Desc').innerHTML= data.description;
                document.getElementById('s_cost').innerHTML= data.price_small ;
                document.getElementById('l_cost').innerHTML= data.price_large ;
                document.getElementById('s_p_name').innerHTML= data.small_portion_name ;
                document.getElementById('l_p_name').innerHTML= data.large_portion_name ;

            });
        }

    </script>
</body>
</html>