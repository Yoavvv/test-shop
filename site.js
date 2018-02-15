(function(){
    
    "use strict";
    
    $(function(){
        
        $.ajax({
            
            method: "GET",
            
            url: "/clothing",
            
            cache: false, 
            
            dataType: "json",
            
            success: function(response) {
                
                for(var i = 0; i < response.length; i++) {
                    var tdID = "<td>" + response[i].code + "</td>";
                    var tdName = "<td>" + response[i].name + "</td>";
                    var tdDescription = "<td>" + response[i].description + "</td>";
                    var tdSize = "<td>" + response[i].size + "</td>";
                    var tdPrice = "<td>" + response[i].price + "</td>";
                    var tr = "<tr>" + tdID + tdName + tdDescription + tdSize + tdPrice + "</tr>";
                    $("#tableClothing").append(tr);
                }
            },
            
            error: function(err) {
                alert("Error: " + err.status + ", " + err.statusText);
            }
            
        });
        
        $.ajax({
            
            method: "POST",
            
            url: "/addNewCloth",
            
            cache: false, 
            
            dataType: "json",
            
            success: function(response) {
                
                for(var i = 0; i < response.length; i++) {
                    var tdID = "<td>" + response[i].code + "</td>";
                    var tdName = "<td>" + response[i].name + "</td>";
                    var tdDescription = "<td>" + response[i].description + "</td>";
                    var tdSize = "<td>" + response[i].size + "</td>";
                    var tdPrice = "<td>" + response[i].price + "</td>";
                    var tr = "<tr>" + tdID + tdName + tdDescription + tdSize + tdPrice + "</tr>";
                    $("#tableClothing").append(tr);
                }
            },
            
            error: function(err) {
                alert("Error: " + err.status + ", " + err.statusText);
            }
            
        });
        
        $("#buttonShow").click(function(){
            
            $.ajax({
            
            method: "GET",
            
            url: "/product/" + $("#textBoxProductID").val(),
            
            cache: false, 
            
            dataType: "json",
            
            success: function(response) {
                
                $("#spanProductName").text("Product Name: " + response.name);
                $("#spanDescription").text("Description: " + response.description);
                $("#spanSize").text("Size: " + response.size);
                $("#spanPrice").text("Price: " + response.price);
                
            },
            
            error: function(err) {
                alert("Error: " + err.status + ", " + err.statusText);
            }
            
        });
                   
    });
        
  });    
    
})();
