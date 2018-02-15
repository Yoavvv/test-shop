var express = require("express");

var fs = require("fs");

var app = express();

var bodyParser = require("body-parser");

app.use(bodyParser.urlencoded({extended: true}));

app.use(express.static(__dirname));

var obj1 = {
    code: 12,
    name: "shirt",
    description: "cool",
    size: "l",
    price: 200
}
var obj2 = {
    code: 13,
    name: "pants",
    description: "ugly",
    size: "m",
    price: 40
}
var obj3 = {
    code: 14,
    name: "sport",
    description: "sweat",
    size: "xl",
    price: 600
}
var obj4 = {
    code: 15,
    name: "school",
    description: "expensive",
    size: "sm",
    price: 900
}
var obj5 = {
    code: 16,
    name: "socks",
    description: "warm",
    size: "xs",
    price: 75
}

var arr = [obj1, obj2, obj3, obj4, obj5];

fs.writeFile("./clothing.json", JSON.stringify(arr, null, 2));


app.get("/clothing", function(request, response){
    
    fs.readFile("./clothing.json", "utf-8", function(err, fileData){
        if(err) {
            response.send(err);
        }
        else {
            response.send(JSON.parse(fileData));
        }
    });
});

app.get("/product/:prodID", function(request, response){
    
    fs.readFile("./clothing.json", "utf-8", function(err, fileData){
        if(err) {
            response.send(err);
        }
        else {
            
            var arr = JSON.parse(fileData);
            
            for(var i = 0; i < arr.length; i++) {
                if(arr[i].code == request.params.prodID) {
                    response.send(arr[i]);
                }
            }
            
        }
    });

});

app.post("/addNewCloth", function(request, response) {
    var newcloth = request.body.newcloth;
    arr.push(newcloth);
    console.log(arr);
   response.send(arr); 
});



app.listen(3000, function(){
    console.log("Listening on http://localhost:3000");
});
