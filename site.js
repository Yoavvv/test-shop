var arr = new Array();

function init() {
    var totalArray = localStorage.getItem("arr");
    
  
    if (totalArray.length != 0) {
     var arrObj = JSON.parse(totalArray);
        arr = arrObj;
        alert(arrObj);
      
        for (var i = 0; i < arr.length; i++) {
            addTask(arr[i].date, arr[i].time, arr[i].description);
        }
    }
}

function submitTask() {
    var getDateBox = document.getElementById("taskDate");
    var date = getDateBox.value;
    var getTimeBox = document.getElementById("taskTime");
    var time = getTimeBox.value;
    var getDescriptionBox = document.getElementById("description");
    var description = getDescriptionBox.value;
    
    if(date.length == 0 || time.length == 0 || description.length == 0) {
         document.getElementById("validateText").innerText = "Must fill all fields !!!";
        
    }else{
        
      addTaskDB(date, time, description); 
       
      addTaskLS();
        
      addTask(date, time, description);      
     
       deleteClick(); document.getElementById("validateText").innerText = ""; 
      document.getElementById('taskDate').value = "";
      document.getElementById('taskTime').value = "";
      document.getElementById('description').value = "";
      }
  }

function addTask(date, time, description) {
    
    var str = "<div class = 'tasksArea'><div class = 'delete'>" + "</div><div class = 'description'> " + description + "</div><div class = 'date'> " + date + " </div><div class = 'time'> " + time + " </div></div>";
  
   
    var div = document.createElement("div");
    
    div.innerHTML = str;
    var tasksBox = document.getElementById("tasksBox");
    tasksBox.appendChild(div);
    
    
    }

function addTaskDB(date, time, description) {
   arr.push({'date': date, 'time': time, 'description': description }); 
}

function addTaskLS () { 
      localStorage.setItem("arr", JSON.stringify(arr));
      }
function deleteClick() {
   
}
 
function createNewTask() {
    var id = +new Date();
    return id;
}

function deleteTask(newTask) {  
    var parent = document.getElementById("tasksBox");
    var child = document.querySelector("#tasksBox    .task[newTask='" + newTask + "']");
    parent.removeChild(child);
}

function deleteOnClick(newTask) {
    var allTasks = document.getElementsByClassName('delete');
    for (var i = 0; i < allTasks.length; i++) {
        allTasks[i].addEventListener("click", function () {
          deleteTask(newTask);
        });
    }
}

/* 

arr.push({'date': date, 'time': time, 'description': description});

var newTask = createNewTask();
        
      addTask(date, time, description, newTask);
        
      deleteOnClick(newTask); 
    }
}

function addTask(date, time, description, newTask) {
    var insideTask = '<div class = "task" newTask=' + newTask + '><div class = "delete"></div><div class = "description">' + description +  '</div><div class = "date">' + date + '</div><div class ="time">' + time + '</div></div>';
    var div = document.createElement('div');
    div.innerHTML = insideTask;
    var tasksBox = document.getElementById("tasksBox");
    tasksBox.appendChild(div.firstChild);
}

function createNewTask() {
    var nowStamp = +new Date();
    return nowStamp;
}

function deleteTask(newTask) {  
    var parent = document.getElementById("tasksBox");
    var child = document.querySelector("#tasksBox    .task[newTask='" + newTask + "']");
    parent.removeChild(child);
}

function deleteOnClick(newTask) {
    var allTasks = document.getElementsByClassName('delete');
    for (var i = 0; i < allTasks.length; i++) {
        allTasks[i].addEventListener("click", function () {
          deleteTask(newTask);
        });
    }
}
*/